<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sites;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use File;
use Illuminate\Support\Str;

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
                'site_name'=>'required|unique:sites|max:255',
                'site_img'=>'required',
                'site_color'=>'required|max:255'
            ],
            [
                'site_name.required'=>"กรุณาป้อนชื่อกองงานด้วยครับ",
                'site_name.max' => "ห้ามป้อนเกิน 255 ตัวอักษร",
                'site_name.unique'=>"มีชื่อกองงานนี้ในระบบแล้วครับ",

                'site_img.required'=>"กรุณาเลือกรูปโลโก้ด้วยครับ",

                'site_color.required'=>"กรุณาเลือกธีมด้วยครับ",
                'site_color.max' => "ห้ามป้อนเกิน 255 ตัวอักษร",

            ]
        );
        $random = Str::random(2);
        $site_path_folder_md5 = md5($request->site_name."_".$random);
        $path_site_path_folder = public_path().'/image/' . $site_path_folder_md5;
        $make_site_path_folder = File::makeDirectory($path_site_path_folder, $mode = 0777, true, true);
        if($make_site_path_folder){
            $year_new = date('Y');
            $path_year = $path_site_path_folder.'/'.$year_new;
            $make_year = File::makeDirectory($path_year, $mode = 0777, true, true);
            if($make_year){
                $path_details_attached = $path_year.'/attached';
                $make_details_attached = File::makeDirectory($path_details_attached, $mode = 0777, true, true);
                //++++++++++++++//++++++++++++++//++++++++++++++//++++++++++++++//++++++++++++++
                $path_details_original = $path_year.'/original';
                $make_details_original = File::makeDirectory($path_details_original, $mode = 0777, true, true);
                //++++++++++++++//++++++++++++++//++++++++++++++//++++++++++++++//++++++++++++++
                $path_details_center = $path_year.'/center';
                $make_details_center = File::makeDirectory($path_details_center, $mode = 0777, true, true);
                //++++++++++++++//++++++++++++++//++++++++++++++//++++++++++++++//++++++++++++++
                $path_details_group = $path_year.'/group';
                $make_details_group = File::makeDirectory($path_details_group, $mode = 0777, true, true);
                //++++++++++++++//++++++++++++++//++++++++++++++//++++++++++++++//++++++++++++++
                $path_details_division = $path_year.'/division';
                $make_details_division = File::makeDirectory($path_details_division, $mode = 0777, true, true);
                //++++++++++++++//++++++++++++++//++++++++++++++//++++++++++++++//++++++++++++++
                $path_details_department = $path_year.'/department';
                $make_details_department = File::makeDirectory($path_details_department, $mode = 0777, true, true);
                //++++++++++++++//++++++++++++++//++++++++++++++//++++++++++++++//++++++++++++++
                $path_details_work = $path_year.'/work';
                $make_details_work = File::makeDirectory($path_details_work, $mode = 0777, true, true);
                //++++++++++++++//++++++++++++++//++++++++++++++//++++++++++++++//++++++++++++++
                $path_details_respond = $path_year.'/respond';
                $make_details_respond = File::makeDirectory($path_details_respond, $mode = 0777, true, true);
         
            }else{
                return redirect()->back()->with('error','พบปัญหาการเพิ่มข้อมูลกรุณาแจ้งผู้พัฒนา [make_year]!');
            }
        }else{
            return redirect()->back()->with('error','พบปัญหาการเพิ่มข้อมูลกรุณาแจ้งผู้พัฒนา [make_site_path_folder]!');
        }

        if($make_details_attached && $make_details_original && $make_details_center &&
        $make_details_group && $make_details_division && $make_details_department &&
        $make_details_work && $make_details_respond && $make_details_respond_retrun){

            //การเข้ารหัสรูปภาพ
            $sign_image = $request->file('site_img');

            //Generate ชื่อภาพ
            $name_gen=hexdec(uniqid());
            // ดึงนามสกุลไฟล์ภาพ
            $site_img_ext = strtolower($sign_image->getClientOriginalExtension());
            $site_img_name = $name_gen.'.'.$site_img_ext;

            //อัพโหลดและบันทึกข้อมูล
            $upload_location = 'image/';
            $full_path = $upload_location.$site_img_name;
    
            $sign_image->move($upload_location,$site_img_name);

            //บันทึกข้อมูล
            $data = array();
            $data["site_name"] = $request->site_name;
            $data["site_path_folder"] = $site_path_folder_md5;
            $data["site_img"] = $full_path;
            $data["site_color"] = $request->site_color;
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
                'site_name'=>'required|max:255',
                'site_img'=>'required',
                'site_color'=>'required|max:255'
            ],
            [
                'site_name.required'=>"กรุณาป้อนชื่อกองงานด้วยครับ",
                'site_name.max' => "ห้ามป้อนเกิน 255 ตัวอักษร",

                'site_img.required'=>"กรุณาเลือกรูปโลโก้ด้วยครับ",

                'site_color.required'=>"กรุณาเลือกธีมด้วยครับ",
                'site_color.max' => "ห้ามป้อนเกิน 255 ตัวอักษร",
            ]
        );

        $site_image = $request->file('site_img');
        //Generate ชื่อภาพ
        $name_gen=hexdec(uniqid());
        // ดึงนามสกุลไฟล์ภาพ
        $site_img_ext = strtolower($site_image->getClientOriginalExtension());
        $site_img_name = $name_gen.'.'.$site_img_ext;
             
        //อัพโหลดและบันทึกข้อมูล
        $upload_location = 'image/';
        $full_path = $upload_location.$site_img_name;

        //ลบภาพเก่าและอัพภาพใหม่แทนที่
        $old_site = $request->old_site_img;
        unlink($old_site);
             
        $site_image->move($upload_location,$site_img_name);

        //query
        $update = DB::table('sites')->where('site_id', $request->site_id)->update([
            'site_name'=>$request->site_name,
            'site_img'=>$full_path,
            'site_color'=>$request->site_color,
            'site_updated_at'=>date('Y-m-d H:i:s')
        ]);
        
        if($update){
            return redirect()->back()->with('success',"อัพเดตข้อมูลเรียบร้อย");
        }else{
            return redirect()->back()->with('error','พบปัญหาการอัพเดตข้อมูลกรุณาแจ้งผู้พัฒนา !');
        }
    }
}
