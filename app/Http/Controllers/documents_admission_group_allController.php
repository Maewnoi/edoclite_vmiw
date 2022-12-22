<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\document;
use App\Models\User;
use App\Models\sub_doc;
use App\Models\sub2_doc;
use App\Models\Groupmem;
use App\Models\reserve_number;
use App\Models\cottons;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\functionController;

class documents_admission_group_allController extends Controller
{
    //สถานะใหม่
    public function index_0(){
        if(Auth::user()->level=='6'){
            //สารบรรณกอง
            // $document_admission_all_group = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
            // ->where('doc_site_id',Auth::user()->site_id)
            // ->where('doc_type', '0')
            // ->where('doc_template', 'A')
            // ->where('doc_status', 'success')
            // ->where('sub_recid', Auth::user()->group)
            // ->where('sub_status', '0')
            // ->ORDERBY('doc_date' ,'DESC')
            // ->get();
            return view('member.documents_admission_group_all.index');
        }else{
            return redirect('member_dashboard')->with('error','คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }

    //สถานะกำลังดำเนินการ
    public function index_1(){
        if(Auth::user()->level=='6'){
            //สารบรรณกอง
            // $document_admission_all_group = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
            // ->where('doc_site_id',Auth::user()->site_id)
            // ->where('doc_type', '0')
            // ->where('doc_template', 'A')
            // ->where('doc_status', 'success')
            // ->where('sub_recid', Auth::user()->group)
            // ->where('sub_status','!=','0')
            // ->where('sub_status','!=','8')
            // ->ORDERBY('doc_date' ,'DESC')
            // ->ORDERBY('doc_recnum' ,'DESC')
            // ->get();
            return view('member.documents_admission_group_all.index');
        }else{
            return redirect('member_dashboard')->with('error','คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }

    //สถานะดำเนินการแล้ว
    public function index_2(){
        if(Auth::user()->level=='6'){
            //สารบรรณกอง
            // $document_admission_all_group = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
            // ->where('doc_site_id',Auth::user()->site_id)
            // ->where('doc_type', '0')
            // ->where('doc_template', 'A')
            // ->where('doc_status', 'success')
            // ->where('sub_recid', Auth::user()->group)
            // ->where('sub_status', '8')
            // ->ORDERBY('doc_date' ,'DESC')
            // ->get();
            return view('member.documents_admission_group_all.index');
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
            
            //    if($document_detail->doc_status == 'success'){
            //         $sub_docsS = sub_doc::where('sub_docid', $id) ->get();

                  /*  if($document_detail->sub_status == 8){
                        $sub2_docsS = sub2_doc::where('sub2_subid', $document_detail->sub_id) ->get();
                        //dd($sub2_docsS);
                    }
                    */    
                   
                   // $sub_docsS = sub_doc::leftJoin('sub2_docs','sub2_docs.sub2_subid','sub_docs.sub_id')
                   // ->where('sub_docid', $id)
                   // ->get();

                
                   
                // }else{
                //     $sub_docsS = '';
                // }

                if($document_detail->sub_status == '8'){
                    $sub2_docs = sub2_doc::where('sub2_docid', $id)->get();
                }else{
                    $sub2_docs = '';
                }
    
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
            $cottons_S = cottons::Join('users','users.cotton','cottons.cottons_id')
            ->where('level', '5')
            ->where('cottons_group', Auth::user()->group)
            ->where('site_id',Auth::user()->site_id)
            ->get();

            //หาชื่อ-นามสกุล หัวหน้ากอง
            $user_Groupmem = User::where('level', '4')
            ->where('site_id',Auth::user()->site_id)
            ->where('group', Auth::user()->group)
            ->first();

            //หาชื่อ-นามสกุล ผู้รับงาน
            $userS_2 = User::where('level', '7')
            ->where('site_id',Auth::user()->site_id)
            ->where('group', Auth::user()->group)
            ->get();
            return view('member.documents_admission_group_all.detail',compact('document_detail','sub2_docs','cottons_S','user_Groupmem','userS_2','reserved_numbersS','dropped_numbersS'));
        }else{
            return redirect('member_dashboard')->with('error','คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }
    //สารบรรณกองลงรับ
    public function takedown(Request $request){
        //ตรวจสอบข้อมูลที่กรอกเข้ามาก่อน
        $request->validate(
            [
                'sub_recnum'=>'required|max:255',
                'sub_date'=>'required|max:255',
                'sub_time'=>'required|max:255'
            ],
            [
                'sub_recnum.required'=>"กรุณากรอกเลขที่ลงรับด้วยครับ",
                'sub_recnum.max' => "ห้ามป้อนเกิน 255 ตัวอักษร",

                'sub_date.required'=>"กรุณาเลือกวันที่ด้วยครับ",
                'sub_date.max' => "ห้ามป้อนเกิน 255 ตัวอักษร",

                'sub_time.required'=>"กรุณาเลือกเวลาด้วยครับ",
                'sub_time.max' => "ห้ามป้อนเกิน 255 ตัวอักษร"
            ]
        );

        //เช็ค tb: reserve_numbers
        $reserve_number_Check_reserve_number = reserve_number::where('reserve_number', $request->sub_recnum)
        ->where('reserve_type', '1')
        ->where('reserve_template', 'A')
        ->where('reserve_site',Auth::user()->site_id)
        ->where('reserve_group',Auth::user()->group)
        ->first();
    
        //เช็คค่าซํ่าเลขที่รับส่วนงาน
        $sub_doc_Check_sub_recnum = sub_doc::where('sub_recnum', $request->sub_recnum)
        ->where('sub_recid',Auth::user()->group)
        ->first();
        if($sub_doc_Check_sub_recnum){
            if($reserve_number_Check_reserve_number){
                return redirect()->back()->with('error','ตรวจพบเลขที่รับส่วนงาน '.$request->sub_recnum.' ซํ้าในระบบ');
            }else{
                $sub_recnum = $request->sub_recnum + 1;
            }
        }else{
            $sub_recnum = $request->sub_recnum;
            if($reserve_number_Check_reserve_number){
                $update_reserve_number = reserve_number::where('reserve_number', $request->sub_recnum)
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
    
            
        if($request->sign_goup_0 == ''){
              //ตรวจสอบข้อมูลที่กรอกเข้ามาก่อน
            $request->validate(
                [
                    'sub2_recid'=>'required|max:255'
                ],
                [
                    'sub2_recid.required'=>"กรุณาเลือกผู้รับด้วยครับ",
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
            //ประทับตรา
            $full_path = functionController::funtion_generate_PDF_II($request->doc_filedirec_1,$request->seal_point,$request->sub_recnum,$request->sub_date,$request->sub_time,$request->sub_id);

            $update_sub_docs = sub_doc::where('sub_id', $request->sub_id)
            ->update([
                'seal_point'=>$request->seal_point,
                'sub_recnum'=>$sub_recnum,
                'sub_date'=>$request->sub_date,
                'sub_time'=>$request->sub_time,
                'sub_status'=>'8',
                'seal_file'=>$full_path,            
                'sub_updated_at'=>date('Y-m-d H:i:s')
            ]);

            // dd($request->sub2_recid);
        }else{
            if($request->sign_goup_0 == 'cottons'){
                $request->validate(
                    [
                        'sub2_recid_cottons'=>'required|max:255'
                    ],
                    [
                        'sub2_recid_cottons.required'=>"กรุณาเลือกฝ่ายด้วยครับ",
                        'sub2_recid_cottons.max' => "ห้ามป้อนเกิน 255 ตัวอักษร"
                    ]
                );
                for ($t = 0; $t < count($request->sub2_recid_cottons); $t++) {
                    $sub2_recid_cottons[$t] = $request->sub2_recid_cottons[$t];
                    $user_check_level_5[$t] = User::where('level', '5')
                    ->where('site_id',Auth::user()->site_id)
                    ->where('group', Auth::user()->group)
                    ->where('cotton', $sub2_recid_cottons[$t])
                    ->first();
                    if($user_check_level_5[$t]){
                        $insert_sub2_doc[$t] = sub_doc::insertGetId([
                            'sub_docid'=>$request->doc_id,
                            'sub_recid'=>Auth::user()->group,
                            'sub_cotton'=>$sub2_recid_cottons[$t],
                            'sub_created_at'=>date('Y-m-d H:i:s')
                        ]);

                        $update_sub_docs = sub_doc::where('sub_id', $insert_sub2_doc[$t])
                        ->update([
                            'seal_point'=>$request->seal_point,
                            'sub_recnum'=>$sub_recnum,
                            'sub_date'=>$request->sub_date,
                            'sub_time'=>$request->sub_time,
                            'sub_status'=>'1',
                            'seal_id_0'=>$user_check_level_5[$t]->id,
                            'sub_updated_at'=>date('Y-m-d H:i:s')
                        ]);
                    }else{
                        return redirect()->back()->with('error','พบปัญหาการอัพเดตข้อมูลกรุณาแจ้งผู้พัฒนา [user_check_level_5]!');
                    }
                  
                }

                $delete = sub_doc::where('sub_id', $request->sub_id)->delete();

               
                // dd($request->sub2_recid_cottons);
            }else if($request->sign_goup_0 == 'groupmems'){
                //มีการเช็คสถานะ ผู้พิจารณาว่าเป็น หัวหน้ากอง หรือ หัวหน้าฝ่าย
                $user_check_level_4 = User::where('level', '4')
                ->where('site_id',Auth::user()->site_id)
                ->where('group', Auth::user()->group)
                ->first();
                if($user_check_level_4){
                    //หัวหน้ากอง

                    $update_sub_docs = sub_doc::where('sub_docid', $request->doc_id)
                    ->where('sub_id', $request->sub_id)
                    ->update([
                        'seal_point'=>$request->seal_point,
                        'sub_recnum'=>$sub_recnum,
                        'sub_date'=>$request->sub_date,
                        'sub_time'=>$request->sub_time,
                        'sub_status'=>'2',
                        'seal_id_1'=>$user_check_level_4->id,     
                        'sub_updated_at'=>date('Y-m-d H:i:s')
                    ]);
                    // dd($request->sub2_recid_groupmems);
                }else{
                    return redirect()->back()->with('error','พบปัญหาการอัพเดตข้อมูลกรุณาแจ้งผู้พัฒนา [user_check_level_4]!');
                }
            }
            $full_path = '';
        }

        

        // //เช็คผู้พิจารณา
        // if($request->sign_goup_0 == ''){
        //     //ถ้าไม่เลือกคนพิจารณา
        //     //นับจำนวนคนทำงาน
        //     for ($t = 0; $t < count($request->sub2_recid); $t++) {
        //         $sub2_recid[$t] = $request->sub2_recid[$t];
        //         $insert_sub2_doc = sub2_doc::insert([
        //             'sub2_docid'=>$request->doc_id,
        //             'sub2_subid'=>$request->sub_id,
        //             'sub2_sendid'=>Auth::user()->group,
        //             'sub2_recid'=>$sub2_recid[$t],
        //             'sub2_status'=>'0',
        //             'sub2_created_at'=>date('Y-m-d H:i:s')
        //         ]);
        //     }
        //     //ประทับตรา
        //     $full_path = functionController::funtion_generate_PDF_II($request->doc_filedirec_1,$request->seal_point,$request->sub_recnum,$request->sub_date,$request->sub_time,$request->sub_id);
        //     $sub_status = '8';
        // }else{
        //     //ถ้าเลือกคนพิจารณา
        //     //มีการเช็คสถานะ ผู้พิจารณาว่าเป็น หัวหน้ากอง หรือ หัวหน้าฝ่าย
        //     $user_check_level = User::where('id', $request->sign_goup_0)
        //     ->first();
        //     if($user_check_level->level == '4'){
        //         //หัวหน้ากอง
        //         $update_sub_docs_0 = sub_doc::where('sub_id', $request->sub_id)->update([
        //             'seal_id_1'=>$request->sign_goup_0
        //         ]);
        //         $sub_status = '2';
        //     }elseif($user_check_level->level == '5'){
        //         //หัวหน้าฝ่าย
        //         $update_sub_docs_1 = sub_doc::where('sub_id', $request->sub_id)->update([
        //             'seal_id_0'=>$request->sign_goup_0
        //         ]);
        //         $sub_status = '1';
        //     }else{
        //         return redirect()->back()->with('error','พบปัญหาการอัพเดตข้อมูลกรุณาแจ้งผู้พัฒนา [user_check_level]!');
        //     }
        //     $full_path = '';
        // }

        //linetoken
        $tokens_Check = Groupmem::where('group_site_id', Auth::user()->site_id)
        ->where('group_id', Auth::user()->group)
        ->first();
        if($tokens_Check){
            $message = "\n⚠️ ลงรับเอกสารรับเข้าภายนอก ⚠️\n>เลขที่หนังสือ :  ".$request->doc_docnum."\n>หน่วยงานต้นเรื่อง :  ".$request->doc_origin."\n>เรื่อง : ".$request->doc_title."\n>เวลาแจ้งเตือน : ".date('Y-m-d H:i')." ";
            functionController::line_notify($message,$tokens_Check->group_token);
        }

        if($update_sub_docs){
            return redirect()->route('documents_admission_group_all_0')->with('success',"ลงรับเรียบร้อย");
        }else{
            return redirect()->back()->with('error','พบปัญหาการอัพเดตข้อมูลกรุณาแจ้งผู้พัฒนา !');
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
}
