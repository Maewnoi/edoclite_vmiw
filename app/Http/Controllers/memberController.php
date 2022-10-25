<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Groupmem;
use App\Models\sites;
use App\Models\cottons;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\functionController;

class memberController extends Controller
{
    use PasswordValidationRules;
    //หน้ากลัก
    public function index(){
        $memberS=User::where('users.level', '!=' , '0')
        ->leftJoin('groupmems','groupmems.group_id','users.group')
        ->orderBy('users.id', 'DESC')
        ->get();

        $select_groupmemsS=Groupmem::join('sites','sites.site_id','groupmems.group_site_id')->get();

        $select_sitesS=sites::get();
        return view('admin.member.index',compact('memberS','select_groupmemsS','select_sitesS'));
    }

    //เพิ่มชื่อผู้ใช้
    public function add(Request $request){
         //ตรวจสอบข้อมูลที่กรอกเข้ามาก่อน
        $request->validate(
            [
                'email'=>'required|unique:users|max:255',
                'password'=> $this->passwordRules(),
                'name'=>'required|unique:users|max:255',
                'level'=>'required|max:255',
                'pos'=>'required|max:255',
                'tel'=>'required|unique:users|min:10|max:10',
                'submem'=>'max:255|nullable',
                'head'=>'max:255|nullable',
                'sign'=>'max:255|nullable|mimes:jpg,jpeg,png,bmp,tiff |max:4096',
            ],
            [
                'email.required'=>"กรุณาป้อนชื่อผู้ใช้หรืออีเมลด้วยครับ",
                'email.max' => "ห้ามป้อนเกิน 255 ตัวอักษร",
                'email.unique'=>"มีชื่อผู้ใช้หรืออีเมลนี้ในระบบแล้วครับ",

                'name.required'=>"กรุณาป้อนชื่อ-นามสกุลด้วยครับ",
                'name.max' => "ห้ามป้อนเกิน 255 ตัวอักษร",
                'name.unique'=>"มีชื่อชื่อ-นามสกุลนี้ในระบบแล้วครับ",

                'level.required'=>"กรุณาเลือกสิทธิ์ด้วยครับ",
                'level.max' => "ห้ามป้อนเกิน 255 ตัวอักษร",

                'pos.required'=>"กรุณาป้อนตำแหน่งด้วยครับ",
                'pos.max' => "ห้ามป้อนเกิน 255 ตัวอักษร",

                'tel.required'=>"กรุณาป้อนเบอร์โทรศัพท์ด้วยครับ",
                'tel.min' => "กรุณาป้อนเบอร์โทรศัพท์ให้ครบ 10 หลัก",
                'tel.max' => "กรุณาป้อนเบอร์โทรศัพท์ให้ครบ 10 หลัก",
                'tel.unique'=>"มีเบอร์โทรศัพท์นี้ในระบบแล้วครับ",

                'sign.max'=>"ชื่อไฟล์มีตัวอักษรเกิน 255",
                'sign.mimes'=>"รองรับไฟล์นามสกุล jpg,jpeg,png,bmp,tiff เท่านั้น",
                'sign.max'=>"รองรับไฟล์ขนาดไม่เกิน 4MB",
            ]
        );

        if($request->cotton != ''){
            $cotton = $request->cotton;
        }else{
            $cotton = '0';
        }

        if($request->group != ''){
            $Select_Sites = Groupmem::where('groupmems.group_id', $request->group)
            ->join('sites','sites.site_id','groupmems.group_site_id')
            ->first();
            $sites = $Select_Sites->site_id;
        }else{
            $sites = $request->sites;
        }

        //ตรวจสอบสิทธิฺซั้าในระบบ
        if($request->level == '1'||$request->level == '3'||$request->level == '4'||$request->level == '6'){
            $memberS_Check = User::where('users.level', $request->level)
            ->where('users.site_id', $sites)
            ->first();
            if($memberS_Check){
                return redirect()->back()->withErrors('ตรวจพบคุณ '.$memberS_Check->name.' ถือสิทธิ์ '.functionController::funtion_user_level($memberS_Check->level).' ในระบบแล้ว');
            }
        }
            
        //เช็คว่ามีการแนบไฟล์รูปไหม
        if($request->sign != ''){
            //การเข้ารหัสรูปภาพ
            $sign_image = $request->file('sign');

            //Generate ชื่อภาพ
            $name_gen=hexdec(uniqid());
            // ดึงนามสกุลไฟล์ภาพ
            $sign_img_ext = strtolower($sign_image->getClientOriginalExtension());
            $sign_img_name = $name_gen.'.'.$sign_img_ext;
            
            
            //อัพโหลดและบันทึกข้อมูล
            $upload_location = 'image/user/';
            $full_path = $upload_location.$sign_img_name;

            $sign_image->move($upload_location,$sign_img_name);
        }else{
            $full_path = '';
        }

        $insert = User::insert([
            'site_id'=>$sites,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'name'=>$request->name,
            'level' =>$request->level,
            'pos'=>$request->pos,
            'group'=>$request->group,
            'cotton'=>$cotton,
            'tel'=>$request->tel,
            'submem'=>$request->submem,
            'head'=>$request->head,
            'sign'=>$full_path,
            'created_at'=>date('Y-m-d H:i:s')
        ]);

        if($insert){
            return redirect()->back()->with('success',"บันทึกข้อมูลเรียบร้อย");
        }else{
            return redirect()->back()->withErrors('พบปัญหาการเพิ่มข้อมูลกรุณาแจ้งผู้พัฒนา !');
        }
        
    }
    //ลบชื่อผู้ใช้
    public function delete(Request $request){
        $delete = DB::table('users')->where('id', $request->id)->delete();
        
        if($delete){
            return redirect()->back()->with('success',"ลบข้อมูลเรียบร้อย");
        }else{
            return redirect()->back()->withErrors('พบปัญหาการลบข้อมูลกรุณาแจ้งผู้พัฒนา !');
        }
    }

    //แก้ไขชื่อผู้ใช้
    public function update(Request $request){
         //ตรวจสอบข้อมูลที่กรอกเข้ามาก่อน
         $request->validate(
            [
                'email'=>'required|max:255',
                'name'=>'required|max:255',
                'tel'=>'required|min:10|max:10',
                'submem'=>'max:255|nullable',
                'head'=>'max:255|nullable',
                'sign'=>'max:255|nullable|mimes:jpg,jpeg,png',
            ],
            [
                'email.required'=>"กรุณาป้อนชื่อผู้ใช้หรืออีเมลด้วยครับ",
                'email.max' => "ห้ามป้อนเกิน 255 ตัวอักษร",

                'name.required'=>"กรุณาป้อนชื่อ-นามสกุลด้วยครับ",
                'name.max' => "ห้ามป้อนเกิน 255 ตัวอักษร",

                'tel.required'=>"กรุณาป้อนเบอร์โทรศัพท์ด้วยครับ",
                'tel.min' => "กรุณาป้อนเบอร์โทรศัพท์ให้ครบ 10 หลัก",
                'tel.max' => "กรุณาป้อนเบอร์โทรศัพท์ให้ครบ 10 หลัก",

                'sign.max'=>"ชื่อไฟล์มีตัวอักษรเกิน 255",
                'sign.mimes'=>"รองรับไฟล์นามสกุล jpg,jpeg,png เท่านั้น",
            ]
        );

        $Select_Sites = Groupmem::where('groupmems.group_id', $request->group)
        ->join('sites','sites.site_id','groupmems.group_site_id')
        ->first();
        if($Select_Sites){
            $sites = $Select_Sites->site_id;
        }else{
            $sites = '0';
        }
        


         //ตรวจสอบสิทธิฺซั้าในระบบ
        // if($request->level == '1'||$request->level == '3'||$request->level == '4'||$request->level == '6'){
        //     $memberS_Check = User::where('users.level', $request->level)
        //     ->where('users.site_id', $sites)
        //     ->where('users.id','!=',$request->id)
        //     ->first();
        //     if($memberS_Check){
        //         return redirect()->back()->withErrors('ตรวจพบคุณ '.$memberS_Check->name.' ถือสิทธิ์ '.functionController::funtion_user_level($memberS_Check->level).' ในระบบแล้ว');
        //     }
        // }

        //เช็คว่ามีการแนบไฟล์รูปไหม
        $sign_image = $request->file('sign');
        if($sign_image){
             //อัพเดตภาพและชื่อ

              //Generate ชื่อภาพ
              $name_gen=hexdec(uniqid());
             // ดึงนามสกุลไฟล์ภาพ
            $sign_img_ext = strtolower($sign_image->getClientOriginalExtension());
            $sign_img_name = $name_gen.'.'.$sign_img_ext;
                
            //อัพโหลดและบันทึกข้อมูล
            $upload_location = 'image/user/';
            $full_path = $upload_location.$sign_img_name;

             //ลบภาพเก่าและอัพภาพใหม่แทนที่
             $old_sign = $request->old_sign;
             unlink($old_sign);
                
             $sign_image->move($upload_location,$sign_img_name);

            //query
            $update = DB::table('users')->where('id', $request->id)->update([
                'site_id'=>$sites,
                'email'=>$request->email,
                'name'=>$request->name,
                'tel'=>$request->tel,
                'submem'=>$request->submem,
                'head'=>$request->head,
                'sign'=>$full_path,
                'updated_at'=>date('Y-m-d H:i:s')
            ]);
            
            if($update){
                return redirect()->back()->with('success',"อัพเดตข้อมูลเรียบร้อย");
            }else{
                return redirect()->back()->withErrors('พบปัญหาการอัพเดตข้อมูลกรุณาแจ้งผู้พัฒนา !');
            }

        }else{
            //อัพเดตชื่ออย่างเดียว
            //query
            $update = DB::table('users')->where('id', $request->id)->update([
                'email'=>$request->email,
                'name'=>$request->name,
                'tel'=>$request->tel,
                'submem'=>$request->submem,
                'head'=>$request->head,
                'updated_at'=>date('Y-m-d H:i:s')
            ]);

            if($update){
                return redirect()->back()->with('success',"อัพเดตข้อมูลเรียบร้อย");
            }else{
                return redirect()->back()->withErrors('พบปัญหาการอัพเดตข้อมูลกรุณาแจ้งผู้พัฒนา !');
            }
        }
    }


}