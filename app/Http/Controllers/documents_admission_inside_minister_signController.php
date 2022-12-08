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

class documents_admission_inside_minister_signController extends Controller
{
    //
    public function index_0(){
        if(Auth::user()->level=='1'){
            return view('member.documents_admission_inside_minister_sign.index');
        }else{
            return redirect('member_dashboard')->with('error','คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }

    public function index_1(){
        if(Auth::user()->level=='1'){
            return view('member.documents_admission_inside_minister_sign.index');
        }else{
            return redirect('member_dashboard')->with('error','คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }

    public function detail($id){
        if(Auth::user()->level=='1'){
            $document_detail = document::join('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->join('sub2_docs','sub2_docs.sub2_subid','sub_docs.sub_id')
            ->join('sub3_docs','sub3_docs.sub3_sub_2id','sub2_docs.sub2_id')
            ->join('sub3_details','sub3_details.sub3d_sub_3id','sub3_docs.sub3_id')
            ->where('doc_id', $id)
            ->where('doc_site_id',Auth::user()->site_id)
            ->first();

            return view('member.documents_admission_inside_minister_sign.detail',compact('document_detail'));
        }else{
            return redirect('member_dashboard')->with('error','คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    } 

    public function understand(Request $request){

        //ตรวจสอบข้อมูลที่กรอกเข้ามาก่อน
        $request->validate(
            [
                'sub3_sealpos'=>'required|max:255'
            ],
            [
                'sub3_sealpos.required'=>"กรุณากรอกตำแหน่งด้วยครับ",
                'sub3_sealpos.max' => "ห้ามป้อนเกิน 255 ตัวอักษร"
            ]
        );

        $full_path = functionController::funtion_generate_PDF_VI(
            $request->sub3d_file,
            $request->sub3_sealid_0,
            $request->sub3_sealid_1,
            $request->sub3_sealid_2,
            $request->sub3_sealpos_0,
            $request->sub3_sealpos_1,
            $request->sub3_sealpos,
            $request->doc_id
        );
        if($full_path){
            $update_sub3_details = sub3_detail::where('sub3d_sub_3id', $request->sub3_id)->update([
                'sub3d_file'=>$full_path
            ]);
            $update_sub3_docs = sub3_doc::where('sub3_id', $request->sub3_id)->update([
                'sub3_sealpos_2'=>$request->sub3_sealpos,
                'sub3_sealdate_2'=>date('Y-m-d H:i:s'),
                'sub3_status'=>'6',
                'sub3_updated_at'=>date('Y-m-d H:i:s')
            ]);
            if($update_sub3_docs && $update_sub3_details){
                //linetoken
                $tokens_Check = Groupmem::where('group_site_id', Auth::user()->site_id)
                ->where('group_id', $request->sub_recid)
                ->first();
                if($tokens_Check){
                    $message = "\n⚠️ นายกลงนามเอกสารรับเข้าตอบกลับภายใน ⚠️\n>เลขที่หนังสือ :  ".$request->doc_docnum."\n>หน่วยงานต้นเรื่อง :  ".$request->doc_origin."\n>เรื่อง : ".$request->doc_title."\n>เวลาแจ้งเตือน : ".date('Y-m-d H:i')." ";
                    functionController::line_notify($message,$tokens_Check->group_token);
                }
                return redirect()->route('documents_admission_inside_minister_sign_all_0')->with('success',"ลงนามเรียบร้อย");
            }else{
                return redirect('member_dashboard')->with('error','เกิดข้อผิดพลาด [update_sub3_docs && update_sub3_details] !');
            }
        }else{
            return redirect('member_dashboard')->with('error','เกิดข้อผิดพลาด [funtion_generate_PDF_VI] !');
        }
        
    }
}
