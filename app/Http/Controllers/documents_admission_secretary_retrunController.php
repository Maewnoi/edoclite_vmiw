<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\document;
use App\Models\User;
use App\Models\sub_doc;
use App\Models\sub2_doc;
use App\Models\sub3_doc;
use App\Models\sub3_detail;
use App\Models\Groupmem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\functionController;

class documents_admission_secretary_retrunController extends Controller
{
    //
    public function index_0(){
        if(Auth::user()->level=='8'){
            return view('member.documents_admission_secretary_retrun.index');
        }else{
            return redirect('member_dashboard')->with('error','คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }

    public function index_1(){
        if(Auth::user()->level=='8'){
            return view('member.documents_admission_secretary_retrun.index');
        }else{
            return redirect('member_dashboard')->with('error','คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }

    public function detail($id){
        if(Auth::user()->level=='8'){
            $document_detail = document::join('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->join('sub2_docs','sub2_docs.sub2_subid','sub_docs.sub_id')
            ->join('sub3_docs','sub3_docs.sub3_sub_2id','sub2_docs.sub2_id')
            ->join('sub3_details','sub3_details.sub3d_sub_3id','sub3_docs.sub3_id')
            ->where('doc_id', $id)
            ->where('doc_site_id',Auth::user()->site_id)
            ->first();

            if($document_detail->sub3_sealid_0 != null){
                $sub3_sealid_0 = $document_detail->sub3_sealid_0;
            }else{
                $sub3_sealid_0 = null;
            }
            if($document_detail->sub3_sealid_1 != null){
                $sub3_sealid_1 = $document_detail->sub3_sealid_1;
            }else{
                $sub3_sealid_1 = null;
            }

            $userS = User::where(function ($query) {
                $query->where('level', '8')
                      ->orWhere('level', '2');
            })
            ->when($sub3_sealid_0 != null, function ($builder_0) use ($sub3_sealid_0){
                $builder_0->where('id','!=',$sub3_sealid_0);
            })
            ->when($sub3_sealid_1 != null, function ($builder_1) use ($sub3_sealid_1){
                $builder_1->where('id','!=',$sub3_sealid_1);
            })
            ->where('site_id',Auth::user()->site_id)
            ->get();

            return view('member.documents_admission_secretary_retrun.detail',compact('document_detail','userS'));
        }else{
            return redirect('member_dashboard')->with('error','คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }


    public function understand(Request $request){
        //ตรวจสอบข้อมูลที่กรอกเข้ามาก่อน
        $request->validate(
            [
                'sub3_sealid'=>'required|max:255'
            ],
            [
                'sub3_sealid.required' => "กรุณาเลือกผู้รับด้วยครับ",
                'sub3_sealid.max' => "ห้ามป้อนเกิน 255 ตัวอักษร"
            ]
        );

        if($request->sub3_sealid == 'ตีกลับ'){
            $update_sub3_docs = sub3_doc::where('sub3_id', $request->sub3_id)->update([
                'sub3_check_0'=>'0',
                'sub3_inspector_0'=>null,
                'sub3_datetime_0'=>null,
                'sub3_check_1'=>'0',
                'sub3_inspector_1'=>null,
                'sub3_datetime_1'=>null,
                'sub3_check_2'=>'0',
                'sub3_inspector_2'=>null,
                'sub3_datetime_2'=>null,

                'sub3_sealdetail_0'=>null,
                'sub3_sealnote_0'=>null,
                'sub3_sealpos_0'=>null,
                'sub3_sealdate_0'=>null,
                'sub3_sealid_0'=>null,

                'sub3_sealdetail_1'=>null,
                'sub3_sealnote_1'=>null,
                'sub3_sealpos_1'=>null,
                'sub3_sealdate_1'=>null,
                'sub3_sealid_1'=>null,

                'sub3_note'=>$request->sub3_note,
                'sub3_status'=>'C',
                'sub3_updated_at'=>date('Y-m-d H:i:s')
            ]);

            if($update_sub3_docs){
                //linetoken
                $tokens_Check = Groupmem::where('group_site_id', Auth::user()->site_id)
                ->where('group_id', $request->sub_recid)
                ->first();

                if($tokens_Check){
                    $message = "\n⚠️ หน้าห้องปลัด|หน้าห้องนาย ตีกลับเอกสารรับเข้าตอบกลับภายนอก ⚠️\n>เลขที่หนังสือ :  ".$request->doc_docnum."\n>หน่วยงานต้นเรื่อง :  ".$request->doc_origin."\n>เรื่อง : ".$request->doc_title."\n>เวลาแจ้งเตือน : ".date('Y-m-d H:i')." ";
                    functionController::line_notify($message,$tokens_Check->group_token);
                }
                return redirect()->route('documents_admission_secretary_retrun_all_0')->with('success',"ตีกลับเรียบร้อย");
            }else{
                return redirect('member_dashboard')->with('error','เกิดข้อผิดพลาด [update_sub3_docs]!');
            }
        }else{
           
            if(Auth::user()->id == $request->sub3_sealid_0){
                $sub3_sealdate = 'sub3_sealdate_0';

                $sub3_sealid = 'sub3_sealid_1';
                $sub3_status = '4';
            }else if(Auth::user()->id == $request->sub3_sealid_1){
                $sub3_sealdate = 'sub3_sealdate_1';

                $sub3_sealid = 'sub3_sealid_0';
                $sub3_status = '3';
            }else{
                return redirect('member_dashboard')->with('error','เกิดข้อผิดพลาด [Auth_id!=sub3_sealid] !');
            }

            $user_check = User::where('id', $request->sub3_sealid)
            ->first();
            if($user_check->level == '8'){
                //หน้าห้อง
             
                $update_sub3_docs = sub3_doc::where('sub3_id', $request->sub3_id)->update([
                    $sub3_sealdate=>date('Y-m-d H:i:s'),
                    $sub3_sealid=>$request->sub3_sealid,
                    'sub3_status'=>$sub3_status,
                    'sub3_updated_at'=>date('Y-m-d H:i:s')
                ]);

                //linetoken
                $tokens_Check = DB::table('tokens')
                ->where('token_site_id', Auth::user()->site_id)
                ->where('token_level', $user_check->level)
                ->first();
                if($tokens_Check){
                    $message = "\n⚠️ หน้าห้องปลัด|หน้าห้องนาย ลงนามเอกสารรับเข้าตอบกลับภายนอก ⚠️\n>เลขที่หนังสือ :  ".$request->doc_docnum."\n>หน่วยงานต้นเรื่อง :  ".$request->doc_origin."\n>เรื่อง : ".$request->doc_title."\n>เวลาแจ้งเตือน : ".date('Y-m-d H:i')." ";
                    functionController::line_notify($message,$tokens_Check->token_token);
                }
            }else if($user_check->level == '2'){
                //ปลัดรองปลัด
                $update_sub3_docs = sub3_doc::where('sub3_id', $request->sub3_id)->update([
                    $sub3_sealdate=>date('Y-m-d H:i:s'),
                    'sub3_sealid_2'=>$request->sub3_sealid,
                    'sub3_status'=>'5',
                    'sub3_updated_at'=>date('Y-m-d H:i:s')
                ]);

                //linetoken
                $tokens_Check = DB::table('tokens')
                ->where('token_site_id', Auth::user()->site_id)
                ->where('token_level', $user_check->level)
                ->first();
                if($tokens_Check){
                    $message = "\n⚠️ หน้าห้องปลัด|หน้าห้องนาย ลงนามเอกสารรับเข้าตอบกลับภายนอก ⚠️\n>เลขที่หนังสือ :  ".$request->doc_docnum."\n>หน่วยงานต้นเรื่อง :  ".$request->doc_origin."\n>เรื่อง : ".$request->doc_title."\n>เวลาแจ้งเตือน : ".date('Y-m-d H:i')." ";
                    functionController::line_notify($message,$tokens_Check->token_token);
                }
            }else{
                return redirect('member_dashboard')->with('error','เกิดข้อผิดพลาด [user_check]!');
            }

            if($update_sub3_docs){
                return redirect()->route('documents_admission_secretary_retrun_all_0')->with('success',"ส่งเรียบร้อย");
            }else{
                return redirect('member_dashboard')->with('error','เกิดข้อผิดพลาด [update_sub3_docs]!');
            }

        }
    }
}
