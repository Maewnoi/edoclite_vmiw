<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
         
            if($document_retrun_inside_detail->docrt_sealid_2 != null){
                $docrt_sealid_2 = $document_retrun_inside_detail->docrt_sealid_2;
            }else{
                $docrt_sealid_2 = null;
            }
            if($document_retrun_inside_detail->docrt_sealid_3 != null){
                $docrt_sealid_3 = $document_retrun_inside_detail->docrt_sealid_3;
            }else{
                $docrt_sealid_3 = null;
            }

            $userS = User::where(function ($query) {
                $query->where('level', '1')
                      ->orWhere('level', '2');
            })
            ->when($docrt_sealid_2!= null, function ($builder_2) use ($docrt_sealid_2){
                $builder_2->where('id','!=',$docrt_sealid_2);
            })
            ->when($docrt_sealid_3 != null, function ($builder_3) use ($docrt_sealid_3){
                $builder_3->where('id','!=',$docrt_sealid_3);
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
        
        if($request->docrt_sealid == 'ตีกลับ'){
            $update_documents_retrun = documents_retrun::where('docrt_id', $request->docrt_id)->update([
                'docrt_check_0'=>'0',
                'docrt_inspector_0'=>null,
                'docrt_datetime_0'=>null,
                'docrt_check_1'=>'0',
                'docrt_inspector_1'=>null,
                'docrt_datetime_1'=>null,
                'docrt_check_2'=>'0',
                'docrt_inspector_2'=>null,
                'docrt_datetime_2'=>null,

                'docrt_sealdetail_0'=>null,
                'docrt_sealnote_0'=>null,
                'docrt_sealpos_0'=>null,
                'docrt_sealdate_0'=>null,
                'docrt_sealid_0'=>null,
                'docrt_ca_0'=>null,

                'docrt_sealdetail_1'=>null,
                'docrt_sealnote_1'=>null,
                'docrt_sealpos_1'=>null,
                'docrt_sealdate_1'=>null,
                'docrt_sealid_1'=>null,
                'docrt_ca_1'=>null,

                'docrt_sealdetail_2'=>null,
                'docrt_sealnote_2'=>null,
                'docrt_sealpos_2'=>null,
                'docrt_sealdate_2'=>null,
                'docrt_sealid_2'=>null,
                'docrt_ca_2'=>null,

                'docrt_sealdetail_3'=>null,
                'docrt_sealnote_3'=>null,
                'docrt_sealpos_3'=>null,
                'docrt_sealdate_3'=>null,
                'docrt_sealid_3'=>null,
                'docrt_ca_3'=>null,

                'docrt_note'=>$request->docrt_note,
                'docrt_status'=>'C',
                'docrt_updated_at'=>date('Y-m-d H:i:s')
            ]);

            if($update_docrt_docs){
                //linetoken
                $tokens_Check = Groupmem::where('group_site_id', Auth::user()->site_id)
                ->where('group_id', $request->docrt_groupmems_id)
                ->first();

                if($tokens_Check){
                    $message = "\n⚠️ รองปลัด|ปลัด ตีกลับเอกสารรับเข้าตอบกลับภายใน ⚠️\n>เรื่อง :  ".$request->docrtdt_topic."\n>ที่ร่าง :  ".$request->docrtdt_draft."\n>วันที่ : ".$request->docrtdt_date."\n>เวลาแจ้งเตือน : ".date('Y-m-d H:i')." ";
                    functionController::line_notify($message,$tokens_Check->group_token);
                }
                return redirect()->route('documents_retrun_inside_deputy_sign_all_0')->with('success',"ตีกลับเรียบร้อย");
            }else{
                return redirect('member_dashboard')->with('error','เกิดข้อผิดพลาด [update_docrt_docs]!');
            }
        }else{
            if(Auth::user()->id == $request->docrt_sealid_2){
                $docrt_sealdate = 'docrt_sealdate_2';
                $docrt_sealpos = 'docrt_sealpos_2';
                $docrt_ca = 'docrt_ca_2';

                $docrt_sealid = 'docrt_sealid_3';
                $docrt_status = '6';

                $full_path = functionController::funtion_generate_PDF_deputy_AND_minister(
                    $request->docrtdt_file,
                    $request->docrt_id,
                    $request->docrt_sealid_2,
                    '',
                    '',
                    '',
                    $request->docrt_sealpos,
                    '',
                    '',
                    ''
                );
                if(!$full_path){
                    return redirect()->back()->with('error','พบปัญหาการประทับตากรุณาแจ้งผู้พัฒนา ![full_path]');
                }
                //ca
                $code_ca_64 = functionController::funtion_generate_CA_for_PDF($full_path);
                if(!$code_ca_64){
                    return redirect()->back()->with('error','พบปัญหาการประทับตากรุณาแจ้งผู้พัฒนา ![code_ca_64]');
                }
                //ลบไฟล์เดิม
                $del_old = unlink($request->docrtdt_file);
                if(!$del_old){
                    return redirect()->back()->with('error','พบปัญหาการประทับตากรุณาแจ้งผู้พัฒนา ![del_old]');
                }
            }else if(Auth::user()->id == $request->docrt_sealid_3){
                $docrt_sealdate = 'docrt_sealdate_3';
                $docrt_sealpos = 'docrt_sealpos_3';
                $docrt_ca = 'docrt_ca_3';

                $docrt_sealid = 'docrt_sealid_2';
                $docrt_status = '5';

                $full_path = functionController::funtion_generate_PDF_deputy_AND_minister(
                    $request->docrtdt_file,
                    $request->docrt_id,
                    '',
                    $request->docrt_sealid_3,
                    '',
                    '',
                    '',
                    $request->docrt_sealpos,
                    '',
                    ''
                );
                if(!$full_path){
                    return redirect()->back()->with('error','พบปัญหาการประทับตากรุณาแจ้งผู้พัฒนา ![full_path]');
                }
                 //ca
                $code_ca_64 = functionController::funtion_generate_CA_for_PDF($full_path);
                if(!$code_ca_64){
                    return redirect()->back()->with('error','พบปัญหาการประทับตากรุณาแจ้งผู้พัฒนา ![code_ca_64]');
                }
                //ลบไฟล์เดิม
                $del_old = unlink($request->docrtdt_file);
                if(!$del_old){
                    return redirect()->back()->with('error','พบปัญหาการประทับตากรุณาแจ้งผู้พัฒนา ![del_old]');
                }
            }else{
                return redirect('member_dashboard')->with('error','เกิดข้อผิดพลาด [Auth_id!=docrt_sealid] !');
            }

            $user_check = User::where('id', $request->docrt_sealid)
            ->first();
            if($user_check->level == '2'){
                $update_documents_retrun = documents_retrun::where('docrt_id', $request->docrt_id)->update([
                    $docrt_sealdate=>date('Y-m-d H:i:s'),
                    $docrt_ca=>$code_ca_64,
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
                    $message = "\n⚠️ รองปลัด|ปลัด ลงนามเอกสารรับเข้าตอบกลับภายใน ⚠️\n>เรื่อง :  ".$request->docrtdt_topic."\n>ที่ร่าง :  ".$request->docrtdt_draft."\n>วันที่ : ".$request->docrtdt_date."\n>เวลาแจ้งเตือน : ".date('Y-m-d H:i')." ";
                    functionController::line_notify($message,$tokens_Check->token_token);
                }

            }else if($user_check->level == '1'){
                $update_documents_retrun = documents_retrun::where('docrt_id', $request->docrt_id)->update([
                    $docrt_sealdate=>date('Y-m-d H:i:s'),
                    $docrt_ca=>$code_ca_64,
                    $docrt_sealpos=>$request->docrt_sealpos,
                    'docrt_sealid_4'=>$request->docrt_sealid,
                    'docrt_status'=>'7',
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
                    $message = "\n⚠️ รองปลัด|ปลัด ลงนามเอกสารรับเข้าตอบกลับภายใน ⚠️\n>เรื่อง :  ".$request->docrtdt_topic."\n>ที่ร่าง :  ".$request->docrtdt_draft."\n>วันที่ : ".$request->docrtdt_date."\n>เวลาแจ้งเตือน : ".date('Y-m-d H:i')." ";
                    functionController::line_notify($message,$tokens_Check->token_token);
                }

            }else{
                return redirect('member_dashboard')->with('error','เกิดข้อผิดพลาด [user_check]!');
            }

            if($update_documents_retrun){
                return redirect()->route('documents_retrun_inside_deputy_sign_all_0')->with('success',"ลงนามเรียบร้อย");
            }else{
                return redirect('member_dashboard')->with('error','เกิดข้อผิดพลาด [update_docrt_docs] !');
            }

        }
    }
}
