<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\token;
use App\Models\sites;

class controltokensController extends Controller
{
    //
    public function index(){
        $tokenS = token::Join('sites','sites.site_id','tokens.token_site_id')->get();
        $sitesS = sites::get();
        return view('admin.controltokens.index',compact('tokenS','sitesS'));
    }

    public function add(Request $request){
        //ตรวจสอบข้อมูลที่กรอกเข้ามาก่อน
        $request->validate(
            [
                'token_token'=>'required|max:255',
                'token_site_id'=>'required|max:255',
                'token_level'=>'required|max:255'
            ],
            [
                'token_token.required'=>"กรุณาป้อน token ด้วยครับ",
                'token_token.max' => "ห้ามป้อนเกิน 255 ตัวอักษร",

                'token_site_id.required'=>"กรุณาเลือก site ด้วยครับ",
                'token_site_id.max' => "ห้ามป้อนเกิน 255 ตัวอักษร",

                'token_level.required'=>"กรุณาเลือกสิทธิ์ด้วยครับ",
                'token_level.max' => "ห้ามป้อนเกิน 255 ตัวอักษร"
            ]
        );

        if($request->token_level == '3' && $request->token_seal == ''){
            return redirect()->back()->with('error','กรุณาใส่รูปประทับตรา (บังคับ) ด้วยครับ !');
        }

        $tokenS = token::where('token_site_id', $request->token_site_id)
        ->where('token_level', $request->token_level)
        ->first();
        if($tokenS){
            return redirect()->back()->with('error','มีในระบบแล้ว !');
        }

        //เช็คว่ามีการแนบไฟล์รูปไหม
        if($request->token_seal != ''){
            //การเข้ารหัสรูปภาพ
            $token_seal = $request->file('token_seal');

            //Generate ชื่อภาพ
            $name_gen=hexdec(uniqid());
            // ดึงนามสกุลไฟล์ภาพ
            $token_seal_ext = strtolower($token_seal->getClientOriginalExtension());
            $token_seal_name = $name_gen.'.'.$token_seal_ext;
            
            
            //อัพโหลดและบันทึกข้อมูล
            $upload_location = 'image/seal/';
            $full_path = $upload_location.$token_seal_name;

            $token_seal->move($upload_location,$token_seal_name);
        }else{
            $full_path = '';
        }

        $insert = token::insert([
            'token_site_id'=>$request->token_site_id,
            'token_level'=>$request->token_level,
            'token_token'=>$request->token_token,
            'token_seal'=>$full_path
        ]);

        if($insert){
            return redirect()->back()->with('success',"บันทึกข้อมูลเรียบร้อย");
        }else{
            return redirect()->back()->with('error','พบปัญหาการเพิ่มข้อมูลกรุณาแจ้งผู้พัฒนา !');
        }

    }

    public function delete(Request $request){

        $del_old = unlink($request->token_seal);
        if(!$del_old){
            return redirect()->back()->with('error','พบปัญหากรุณาแจ้งผู้พัฒนา ![del_old]');
        }

        $delete = token::where('token_id', $request->token_id)->delete();

        if($delete){
            return redirect()->back()->with('success',"ลบข้อมูลเรียบร้อย");
        }else{
            return redirect()->back()->with('error','พบปัญหาการลบข้อมูลกรุณาแจ้งผู้พัฒนา !');
        }
    }

    public function update(Request $request){
         //ตรวจสอบข้อมูลที่กรอกเข้ามาก่อน
         $request->validate(
            [
                'token_token'=>'required|max:255'
            ],
            [
                'token_token.required'=>"กรุณาป้อน token ด้วยครับ",
                'token_token.max' => "ห้ามป้อนเกิน 255 ตัวอักษร"
            ]
        );

        //เช็คว่ามีการแนบไฟล์รูปไหม
        if($request->token_seal != ''){
            //การเข้ารหัสรูปภาพ
            $token_seal = $request->file('token_seal');

            //Generate ชื่อภาพ
            $name_gen=hexdec(uniqid());
            // ดึงนามสกุลไฟล์ภาพ
            $token_seal_ext = strtolower($token_seal->getClientOriginalExtension());
            $token_seal_name = $name_gen.'.'.$token_seal_ext;
            
            
            //อัพโหลดและบันทึกข้อมูล
            $upload_location = 'image/seal/';
            $full_path = $upload_location.$token_seal_name;

            $token_seal->move($upload_location,$token_seal_name);

            $update_img = token::where('token_id', $request->token_id)->update([
                'token_seal'=>$full_path
            ]);

            $del_old = unlink($request->token_seal_old);
           
        }

        //query
        $update = token::where('token_id', $request->token_id)->update([
            'token_token'=>$request->token_token
        ]);

        if($update){
            return redirect()->back()->with('success',"แก้ไขข้อมูลเรียบร้อย");
        }else{
            return redirect()->back()->with('error','พบปัญหาการแก้ไขข้อมูลกรุณาแจ้งผู้พัฒนา !');
        }
    }

}
