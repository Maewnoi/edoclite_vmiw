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

class documents_admission_work_allController extends Controller
{
    //

    //งานเอกสารรับเข้าที่ยังไม่อ่าน
    public function index_0(){
        if(Auth::user()->level=='7'){
            //สารบรรณกอง
            $document_admission_all_work = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->leftJoin('sub2_docs','sub2_docs.sub2_subid','sub_docs.sub_id')
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '0')
            ->where('doc_template', 'A')
            ->where('doc_status', 'success')
            ->where('sub_recid', Auth::user()->group)
            ->where('sub_status', '8')
            ->where('sub2_status', '0')
            ->where('sub2_recid', Auth::user()->id)
            ->get();
            return view('member.documents_admission_work_all.index',compact('document_admission_all_work'));
        }else{
            return redirect('member_dashboard')->with('error','คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }

    //งานเอกสารรับเข้าที่อ่านแล้ว
    public function index_1(){
        if(Auth::user()->level=='7'){
            //สารบรรณกอง
            $document_admission_all_work = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->leftJoin('sub2_docs','sub2_docs.sub2_subid','sub_docs.sub_id')
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '0')
            ->where('doc_template', 'A')
            ->where('doc_status', 'success')
            ->where('sub_recid', Auth::user()->group)
            ->where('sub_status', '8')
            ->where('sub2_status', '1')
            ->where('sub2_recid', Auth::user()->id)
            ->get();
            return view('member.documents_admission_work_all.index',compact('document_admission_all_work'));
        }else{
            return redirect('member_dashboard')->with('error','คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }

    public function detail($id){
        if(Auth::user()->level=='7'){
            //งาน
            $document_detail = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->leftJoin('sub2_docs','sub2_docs.sub2_subid','sub_docs.sub_id')
            ->where('doc_id', $id)
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('sub_recid', Auth::user()->group)
            ->where('sub2_recid',Auth::user()->id)
            ->first();

            if($document_detail->sub2_status == '0'){
                //document_update_sub2_status อ่าน
                // $document_update_sub2_status = sub2_doc::where('sub2_id', $document_detail->sub2_id)->update([
                //     'sub2_status'=>'1',
                //     'sub2_updated_at'=>date('Y-m-d H:i:s')
                // ]);
                return view('member.documents_admission_work_all.detail',compact('document_detail'))->with('success','อ่านเอกสารเรียบร้อย !');
                
            }else{
                return view('member.documents_admission_work_all.detail',compact('document_detail'));
            }
        }else{
            return redirect('member_dashboard')->with('error','คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }

    public function respond(Request $request){
        if($request->bt_respond == 'respond_garudav'){
            //หาหัวหน้าฝ่าย
            $userS_0 = User::where('level', '5')
            ->where('site_id',Auth::user()->site_id)
            ->where('group', Auth::user()->group)
            ->where('cotton', Auth::user()->cotton)
            ->first();
            if($userS_0){
                $insert_sub3_docs = sub3_doc::insertGetId([
                    'sub3_docid'=>$request->doc_id_garuda,
                    'sub3_subid'=>$request->sub_id_garuda,
                    'sub3_sub_2id'=>$request->sub2_id_garuda,
                    'sub3_type'=>$request->sub3_type,
                    'sub3_status' =>'0',
                    'sub3_inspector_0'=>$userS_0->id,
                    'sub3_created_at'=>date('Y-m-d H:i:s')
                ]);
                    
                $insert_sub3_detail = sub3_detail::insertGetId([
                    'sub3d_sub_3id'=>$insert_sub3_docs,
                    'sub3d_government'=>$request->sub3d_government_garuda,
                    'sub3d_draft'=>$request->sub3d_draft_garuda,
                    'sub3d_date'=>$request->sub3d_date_garuda,
                    'sub3d_topic'=>$request->sub3d_topic_garuda,
                    'sub3d_podium' =>$request->sub3d_podium_garuda,
                    'sub3d_speed'=>$request->sub3d_speed
                ]);
                
                $request->request->add(['sub3d_id_garuda' => $insert_sub3_docs,'action_garuda' => 'respond']);
                event(new functionController($full_path = functionController::funtion_PDFRespond_garuda($request)));
                if(!$full_path){
                    return redirect('member_dashboard')->with('error','พบปัญหาบางอย่างผิดพลาด [funtion_PDFRespond_garuda] !');
                }
                $update_sub3_detail = sub3_detail::where('sub3d_id', $insert_sub3_detail)->update([
                    'sub3d_file'=>$full_path
                ]);
                if($insert_sub3_docs && $insert_sub3_detail && $update_sub3_detail){
                    //linetoken
                    $tokens_Check = Groupmem::where('group_site_id', Auth::user()->site_id)
                    ->where('group_id', Auth::user()->group)
                    ->first();
                    if($tokens_Check){
                        $message = "\n⚠️ ตอบกลับเอกสารภายนอก ⚠️\n>เลขที่หนังสือ :  ".$request->doc_docnum_garuda."\n>หน่วยงานต้นเรื่อง :  ".$request->doc_origin_garuda."\n>เรื่อง : ".$request->doc_title_garuda."\n>เวลาแจ้งเตือน : ".date('Y-m-d H:i')." ";
                        functionController::line_notify($message,$tokens_Check->group_token);
                    }
                    return redirect()->route('documents_admission_work_all_0')->with('success',"ตอบการเอกสารเรียบร้อย");
                }else{
                    return redirect('member_dashboard')->with('error','พบปัญหาบางอย่างผิดพลาด [insert] !');
                }
            }else{
                return redirect('member_dashboard')->with('error','พบปัญหาบางอย่างผิดพลาด [userS_level_5] !');
            }
        }else if($request->bt_respond == 'respond'){
             //หาหัวหน้าฝ่าย
            $userS_0 = User::where('level', '5')
            ->where('site_id',Auth::user()->site_id)
            ->where('group', Auth::user()->group)
            ->where('cotton', Auth::user()->cotton)
            ->first();
            if($userS_0){
                $insert_sub3_docs = sub3_doc::insertGetId([
                    'sub3_docid'=>$request->doc_id,
                    'sub3_subid'=>$request->sub_id,
                    'sub3_sub_2id'=>$request->sub2_id,
                    'sub3_type'=>$request->sub3_type,
                    'sub3_status' =>'0',
                    'sub3_inspector_0'=>$userS_0->id,
                    'sub3_created_at'=>date('Y-m-d H:i:s')
                ]);
                
                $insert_sub3_detail = sub3_detail::insertGetId([
                    'sub3d_sub_3id'=>$insert_sub3_docs,
                    'sub3d_government'=>$request->sub3d_government,
                    'sub3d_draft'=>$request->sub3d_draft,
                    'sub3d_date'=>$request->sub3d_date,
                    'sub3d_topic'=>$request->sub3d_topic,
                    'sub3d_podium' =>$request->sub3d_podium,
                    // 'sub3d_therefore'=>$request->sub3d_therefore,
                    // 'sub3d_pos'=>$request->sub3d_pos,
                    'sub3d_speed'=>$request->sub3d_speed
                ]);
            
                $request->request->add(['sub3d_id' => $insert_sub3_docs,'action' => 'respond']);
                event(new functionController($full_path = functionController::funtion_PDFRespond($request)));
                if(!$full_path){
                    return redirect('member_dashboard')->with('error','พบปัญหาบางอย่างผิดพลาด [funtion_PDFRespond] !');
                }
                $update_sub3_detail = sub3_detail::where('sub3d_id', $insert_sub3_detail)->update([
                    'sub3d_file'=>$full_path
                ]);
                if($insert_sub3_docs && $insert_sub3_detail && $update_sub3_detail){
                    //linetoken
                    $tokens_Check = Groupmem::where('group_site_id', Auth::user()->site_id)
                    ->where('group_id', Auth::user()->group)
                    ->first();
                    if($tokens_Check){
                        $message = "\n⚠️ ตอบกลับเอกสารภายนอก ⚠️\n>เลขที่หนังสือ :  ".$request->doc_docnum."\n>หน่วยงานต้นเรื่อง :  ".$request->doc_origin."\n>เรื่อง : ".$request->doc_title."\n>เวลาแจ้งเตือน : ".date('Y-m-d H:i')." ";
                        functionController::line_notify($message,$tokens_Check->group_token);
                    }
                    return redirect()->route('documents_admission_work_all_0')->with('success',"ตอบการเอกสารเรียบร้อย");
                }else{
                    return redirect('member_dashboard')->with('error','พบปัญหาบางอย่างผิดพลาด [insert] !');
                }
            }else{
                return redirect('member_dashboard')->with('error','พบปัญหาบางอย่างผิดพลาด [userS_level_5] !');
            }
        }else{
            return redirect('member_dashboard')->with('error','พบปัญหาบางอย่างผิดพลาด [bt_respond] !');
        }
       
    }
}
