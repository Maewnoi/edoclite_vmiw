<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Groupmem;
use App\Models\User;
use App\Models\documents_retrun;
use App\Models\documents_retrun_detail;

class documents_retrun_inside_secretaryController extends Controller
{
    //
    public function index_0(){
        if(Auth::user()->level=='8'){
            return view('member.documents_retrun_inside_secretary.index');
        }else{
            return redirect('member_dashboard')->with('error','คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }

    public function index_1(){
        if(Auth::user()->level=='8'){
            return view('member.documents_retrun_inside_secretary.index');
        }else{
            return redirect('member_dashboard')->with('error','คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }

    public function detail($id){
        if(Auth::user()->level=='8'){
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
                $query->where('level', '8')
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

            return view('member.documents_retrun_inside_secretary.detail',compact('document_retrun_inside_detail','userS'));
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
                'docrt_sealid.required' => "กรุณาเลือกผู้รับด้วยครับ",
                'docrt_sealid.max' => "ห้ามป้อนเกิน 255 ตัวอักษร"
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

                'docrt_sealdetail_1'=>null,
                'docrt_sealnote_1'=>null,
                'docrt_sealpos_1'=>null,
                'docrt_sealdate_1'=>null,
                'docrt_sealid_1'=>null,

                'docrt_note'=>$request->docrt_note,
                'docrt_status'=>'C',
                'docrt_updated_at'=>date('Y-m-d H:i:s')
            ]);

            if($update_documents_retrun){
                //linetoken
                $tokens_Check = Groupmem::where('group_site_id', Auth::user()->site_id)
                ->where('group_id', $request->docrt_groupmems_id)
                ->first();

                if($tokens_Check){
                    $message = "\n⚠️ หน้าห้องปลัด|หน้าห้องนาย ตีกลับเอกสารรับเข้าตอบกลับภายใน ⚠️\n>เรื่อง :  ".$request->docrtdt_topic."\n>ที่ร่าง :  ".$request->docrtdt_draft."\n>วันที่ : ".$request->docrtdt_date."\n>เวลาแจ้งเตือน : ".date('Y-m-d H:i')." ";
                    functionController::line_notify($message,$tokens_Check->group_token);
                }
                return redirect()->route('documents_retrun_inside_secretary_all_0')->with('success',"ตีกลับเรียบร้อย");
            }else{
                return redirect('member_dashboard')->with('error','เกิดข้อผิดพลาด [update_docrt_docs]!');
            }
        }else{
            if(Auth::user()->id == $request->docrt_sealid_0){
                $docrt_sealdate = 'docrt_sealdate_0';

                $docrt_sealid = 'docrt_sealid_1';
                $docrt_status = '4';
            }else if(Auth::user()->id == $request->docrt_sealid_1){
                $docrt_sealdate = 'docrt_sealdate_1';

                $docrt_sealid = 'docrt_sealid_0';
                $docrt_status = '3';
            }else{
                return redirect('member_dashboard')->with('error','เกิดข้อผิดพลาด [Auth_id!=docrt_sealid] !');
            }

            $user_check = User::where('id', $request->docrt_sealid)
            ->first();
            if($user_check->level == '8'){
                //หน้าห้อง
                $update_documents_retrun = documents_retrun::where('docrt_id', $request->docrt_id)->update([
                    $docrt_sealdate=>date('Y-m-d H:i:s'),
                    $docrt_sealid=>$request->docrt_sealid,
                    'docrt_status'=>$docrt_status,
                    'docrt_updated_at'=>date('Y-m-d H:i:s')
                ]);

                //linetoken
                $tokens_Check = DB::table('tokens')
                ->where('token_site_id', Auth::user()->site_id)
                ->where('token_level', $user_check->level)
                ->first();
                if($tokens_Check){
                    $message = "\n⚠️ หน้าห้องปลัด|หน้าห้องนาย ลงนามเอกสารรับเข้าตอบกลับภายใน ⚠️\n>เรื่อง :  ".$request->docrtdt_topic."\n>ที่ร่าง :  ".$request->docrtdt_draft."\n>วันที่ : ".$request->docrtdt_date."\n>เวลาแจ้งเตือน : ".date('Y-m-d H:i')." ";
                    functionController::line_notify($message,$tokens_Check->token_token);
                }
            }else if($user_check->level == '2'){
                //ปลัดรองปลัด
                $update_documents_retrun = documents_retrun::where('docrt_id', $request->docrt_id)->update([
                    $docrt_sealdate=>date('Y-m-d H:i:s'),
                    'docrt_sealid_2'=>$request->docrt_sealid,
                    'docrt_status'=>'5',
                    'docrt_updated_at'=>date('Y-m-d H:i:s')
                ]);

                //linetoken
                $tokens_Check = DB::table('tokens')
                ->where('token_site_id', Auth::user()->site_id)
                ->where('token_level', $user_check->level)
                ->first();
                if($tokens_Check){
                    $message = "\n⚠️ หน้าห้องปลัด|หน้าห้องนาย ลงนามเอกสารรับเข้าตอบกลับภายใน ⚠️\n>เรื่อง :  ".$request->docrtdt_topic."\n>ที่ร่าง :  ".$request->docrtdt_draft."\n>วันที่ : ".$request->docrtdt_date."\n>เวลาแจ้งเตือน : ".date('Y-m-d H:i')." ";
                    functionController::line_notify($message,$tokens_Check->token_token);
                }
            }else{
                return redirect('member_dashboard')->with('error','เกิดข้อผิดพลาด [user_check]!');
            }

            if($update_documents_retrun){
                return redirect()->route('documents_retrun_inside_secretary_all_0')->with('success',"ส่งเรียบร้อย");
            }else{
                return redirect('member_dashboard')->with('error','เกิดข้อผิดพลาด [update_documents_retrun]!');
            }

        }

    }

}
