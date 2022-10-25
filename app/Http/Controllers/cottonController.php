<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cottons;
use App\Models\Groupmem;
use App\Models\sites;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class cottonController extends Controller
{
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    //หน้ากลัก
    public function index(){
        $cottonS=cottons::orderBy('cottons.cottons_id', 'DESC')->get();
        $select_groupmemsS=Groupmem::join('sites','sites.site_id','groupmems.group_site_id')->get();
        return view('admin.cotton.index',compact('cottonS','select_groupmemsS'));
    }

    //insert_กอองาน
    public function add(Request $request){
        //ตรวจสอบข้อมูลที่กรอกเข้ามาก่อน
        $request->validate(
            [
                'cottons_name'=>'required|max:255',
                'cottons_group'=>'required|max:255'
            ],
            [
                'cottons_name.required'=>"กรุณาป้อนชื่อฝ่ายด้วยครับ",
                'cottons_name.max' => "ห้ามป้อนเกิน 255 ตัวอักษร",

                'cottons_group.required'=>"กรุณาเลือกกองงานด้วยครับ",
                'cottons_group.max' => "ห้ามป้อนเกิน 255 ตัวอักษร"
            ]
        );

        $insert = cottons::insert([
            'cottons_name'=>$request->cottons_name,
            'cottons_group'=>$request->cottons_group,
            'cottons_created_at'=>date('Y-m-d H:i:s')
        ]);

        if($insert){
            return redirect()->back()->with('success',"บันทึกข้อมูลเรียบร้อย");
        }else{
            return redirect()->back()->withErrors('พบปัญหาการเพิ่มข้อมูลกรุณาแจ้งผู้พัฒนา !');
        }

    }

    //delete
    public function delete(Request $request){
        $delete = cottons::where('cottons_id', $request->cottons_id)->delete();
        if($delete){
            return redirect()->back()->with('success',"ลบข้อมูลเรียบร้อย");
        }else{
            return redirect()->back()->withErrors('พบปัญหาการลบข้อมูลกรุณาแจ้งผู้พัฒนา !');
        }
    }

    //update_กอองาน
    public function update(Request $request){
        //ตรวจสอบข้อมูล
        $request->validate(
            [
                'cottons_name'=>'required|max:255'
            ],
            [
                'cottons_name.required'=>"กรุณาป้อนชื่อฝ่ายด้วยครับ",
                'cottons_name.max' => "ห้ามป้อนเกิน 255 ตัวอักษร"
            ]
        );

       //query
       $update = cottons::where('cottons_id', $request->cottons_id)->update([
        'cottons_name'=>$request->cottons_name,
        'cottons_updated_at'=>date('Y-m-d H:i:s')
        ]);
        
        if($update){
            return redirect()->back()->with('success',"อัพเดตข้อมูลเรียบร้อย");
        }else{
            return redirect()->back()->withErrors('พบปัญหาการอัพเดตข้อมูลกรุณาแจ้งผู้พัฒนา !');
        }
    }
}
