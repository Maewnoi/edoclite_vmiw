<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\document;
use App\Models\User;
use App\Models\sub_doc;
use App\Models\sub2_doc;
use App\Models\Groupmem;
use App\Models\cottons;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\functionController;

class documents_admission_division_allController extends Controller
{
    //
    //งานรอพิจารณา
    public function index_0(){
        if(Auth::user()->level=='4'){
            //หัวหน้ากอง
            // $document_admission_division_all = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
            // ->where('doc_site_id',Auth::user()->site_id)
            // ->where('doc_type', '0')
            // ->where('doc_template', 'A')
            // ->where('doc_status', 'success')
            // ->where('sub_recid', Auth::user()->group)
            // ->where('sub_status', '2')
            // ->where('seal_id_1', Auth::user()->id)
            // ->get();
            return view('member.documents_admission_division_all.index');
        }else{
            return redirect('member_dashboard')->with('error','คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }
    //งานพิจารณาแล้ว
    public function index_1(){
        if(Auth::user()->level=='4'){
            //หัวหน้ากอง
            // $document_admission_division_all = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
            // ->where('doc_site_id',Auth::user()->site_id)
            // ->where('doc_type', '0')
            // ->where('doc_template', 'A')
            // ->where('doc_status', 'success')
            // ->where('sub_recid', Auth::user()->group)
            // ->where('sub_status', '!=','2')
            // ->where('seal_id_1', Auth::user()->id)
            // ->where('seal_date_1', '!=', NULL)
            // ->get();
            return view('member.documents_admission_division_all.index');
        }else{
            return redirect('member_dashboard')->with('error','คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
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
            $userS_0 = cottons::Join('users','users.cotton','cottons.cottons_id')
            ->where('level', '5')
            ->where('cottons_group', Auth::user()->group)
            ->where('site_id',Auth::user()->site_id)
            ->get();

            //หาชื่อ-นามสกุล ผู้รับงาน
            $userS_2 = User::where('level', '7')
            ->where('site_id',Auth::user()->site_id)
            ->where('group', Auth::user()->group)
            ->get();

            if($document_detail->sub_status == '8'){
                $sub2_docs = sub2_doc::where('sub2_docid', $id)->get();
            }else{
                $sub2_docs = '';
            }

         

            //หาชื่อ-นามสกุล นายก
            // $userS_1 = User::where('level', '1')
            // ->where('site_id',Auth::user()->site_id)
            // ->get();

            //หาชื่อ-นามสกุล รองนายก|ปลัด|รองปลัด
            // $userS_3 = User::where('level', '2')
            // ->where('site_id',Auth::user()->site_id)
            // ->get();

            return view('member.documents_admission_division_all.detail',compact('document_detail','userS_0','userS_2','sub2_docs'));
        }else{
            return redirect('member_dashboard')->with('error','คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }

    //หัวหน้าฝ่ายลงรับ
    public function takedown(Request $request){
        //ตรวจสอบข้อมูลที่กรอกเข้ามาก่อน
        $request->validate(
            [
                'seal_pos_1'=>'required|max:255'
            ],
            [
                'seal_pos_1.required'=>"กรุณากรอกตำแหน่งด้วยครับ",
                'seal_pos_1.max' => "ห้ามป้อนเกิน 255 ตัวอักษร"
            ]
        );

        //เช็คผู้พิจารณา
        if($request->sign_goup_0 == ''){
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
            //เซ็น
            $full_path = functionController::funtion_generate_PDF_division_to_work($request->seal_file ,$request->seal_detail_1 ,$request->seal_id_1 ,$request->seal_pos_1 ,$request->sub_id);
            // $full_path = functionController::funtion_generate_PDF_III($request->doc_filedirec_1,$request->seal_point,$request->sub_recnum,$request->sub_date,$request->sub_time,$request->sub_id,$request->seal_pos_0,$request->seal_date_1,$request->seal_pos_1,$request->seal_date_0,$request->seal_id_1,$request->seal_id_0,$request->seal_detail_1,$request->seal_detail_0);

            $update_sub_docs = sub_doc::where('sub_id', $request->sub_id)
            ->update([
                 'seal_detail_1'=>$request->seal_detail_1,
                 'seal_pos_1'=>$request->seal_pos_1,
                 'seal_date_1'=>date('Y-m-d H:i:s'),
                 'sub_status'=>'8',
                 'seal_file'=>$full_path,
                 'sub_updated_at'=>date('Y-m-d H:i:s')
            ]);
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
                //ถ้าเลือกคนพิจารณา
                //มีการเช็คสถานะ
                $document_check = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
                ->where('sub_docid', $request->doc_id)
                ->where('sub_id', $request->sub_id)
                ->first();
                if($document_check){
                    $full_path = functionController::funtion_generate_PDF_division_to_department($request->seal_file ,$request->seal_detail_1 ,$request->seal_id_1 ,$request->seal_pos_1 ,$request->sub_id);

                    for ($t = 0; $t < count($request->sub2_recid_cottons); $t++) {
                        $sub2_recid_cottons[$t] = $request->sub2_recid_cottons[$t];
                        $user_check_level_5[$t] = User::where('level', '5')
                        ->where('site_id',Auth::user()->site_id)
                        ->where('group', Auth::user()->group)
                        ->where('cotton', $sub2_recid_cottons[$t])
                        ->first();
                        if($user_check_level_5[$t]){
                            $update_sub_docs = sub_doc::insert([
                                'sub_docid'=>$request->doc_id,
                                'sub_recnum'=>$document_check->sub_recnum,
                                'sub_date'=>$document_check->sub_date,
                                'sub_time'=>$document_check->sub_time,
                                'sub_recid'=>Auth::user()->group,
                                'sub_cotton'=>$sub2_recid_cottons[$t],
                                'sub_status'=>'1',
                                'sub_created_at'=>date('Y-m-d H:i:s'),
                                'sub_updated_at'=>date('Y-m-d H:i:s'),
                                'seal_recname_0'=>$document_check->seal_recname_0,
                                'seal_detail_0'=>$document_check->seal_detail_0,
                                'seal_note_0'=>$document_check->seal_note_0,
                                'seal_pos_0'=>$document_check->seal_pos_0,
                                'seal_date_0'=>$document_check->seal_date_0,
                                'seal_id_0'=>$user_check_level_5[$t]->id,
                                'seal_point'=>$document_check->seal_point,
                                'seal_id_1'=>$document_check->seal_id_1,
                                'seal_detail_1'=>$request->seal_detail_1,
                                'seal_pos_1'=>$request->seal_pos_1,
                                'seal_file'=>$full_path,
                                'seal_date_1'=>date('Y-m-d H:i:s'),
                            ]);

                        }else{
                            return redirect()->back()->with('error','พบปัญหาการอัพเดตข้อมูลกรุณาแจ้งผู้พัฒนา [user_check_level_5]!');
                        }
                      
                    }

                    $delete = sub_doc::where('sub_id', $request->sub_id)->delete();
                }else{
                    return redirect()->back()->with('error','พบปัญหาการอัพเดตข้อมูลกรุณาแจ้งผู้พัฒนา [document_check]!');
                }
               

                // $user_check_level_goup_3 = User::where('id', $request->sign_goup_0)
                // ->first();
                // if($user_check_level_goup_3->level == '5'){
                //     //หัวหน้าฝ่าย
                //     $update_sub_docs_0 = sub_doc::where('sub_id', $request->sub_id)->update([
                //         'seal_id_0'=>$request->sign_goup_0
                //     ]);
                //     $sub_status = '1';
                // }elseif($user_check_level_goup_3->level == '1'||$user_check_level_goup_3->level == '2'){
                //     //นายก  รองนายก|ปลัด|รองปลัด
                //     $update_sub_docs_2 = sub_doc::where('sub_id', $request->sub_id)->update([
                //         'seal_id_2'=>$request->sign_goup_3
                //     ]);
                //     $sub_status = '3';

                //     if($request->sign_goup_4 != ''){
                //         //ถ้าเลือกผู้พิจารณาคนที่ 2
                //         $update_sub_docs_3 = sub_doc::where('sub_id', $request->sub_id)->update([
                //             'seal_id_3'=>$request->sign_goup_4
                //         ]);
                //     }
                //     if($request->sign_goup_5 != ''){
                //         //ถ้าเลือกผู้พิจารณาคนที่ 3
                //         $update_sub_docs_4 = sub_doc::where('sub_id', $request->sub_id)->update([
                //             'seal_id_4'=>$request->sign_goup_5
                //         ]);
                //     }
                //     if($request->sign_goup_6 != ''){
                //         //ถ้าเลือกผู้พิจารณาคนที่ 4
                //         $update_sub_docs_5 = sub_doc::where('sub_id', $request->sub_id)->update([
                //             'seal_id_5'=>$request->sign_goup_6
                //         ]);
                //     }
            }else{
                return redirect()->back()->with('error','พบปัญหาการอัพเดตข้อมูลกรุณาแจ้งผู้พัฒนา [user_check_level_5]!');
            }

        }

        //linetoken
        $tokens_Check = Groupmem::where('group_site_id', Auth::user()->site_id)
        ->where('group_id', Auth::user()->group)
        ->first();
        if($tokens_Check){
            $message = "\n⚠️ หัวหน้ากองพิจารณาเอกสารรับเข้าภายนอก ⚠️\n>เลขที่หนังสือ :  ".$request->doc_docnum."\n>หน่วยงานต้นเรื่อง :  ".$request->doc_origin."\n>เรื่อง : ".$request->doc_title."\n>เวลาแจ้งเตือน : ".date('Y-m-d H:i')." ";
            functionController::line_notify($message,$tokens_Check->group_token);
        }
 
        if($update_sub_docs){
            return redirect()->route('documents_admission_division_all_0')->with('success',"ลงรับเรียบร้อย");
        }else{
            return redirect()->back()->with('error','พบปัญหาการอัพเดตข้อมูลกรุณาแจ้งผู้พัฒนา !');
        }
    }
}
