<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Groupmem;
use App\Models\document;
use App\Models\sub_doc;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\functionController;

class documents_pendingController extends Controller
{
    //

    public function index(){
        //Groupmem เช็คกองงาน
        $Groupmem = Groupmem::where('group_site_id',Auth::user()->site_id)
        ->where('group_id',Auth::user()->group)
        ->first();

        if(Auth::user()->center == '1'){
        //หัวหน้าสำนักปลัด
            // $documents = document::where('doc_site_id',Auth::user()->site_id)
            // ->where('doc_type', '0')
            // ->where('doc_template', 'A')
            // ->where('doc_status', 'waiting')
            // ->get();
            return view('member.documents_pending.index');
        }else{
            return redirect('member_dashboard')->with('error','คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }
    public function detail($id){

        if(Auth::user()->center == '1'){
            //หัวหน้าสำนักปลัด
            $document_detail = document::where('doc_id', $id)->where('doc_site_id',Auth::user()->site_id)->first();
            $GroupmemS = Groupmem::where('group_site_id',Auth::user()->site_id)->get();
   
            if($document_detail->doc_status == 'success'){
                $sub_docsS = sub_doc::where('sub_docid', $id)->get();
                foreach($sub_docsS as $row_sub_docs){
                    $sub_recid_arr[] = $row_sub_docs->sub_recid;
                }
                $sub_docsS_ip = implode(",", $sub_recid_arr);
                // dd($sub_docsS_ip);
                $GroupmemS_success = Groupmem::where('group_site_id',Auth::user()->site_id)
                ->whereNotIn('group_id', $sub_recid_arr)
                ->get();
            }else{
                $sub_docsS = array();
                $GroupmemS_success = array();
            }

            // dd($GroupmemS_success);
            return view('member.documents_pending.detail',compact('document_detail','sub_docsS','GroupmemS','GroupmemS_success'));
        }else{
            return redirect('member_dashboard')->with('error','คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }

    public function pending(Request $request){
        //ตรวจสอบข้อมูลที่กรอกเข้ามาก่อน
        $request->validate(
            [
                'sub_recid'=>'required|max:255',
                'pos'=>'required|max:255'
            ],
            [
                'sub_recid.required'=>"กรุณาเลือกกองที่เกี่ยวข้องด้วยครับ",
                'sub_recid.max' => "ห้ามป้อนเกิน 255 ตัวอักษร",

                'pos.required'=>"กรุณาป้อตำแหน่งด้วยครับ",
                'pos.max' => "ห้ามป้อนเกิน 255 ตัวอักษร"
            ]
        );

        //ประทับตาและเซ็น
        $full_path = functionController::funtion_generate_PDF_I($request->sub_recid ,$request->seal_point ,$request->doc_recnum ,$request->doc_date ,$request->doc_time ,$request->pos ,$request->doc_filedirec ,$request->doc_id ,$request->seal_deteil ,$request->doc_docnum ,$request->doc_title);
        if(!$full_path){
           return redirect()->back()->with('error','พบปัญหาการประทับตากรุณาแจ้งผู้พัฒนา ![full_path]');
        }
        //ca
        $code_ca_64 = functionController::funtion_generate_CA_for_PDF($full_path);
        if(!$code_ca_64){
            return redirect()->back()->with('error','พบปัญหาการประทับตากรุณาแจ้งผู้พัฒนา ![code_ca_64]');
        }

        //นับจำนวนกองงาน
        for ($t = 0; $t < count($request->sub_recid); $t++) {
            $sub_recid[$t] = $request->sub_recid[$t];
            //insert tb sub_docs
            $insert_sub_docs = sub_doc::insert([
                'sub_docid'=>$request->doc_id,
                'sub_recid'=>$sub_recid[$t],
                'sub_status'=>'0',
                'sub_check'=>'0',
                'sub_created_at'=>date('Y-m-d H:i:s')
            ]);

            //linetoken
            $tokens_Check = Groupmem::where('group_site_id', Auth::user()->site_id)
            ->where('group_id', $sub_recid[$t])
            ->first();
            if($tokens_Check){
                $message = "\n⚠️ พิจารณาเอกสารรับเข้าภายนอก ⚠️\n>เลขที่หนังสือ :  ".$request->doc_docnum."\n>หน่วยงานต้นเรื่อง :  ".$request->doc_origin."\n>เรื่อง : ".$request->doc_title."\n>เวลาแจ้งเตือน : ".date('Y-m-d H:i')." ";
                functionController::line_notify($message,$tokens_Check->group_token);
            }
        }

        //update tb documents
        $update_documents = document::where('doc_id', $request->doc_id)->update([
            'doc_status'=>'success',
            'doc_filedirec_1'=>$full_path,
            'doc_filedirec_1_ca'=>$code_ca_64,
            'doc_updated_at'=>date('Y-m-d H:i:s')
        ]);

        
        
        if($update_documents){
            return redirect()->route('documents_pending_all')->with('success',"พิจารณาเรียบร้อย");
        }else{
            return redirect()->back()->with('error','พบปัญหาการอัพเดตข้อมูลกรุณาแจ้งผู้พัฒนา !');
        }

    }

    
    public function updateGroupmem(Request $request){
           //ตรวจสอบข้อมูลที่กรอกเข้ามาก่อน
           $request->validate(
            [
                'sub_recid'=>'required|max:255'
            ],
            [
                'sub_recid.required'=>"กรุณาเลือกกองที่เกี่ยวข้องด้วยครับ",
                'sub_recid.max' => "ห้ามป้อนเกิน 255 ตัวอักษร"
            ]
        );
        $check_err = 0;
        //เช็คจำนวนลบ
        for ($e = 0; $e < count($request->sub_recid_old); $e++) {
            $sub_recid_old[$e] = $request->sub_recid_old[$e];
            if (!in_array($sub_recid_old[$e], $request->sub_recid)) {
                // echo $sub_recid_old[$e]." ลบ<br>";
                $delete_sub_docs = sub_doc::where('sub_docid', $request->doc_id)
                ->where('sub_recid', $sub_recid_old[$e])
                ->delete();
                $check_err = 1;
            }
        }

        //เช็ตจำนวนเพิ่ม
        for ($t = 0; $t < count($request->sub_recid); $t++) {
            $sub_recid[$t] = $request->sub_recid[$t];
            $document_admission_all[$t] = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->where('sub_docid', $request->doc_id)
            ->where('sub_recid', $sub_recid[$t])
            ->first();
            if(!$document_admission_all[$t]){
                // echo $sub_recid[$t]."เพิ่ม<br>";
                $insert_sub_docs = sub_doc::insert([
                    'sub_docid'=>$request->doc_id,
                    'sub_recid'=>$sub_recid[$t],
                    'sub_status'=>'0',
                    'sub_check'=>'0',
                    'sub_created_at'=>date('Y-m-d H:i:s')
                ]);
                $check_err = 1;
            }
        }

        if($check_err == 1){
            //linetoken
            $tokens_Check = DB::table('tokens')
            ->where('token_site_id', Auth::user()->site_id)
            ->where('token_level', Auth::user()->level)
            ->first();
            if($tokens_Check){
                $message = "\n⚠️ แก้ไขกองที่เกี่ยวข้องเอกสารรับเข้าภายนอก ⚠️\n>เลขที่รับส่วนงาน :  ".$request->doc_recnum."\n>เลขที่หนังสือ :  ".$request->doc_docnum."\n>เรื่อง :  ".$request->doc_title."\n>เวลาแจ้งเตือน : ".date('Y-m-d H:i')." ";
                functionController::line_notify($message,$tokens_Check->token_token);
            }
            return redirect()->route('documents_pending_all')->with('success',"แก้ไขกองที่เกี่ยวข้องเรียบร้อย");
        }else{
            return redirect()->back()->with('error','ไม่มีการแก้ไขใดๆ !');
        }

    }

}
