<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Groupmem;
use App\Models\User;
use App\Models\documents_retrun;
use App\Models\documents_retrun_detail;

class documents_retrun_inside_minister_signController extends Controller
{
    //
    public function index_0(){
        if(Auth::user()->level=='1'){
            return view('member.documents_retrun_inside_minister_sign.index');
        }else{
            return redirect('member_dashboard')->with('error','คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }

    public function index_1(){
        if(Auth::user()->level=='1'){
            return view('member.documents_retrun_inside_minister_sign.index');
        }else{
            return redirect('member_dashboard')->with('error','คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }

    public function detail($id){
        if(Auth::user()->level=='1'){
            $document_retrun_inside_detail = documents_retrun::join('Documents_retrun_details','Documents_retrun_details.docrtdt_docrt_id','Documents_retruns.docrt_id')
            ->where('docrt_id',$id)
            ->where('docrt_sites_id',Auth::user()->site_id)
            ->first();

            return view('member.documents_retrun_inside_minister_sign.detail',compact('document_retrun_inside_detail'));
        }else{
            return redirect('member_dashboard')->with('error','คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }

    public function understand(Request $request){

        //ตรวจสอบข้อมูลที่กรอกเข้ามาก่อน
        $request->validate(
            [
                'docrt_sealpos'=>'required|max:255'
            ],
            [
                'docrt_sealpos.required'=>"กรุณากรอกตำแหน่งด้วยครับ",
                'docrt_sealpos.max' => "ห้ามป้อนเกิน 255 ตัวอักษร"
            ]
        );

        $full_path = functionController::funtion_generate_PDF_VI(
            $request->docrtdt_file,
            $request->docrt_sealid_0,
            $request->docrt_sealid_1,
            $request->docrt_sealid_2,
            $request->docrt_sealpos_0,
            $request->docrt_sealpos_1,
            $request->docrt_sealpos,
            $request->docrt_id
        );
        if($full_path){
            $update_documents_retrun_detail = documents_retrun_detail::where('docrtdt_docrt_id', $request->docrt_id)->update([
                'docrtdt_file'=>$full_path
            ]);
            $update_documents_retrun = documents_retrun::where('docrt_id', $request->docrt_id)->update([
                'docrt_sealpos_2'=>$request->docrt_sealpos,
                'docrt_sealdate_2'=>date('Y-m-d H:i:s'),
                'docrt_status'=>'6',
                'docrt_updated_at'=>date('Y-m-d H:i:s')
            ]);
            if($update_documents_retrun && $update_documents_retrun_detail){
                //linetoken
                $tokens_Check = Groupmem::where('group_site_id', Auth::user()->site_id)
                ->where('group_id', $request->docrt_groupmems_id)
                ->first();
                if($tokens_Check){
                    $message = "\n⚠️ นายกลงนามเอกสารตอบกลับภายใน ⚠️\n>เรื่อง :  ".$request->docrtdt_topic."\n>ที่ร่าง :  ".$request->docrtdt_draft."\n>วันที่ : ".$request->docrtdt_date."\n>เวลาแจ้งเตือน : ".date('Y-m-d H:i')." ";
                    functionController::line_notify($message,$tokens_Check->group_token);
                }
                return redirect()->route('documents_retrun_inside_minister_sign_all_0')->with('success',"ลงนามเรียบร้อย");
            }else{
                return redirect('member_dashboard')->with('error','เกิดข้อผิดพลาด [update_documents_retrun && update_documents_retrun_detail] !');
            }
        }else{
            return redirect('member_dashboard')->with('error','เกิดข้อผิดพลาด [funtion_generate_PDF_VI] !');
        }
        
    }
}
