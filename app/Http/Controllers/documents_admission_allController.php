<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\document;
use App\Models\Groupmem;
use App\Models\reserve_number;
use App\Models\sub_doc;
use App\Models\sub2_doc;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\sites;

class documents_admission_allController extends Controller
{
    //
    public function index(){
        
        if(Auth::user()->level=='3'){
        //สารบรรณกลาง
            // $documents = document::where('doc_site_id',Auth::user()->site_id)
            // ->where('doc_type', '0')
            // ->where('doc_template', 'A')
            // ->orderby('doc_date','DESC')
            // ->get();
            return view('member.documents_admission_all.index');
        }else{
            return redirect('member_dashboard')->with('error','คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }
    public function detail($id){

        if(Auth::user()->level=='3'){
            //สารบรรณกลาง
            $document_detail = document::where('doc_id', $id)->where('doc_site_id',Auth::user()->site_id)->first();
            if($document_detail->doc_status == 'success'){
                $sub_docsS = sub_doc::where('sub_docid', $id)->get();
                foreach($sub_docsS as $row_sub_docs){
                    $sub_recid_arr[] = $row_sub_docs->sub_recid;
                }
                $sub_docsS_ip = implode(",", $sub_recid_arr);
                // dd($sub_docsS_ip);
                $GroupmemS = Groupmem::where('group_site_id',Auth::user()->site_id)
                ->whereNotIn('group_id', $sub_recid_arr)
                ->get();
            }else{
                $sub_docsS = array();
                $GroupmemS = array();
            }
            return view('member.documents_admission_all.detail',compact('document_detail','sub_docsS','GroupmemS'));
        }else{
            return redirect('member_dashboard')->with('error','คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }
    
    public function updateGeneral(Request $request){
         //ตรวจสอบข้อมูลที่กรอกเข้ามาก่อน
         $request->validate(
            [
                'doc_docnum'=>'required|max:255',
                'doc_date'=>'required',
                'doc_date_2'=>'required',
                'doc_title'=>'required|max:255'
            ],
            [

                'doc_docnum.required'=>"กรุณาป้อนเลขที่หนังสือด้วยครับ",
                'doc_docnum.max' => "ห้ามป้อนเกิน 255 ตัวอักษร",

                'doc_date.required'=>"กรุณาเลือกวันที่ด้วยครับ",

                'doc_date_2.required'=>"กรุณาเลือกลงวันที่ด้วยครับ", 

                'doc_title.required'=>"กรุณาป้อนเรื่องด้วยครับ",
                'doc_title.max' => "ห้ามป้อนเกิน 255 ตัวอักษร"
            ]
        );

        //เช็คเลขที่หนังสือค่าซํ้า
        if($request->doc_docnum != '-'){
            $document_Check_doc_docnum = document::where('doc_docnum', $request->doc_docnum)
            ->where('doc_id','!=', $request->doc_id)
            ->where('doc_type', '0')
            ->where('doc_template', 'A')
            ->where('doc_site_id', Auth::user()->site_id)
            ->first();
            if($document_Check_doc_docnum){
                return redirect()->back()->with('error','ตรวจพบเลขที่หนังสือ '.$request->doc_docnum.' ซํ้าในระบบ');
            }
        }

        //query
        $update_document = document::where('doc_id', $request->doc_id)->update([
            'doc_docnum'=>$request->doc_docnum,
            'doc_date'=>$request->doc_date,
            'doc_date_2'=>$request->doc_date_2,
            'doc_title' =>$request->doc_title,
            'doc_updated_at'=>date('Y-m-d H:i:s')
        ]);

        if($update_document){
            return redirect()->back()->with('success',"อัพเดตข้อมูลเรียบร้อย");
        }else{
            return redirect()->back()->with('error','พบปัญหาการอัพเดตข้อมูลกรุณาแจ้งผู้พัฒนา !');
        }

    }
    
    public function updateFile(Request $request){
        //ตรวจสอบข้อมูลที่กรอกเข้ามาก่อน
        $request->validate(
            [
                'doc_filedirec'=>'required|mimes:pdf|max:10000',
            ],
            [
                'doc_filedirec.required'=>"กรุณาแนบอัพโหลดไฟล์เอกสารด้วยครับ",
                'doc_filedirec.mimes'=>"รองรับไฟล์นามสกุล PDF เท่านั้น",
                'doc_filedirec.max'=>"รองรับขนาดไฟล์ไม่เกิน 10MB",
            ]
        );
        $sites= sites::where('sites.site_id', Auth::user()->site_id)->first();
        $date_new = date('Y-m-d');
        $year_new = date('Y');

        //การเข้ารหัสไฟล์_doc_filedirec
        $doc_filedirec = $request->file('doc_filedirec');
        //Generate ชื่อไฟล์
        $name_gen_new = $request->doc_id."_".$date_new;
        // ดึงนามสกุลไฟล์
        $doc_filedirec_img_ext = strtolower($doc_filedirec->getClientOriginalExtension());
        $doc_filedirec_img_name = $name_gen_new.'.'.$doc_filedirec_img_ext;
        //อัพโหลดและบันทึกข้อมูล
        $upload_location = 'image/'.$sites->site_path_folder.'/'.$year_new.'/original/';
        $doc_filedirec_full_path = $upload_location.$doc_filedirec_img_name;

        //ลบภาพเก่าและอัพภาพใหม่แทนที่
        $old_doc_filedirec = $request->old_doc_filedirec;
        unlink($old_doc_filedirec);

        $doc_filedirec->move($upload_location,$doc_filedirec_img_name);

        //query
        $update_document = document::where('doc_id', $request->doc_id)->update([
            'doc_filedirec'=>$doc_filedirec_full_path,
            'doc_updated_at'=>date('Y-m-d H:i:s')
        ]);

        if($update_document){
            return redirect()->back()->with('success',"อัพเดตข้อมูลเรียบร้อย");
        }else{
            return redirect()->back()->with('error','พบปัญหาการอัพเดตข้อมูลกรุณาแจ้งผู้พัฒนา !');
        }

    }

    public function delete(Request $request){
        if($request->doc_attached_file != ''){
            $doc_attached_file = $request->doc_attached_file;
            unlink($doc_attached_file);
        }
        if($request->doc_filedirec != ''){
            $doc_filedirec = $request->doc_filedirec;
            unlink($doc_filedirec);
        }

        $reserve_number_Check_reserve_number_receive = reserve_number::where('reserve_number', $request->doc_recnum)
        ->where('reserve_site',Auth::user()->site_id)
        ->where('reserve_type', '0')
        ->where('reserve_template', 'A')
        ->first();
        if($reserve_number_Check_reserve_number_receive){
            $update_reserve_number_receive = reserve_number::where('reserve_id', $reserve_number_Check_reserve_number_receive->reserve_id)->update([
                'reserve_status'=>'2',
                'reserve_used'=>NULL,
                'reserve_updated_at'=>date('Y-m-d H:i:s')
            ]);
        }else{
            $insert_reserve_number_receive = reserve_number::insert([
                'reserve_number'=>$request->doc_recnum,
                'reserve_date'=>date('Y-m-d H:i:s'),
                'reserve_status'=>'2',
                'reserve_type'=>'0',
                'reserve_template' =>'A',
                'reserve_owner'=>Auth::user()->id,
                'reserve_site'=>Auth::user()->site_id,
                'reserve_created_at'=>date('Y-m-d H:i:s')
            ]);
        }

        $delete_document = document::where('doc_id', $request->doc_id)->delete();

        //linetoken
        $tokens_Check = DB::table('tokens')
        ->where('token_site_id', Auth::user()->site_id)
        ->where('token_level', Auth::user()->level)
        ->first();
        if($tokens_Check){
            $message = "\n⚠️ ลบเอกสารรับเข้าภายนอก ⚠️\n>เลขที่รับส่วนงาน :  ".$request->doc_recnum."\n>เลขที่หนังสือ :  ".$request->doc_docnum."\n>เรื่อง :  ".$request->doc_title."\n>เวลาแจ้งเตือน : ".date('Y-m-d H:i')." ";
            functionController::line_notify($message,$tokens_Check->token_token);
        }

        if($delete_document){
            return redirect()->route('documents_admission_all')->with('success',"ลบข้อมูลเรียบร้อย");
        }else{
            return redirect()->back()->with('error','พบปัญหาการลบข้อมูลกรุณาแจ้งผู้พัฒนา !');
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
            return redirect()->route('documents_admission_all')->with('success',"แก้ไขกองที่เกี่ยวข้องเรียบร้อย");
        }else{
            return redirect()->back()->with('error','ไม่มีการแก้ไขใดๆ !');
        }
    }
}