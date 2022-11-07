<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\document;
use App\Models\User;
use App\Models\sub_doc;
use App\Models\sub2_doc;
use App\Models\Groupmem;
use App\Models\reserve_number;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\functionController;

class documents_admission_group_inside_allController extends Controller
{
    //
    //สถานะใหม่
    public function index_0(){
        if(Auth::user()->level=='6'){
            //สารบรรณกอง
            // $document_admission_all_group_inside = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
            // ->where('doc_site_id',Auth::user()->site_id)
            // ->where('doc_type', '1')
            // ->where(function ($query) {
            //     $query->where('doc_template', 'B')
            //           ->orWhere('doc_template', 'C')
            //           ->orWhere('doc_template', 'D')
            //           ->orWhere('doc_template', 'E');
            // })
            // ->where('doc_status', 'success')
            // ->where('sub_recid', Auth::user()->group)
            // ->where('sub_status', '0')
            // ->get();

            return view('member.documents_admission_group_inside_all.index');
        }else{
            return redirect('member_dashboard')->with('error','คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }

    //สถานะกำลังดำเนินการ
    public function index_1(){
        if(Auth::user()->level=='6'){
            //สารบรรณกอง
            // $document_admission_all_group_inside = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
            // ->where('doc_site_id',Auth::user()->site_id)
            // ->where('doc_type', '1')
            // ->where(function ($query) {
            //     $query->where('doc_template', 'B')
            //           ->orWhere('doc_template', 'C')
            //           ->orWhere('doc_template', 'D')
            //           ->orWhere('doc_template', 'E');
            // })
            // ->where('doc_status', 'success')
            // ->where('sub_recid', Auth::user()->group)
            // ->where('sub_status','!=','0')
            // ->where('sub_status','!=','8')
            // ->get();
            return view('member.documents_admission_group_inside_all.index');

        }else{
            return redirect('member_dashboard')->with('error','คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }

    //สถานะดำเนินการแล้ว
    public function index_2(){
        if(Auth::user()->level=='6'){
            //สารบรรณกอง
            // $document_admission_all_group_inside = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
            // ->where('doc_site_id',Auth::user()->site_id)
            // ->where('doc_type', '1')
            // ->where(function ($query) {
            //     $query->where('doc_template', 'B')
            //           ->orWhere('doc_template', 'C')
            //           ->orWhere('doc_template', 'D')
            //           ->orWhere('doc_template', 'E');
            // })
            // ->where('doc_status', 'success')
            // ->where('sub_recid', Auth::user()->group)
            // ->where('sub_status', '8')
            // ->get();
            return view('member.documents_admission_group_inside_all.index');

        }else{
            return redirect('member_dashboard')->with('error','คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }


    public function detail($id){
        if(Auth::user()->level=='6'){
            //สารบรรณกอง
            $document_detail = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->where('doc_id', $id)
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('sub_recid', Auth::user()->group)
            ->first();

            //หาตัวเลขที่จองไว้
            $reserved_numbersS = reserve_number::where('reserve_site',Auth::user()->site_id)
            ->where('reserve_owner',Auth::user()->id)
            ->where('reserve_type', '1')
            ->where('reserve_template', 'A')
            ->where('reserve_status', '0')
            ->get();
            //หาตัวเลขที่หลุดจอง
            $dropped_numbersS = reserve_number::where('reserve_group',Auth::user()->group)
            ->where('reserve_site',Auth::user()->site_id)
            ->where('reserve_type', '1')
            ->where('reserve_template', 'A')
            ->where('reserve_status', '2')
            ->get();

            //หาชื่อ-นามสกุล หัวหน้าฝ่าย
            $userS_0 = User::where('level', '5')
            ->where('site_id',Auth::user()->site_id)
            ->where('group', Auth::user()->group)
            ->get();

            //หาชื่อ-นามสกุล หัวหน้ากอง
            $userS_1 = User::where('level', '4')
            ->where('site_id',Auth::user()->site_id)
            ->where('group', Auth::user()->group)
            ->get();

            //หาชื่อ-นามสกุล ผู้รับงาน
            $userS_2 = User::where('level', '7')
            ->where('site_id',Auth::user()->site_id)
            ->where('group', Auth::user()->group)
            ->get();

           
            return view('member.documents_admission_group_inside_all.detail',compact('document_detail','userS_0','userS_1','userS_2','reserved_numbersS','dropped_numbersS'));
        }else{
            return redirect('member_dashboard')->with('error','คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }

    public static function getdoc_recnum_inside($id) {
        $reserve_number_reserve_date_inside = reserve_number::where('reserve_id',$id)
        ->first();
        if($reserve_number_reserve_date_inside){
            return date('dmY', strtotime($reserve_number_reserve_date_inside->reserve_date));
        }else{
            return redirect('member_dashboard')->with('error','พบปัญหาบางอย่างไม่ถูกต้อง [getdoc_recnum_inside] !');
        }
    }

    //สารบรรณกองลงรับ
    public function takedown(Request $request){
        //ตรวจสอบข้อมูลที่กรอกเข้ามาก่อน
        $request->validate(
            [
                'sub_recnum_inside'=>'required|max:255',
                'sub_date_inside'=>'required|max:255',
                'sub_time_inside'=>'required|max:255'
            ],
            [
                'sub_recnum_inside.required'=>"กรุณากรอกเลขที่ลงรับด้วยครับ",
                'sub_recnum_inside.max' => "ห้ามป้อนเกิน 255 ตัวอักษร",

                'sub_date_inside.required'=>"กรุณาเลือกวันที่ด้วยครับ",
                'sub_date_inside.max' => "ห้ามป้อนเกิน 255 ตัวอักษร",

                'sub_time_inside.required'=>"กรุณาเลือกเวลาด้วยครับ",
                'sub_time_inside.max' => "ห้ามป้อนเกิน 255 ตัวอักษร"
            ]
        );

        $full_path_inside = functionController::funtion_generate_PDF_IV($request->seal_point_inside, $request->sub_recnum_inside, $request->sub_date_inside, $request->sub_time_inside, $request->doc_docnum_inside, $request->doc_title_inside, $request->doc_filedirec_inside, $request->doc_id_inside);
        //เช็คผู้พิจารณา
        if($request->sign_goup_0_inside == ''){
            //ถ้าไม่เลือกคนพิจารณา
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
            $full_path_seal_file = functionController::funtion_generate_PDF_V($full_path_inside, $request->doc_id_inside);
            $sub_status_inside = '8';
        }else{
            //ถ้าเลือกคนพิจารณา
            //มีการเช็คสถานะ ผู้พิจารณาว่าเป็น หัวหน้ากอง หรือ หัวหน้าฝ่าย
            $user_check_level = User::where('id', $request->sign_goup_0_inside)
            ->first();
            if($user_check_level->level == '4'){
                //หัวหน้ากอง
                $update_sub_docs_0 = sub_doc::where('sub_id', $request->sub_id_inside)->update([
                    'seal_id_1'=>$request->sign_goup_0_inside
                ]);
                $sub_status_inside = '2';
            }elseif($user_check_level->level == '5'){
                //หัวหน้าฝ่าย
                $update_sub_docs_1 = sub_doc::where('sub_id', $request->sub_id_inside)->update([
                    'seal_id_0'=>$request->sign_goup_0_inside
                ]);
                $sub_status_inside = '1';
            }else{
                return redirect()->back()->with('error','พบปัญหาการอัพเดตข้อมูลกรุณาแจ้งผู้พัฒนา [user_check_level]!');
            }
            $full_path_seal_file = '';
        }

        //เช็ค tb: reserve_numbers
        $reserve_number_Check_reserve_number = reserve_number::where('reserve_number', $request->sub_recnum_inside)
        ->where('reserve_type', '1')
        ->where('reserve_template', 'A')
        ->where('reserve_site',Auth::user()->site_id)
        ->where('reserve_group',Auth::user()->group)
        ->first();

        //เช็คค่าซํ่าเลขที่รับส่วนงาน
        $sub_doc_Check_sub_recnum_inside = sub_doc::where('sub_recnum', $request->sub_recnum_inside)
        ->where('sub_recid',Auth::user()->group)
        ->first();
        if($sub_doc_Check_sub_recnum_inside){
            if($reserve_number_Check_reserve_number){
                return redirect()->back()->with('error','ตรวจพบเลขที่รับส่วนงาน '.$request->sub_recnum_inside.' ซํ้าในระบบ');
            }else{
                $sub_recnum_inside = $request->sub_recnum_inside + 1;
            }
        }else{
            $sub_recnum_inside = $request->sub_recnum_inside;
            if($reserve_number_Check_reserve_number){
                $update_reserve_number = reserve_number::where('reserve_number', $request->sub_recnum_inside)
                ->where('reserve_type', '1')
                ->where('reserve_template', 'A')
                ->where('reserve_site',Auth::user()->site_id)
                ->where('reserve_group',Auth::user()->group)
                ->update([
                    'reserve_status'=>'1',
                    'reserve_used'=>Auth::user()->id,
                    'reserve_topic'=>$request->doc_title,
                    'reserve_updated_at'=>date('Y-m-d H:i:s')
                ]);
            }
        }

        $update_sub_docs = sub_doc::where('sub_id', $request->sub_id_inside)->update([
            'seal_point'=>$request->seal_point_inside,
            'sub_recnum'=>$sub_recnum_inside,
            'sub_date'=>$request->sub_date_inside,
            'sub_time'=>$request->sub_time_inside,
            'sub_status'=>$sub_status_inside,
            'seal_file'=>$full_path_seal_file,        
            'sub_updated_at'=>date('Y-m-d H:i:s')
        ]);
        
        //update tb documents
        $update_documents = document::where('doc_id', $request->doc_id_inside)->update([
            'doc_filedirec_1'=>$full_path_inside,
            'doc_updated_at'=>date('Y-m-d H:i:s')
        ]);

        //linetoken
        $tokens_Check = Groupmem::where('group_site_id', Auth::user()->site_id)
        ->where('group_id', Auth::user()->group)
        ->first();
        if($tokens_Check){
            $message = "\n⚠️ ลงรับเอกสารรับเข้าภายใน ⚠️\n>เลขที่หนังสือ :  ".$request->doc_docnum."\n>หน่วยงานต้นเรื่อง :  ".$request->doc_origin."\n>เรื่อง : ".$request->doc_title."\n>เวลาแจ้งเตือน : ".date('Y-m-d H:i')." ";
            functionController::line_notify($message,$tokens_Check->group_token);
        }

        if($update_sub_docs && $update_documents){
            return redirect()->route('documents_admission_group_inside_all_0')->with('success',"ลงรับเรียบร้อย");
        }else{
            return redirect()->back()->with('error','พบปัญหาการอัพเดตข้อมูลกรุณาแจ้งผู้พัฒนา !');
        }
    }
}
