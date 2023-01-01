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

class documents_admission_division_retrunController extends Controller
{
    public function index(){
        if(Auth::user()->level=='4'){
            // $document_admission_division_retrun = document::join('sub_docs','sub_docs.sub_docid','documents.doc_id')
            // ->join('sub2_docs','sub2_docs.sub2_subid','sub_docs.sub_id')
            // ->join('sub3_docs','sub3_docs.sub3_sub_2id','sub2_docs.sub2_id')
            // ->join('sub3_details','sub3_details.sub3d_sub_3id','sub3_docs.sub3_id')
            // ->where('doc_site_id',Auth::user()->site_id)
            // ->where('doc_type', '0')
            // ->where('doc_template', 'A')
            // ->where('doc_status', 'success')
            // ->where('sub_recid', Auth::user()->group)
            // ->where('sub_status', '8')
            // ->where('sub2_status', '1')
            // ->where('sub3_status', '1')
            // ->where('sub3_inspector_1', Auth::user()->id)
            // ->get();


            return view('member.documents_admission_division_retrun.index');
        }else{
            return redirect('member_dashboard')->with('error','คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }

    public function detail($id){
        if(Auth::user()->level=='4'){
            $document_detail = document::join('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->join('sub2_docs','sub2_docs.sub2_subid','sub_docs.sub_id')
            ->join('sub3_docs','sub3_docs.sub3_sub_2id','sub2_docs.sub2_id')
            ->join('sub3_details','sub3_details.sub3d_sub_3id','sub3_docs.sub3_id')
            ->where('doc_id', $id)
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('sub_recid', Auth::user()->group)
            ->where('sub3_inspector_1', Auth::user()->id)
            ->first();

            //หาชื่อ-นามสกุล 8
            $userS_8 = User::where('level', '8')
            ->where('site_id',Auth::user()->site_id)
            ->get();

            //หาชื่อ-นามสกุล 2
            $userS_2 = User::where('level', '2')
            ->where('site_id',Auth::user()->site_id)
            ->get();

            return view('member.documents_admission_division_retrun.detail',compact('document_detail','userS_8','userS_2'));
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
                'sub3_sealid.required'=>"กรุณาเลือกผู้รับด้วยครับ",
                'sub3_sealid.max' => "ห้ามป้อนเกิน 255 ตัวอักษร"
            ]
        );

        if($request->sub3_sealid == 'นิติการ'){
            //หา นิติการ
            $userS_0 = User::where('jurisprudence', '1')
            ->where('site_id',Auth::user()->site_id)
            ->where('group', Auth::user()->group)
            ->first();
            if($userS_0){
                $update_sub3_docs = sub3_doc::where('sub3_id', $request->sub3_id)->update([
                    'sub3_check_1'=>'1',
                    'sub3_datetime_1'=>date('Y-m-d H:i:s'),
                    'sub3_status'=>'2',
                    'sub3_updated_at'=>date('Y-m-d H:i:s')
                ]);
                if($update_sub3_docs){
                    //linetoken
                    $tokens_Check = Groupmem::where('group_site_id', Auth::user()->site_id)
                    ->where('group_id', Auth::user()->group)
                    ->first();
                    if($tokens_Check){
                        $message = "\n⚠️ หัวหน้ากองรับทราบตอบกลับเอกสารภายนอก ⚠️\n>เลขที่หนังสือ :  ".$request->doc_docnum."\n>หน่วยงานต้นเรื่อง :  ".$request->doc_origin."\n>เรื่อง : ".$request->doc_title."\n>เวลาแจ้งเตือน : ".date('Y-m-d H:i')." ";
                        functionController::line_notify($message,$tokens_Check->group_token);
                    }
                    return redirect()->route('documents_admission_division_retrun')->with('success',"รับทราบเรียบร้อย");
                }else{
                    return redirect('member_dashboard')->with('error','เกิดข้อผิดพลาด [update_sub3_docs] !');
                }
            }else{
                return redirect('member_dashboard')->with('error','เกิดข้อผิดพลาด ไม่พบนิติการในฝ่าย กรุณาแต่งตั้งนิติการในระบบก่อน [userS_0] !');
            }
        }else{
            $user_check_l = User::where('id',$request->sub3_sealid)
            ->first();
            if($user_check_l){
                if($user_check_l->level == '8'){
                    //หา หน้าห้อง
                    $update_sub3_docs = sub3_doc::where('sub3_id', $request->sub3_id)->update([
                        'sub3_check_1'=>'1',
                        'sub3_datetime_1'=>date('Y-m-d H:i:s'),
                        'sub3_status'=>'3',
                        'sub3_sealid_0'=>$request->sub3_sealid,
                        'sub3_updated_at'=>date('Y-m-d H:i:s')
                    ]);
                }else if($user_check_l->level == '2'){
                    //หา ปลัด||รองปลัด
                    $update_sub3_docs = sub3_doc::where('sub3_id', $request->sub3_id)->update([
                        'sub3_check_1'=>'1',
                        'sub3_datetime_1'=>date('Y-m-d H:i:s'),
                        'sub3_status'=>'5',
                        'sub3_sealid_2'=>$request->sub3_sealid,
                        'sub3_updated_at'=>date('Y-m-d H:i:s')
                    ]);
                }else{
                    return redirect('member_dashboard')->with('error','เกิดข้อผิดพลาด [level] !');
                }
            }else{
                return redirect('member_dashboard')->with('error','เกิดข้อผิดพลาด [user_check_l] !');
            }

            if($update_sub3_docs){
                //linetoken
                $tokens_Check = Groupmem::where('group_site_id', Auth::user()->site_id)
                ->where('group_id', Auth::user()->group)
                ->first();
                if($tokens_Check){
                    $message = "\n⚠️ หัวหน้ากองรับทราบตอบกลับเอกสารภายนอก ⚠️\n>เลขที่หนังสือ :  ".$request->doc_docnum."\n>หน่วยงานต้นเรื่อง :  ".$request->doc_origin."\n>เรื่อง : ".$request->doc_title."\n>เวลาแจ้งเตือน : ".date('Y-m-d H:i')." ";
                    functionController::line_notify($message,$tokens_Check->group_token);
                }
                return redirect()->route('documents_admission_division_retrun')->with('success',"รับทราบเรียบร้อย");
            }else{
                return redirect('member_dashboard')->with('error','เกิดข้อผิดพลาด [update_sub3_docs] !');
            }

        }

       
    }
}
