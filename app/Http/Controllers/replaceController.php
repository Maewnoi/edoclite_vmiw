<?php
namespace App\Http\Controllers;
use setasign\Fpdi\Fpdi;
use setasign\Fpdf\Fpdf;
use Illuminate\Http\Request;
use App\Models\Groupmem;
use App\Models\sites;
use App\Models\User;
use App\Models\document;
use App\Models\cottons;
use App\Models\reserve_number;
use App\Models\sub_doc;
use App\Models\sub2_doc;
use App\Models\sub3_doc;
use App\Models\sub3_detail;
use App\Models\token;
use Illuminate\Support\Facades\Auth;

class replaceController extends Controller
{
    //หน้ากลัก
    public function index(){
        $memberS=User::where('users.level', '!=' , '0')
            ->leftJoin('groupmems','groupmems.group_id','users.group')
            ->orderBy('users.id', 'DESC')
            ->get();
        
        $select_sitesS=sites::get();

        return view('member.replace.index',compact('memberS','select_sitesS'));
       
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
                return redirect()->back()->with('error','พบปัญหาการอัพเดตข้อมูลกรุณาแจ้งผู้พัฒนา !');
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
                return redirect()->back()->with('error','พบปัญหาการอัพเดตข้อมูลกรุณาแจ้งผู้พัฒนา !');
            }
        }
    }


}