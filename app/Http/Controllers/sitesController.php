<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sites;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use File;

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

        $site_path_folder_md5 = md5($request->site_name);
        $path_site_path_folder = public_path().'/image/' . $site_path_folder_md5;
        $make_site_path_folder = File::makeDirectory($path_site_path_folder, $mode = 0777, true, true);
        if($make_site_path_folder){
            $year_new = date('Y');
            $path_year = $path_site_path_folder.'/'.$year_new;
            $make_year = File::makeDirectory($path_year, $mode = 0777, true, true);
            if($make_year){
                $path_details_attachedfile = $path_year.'/attachedfile';
                $make_details_attachedfile = File::makeDirectory($path_details_attachedfile, $mode = 0777, true, true);
                //++++++++++++++//++++++++++++++//++++++++++++++//++++++++++++++//++++++++++++++
                $path_details_fileseal00 = $path_year.'/fileseal00';
                $make_details_fileseal00 = File::makeDirectory($path_details_fileseal00, $mode = 0777, true, true);
                //++++++++++++++//++++++++++++++//++++++++++++++//++++++++++++++//++++++++++++++
                $path_details_fileseal01 = $path_year.'/fileseal01';
                $make_details_fileseal01 = File::makeDirectory($path_details_fileseal01, $mode = 0777, true, true);
                //++++++++++++++//++++++++++++++//++++++++++++++//++++++++++++++//++++++++++++++
                $path_details_upload = $path_year.'/upload';
                $make_details_upload = File::makeDirectory($path_details_upload, $mode = 0777, true, true);
                //++++++++++++++//++++++++++++++//++++++++++++++//++++++++++++++//++++++++++++++
                $path_details_respond = $path_year.'/respond';
                $make_details_respond = File::makeDirectory($path_details_respond, $mode = 0777, true, true);
                //++++++++++++++//++++++++++++++//++++++++++++++//++++++++++++++//++++++++++++++
                $path_details_respond_retrun = $path_year.'/respond_retrun';
                $make_details_respond_retrun = File::makeDirectory($path_details_respond_retrun, $mode = 0777, true, true);
            }else{
                return redirect()->back()->with('error','พบปัญหาการเพิ่มข้อมูลกรุณาแจ้งผู้พัฒนา [make_year]!');
            }
        }else{
            return redirect()->back()->with('error','พบปัญหาการเพิ่มข้อมูลกรุณาแจ้งผู้พัฒนา [make_site_path_folder]!');
        }

        if($make_details_attachedfile && $make_details_fileseal00 && $make_details_fileseal01 &&
        $make_details_upload && $make_details_respond && $make_details_respond_retrun){
            //บันทึกข้อมูล
            $data = array();
            $data["site_name"] = $request->site_name;
            $data["site_path_folder"] = $site_path_folder_md5;
            $data["site_created_at"] = date('Y-m-d H:i:s');

            //query builder
            $insert = DB::table('sites')->insert($data);
            if($insert){
                return redirect()->back()->with('success',"บันทึกข้อมูลกองงานเรียบร้อย");
            }else{
                return redirect()->back()->with('error','พบปัญหาการเพิ่มข้อมูลกรุณาแจ้งผู้พัฒนา !');
            }
        }else{
            return redirect()->back()->with('error','พบปัญหาการเพิ่มข้อมูลกรุณาแจ้งผู้พัฒนา [make_details.......]!');
        }
       
    }

    //delete_กองงาน
    public function delete(Request $request){
        $delete = DB::table('sites')->where('site_id', $request->site_id)->delete();
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
            return redirect()->back()->with('error','พบปัญหาการอัพเดตข้อมูลกรุณาแจ้งผู้พัฒนา !');
        }
    }
}
