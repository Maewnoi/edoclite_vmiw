<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Groupmem;
use App\Models\User;
use App\Models\documents_retrun;
use App\Models\documents_retrun_detail;


class documents_retrun_inside_jurisprudenceController extends Controller
{
    //
    public function index(){
        if(Auth::user()->jurisprudence=='1'){
            // $documents_retrun_inside_jurisprudence = documents_retrun::join('Documents_retrun_details','Documents_retrun_details.docrtdt_docrt_id','Documents_retruns.docrt_id')
            // ->where('docrt_sites_id',Auth::user()->site_id)
            // ->where('docrt_status', '2')
            // ->get();
     
            return view('member.documents_retrun_inside_jurisprudence.index');
        }else{
            return redirect('member_dashboard')->with('error','คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }

    public function detail($id){
        if(Auth::user()->jurisprudence=='1'){
            $document_retrun_inside_detail = documents_retrun::join('Documents_retrun_details','Documents_retrun_details.docrtdt_docrt_id','Documents_retruns.docrt_id')
            ->where('docrt_id',$id)
            ->where('docrt_status', '2')
            ->first();

            if($document_retrun_inside_detail->docrt_sealid_0 != null){
                $docrt_sealid_0 = $document_retrun_inside_detail->docrt_sealid_0;
            }else{
                $docrt_sealid_0 = null;
            }
            if($document_retrun_inside_detail->docrt_sealid_1 != null){
                $docrt_sealid_1 = $document_retrun_inside_detail->docrt_sealid_1;
            }else{
                $docrt_sealid_1 = null;
            }

            $userS = User::where(function ($query) {
                $query->where('level', '1')
                      ->orWhere('level', '2');
            })
            ->when($docrt_sealid_0 != null, function ($builder_0) use ($docrt_sealid_0){
                $builder_0->where('id','!=',$docrt_sealid_0);
            })
            ->when($docrt_sealid_1 != null, function ($builder_1) use ($docrt_sealid_1){
                $builder_1->where('id','!=',$docrt_sealid_1);
            })
            ->where('site_id',Auth::user()->site_id)
            ->get();
            return view('member.documents_retrun_inside_jurisprudence.detail',compact('document_retrun_inside_detail','userS'));
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
                'docrt_sealid.required'=>"กรุณาเลือกผู้ลงนามด้วยครับ",
                'docrt_sealid.max' => "ห้ามป้อนเกิน 255 ตัวอักษร"
            ]
        );
        if($request->docrt_sealid == 'not'){
            $update_documents_retruns = documents_retrun::where('docrt_id', $request->docrt_id)->update([
                'docrt_check_2'=>'1',
                'docrt_datetime_2'=>date('Y-m-d H:i:s'),
                'docrt_inspector_2'=>Auth::user()->id,
                'docrt_status'=>'6',
                'docrt_updated_at'=>date('Y-m-d H:i:s')
            ]);
        }else{
            $user = User::where('id',$request->docrt_sealid)->first();
            if($user->level == '1'){
                $update_documents_retruns = documents_retrun::where('docrt_id', $request->docrt_id)->update([
                    'docrt_check_2'=>'1',
                    'docrt_datetime_2'=>date('Y-m-d H:i:s'),
                    'docrt_inspector_2'=>Auth::user()->id,
                    'docrt_sealid_2'=>$request->docrt_sealid,
                    'docrt_status'=>'5',
                    'docrt_updated_at'=>date('Y-m-d H:i:s')
                ]);
            }else if($user->level == '2'){
                $update_documents_retruns = documents_retrun::where('docrt_id', $request->docrt_id)->update([
                    'docrt_check_2'=>'1',
                    'docrt_datetime_2'=>date('Y-m-d H:i:s'),
                    'docrt_inspector_2'=>Auth::user()->id,
                    'docrt_sealid_0'=>$request->docrt_sealid,
                    'docrt_status'=>'3',
                    'docrt_updated_at'=>date('Y-m-d H:i:s')
                ]);
            }else{
            }
        }
        if($update_documents_retruns){
            //linetoken
            $tokens_Check = Groupmem::where('group_site_id', Auth::user()->site_id)
            ->where('group_id', Auth::user()->group)
            ->first();
            if($tokens_Check){
                $message = "\n⚠️ นิติการอนุมัติตอบกลับเอกสารภายใน ⚠️\n>เรื่อง :  ".$request->docrtdt_topic."\n>ที่ร่าง :  ".$request->docrtdt_draft."\n>วันที่ : ".$request->docrtdt_date."\n>เวลาแจ้งเตือน : ".date('Y-m-d H:i')." ";
                functionController::line_notify($message,$tokens_Check->group_token);
            }
            return redirect()->route('documents_retrun_inside_jurisprudence_all')->with('success',"อนุมัติเรียบร้อย");
        }else{
            return redirect('member_dashboard')->with('error','เกิดข้อผิดพลาด [update_documents_retruns] !');
        }
        
    }

    public function do_not_understand(Request $request){
        $update_documents_retruns = documents_retrun::where('docrt_id', $request->docrt_id)->update([
            'docrt_check_0'=>'0',
            'docrt_inspector_0'=>null,
            'docrt_datetime_0'=>null,
            'docrt_check_1'=>'0',
            'docrt_inspector_1'=>null,
            'docrt_datetime_1'=>null,
            'docrt_check_2'=>'0',
            'docrt_inspector_2'=>null,
            'docrt_datetime_2'=>null,
            'docrt_status'=>'C',
            'docrt_updated_at'=>date('Y-m-d H:i:s')
        ]);

        if($update_documents_retruns){
            //linetoken
            $tokens_Check = Groupmem::where('group_site_id', Auth::user()->site_id)
            ->where('group_id', Auth::user()->group)
            ->first();
            if($tokens_Check){
                $message = "\n⚠️ นิติการ(ไม่)อนุมัติเอกสารตอบกลับภายใน ⚠️\n>เรื่อง :  ".$request->docrtdt_topic."\n>ที่ร่าง :  ".$request->docrtdt_draft."\n>วันที่ : ".$request->docrtdt_date."\n>เวลาแจ้งเตือน : ".date('Y-m-d H:i')." ";
                functionController::line_notify($message,$tokens_Check->group_token);
            }
            return redirect()->route('documents_retrun_inside_jurisprudence_all')->with('success',"ไม่อนุมัติเรียบร้อย");
        }else{
            return redirect('member_dashboard')->with('error','เกิดข้อผิดพลาด [update_documents_retruns]!');
        }
        
    }
}
