<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            $document_retrun_inside_detail = documents_retrun::join('documents_retrun_details','documents_retrun_details.docrtdt_docrt_id','documents_retruns.docrt_id')
            ->where('docrt_id',$id)
            ->where('docrt_sites_id',Auth::user()->site_id)
            ->first();

            if($document_retrun_inside_detail->docrt_sealid_4 != null){
                $docrt_sealid_4 = $document_retrun_inside_detail->docrt_sealid_4;
            }else{
                $docrt_sealid_4 = null;
            }
            if($document_retrun_inside_detail->docrt_sealid_5 != null){
                $docrt_sealid_5 = $document_retrun_inside_detail->docrt_sealid_5;
            }else{
                $docrt_sealid_5 = null;
            }

            $userS = User::where('level', '1')
            ->when($docrt_sealid_4 != null, function ($builder_4) use ($docrt_sealid_4){
                $builder_4->where('id','!=',$docrt_sealid_4);
            })
            ->when($docrt_sealid_5 != null, function ($builder_5) use ($docrt_sealid_5){
                $builder_5->where('id','!=',$docrt_sealid_5);
            })
            ->where('site_id',Auth::user()->site_id)
            ->get();

            return view('member.documents_retrun_inside_minister_sign.detail',compact('document_retrun_inside_detail','userS'));
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

        if($request->docrt_sealid == 'ไม่มีผู้ลงนามต่อ'){
            if(Auth::user()->id == $request->docrt_sealid_4){
                $docrt_sealdate = 'docrt_sealdate_4';
                $docrt_sealpos = 'docrt_sealpos_4';

                $full_path = functionController::funtion_generate_PDF_deputy_AND_minister(
                    $request->docrtdt_file,
                    $request->docrt_id,
                    '',
                    '',
                    $request->docrt_sealid_4,
                    '',
                    '',
                    '',
                    $request->docrt_sealpos,
                    ''
                );
            }else if(Auth::user()->id == $request->docrt_sealid_5){
                $docrt_sealdate = 'docrt_sealdate_5';
                $docrt_sealpos = 'docrt_sealpos_5';

                $full_path = functionController::funtion_generate_PDF_deputy_AND_minister(
                    $request->docrtdt_file,
                    $request->docrt_id,
                    '',
                    '',
                    '',
                    $request->docrt_sealid_5,
                    '',
                    '',
                    '',
                    $request->docrt_sealpos
                );
            }else{
                return redirect('member_dashboard')->with('error','เกิดข้อผิดพลาด [Auth_id!=docrt_sealid] !');
            }

            $update_documents_retrun = documents_retrun::where('docrt_id', $request->docrt_id)->update([
                $docrt_sealdate=>date('Y-m-d H:i:s'),
                $docrt_sealpos=>$request->docrt_sealpos,
                'docrt_status'=>'9',
                'docrt_updated_at'=>date('Y-m-d H:i:s')
            ]);

            $update_documents_retrun_detail = documents_retrun_detail::where('docrtdt_docrt_id', $request->docrt_id)->update([
                'docrtdt_file'=>$full_path
            ]);
            
            if($update_documents_retrun){
                //linetoken
                $tokens_Check = Groupmem::where('group_site_id', Auth::user()->site_id)
                ->where('group_id', $request->docrt_groupmems_id)
                ->first();

                if($tokens_Check){
                    $message = "\n⚠️ รองปลัด|ปลัด ลงนามเอกสารรับเข้าตอบกลับภายใน ⚠️\n>เรื่อง :  ".$request->docrtdt_topic."\n>ที่ร่าง :  ".$request->docrtdt_draft."\n>วันที่ : ".$request->docrtdt_date."\n>เวลาแจ้งเตือน : ".date('Y-m-d H:i')." ";
                    functionController::line_notify($message,$tokens_Check->group_token);
                }
                return redirect()->route('documents_retrun_inside_minister_sign_all_0')->with('success',"ลงนามเรียบร้อย");
            }else{
                return redirect('member_dashboard')->with('error','เกิดข้อผิดพลาด [update_docrt_docs]!');
            }
        }else{
            if(Auth::user()->id == $request->docrt_sealid_4){
                $docrt_sealdate = 'docrt_sealdate_4';
                $docrt_sealpos = 'docrt_sealpos_4';
    
                $docrt_sealid = 'docrt_sealid_5';
                $docrt_status = '8';

                $full_path = functionController::funtion_generate_PDF_deputy_AND_minister(
                    $request->docrtdt_file,
                    $request->docrt_id,
                    '',
                    '',
                    $request->docrt_sealid_4,
                    '',
                    '',
                    '',
                    $request->docrt_sealpos,
                    ''
                );
            }else if(Auth::user()->id == $request->docrt_sealid_5){
                $docrt_sealdate = 'docrt_sealdate_5';
                $docrt_sealpos = 'docrt_sealpos_5';
    
                $docrt_sealid = 'docrt_sealid_4';
                $docrt_status = '7';

                $full_path = functionController::funtion_generate_PDF_deputy_AND_minister(
                    $request->docrtdt_file,
                    $request->docrt_id,
                    '',
                    '',
                    '',
                    $request->docrt_sealid_5,
                    '',
                    '',
                    '',
                    $request->docrt_sealpos
                );
            }else{
                return redirect('member_dashboard')->with('error','เกิดข้อผิดพลาด [Auth_id!=docrt_sealid] !');
            }

            $user_check = User::where('id', $request->docrt_sealid)
            ->first();
            if($user_check->level == '1'){
                $update_documents_retrun = documents_retrun::where('docrt_id', $request->docrt_id)->update([
                    $docrt_sealdate=>date('Y-m-d H:i:s'),
                    $docrt_sealpos=>$request->docrt_sealpos,
                    $docrt_sealid=>$request->docrt_sealid,
                    'docrt_status'=>$docrt_status,
                    'docrt_updated_at'=>date('Y-m-d H:i:s')
                ]);

                $update_documents_retrun_detail = documents_retrun_detail::where('docrtdt_docrt_id', $request->docrt_id)->update([
                    'docrtdt_file'=>$full_path
                ]);

                //linetoken
                $tokens_Check = DB::table('tokens')
                ->where('token_site_id', Auth::user()->site_id)
                ->where('token_level', $user_check->level)
                ->first();
                if($tokens_Check){
                    $message = "\n⚠️ รองนายก|นายก ลงนามเอกสารรับเข้าตอบกลับภายใน ⚠️\n>เรื่อง :  ".$request->docrtdt_topic."\n>ที่ร่าง :  ".$request->docrtdt_draft."\n>วันที่ : ".$request->docrtdt_date."\n>เวลาแจ้งเตือน : ".date('Y-m-d H:i')." ";
                    functionController::line_notify($message,$tokens_Check->token_token);
                }
                return redirect()->route('documents_retrun_inside_minister_sign_all_0')->with('success',"ลงนามเรียบร้อย");
            }else{
                return redirect('member_dashboard')->with('error','เกิดข้อผิดพลาด [user_check]!');
            }

        }
        
    }
}
