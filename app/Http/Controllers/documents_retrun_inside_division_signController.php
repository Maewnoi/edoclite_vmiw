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
            return view('member.documents_retrun_inside_division_sign.detail',compact('document_retrun_inside_detail'));
        }else{
            return redirect('member_dashboard')->with('error','คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }

    public function understand(Request $request){
       //หา นิติการ
        $userS_0 = User::where('jurisprudence', '1')
        ->where('site_id',Auth::user()->site_id)
        ->where('group', Auth::user()->group)
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
        

    }
}
