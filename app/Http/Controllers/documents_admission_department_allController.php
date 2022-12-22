<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\document;
use App\Models\User;
use App\Models\sub_doc;
use App\Models\sub2_doc;
use App\Models\Groupmem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\functionController;

class documents_admission_department_allController extends Controller
{
    //งานรอพิจารณา
    public function index_0(){
        if(Auth::user()->level=='5'){
            //หัวหน้าฝ่าย
            // $document_admission_department_all = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
            // ->where('doc_site_id',Auth::user()->site_id)
            // ->where('doc_type', '0')
            // ->where('doc_template', 'A')
            // ->where('doc_status', 'success')
            // ->where('sub_recid', Auth::user()->group)
            // ->where('sub_cotton', Auth::user()->cotton)
            // ->where('sub_status', '1')
            // ->where('seal_id_0', Auth::user()->id)
            // ->get();
            return view('member.documents_admission_department_all.index');
        }else{
            return redirect('member_dashboard')->with('error','คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }
    //งานพิจารณาแล้ว
    public function index_1(){
        if(Auth::user()->level=='5'){
            //หัวหน้าฝ่าย
            // $document_admission_department_all = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
            // ->where('doc_site_id',Auth::user()->site_id)
            // ->where('doc_type', '0')
            // ->where('doc_template', 'A')
            // ->where('doc_status', 'success')
            // ->where('sub_recid', Auth::user()->group)
            // ->where('sub_cotton', Auth::user()->cotton)
            // ->where('sub_status', '!=','1')
            // ->where('seal_id_0', Auth::user()->id)
            // ->where('seal_date_0', '!=', NULL)
            // ->get();
            return view('member.documents_admission_department_all.index');
        }else{
            return redirect('member_dashboard')->with('error','คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }

    public function detail($id){
        if(Auth::user()->level=='5'){
           //หัวหน้าฝ่าย
           $document_detail = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->where('doc_id', $id)
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('sub_recid', Auth::user()->group)
            ->where('seal_id_0', Auth::user()->id)
            ->first();

            //หาชื่อ-นามสกุล หัวหน้ากอง
            $userS_0 = User::where('level', '4')
            ->where('site_id',Auth::user()->site_id)
            ->where('group', Auth::user()->group)
            ->get();

            //หาชื่อ-นามสกุล ผู้รับงาน
            $userS_2 = User::where('level', '7')
            ->where('site_id',Auth::user()->site_id)
            ->where('group', Auth::user()->group)
            ->where('cotton', Auth::user()->cotton)
            ->get();

            if($document_detail->sub_status == '8'){
                $sub2_docs = sub2_doc::where('sub2_docid', $id)->get();
            }else{
                $sub2_docs = '';
            }
            return view('member.documents_admission_department_all.detail',compact('document_detail','userS_0','userS_2','sub2_docs'));
        }else{
            return redirect('member_dashboard')->with('error','คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }

    //หัวหน้าฝ่ายลงรับ
    public function takedown(Request $request){
        //ตรวจสอบข้อมูลที่กรอกเข้ามาก่อน
        $request->validate(
            [
                'seal_pos_0'=>'required|max:255'
            ],
            [
                'seal_pos_0.required'=>"กรุณากรอกตำแหน่งด้วยครับ",
                'seal_pos_0.max' => "ห้ามป้อนเกิน 255 ตัวอักษร"
            ]
        );

        //เช็คผู้พิจารณา
        if($request->sign_goup_1 == ''){
            $request->validate(
                [
                    'sub2_recid'=>'required|max:255'
                ],
                [
                    'sub2_recid.required'=>"กรุณากรอกตำแหน่งด้วยครับ",
                    'sub2_recid.max' => "ห้ามป้อนเกิน 255 ตัวอักษร"
                ]
            );
            //ถ้าไม่เลือกคนพิจารณา
            //นับจำนวนคนทำงาน
            for ($t = 0; $t < count($request->sub2_recid); $t++) {
                $sub2_recid[$t] = $request->sub2_recid[$t];
                $insert_sub2_doc = sub2_doc::insert([
                    'sub2_docid'=>$request->doc_id,
                    'sub2_subid'=>$request->sub_id,
                    'sub2_sendid'=>Auth::user()->group,
                    'sub2_recid'=>$sub2_recid[$t],
                    'sub2_status'=>'0',
                    'sub2_created_at'=>date('Y-m-d H:i:s')
                ]);
            }
            //ประทับตราและเซ็น
            $full_path = functionController::funtion_generate_PDF_III($request->doc_filedirec_1,$request->seal_point,$request->sub_recnum,$request->sub_date,$request->sub_time,$request->sub_id,$request->seal_pos_0,$request->seal_date_1,$request->seal_pos_1,$request->seal_date_0,$request->seal_id_1,$request->seal_id_0,$request->seal_detail_1,$request->seal_detail_0);
            $sub_status = '8';
        }else{
            //ถ้าเลือกคนพิจารณา
            //มีการเช็คสถานะ
            $user_check_level = User::where('id', $request->sign_goup_1)
            ->first();
            if($user_check_level->level == '4'){
                //หัวหน้ากอง
                $update_sub_docs_0 = sub_doc::where('sub_id', $request->sub_id)->update([
                    'seal_id_1'=>$request->sign_goup_1
                ]);
                $sub_status = '2';
            }else{
                return redirect()->back()->with('error','พบปัญหาการอัพเดตข้อมูลกรุณาแจ้งผู้พัฒนา [user_check_level]!');
            }
            $full_path = '';
        }

        $update_sub_docs = sub_doc::where('sub_id', $request->sub_id)->update([
            'seal_detail_0'=>$request->seal_detail_0,
            'seal_pos_0'=>$request->seal_pos_0,
            'seal_date_0'=>date('Y-m-d H:i:s'),
            'sub_status'=>$sub_status,
            'seal_file'=>$full_path,
            'sub_updated_at'=>date('Y-m-d H:i:s')
        ]);

        //linetoken
        $tokens_Check = Groupmem::where('group_site_id', Auth::user()->site_id)
        ->where('group_id', Auth::user()->group)
        ->first();
        if($tokens_Check){
            $message = "\n⚠️ หัวหน้าฝ่ายพิจารณาเอกสารรับเข้าภายนอก ⚠️\n>เลขที่หนังสือ :  ".$request->doc_docnum."\n>หน่วยงานต้นเรื่อง :  ".$request->doc_origin."\n>เรื่อง : ".$request->doc_title."\n>เวลาแจ้งเตือน : ".date('Y-m-d H:i')." ";
            functionController::line_notify($message,$tokens_Check->group_token);
        }

        if($update_sub_docs){
            return redirect()->route('documents_admission_department_all_0')->with('success',"ลงรับเรียบร้อย");
        }else{
            return redirect()->back()->with('error','พบปัญหาการอัพเดตข้อมูลกรุณาแจ้งผู้พัฒนา !');
        }
    }
}
