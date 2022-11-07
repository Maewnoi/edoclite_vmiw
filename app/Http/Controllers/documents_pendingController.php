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

        if(Auth::user()->level == '4' && $Groupmem->group_name == 'สำนักปลัด'){
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
        //Groupmem เช็คกองงาน
        $Groupmem = Groupmem::where('group_site_id',Auth::user()->site_id)
        ->where('group_id',Auth::user()->group)
        ->first();

        if(Auth::user()->level == '4' && $Groupmem->group_name == 'สำนักปลัด'){
        //หัวหน้าสำนักปลัด
        $document_detail = document::where('doc_id', $id)->where('doc_site_id',Auth::user()->site_id)->first();
        $GroupmemS = Groupmem::where('group_site_id',Auth::user()->site_id)->get();
            return view('member.documents_pending.detail',compact('document_detail','GroupmemS'));
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
           return redirect()->back()->with('error','พบปัญหาการประทับตากรุณาแจ้งผู้พัฒนา !');
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
            'doc_updated_at'=>date('Y-m-d H:i:s')
        ]);

        
        
        if($update_documents){
            return redirect()->route('documents_pending_all')->with('success',"พิจารณาเรียบร้อย");
        }else{
            return redirect()->back()->with('error','พบปัญหาการอัพเดตข้อมูลกรุณาแจ้งผู้พัฒนา !');
        }

    }


}
