<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Groupmem;
use App\Models\User;
use App\Models\documents_retrun;
use App\Models\documents_retrun_detail;

class documents_retrun_inside_deputy_signController extends Controller
{
    //
    public function index_0(){
        if(Auth::user()->level=='2'){
            return view('member.documents_retrun_inside_deputy_sign.index');
        }else{
            return redirect('member_dashboard')->with('error','คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }

    public function index_1(){
        if(Auth::user()->level=='2'){
            return view('member.documents_retrun_inside_deputy_sign.index');
        }else{
            return redirect('member_dashboard')->with('error','คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }

    public function detail($id){
        if(Auth::user()->level=='2'){
            $document_retrun_inside_detail = documents_retrun::join('documents_retrun_details','documents_retrun_details.docrtdt_docrt_id','documents_retruns.docrt_id')
            ->where('docrt_id',$id)
            ->where('docrt_sites_id',Auth::user()->site_id)
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
 
            return view('member.documents_retrun_inside_deputy_sign.detail',compact('document_retrun_inside_detail','userS'));
        }else{
            return redirect('member_dashboard')->with('error','คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }

    public function understand(Request $request){
        //ตรวจสอบข้อมูลที่กรอกเข้ามาก่อน
        $request->validate(
            [
                'docrt_sealid'=>'required|max:255',
                'docrt_sealpos'=>'required|max:255'
            ],
            [
                'docrt_sealid.required'=>"กรุณาเลือกผู้ลงนามด้วยครับ",
                'docrt_sealid.max' => "ห้ามป้อนเกิน 255 ตัวอักษร",
                'docrt_sealpos.required' => "กรุณากรอกตำแหน่งด้วยครับ",
                'docrt_sealpos.max' => "ห้ามป้อนเกิน 255 ตัวอักษร"
            ]
        );
        
        if(Auth::user()->id == $request->docrt_sealid_0){
            $docrt_sealdate = 'docrt_sealdate_0';
            $docrt_sealpos = 'docrt_sealpos_0';
        }else if(Auth::user()->id == $request->docrt_sealid_1){
            $docrt_sealdate = 'docrt_sealdate_1';
            $docrt_sealpos = 'docrt_sealpos_1';
        }else{
            return redirect('member_dashboard')->with('error','เกิดข้อผิดพลาด [Auth_id!=docrt_sealid] !');
        }

        if($request->docrt_sealid == 'not'){
            if(Auth::user()->id == $request->sdocrt_sealid_0){
                $full_path = functionController::funtion_generate_PDF_VI(
                    $request->docrtdt_file,
                    $request->docrt_sealid_0,
                    $request->docrt_sealid_1,
                    '',
                    $request->docrt_sealpos,
                    $request->docrt_sealpos_1,
                    '',
                    $request->docrt_id
                );
            }else if(Auth::user()->id == $request->docrt_sealid_1){
                $full_path = functionController::funtion_generate_PDF_VI(
                    $request->docrtdt_file,
                    $request->docrt_sealid_0,
                    $request->docrt_sealid_1,
                    '',
                    $request->docrt_sealpos_0,
                    $request->docrt_sealpos,
                    '',
                    $request->docrt_id
                );
            }
            if(!$full_path){
                return redirect('member_dashboard')->with('error','เกิดข้อผิดพลาด [funtion_generate_PDF_VI] !');
            }
            $update_documents_retrun_detail = documents_retrun_detail::where('docrtdt_docrt_id', $request->docrt_id)->update([
                'docrtdt_file'=>$full_path
            ]);
            $update_documents_retrun = documents_retrun::where('docrt_id', $request->docrt_id)->update([
                $docrt_sealpos=>$request->docrt_sealpos,
                $docrt_sealdate=>date('Y-m-d H:i:s'),
                'docrt_status'=>'6',
                'docrt_updated_at'=>date('Y-m-d H:i:s')
            ]);
        }else{
            $user = User::where('id',$request->docrt_sealid)->first();
            if($user->level == '1'){
                //นายก
                $update_documents_retrun = documents_retrun::where('docrt_id', $request->docrt_id)->update([
                    $docrt_sealpos=>$request->docrt_sealpos,
                    $docrt_sealdate=>date('Y-m-d H:i:s'),
                    'docrt_sealid_2'=>$request->docrt_sealid,
                    'docrt_status'=>'5',
                    'docrt_updated_at'=>date('Y-m-d H:i:s')
                ]);
            }else if($user->level == '2'){
                //ปลัด
                $update_documents_retrun = documents_retrun::where('docrt_id', $request->docrt_id)->update([
                    $docrt_sealpos=>$request->docrt_sealpos,
                    $docrt_sealdate=>date('Y-m-d H:i:s'),
                    'docrt_sealid_1'=>$request->docrt_sealid,
                    'docrt_status'=>'4',
                    'docrt_updated_at'=>date('Y-m-d H:i:s')
                ]);
            }else{
                return redirect('member_dashboard')->with('error','เกิดข้อผิดพลาด [user_level_null] !');
            }
        }

        if($update_documents_retrun){
            //linetoken
            $tokens_Check = Groupmem::where('group_site_id', Auth::user()->site_id)
            ->where('group_id', $request->docrt_groupmems_id)
            ->first();
            if($tokens_Check){
                $message = "\n⚠️ ปลัดลงนามเอกสารตอบกลับภายใน ⚠️\n>เรื่อง :  ".$request->docrtdt_topic."\n>ที่ร่าง :  ".$request->docrtdt_draft."\n>วันที่ : ".$request->docrtdt_date."\n>เวลาแจ้งเตือน : ".date('Y-m-d H:i')." ";
                functionController::line_notify($message,$tokens_Check->group_token);
            }
            return redirect()->route('documents_admission_inside_deputy_sign_all_0')->with('success',"ลงนามเรียบร้อย");
        }else{
            return redirect('member_dashboard')->with('error','เกิดข้อผิดพลาด [update_documents_retrun] !');
        }
    }
}
