<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Groupmem;
use App\Models\User;
use App\Models\documents_retrun;
use App\Models\documents_retrun_detail;

class documents_retrun_inside_division_signController extends Controller
{
    //
    public function index(){
        if(Auth::user()->level=='4'){
            // $documents_retrun_inside_division_sign = documents_retrun::join('documents_retrun_details','documents_retrun_details.docrtdt_docrt_id','documents_retruns.docrt_id')
            // ->where('docrt_sites_id',Auth::user()->site_id)
            // ->where('docrt_status', '1')
            // ->where('docrt_inspector_1', Auth::user()->id)
            // ->get();
            return view('member.documents_retrun_inside_division_sign.index');
        }else{
            return redirect('member_dashboard')->with('error','คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }
    
    public function detail($id){
        if(Auth::user()->level=='4'){
            $document_retrun_inside_detail = documents_retrun::join('documents_retrun_details','documents_retrun_details.docrtdt_docrt_id','documents_retruns.docrt_id')
            ->where('docrt_id',$id)
            ->first();

            //หาชื่อ-นามสกุล 8
            $userS_8 = User::where('level', '8')
            ->where('site_id',Auth::user()->site_id)
            ->get();
  
            //หาชื่อ-นามสกุล 2
            $userS_2 = User::where('level', '2')
            ->where('site_id',Auth::user()->site_id)
            ->get();
            return view('member.documents_retrun_inside_division_sign.detail',compact('document_retrun_inside_detail','userS_8','userS_2'));
        }else{
            return redirect('member_dashboard')->with('error','คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }

    public function understand(Request $request){
        //ตรวจสอบข้อมูลที่กรอกเข้ามาก่อน
        $request->validate(
            [
                'docrt_sealid'=>'required|max:255'
            ],
            [
                'docrt_sealid.required'=>"กรุณาเลือกผู้รับด้วยครับ",
                'docrt_sealid.max' => "ห้ามป้อนเกิน 255 ตัวอักษร"
            ]
        );
        if($request->docrt_sealid == 'นิติการ'){
            //หา นิติการ
            $userS_0 = User::where('jurisprudence', '1')
            ->where('site_id',Auth::user()->site_id)
            ->first();
            if($userS_0){
                $update_documents_retrun = documents_retrun::where('docrt_id', $request->docrt_id)->update([
                    'docrt_check_1'=>'1',
                    'docrt_datetime_1'=>date('Y-m-d H:i:s'),
                    'docrt_status'=>'2',
                    'docrt_updated_at'=>date('Y-m-d H:i:s')
                ]);
                if($update_documents_retrun){
                    //linetoken
                    $tokens_Check = Groupmem::where('group_site_id', Auth::user()->site_id)
                    ->where('group_id', Auth::user()->group)
                    ->first();
                    if($tokens_Check){
                        $message = "\n⚠️ หัวหน้ากองรับทราบตอบกลับเอกสารตอบกลับภายใน ⚠️\n>เรื่อง :  ".$request->docrtdt_topic."\n>ที่ร่าง :  ".$request->docrtdt_draft."\n>วันที่ : ".$request->docrtdt_date."\n>เวลาแจ้งเตือน : ".date('Y-m-d H:i')." ";
                        functionController::line_notify($message,$tokens_Check->group_token);
                    }
                    return redirect()->route('documents_retrun_inside_division_sign_all')->with('success',"รับทราบเรียบร้อย");
                }else{
                    return redirect('member_dashboard')->with('error','เกิดข้อผิดพลาด [update_documents_retrun] !');
                }
            }else{
                return redirect('member_dashboard')->with('error','เกิดข้อผิดพลาด ไม่พบหัวหน้ากองในระบบ [userS_0] !');
            }
        }else{
            $user_check_l = User::where('id',$request->docrt_sealid)
            ->first();
            if($user_check_l){
                if($user_check_l->level == '8'){
                    //หา หน้าห้อง
                    $update_documents_retrun = documents_retrun::where('docrt_id', $request->docrt_id)->update([
                        'docrt_check_1'=>'1',
                        'docrt_datetime_1'=>date('Y-m-d H:i:s'),
                        'docrt_status'=>'3',
                        'docrt_sealid_0'=>$request->docrt_sealid,
                        'docrt_updated_at'=>date('Y-m-d H:i:s')
                    ]);
                }else if($user_check_l->level == '2'){
                    //หา ปลัด||รองปลัด
                    $update_documents_retrun = documents_retrun::where('docrt_id', $request->docrt_id)->update([
                        'docrt_check_1'=>'1',
                        'docrt_datetime_1'=>date('Y-m-d H:i:s'),
                        'docrt_status'=>'5',
                        'docrt_sealid_2'=>$request->docrt_sealid,
                        'docrt_updated_at'=>date('Y-m-d H:i:s')
                    ]);
                }else{
                    return redirect('member_dashboard')->with('error','เกิดข้อผิดพลาด [level] !');
                }
            }else{
                return redirect('member_dashboard')->with('error','เกิดข้อผิดพลาด [user_check_l] !');
            }

            if($update_documents_retrun){
                //linetoken
                $tokens_Check = Groupmem::where('group_site_id', Auth::user()->site_id)
                ->where('group_id', Auth::user()->group)
                ->first();
                if($tokens_Check){
                    $message = "\n⚠️ หัวหน้ากองรับทราบตอบกลับเอกสารตอบกลับภายใน ⚠️\n>เรื่อง :  ".$request->docrtdt_topic."\n>ที่ร่าง :  ".$request->docrtdt_draft."\n>วันที่ : ".$request->docrtdt_date."\n>เวลาแจ้งเตือน : ".date('Y-m-d H:i')." ";
                    functionController::line_notify($message,$tokens_Check->group_token);
                }
                return redirect()->route('documents_retrun_inside_division_sign_all')->with('success',"รับทราบเรียบร้อย");
            }else{
                return redirect('member_dashboard')->with('error','เกิดข้อผิดพลาด [update_sub3_docs] !');
            }
        }
        

    }
}
