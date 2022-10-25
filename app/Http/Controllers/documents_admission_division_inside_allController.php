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

class documents_admission_division_inside_allController extends Controller
{
    //
    //งานรอพิจารณา
    public function index_0(){
        if(Auth::user()->level=='4'){
            //หัวหน้ากอง
            $document_admission_division_inside_all = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '1')
            ->where(function ($query) {
                $query->where('doc_template', 'B')
                      ->orWhere('doc_template', 'C')
                      ->orWhere('doc_template', 'D')
                      ->orWhere('doc_template', 'E');
            })
            ->where('doc_status', 'success')
            ->where('sub_recid', Auth::user()->group)
            ->where('sub_status', '2')
            ->where('seal_id_1', Auth::user()->id)
            ->get();
            return view('member.documents_admission_division_inside_all.index',compact('document_admission_division_inside_all'));
        }else{
            return redirect('member_dashboard')->withErrors('คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }
    //งานพิจารณาแล้ว
    public function index_1(){
        if(Auth::user()->level=='4'){
            //หัวหน้ากอง
            $document_admission_division_inside_all = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '1')
            ->where(function ($query) {
                $query->where('doc_template', 'B')
                      ->orWhere('doc_template', 'C')
                      ->orWhere('doc_template', 'D')
                      ->orWhere('doc_template', 'E');
            })
            ->where('doc_status', 'success')
            ->where('sub_recid', Auth::user()->group)
            ->where('sub_status', '!=','2')
            ->where('seal_id_1', Auth::user()->id)
            ->where('seal_date_1', '!=', NULL)
            ->get();
            return view('member.documents_admission_division_inside_all.index',compact('document_admission_division_inside_all'));
        }else{
            return redirect('member_dashboard')->withErrors('คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }

    public function detail($id){
        if(Auth::user()->level=='4'){
            //หัวหน้ากอง
            $document_detail = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->where('doc_id', $id)
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('sub_recid', Auth::user()->group)
            ->where('seal_id_1', Auth::user()->id)
            ->first();

            //หาชื่อ-นามสกุล หัวหน้าฝ่าย
            $userS_0 = User::where('level', '5')
            ->where('site_id',Auth::user()->site_id)
            ->where('group', Auth::user()->group)
            ->get();

            //หาชื่อ-นามสกุล ผู้รับงาน
            $userS_2 = User::where('level', '7')
            ->where('site_id',Auth::user()->site_id)
            ->where('group', Auth::user()->group)
            ->get();

            //หาชื่อ-นามสกุล นายก
            // $userS_1 = User::where('level', '1')
            // ->where('site_id',Auth::user()->site_id)
            // ->get();

            //หาชื่อ-นามสกุล รองนายก|ปลัด|รองปลัด
            // $userS_3 = User::where('level', '2')
            // ->where('site_id',Auth::user()->site_id)
            // ->get();

            return view('member.documents_admission_division_inside_all.detail',compact('document_detail','userS_0','userS_2'));
        }else{
            return redirect('member_dashboard')->withErrors('คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }

    //หัวหน้าฝ่ายลงรับ
    public function takedown(Request $request){
        //ตรวจสอบข้อมูลที่กรอกเข้ามาก่อน
        $request->validate(
            [
                'seal_pos_1_inside'=>'required|max:255'
            ],
            [
                'seal_pos_1_inside.required'=>"กรุณากรอกตำแหน่งด้วยครับ",
                'seal_pos_1_inside.max' => "ห้ามป้อนเกิน 255 ตัวอักษร"
            ]
        );

        if($request->sign_goup_0_inside == ''){
             //นับจำนวนคนทำงาน
             for ($t = 0; $t < count($request->sub2_recid_inside); $t++) {
                $sub2_recid_inside[$t] = $request->sub2_recid_inside[$t];
                $insert_sub2_doc = sub2_doc::insert([
                    'sub2_docid'=>$request->doc_id_inside,
                    'sub2_subid'=>$request->sub_id_inside,
                    'sub2_sendid'=>Auth::user()->group,
                    'sub2_recid'=>$sub2_recid_inside[$t],
                    'sub2_status'=>'0',
                    'sub2_created_at'=>date('Y-m-d H:i:s')
                ]);
            }
            //ประทับตราและเซ็น
            $full_path_inside = functionController::funtion_generate_PDF_III($request->doc_filedirec_1_inside, $request->seal_point_inside, $request->sub_recnum_inside, $request->sub_date_inside, $request->sub_time_inside, $request->sub_id_inside, $request->seal_pos_0_inside, $request->seal_date_1_inside, $request->seal_pos_1_inside, $request->seal_date_0_inside, $request->seal_id_1_inside, $request->seal_id_0_inside, $request->seal_detail_1_inside, $request->seal_detail_0_inside);
            $sub_status_inside = '8';
        }else{
            $user_check_level_goup_3 = User::where('id', $request->sign_goup_0_inside)
            ->first();
            if($user_check_level_goup_3->level == '5'){
                //หัวหน้าฝ่าย
                $update_sub_docs_0 = sub_doc::where('sub_id', $request->sub_id_inside)->update([
                    'seal_id_0'=>$request->sign_goup_0_inside
                ]);
                $sub_status_inside = '1';
            }else{
                return redirect()->back()->withErrors('พบปัญหาการอัพเดตข้อมูลกรุณาแจ้งผู้พัฒนา [user_check_level_goup_3]!');
            }
            $full_path_inside = '';
        }

        $update_sub_docs = sub_doc::where('sub_id', $request->sub_id_inside)->update([
            'seal_detail_1'=>$request->seal_detail_1_inside,
            'seal_pos_1'=>$request->seal_pos_1_inside,
            'seal_date_1'=>date('Y-m-d H:i:s'),
            'sub_status'=>$sub_status_inside,
            'seal_file'=>$full_path_inside,
            'sub_updated_at'=>date('Y-m-d H:i:s')
        ]);

        //linetoken
        $tokens_Check = Groupmem::where('group_site_id', Auth::user()->site_id)
        ->where('group_id', Auth::user()->group)
        ->first();
        if($tokens_Check){
            $message = "\n⚠️ หัวหน้ากองพิจารณาเอกสารรับเข้าภายนอก ⚠️\n>เลขที่หนังสือ :  ".$request->doc_docnum_inside."\n>หน่วยงานต้นเรื่อง :  ".$request->doc_origin_inside."\n>เรื่อง : ".$request->doc_title_inside."\n>เวลาแจ้งเตือน : ".date('Y-m-d H:i')." ";
            functionController::line_notify($message,$tokens_Check->group_token);
        }
 
        if($update_sub_docs){
            return redirect()->route('documents_admission_division_inside_all_0')->with('success',"ลงรับเรียบร้อย");
        }else{
            return redirect()->back()->withErrors('พบปัญหาการอัพเดตข้อมูลกรุณาแจ้งผู้พัฒนา !');
        }
    }
}
