<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\document;
use App\Models\Groupmem;
use App\Models\User;
use App\Http\Controllers\functionController;
use App\Models\reserve_number;
use App\Models\sub_doc;
use App\Models\sub2_doc;

class member_dashboardController extends Controller
{
    //
    public function index(){
        if(Auth::user()->level=='1'){
            //นายก
            
            return view('member_dashboard');
        }else if(Auth::user()->level=='2'){
            //รองนายก|ปลัด|รองปลัด
            return view('member_dashboard');
        }else if(Auth::user()->level=='3'){
            //สารบรรณกลาง
            // //หาตัวเลขที่จองไว้
            // $reserved_numbersS = reserve_number::where('reserve_site',Auth::user()->site_id)
            // ->where('reserve_owner',Auth::user()->id)
            // ->where('reserve_type', '0')
            // ->where('reserve_template', 'A')
            // ->where('reserve_status', '0')
            // ->get();
            // //หาตัวเลขที่หลุดจอง
            // $dropped_numbersS = reserve_number::where('reserve_site',Auth::user()->site_id)
            // ->where('reserve_type', '0')
            // ->where('reserve_template', 'A')
            // ->where('reserve_status', '2')
            // ->get();
            //นับจำนวนงานใหม่ waiting
            $document_admission_all_waiting_count = document::where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '0')
            ->where('doc_template', 'A')
            ->where('doc_status', 'waiting')
            ->count();
            //นับจำนวนงานใหม่ success
            $document_admission_all_success_count = document::where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '0')
            ->where('doc_template', 'A')
            ->where('doc_status', 'success')
            ->count();
            return view('member_dashboard',compact('document_admission_all_waiting_count','document_admission_all_success_count'));
        }else if(Auth::user()->level=='4'){
            //หัวหน้ากอง

            $documents_admission_division_all_count_0 = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '0')
            ->where('doc_template', 'A')
            ->where('doc_status', 'success')
            ->where('sub_recid', Auth::user()->group)
            ->where('sub_status', '2')
            ->where('seal_id_1', Auth::user()->id)
            ->count();

            $documents_admission_division_all_count_1 = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '0')
            ->where('doc_template', 'A')
            ->where('doc_status', 'success')
            ->where('sub_recid', Auth::user()->group)
            ->where('sub_status', '!=','2')
            ->where('seal_id_1', Auth::user()->id)
            ->where('seal_date_1', '!=', NULL)
            ->count();

            $documents_admission_division_inside_all_count_0 = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
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
            ->count();

            $documents_admission_division_inside_all_count_1 = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
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
            ->count();
            return view('member_dashboard',compact('documents_admission_division_all_count_0','documents_admission_division_all_count_1','documents_admission_division_inside_all_count_0','documents_admission_division_inside_all_count_1'));
        }else if(Auth::user()->level=='5'){
            //หัวหน้าฝ่าย
            //นับจำนวนงานรอพิจารณา
            $document_admission_department_all_count_0 = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '0')
            ->where('doc_template', 'A')
            ->where('doc_status', 'success')
            ->where('sub_recid', Auth::user()->group)
            ->where('sub_status', '1')
            ->where('seal_id_0', Auth::user()->id)
            ->count();
            //นับจำนวนงานพิจารณาแล้ว
            $document_admission_department_all_count_1 = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '0')
            ->where('doc_template', 'A')
            ->where('doc_status', 'success')
            ->where('sub_recid', Auth::user()->group)
            ->where('sub_status', '!=','1')
            ->where('seal_id_0', Auth::user()->id)
            ->where('seal_date_0', '!=', NULL)
            ->count();

            $document_admission_department_inside_all_count_0 = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
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
            ->where('sub_status', '1')
            ->where('seal_id_0', Auth::user()->id)
            ->count();

            $document_admission_department_inside_all_count_1 = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
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
            ->where('sub_status', '!=','1')
            ->where('seal_id_0', Auth::user()->id)
            ->where('seal_date_0', '!=', NULL)
            ->count();
            return view('member_dashboard',compact('document_admission_department_all_count_0','document_admission_department_all_count_1','document_admission_department_inside_all_count_0','document_admission_department_inside_all_count_1'));
        }else if(Auth::user()->level=='6'){
            //สารบรรณกอง
             //นับจำนวนงานภายนอกใหม่
             $document_admission_all_group_count_0 = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
             ->where('doc_site_id',Auth::user()->site_id)
             ->where('doc_type', '0')
             ->where('doc_template', 'A')
             ->where('doc_status', 'success')
             ->where('sub_recid', Auth::user()->group)
             ->where('sub_status', '0')
             ->count();
             //นับจำนวนงานภายนอกรอดำเนินการ
             $document_admission_all_group_count_1 = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
             ->where('doc_site_id',Auth::user()->site_id)
             ->where('doc_type', '0')
             ->where('doc_template', 'A')
             ->where('doc_status', 'success')
             ->where('sub_recid', Auth::user()->group)
             ->where('sub_status','!=','0')
             ->where('sub_status','!=','8')
             ->count();
             //นับจำนวนงานภายนอกดำเนินการแล้ว
             $document_admission_all_group_count_2 = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
             ->where('doc_site_id',Auth::user()->site_id)
             ->where('doc_type', '0')
             ->where('doc_template', 'A')
             ->where('doc_status', 'success')
             ->where('sub_recid', Auth::user()->group)
             ->where('sub_status', '8')
             ->count();

             $document_admission_all_group_inside_count_0 = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
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
             ->where('sub_status', '0')
             ->count();

             $document_admission_all_group_inside_count_1 = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
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
             ->where('sub_status','!=','0')
             ->where('sub_status','!=','8')
             ->count();

             $document_admission_all_group_inside_count_2 = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
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
             ->where('sub_status', '8')
             ->count();

            //  //หาชื่อและไอดี กอง miw
            // $GroupmemS = Groupmem::where('group_site_id',Auth::user()->site_id)
            // ->where('group_id','!=',Auth::user()->group)
            // ->get();
            
            //  //หาชื่อและไอดี พนักงาน miw
            //  $UserS = User::where('group',Auth::user()->group)
            //  ->get();

            return view('member_dashboard',compact('document_admission_all_group_count_0','document_admission_all_group_count_1','document_admission_all_group_count_2','document_admission_all_group_inside_count_0','document_admission_all_group_inside_count_1','document_admission_all_group_inside_count_2'));
       
        }else if(Auth::user()->level=='7'){
            //งาน
           //นักจำนวนงานยังไม่อ่าน
           $document_admission_all_work_count_0 = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
           ->leftJoin('sub2_docs','sub2_docs.sub2_subid','sub_docs.sub_id')
           ->where('doc_site_id',Auth::user()->site_id)
           ->where('doc_type', '0')
           ->where('doc_template', 'A')
           ->where('doc_status', 'success')
           ->where('sub_recid', Auth::user()->group)
           ->where('sub_status', '8')
           ->where('sub2_status', '0')
           ->where('sub2_recid', Auth::user()->id)
           ->count();
           //นับจำนวนงานอ่านแล้ว
           $document_admission_all_work_count_1 = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
           ->leftJoin('sub2_docs','sub2_docs.sub2_subid','sub_docs.sub_id')
           ->where('doc_site_id',Auth::user()->site_id)
           ->where('doc_type', '0')
           ->where('doc_template', 'A')
           ->where('doc_status', 'success')
           ->where('sub_recid', Auth::user()->group)
           ->where('sub_status', '8')
           ->where('sub2_status', '1')
           ->where('sub2_recid', Auth::user()->id)
           ->count();

           $document_admission_all_work_inside_count_0 = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
           ->leftJoin('sub2_docs','sub2_docs.sub2_subid','sub_docs.sub_id')
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
           ->where('sub_status', '8')
           ->where('sub2_status', '0')
           ->where('sub2_recid', Auth::user()->id)
           ->count();

           $document_admission_all_work_inside_count_1 = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
           ->leftJoin('sub2_docs','sub2_docs.sub2_subid','sub_docs.sub_id')
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
           ->where('sub_status', '8')
           ->where('sub2_status', '1')
           ->where('sub2_recid', Auth::user()->id)
           ->count();
            return view('member_dashboard',compact('document_admission_all_work_count_0','document_admission_all_work_count_1','document_admission_all_work_inside_count_0','document_admission_all_work_inside_count_1'));
        }else{
            return route('logout');
        }
  
    }

    public function document_accepting_new(Request $request){
        //ตรวจสอบข้อมูลที่กรอกเข้ามาก่อน
        $request->validate(
            [
                'doc_recnum'=>'required|max:255',
                'doc_docnum'=>'required|max:255',
                'doc_date'=>'required',
                'doc_date_2'=>'required',
                'doc_time'=>'required',
                'doc_origin'=>'required|max:255',
                'doc_title'=>'required|max:255',
                'doc_filedirec'=>'required|mimes:pdf|max:10000',
                'doc_speed'=>'required|max:255',
            ],
            [
                'doc_recnum.required'=>"กรุณาป้อนเลขที่รับส่วนงานด้วยครับ",
                'doc_recnum.max' => "ห้ามป้อนเกิน 255 ตัวอักษร",

                'doc_docnum.required'=>"กรุณาป้อนเลขที่หนังสือด้วยครับ",
                'doc_docnum.max' => "ห้ามป้อนเกิน 255 ตัวอักษร",

                'doc_date.required'=>"กรุณาเลือกวันที่ด้วยครับ",

                'doc_date_2.required'=>"กรุณาเลือกลงวันที่ด้วยครับ", 

                'doc_time.required'=>"กรุณาเลือกเวลาด้วยครับ",


                'doc_origin.required'=>"กรุณาป้อนหน่วยงานเจ้าของเรื่องด้วยครับ",
                'doc_origin.max' => "ห้ามป้อนเกิน 255 ตัวอักษร",

                'doc_title.required'=>"กรุณาป้อนเรื่องด้วยครับ",
                'doc_title.max' => "ห้ามป้อนเกิน 255 ตัวอักษร",

                'doc_filedirec.required'=>"กรุณาแนบอัพโหลดไฟล์เอกสารด้วยครับ",
                'doc_filedirec.mimes'=>"รองรับไฟล์นามสกุล PDF เท่านั้น",
                'doc_filedirec.max'=>"รองรับขนาดไฟล์ไม่เกิน 10MB",

                'doc_speed.required'=>"กรุณาเลือกชั้นความเร็วด้วยครับ",
                'doc_speed.max' => "ห้ามป้อนเกิน 255 ตัวอักษร",
            ]
        );

        //เลือกว่ามีการประทับตาไหม
        //if($request->checkbox_seal_point == 'seal_point'){
            $seal_point = $request->seal_point;
       // }else{
       //     $seal_point = '0';
       // }
       
        //เช็คเลขที่หนังสือค่าซํ้า
        if($request->doc_docnum != '-'){
            $document_Check_doc_docnum = document::where('doc_docnum', $request->doc_docnum)
            ->where('doc_type', '0')
            ->where('doc_template', 'A')
            ->where('doc_site_id', Auth::user()->site_id)
            ->first();
            if($document_Check_doc_docnum){
                return redirect()->back()->with('error','ตรวจพบเลขที่หนังสือ '.$request->doc_docnum.' ซํ้าในระบบ');
            }
        }

        //เช็ค tb: reserve_numbers
        $reserve_number_Check_reserve_number = reserve_number::where('reserve_number', $request->doc_recnum)
        ->where('reserve_type', '0')
        ->where('reserve_template', 'A')
        ->where('reserve_site',Auth::user()->site_id)
        ->first();
        

        //เช็คค่าซํ่าเลขที่รับส่วนงาน
        $document_Check_doc_recnum = document::where('doc_recnum', $request->doc_recnum)
        ->where('doc_type', '0')
        ->where('doc_template', 'A')
        ->where('doc_site_id', Auth::user()->site_id)
        ->first();
        if($document_Check_doc_recnum){
            if($reserve_number_Check_reserve_number){
                return redirect()->back()->with('error','ตรวจพบเลขที่รับส่วนงาน '.$request->doc_recnum.' ซํ้าในระบบ');
            }else{
                $doc_recnum = $request->doc_recnum + 1;
            }
        }else{
            $doc_recnum = $request->doc_recnum;
            if($reserve_number_Check_reserve_number){
                $update_reserve_number = reserve_number::where('reserve_number', $request->doc_recnum)
                ->where('reserve_type', '0')
                ->where('reserve_template', 'A')
                ->where('reserve_site',Auth::user()->site_id)
                ->update([
                    'reserve_status'=>'1',
                    'reserve_used'=>Auth::user()->id,
                    'reserve_topic'=>$request->doc_title,
                    'reserve_updated_at'=>date('Y-m-d H:i:s')
                ]);
            }
        }
        
        //หา ID documentล่าสุด
        $document_Check_doc_id = document::max('doc_id');
        $doc_id_new = $document_Check_doc_id + 1;
        $date_new = date('Y-m-d');
        $year_new = date('Y');
        //การเข้ารหัสไฟล์_doc_filedirec
        $doc_filedirec = $request->file('doc_filedirec');
        //Generate ชื่อไฟล์
        $name_gen_new = $doc_id_new."_".$date_new;
        // ดึงนามสกุลไฟล์
        $doc_filedirec_img_ext = strtolower($doc_filedirec->getClientOriginalExtension());
        $doc_filedirec_img_name = $name_gen_new.'.'.$doc_filedirec_img_ext;
        //อัพโหลดและบันทึกข้อมูล
        $upload_location = 'image/'.$year_new.'/upload/';
        $doc_filedirec_full_path = $upload_location.$doc_filedirec_img_name;
        $doc_filedirec->move($upload_location,$doc_filedirec_img_name);

        //เช็คว่ามีการแนบไฟล์รูป_doc_attached_file_ไหม
        $doc_attached_file = $request->file('doc_attached_file');
        if($doc_attached_file){
            // ดึงนามสกุลไฟล์
            $doc_attached_file_img_ext = strtolower($doc_attached_file->getClientOriginalExtension());
            $doc_attached_file_img_ext_img_name = $name_gen_new.'.'.$doc_attached_file_img_ext;
            //อัพโหลดและบันทึกข้อมูล
            $upload_location_doc_attached_file = 'image/'.$year_new.'/attachedfile/';
            $doc_attached_file_full_path = $upload_location_doc_attached_file.$doc_attached_file_img_ext_img_name;
            $doc_attached_file->move($upload_location_doc_attached_file,$doc_attached_file_img_ext_img_name);
        }else{
            $doc_attached_file_full_path = '';
        }

        $insert_document = document::insert([
            'doc_site_id'=>Auth::user()->site_id,
            'doc_recnum'=>$doc_recnum,
            'doc_docnum'=>$request->doc_docnum,
            'doc_date'=>$request->doc_date,
            'doc_date_2' =>$request->doc_date_2,
            'doc_time'=>$request->doc_time,
            'doc_origin'=>$request->doc_origin,
            'doc_title'=>$request->doc_title,
            'doc_filedirec'=>$doc_filedirec_full_path,
            'doc_attached_file'=>$doc_attached_file_full_path,
            'seal_point'=>$seal_point,
            'doc_type'=>'0',
            'doc_template'=>'A',
            'doc_speed'=>$request->doc_speed,
            'doc_secret'=>$request->doc_secret,
            'doc_status'=>'waiting',
            'doc_owner'=>Auth::user()->id,
            'doc_created_at'=>date('Y-m-d H:i:s')
        ]);

        //linetoken
        $tokens_Check = DB::table('tokens')
        ->where('token_site_id', Auth::user()->site_id)
        ->where('token_level', Auth::user()->level)
        ->first();
        if($tokens_Check){
            $message = "\n⚠️ สร้างเอกสารรับเข้าภายนอกใหม่ ⚠️\n>เลขที่หนังสือ :  ".$request->doc_docnum."\n>หน่วยงานต้นเรื่อง :  ".$request->doc_origin."\n>เรื่อง : ".$request->doc_title."\n>เวลาแจ้งเตือน : ".date('Y-m-d H:i')." ";
            functionController::line_notify($message,$tokens_Check->token_token);
        }

        if($insert_document){
            return redirect()->back()->with('success',"สร้างเอกสารใหม่เรียบร้อย  s");
        }else{
            return redirect()->back()->with('error','พบปัญหาการเพิ่มข้อมูลกรุณาแจ้งผู้พัฒนา !');
        }
        
    }

    public static function getdoc_recnum($id){
        $reserve_number_reserve_date = reserve_number::where('reserve_id',$id)
        ->first();
        if($reserve_number_reserve_date){
            return date('dmY', strtotime($reserve_number_reserve_date->reserve_date));
        }else{
            return redirect('member_dashboard')->with('error','พบปัญหาบางอย่างไม่ถูกต้อง [getdoc_recnum] !');
        }
    }

    public function document_accepting_new_inside(Request $request){
        //ตรวจสอบข้อมูลที่กรอกเข้ามาก่อน
        $request->validate(
            [
                'doc_template_inside'=>'required|max:255',
                'doc_recnum_inside'=>'required|max:255',
                'doc_docnum_inside'=>'required|max:255',
                'doc_date_inside'=>'required',
                'doc_date_2_inside'=>'required',
                'doc_time_inside'=>'required',
                'doc_title_inside'=>'required|max:255',
                'doc_filedirec_inside'=>'required|mimes:pdf|max:10000',
                'doc_speed_inside'=>'required|max:255',
                'doc_secret_inside'=>'required|max:255',
                'send_inside'=>'required',
            ],
            [
                'doc_template_inside.required'=>"กรุณาเลือกประเภทเอกสารด้วยครับ",
                'doc_template_inside.max' => "ห้ามป้อนเกิน 255 ตัวอักษร",

                'doc_recnum_inside.required'=>"กรุณาป้อนเลขที่รับส่วนงานด้วยครับ",
                'doc_recnum_inside.max' => "ห้ามป้อนเกิน 255 ตัวอักษร",

                'doc_docnum_inside.required'=>"กรุณาป้อนเลขที่หนังสือด้วยครับ",
                'doc_docnum_inside.max' => "ห้ามป้อนเกิน 255 ตัวอักษร",

                'doc_date_inside.required'=>"กรุณาเลือกวันที่ด้วยครับ",

                'doc_date_2_inside.required'=>"กรุณาเลือกลงวันที่ด้วยครับ", 

                'doc_time_inside.required'=>"กรุณาเลือกเวลาด้วยครับ",

                'doc_title_inside.required'=>"กรุณาป้อนเรื่องด้วยครับ",
                'doc_title_inside.max' => "ห้ามป้อนเกิน 255 ตัวอักษร",

                'doc_filedirec_inside.required'=>"กรุณาแนบอัพโหลดไฟล์เอกสารด้วยครับ",
                'doc_filedirec_inside.mimes'=>"รองรับไฟล์นามสกุล PDF เท่านั้น",
                'doc_filedirec_inside.max'=>"รองรับขนาดไฟล์ไม่เกิน 10MB",

                'doc_speed_inside.required'=>"กรุณาเลือกชั้นความเร็วด้วยครับ",
                'doc_speed_inside.max' => "ห้ามป้อนเกิน 255 ตัวอักษร",

                'doc_secret_inside.required'=>"กรุณาเลือกชั้นความลับด้วยครับ",
                'doc_secret_inside.max' => "ห้ามป้อนเกิน 255 ตัวอักษร",

                'send_inside.required'=>"กรุณาเลือกส่งด้วยครับ",
            ]
        );

        //เช็คเลขที่หนังสือค่าซํ้า
        if($request->doc_docnum_inside != '-'){
            $document_Check_doc_docnum = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->where('doc_docnum', $request->doc_docnum_inside)
            ->where('doc_type', '1')
            ->where('doc_template', $request->doc_template_inside)
            ->where('doc_site_id', Auth::user()->site_id)
            ->where('doc_group',Auth::user()->group)
            ->first();
            if($document_Check_doc_docnum){
                return redirect()->back()->with('error','ตรวจพบเลขที่หนังสือ '.$request->doc_docnum_inside.' ซํ้าในระบบ');
            }
        }

         //เช็ค tb: reserve_numbers
         $reserve_number_Check_reserve_number = reserve_number::where('reserve_number', $request->doc_recnum_inside)
         ->where('reserve_group',Auth::user()->group)
         ->where('reserve_site',Auth::user()->site_id)
         ->where('reserve_type', '1')
         ->where('reserve_template', $request->doc_template_inside)
         ->first();
         
 
         //เช็คค่าซํ่าเลขที่รับส่วนงาน
         $document_Check_doc_recnum = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
         ->where('doc_recnum', $request->doc_recnum_inside)
         ->where('doc_site_id',Auth::user()->site_id)
         ->where('doc_group',Auth::user()->group)
         ->where('doc_type','1')
         ->where('doc_template',$request->doc_template_inside)
         ->first();
         if($document_Check_doc_recnum){
             if($reserve_number_Check_reserve_number){
                 return redirect()->back()->with('error','ตรวจพบเลขที่รับส่วนงาน '.$request->doc_recnum_inside.' ซํ้าในระบบ');
             }else{
                 $doc_recnum = $request->doc_recnum_inside + 1;
             }
         }else{
             $doc_recnum = $request->doc_recnum_inside;
             if($reserve_number_Check_reserve_number){
                 $update_reserve_number = reserve_number::where('reserve_number', $request->doc_recnum_inside)
                 ->where('reserve_type', '1')
                 ->where('reserve_template', $request->doc_template_inside)
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

        //หา ID documentล่าสุด
        $document_Check_doc_id = document::max('doc_id');
        $doc_id_new = $document_Check_doc_id + 1;
        $date_new = date('Y-m-d');
        $year_new = date('Y');
        //การเข้ารหัสไฟล์_doc_filedirec
        $doc_filedirec = $request->file('doc_filedirec_inside');
        //Generate ชื่อไฟล์
        $name_gen_new = $doc_id_new."_".$date_new;
        // ดึงนามสกุลไฟล์
        $doc_filedirec_img_ext = strtolower($doc_filedirec->getClientOriginalExtension());
        $doc_filedirec_img_name = $name_gen_new.'.'.$doc_filedirec_img_ext;
        //อัพโหลดและบันทึกข้อมูล
        $upload_location = 'image/'.$year_new.'/upload/';
        $doc_filedirec_full_path = $upload_location.$doc_filedirec_img_name;
        $doc_filedirec->move($upload_location,$doc_filedirec_img_name);

        //เช็คว่ามีการแนบไฟล์รูป_doc_attached_file_ไหม
        $doc_attached_file = $request->file('doc_attached_file_inside');
        if($doc_attached_file){
            // ดึงนามสกุลไฟล์
            $doc_attached_file_img_ext = strtolower($doc_attached_file->getClientOriginalExtension());
            $doc_attached_file_img_ext_img_name = $name_gen_new.'.'.$doc_attached_file_img_ext;
            //อัพโหลดและบันทึกข้อมูล
            $upload_location_doc_attached_file = 'image/'.$year_new.'/attachedfile/';
            $doc_attached_file_full_path = $upload_location_doc_attached_file.$doc_attached_file_img_ext_img_name;
            $doc_attached_file->move($upload_location_doc_attached_file,$doc_attached_file_img_ext_img_name);
        }else{
            $doc_attached_file_full_path = '';
        }

        $insert_document = document::insertGetId([
            'doc_site_id'=>Auth::user()->site_id,
            'doc_recnum'=>$doc_recnum,
            'doc_docnum'=>$request->doc_docnum_inside,
            'doc_date'=>$request->doc_date_inside,
            'doc_date_2' =>$request->doc_date_2_inside,
            'doc_time'=>$request->doc_time_inside,
            'doc_title'=>$request->doc_title_inside,
            'doc_filedirec'=>$doc_filedirec_full_path,
            'doc_attached_file'=>$doc_attached_file_full_path,
            'doc_type'=>'1',
            'doc_template'=>$request->doc_template_inside,
            'doc_speed'=>$request->doc_speed_inside,
            'doc_secret'=>$request->doc_secret_inside,
            'doc_status'=>'success',
            'doc_owner'=>Auth::user()->id,
            'doc_group'=>Auth::user()->group,
            'doc_created_at'=>date('Y-m-d H:i:s')
        ]);

        if($insert_document){
             //เช็คผู้ส่ง
            if($request->send_inside == '0'){
                //insert sub_doc
                $insert_sub_doc = sub_doc::insertGetId([
                    'sub_docid'=>$insert_document,
                    'sub_recid'=>Auth::user()->group,
                    'sub_status'=>'8',
                    'seal_file'=>$doc_filedirec_full_path,
                    'sub_check'=>'0',
                    'sub_created_at'=>date('Y-m-d H:i:s')
                ]);
                if($insert_sub_doc){
                    //insert sub2_doc
                    for ($t = 0; $t < count($request->sub2_recid_inside); $t++) {
                            $sub2_recid_inside[$t] = $request->sub2_recid_inside[$t];
                            $insert_sub2_doc = sub2_doc::insert([
                                'sub2_docid'=>$insert_document,
                                'sub2_subid'=>$insert_sub_doc,
                                'sub2_recid'=>$sub2_recid_inside[$t],
                                'sub2_sendid'=>Auth::user()->id,
                                'sub2_status'=>'0',
                                'sub2_check'=>'0',
                                'sub2_created_at'=>date('Y-m-d H:i:s')
                            ]);
                        }
                    }
                
            }else if($request->send_inside == '1'){
                for ($t = 0; $t < count($request->sub_recid_inside); $t++) {
                    $sub_recid_inside[$t] = $request->sub_recid_inside[$t];
                    $insert_sub_doc = sub_doc::insert([
                        'sub_docid'=>$insert_document,
                        'sub_recid'=>$sub_recid_inside[$t],
                        'sub_status'=>'0',
                        'sub_check'=>'0',
                        'sub_created_at'=>date('Y-m-d H:i:s')
                    ]);
                }
            }else{
                return redirect()->back()->with('error','พบปัญหาการเพิ่มข้อมูลกรุณาแจ้งผู้พัฒนา [send_inside]!');
            }

             //linetoken
            $tokens_Check = Groupmem::where('group_site_id', Auth::user()->site_id)
            ->where('group_id', Auth::user()->group)
            ->first();
            if($tokens_Check){
                $message = "\n⚠️ สร้างเอกสารส่งภายใน ⚠️\n>เลขที่หนังสือ :  ".$request->doc_docnum."\n>หน่วยงานต้นเรื่อง :  ".$request->doc_origin."\n>เรื่อง : ".$request->doc_title."\n>เวลาแจ้งเตือน : ".date('Y-m-d H:i')." ";
                functionController::line_notify($message,$tokens_Check->group_token);
            }

            return redirect()->back()->with('success',"สร้างเอกสารใหม่ภายในเรียบร้อย");
        }else{
            return redirect()->back()->with('error','พบปัญหาการเพิ่มข้อมูลกรุณาแจ้งผู้พัฒนา [insert_document]!');
        }

    }
}