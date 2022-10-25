<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sites;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class sitesController extends Controller
{
    //

    //หน้ากลัก
    public function index(){
        $sitesrS=sites::get();
        return view('admin.sites.index',compact('sitesrS'));
    }

     //insert_กอองาน
     public function add(Request $request){
        //ตรวจสอบข้อมูลที่กรอกเข้ามาก่อน
        $request->validate(
            [
                'site_name'=>'required|unique:sites|max:255'
            ],
            [
                'site_name.required'=>"กรุณาป้อนชื่อกองงานด้วยครับ",
                'site_name.max' => "ห้ามป้อนเกิน 255 ตัวอักษร",
                'site_name.unique'=>"มีชื่อกองงานนี้ในระบบแล้วครับ"
            ]
        );
        //บันทึกข้อมูล
        $data = array();
        $data["site_name"] = $request->site_name;
        $data["site_created_at"] = date('Y-m-d H:i:s');

        //query builder
        $insert = DB::table('sites')->insert($data);
        if($insert){
            return redirect()->back()->with('success',"บันทึกข้อมูลกองงานเรียบร้อย");
        }else{
            return redirect()->back()->withErrors('พบปัญหาการเพิ่มข้อมูลกรุณาแจ้งผู้พัฒนา !');
        }
    }

    //delete_กองงาน
    public function delete(Request $request){
        $delete = DB::table('sites')->where('site_id', $request->site_id)->delete();
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
                'site_name'=>'required|unique:sites|max:255'
            ],
            [
                'site_name.required'=>"กรุณาป้อนชื่อกองงานด้วยครับ",
                'site_name.max' => "ห้ามป้อนเกิน 255 ตัวอักษร",
                'site_name.unique'=>"มีชื่อกองงานนี้ในระบบแล้วครับ"
            ]
        );
        //query
        $update = DB::table('sites')->where('site_id', $request->site_id)->update([
            'site_name'=>$request->site_name,
            'site_updated_at'=>date('Y-m-d H:i:s')
        ]);
        
        if($update){
            return redirect()->back()->with('success',"อัพเดตข้อมูลเรียบร้อย");
        }else{
            return redirect()->back()->withErrors('พบปัญหาการอัพเดตข้อมูลกรุณาแจ้งผู้พัฒนา !');
        }
    }
}
