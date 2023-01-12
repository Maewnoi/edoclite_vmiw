<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Groupmem;
use App\Models\sites;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class GroupmemController extends Controller
{
    //หน้ากลัก
    public function index(){
       

        if(Auth::user()->level=='0'){
             $GroupmemS=Groupmem::orderBy('group_id', 'DESC')
             ->get();
             $sitesS=sites::get();
        }else if(Auth::user()->level=='3'){

            $GroupmemS=Groupmem::where('group_site_id',Auth::user()->site_id)
            ->orderBy('group_id', 'DESC')
             ->get();
             $sitesS=sites::where('site_id',Auth::user()->site_id)
             ->get();
             
        }
        
        // dd($GroupmemS);
        return view('admin.groupmem.index',compact('GroupmemS','sitesS'));
    }

    //insert_กอองาน
    public function add(Request $request){
        //ตรวจสอบข้อมูลที่กรอกเข้ามาก่อน
        $request->validate(
            [
                'group_name'=>'required|max:255',
                'group_site_id'=>'required|max:255',
                'group_seal'=>'required|max:255'
            ],
            [
                'group_name.required'=>"กรุณาป้อนชื่อกองงานด้วยครับ",
                'group_name.max' => "ห้ามป้อนเกิน 255 ตัวอักษร",

                'group_site_id.required'=>"กรุณาเลือก Sites ด้วยครับ",
                'group_site_id.max' => "ห้ามป้อนเกิน 255 ตัวอักษร",

                'group_seal.required'=>"กรุณาเลือกรูปประทับตรา ด้วยครับ",
                'group_seal.max' => "ห้ามป้อนเกิน 255 ตัวอักษร"
            ]
        );

        $Groupmem_check = Groupmem::where('group_name', $request->group_name)
        ->where('group_site_id', $request->group_site_id)
        ->first();
        if($Groupmem_check){
            return redirect()->back()->with('error','ตรวจพบชื่อกองงาน '.$Groupmem_check->group_name.' มีในระบบแล้ว');
        }

         //เช็คว่ามีการแนบไฟล์รูปไหม
         if($request->group_seal != ''){
            //การเข้ารหัสรูปภาพ
            $group_seal = $request->file('group_seal');

            //Generate ชื่อภาพ
            $name_gen=hexdec(uniqid());
            // ดึงนามสกุลไฟล์ภาพ
            $group_seal_ext = strtolower($group_seal->getClientOriginalExtension());
            $group_seal_name = $name_gen.'.'.$group_seal_ext;
            
            
            //อัพโหลดและบันทึกข้อมูล
            $upload_location = 'image/seal/';
            $full_path = $upload_location.$group_seal_name;

            $group_seal->move($upload_location,$group_seal_name);
        }else{
            $full_path = '';
        }

        //บันทึกข้อมูล
        $data = array();
        $data["group_site_id"] = $request->group_site_id;
        $data["group_name"] = $request->group_name;
        $data["group_token"] = $request->group_token;
        $data["group_seal"] = $full_path;
        $data["group_created_at"] = date('Y-m-d H:i:s');

        //query builder
        $insert = DB::table('groupmems')->insert($data);
        if($insert){
            return redirect()->back()->with('success',"บันทึกข้อมูลกองงานเรียบร้อย");
        }else{
            return redirect()->back()->with('error','พบปัญหาการเพิ่มข้อมูลกรุณาแจ้งผู้พัฒนา !');
        }
        
    }
    //delete_กองงาน
    public function delete(Request $request){
        $del_old = unlink($request->group_seal);
        if(!$del_old){
            return redirect()->back()->with('error','พบปัญหากรุณาแจ้งผู้พัฒนา ![del_old]');
        }

        $delete = DB::table('groupmems')->where('group_id', $request->group_id)->delete();
        if($delete){
            return redirect()->back()->with('success',"ลบข้อมูลเรียบร้อย");
        }else{
            return redirect()->back()->with('error','พบปัญหาการลบข้อมูลกรุณาแจ้งผู้พัฒนา !');
        }
    }

    //update_กอองาน
    public function update(Request $request){
        //ตรวจสอบข้อมูล
        $request->validate(
            [
                'group_name'=>'required|max:255',
                'group_site_id'=>'required|max:255'
            ],
            [
                'group_name.required'=>"กรุณาป้อนชื่อกองงานด้วยครับ",
                'group_name.max' => "ห้ามป้อนเกิน 255 ตัวอักษร",


                'group_site_id.required'=>"กรุณาเลือก Sites ด้วยครับ",
                'group_site_id.max' => "ห้ามป้อนเกิน 255 ตัวอักษร"
            ]
        );

        $Groupmem_check = Groupmem::where('group_name', $request->group_name)
        ->where('group_site_id', $request->group_site_id)
        ->where('group_id','!=', $request->group_id)
        ->first();
        if($Groupmem_check){
            return redirect()->back()->with('error','ตรวจพบชื่อกองงาน '.$Groupmem_check->group_name.' มีในระบบแล้ว');
        }

        //เช็คว่ามีการแนบไฟล์รูปไหม
        if($request->group_seal != ''){
            //การเข้ารหัสรูปภาพ
            $group_seal = $request->file('group_seal');

            //Generate ชื่อภาพ
            $name_gen=hexdec(uniqid());
            // ดึงนามสกุลไฟล์ภาพ
            $group_seal_ext = strtolower($group_seal->getClientOriginalExtension());
            $group_seal_name = $name_gen.'.'.$group_seal_ext;
            
            
            //อัพโหลดและบันทึกข้อมูล
            $upload_location = 'image/seal/';
            $full_path = $upload_location.$group_seal_name;

            $group_seal->move($upload_location,$group_seal_name);

            $update_img = DB::table('groupmems')->where('group_id', $request->group_id)->update([
                'group_seal'=>$full_path
            ]);

            $del_old = unlink($request->group_seal_old);
        }else{
            $full_path = '';
        }

        //query
        $update = DB::table('groupmems')->where('group_id', $request->group_id)->update([
            'group_site_id'=>$request->group_site_id,
            'group_name'=>$request->group_name,
            'group_token'=>$request->group_token,
            'group_updated_at'=>date('Y-m-d H:i:s')
        ]);
        
        if($update){
            return redirect()->back()->with('success',"อัพเดตข้อมูลเรียบร้อย");
        }else{
            return redirect()->back()->with('error','พบปัญหาการอัพเดตข้อมูลกรุณาแจ้งผู้พัฒนา !');
        }
    }
}