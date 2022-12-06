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

class documents_admission_inside_work_retrunController extends Controller
{
    //
    public function index(){
        if(Auth::user()->level=='7'){
            return view('member.documents_admission_inside_work_retrun.index');
        }else{
            return redirect('member_dashboard')->with('error','คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }

    public function detail($id){
        if(Auth::user()->level=='7'){
            $document_detail = document::join('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->join('sub2_docs','sub2_docs.sub2_subid','sub_docs.sub_id')
            ->join('sub3_docs','sub3_docs.sub3_sub_2id','sub2_docs.sub2_id')
            ->join('sub3_details','sub3_details.sub3d_sub_3id','sub3_docs.sub3_id')
            ->where('doc_id', $id)
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('sub_recid', Auth::user()->group)
            ->where('sub3_status', 'C')
            ->first();
            return view('member.documents_admission_inside_work_retrun.detail',compact('document_detail'));
        }else{
            return redirect('member_dashboard')->with('error','คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }

    public function respond(Request $request){
        if($request->bt_respond == 'respond_garuda'){
            //หาหัวหน้าฝ่าย
            $userS_0 = User::where('level', '5')
            ->where('site_id',Auth::user()->site_id)
            ->where('group', Auth::user()->group)
            ->where('cotton', Auth::user()->cotton)
            ->first();
            if($userS_0){
                $update_sub3_docs = sub3_doc::where('sub3_id', $request->sub3_id_garuda)->update([
                    'sub3_status' =>'0',
                    'sub3_inspector_0' => $userS_0->id,
                    'sub3_updated_at' => date('Y-m-d H:i:s')
                ]);
                    
                $update_sub3_detail = sub3_detail::where('sub3d_id', $request->sub3d_id_garuda)->update([
                    'sub3d_government'=>$request->sub3d_government_garuda,
                    'sub3d_draft'=>$request->sub3d_draft_garuda,
                    'sub3d_date'=>$request->sub3d_date_garuda,
                    'sub3d_topic'=>$request->sub3d_topic_garuda,
                    'sub3d_podium' =>$request->sub3d_podium_garuda
                ]);

                $request->request->add(['sub3d_id_garuda' => $request->sub3d_id_garuda,'action_garuda' => 'respond']);
                event(new functionController($full_path = functionController::funtion_PDFRespond_garuda($request)));
                if(!$full_path){
                    return redirect('member_dashboard')->with('error','พบปัญหาบางอย่างผิดพลาด [funtion_PDFRespond_garuda] !');
                }
                $update_sub3_detail_full_path = sub3_detail::where('sub3d_id', $request->sub3d_id_garuda)->update([
                    'sub3d_file'=>$full_path
                ]);
                if($update_sub3_docs && $update_sub3_detail && $update_sub3_detail_full_path){
                    //linetoken
                    $tokens_Check = Groupmem::where('group_site_id', Auth::user()->site_id)
                    ->where('group_id', Auth::user()->group)
                    ->first();
                    if($tokens_Check){
                        $message = "\n⚠️ ตอบกลับเอกสารภายในอีกครั้ง ⚠️\n>เลขที่หนังสือ :  ".$request->doc_docnum_garuda."\n>หน่วยงานต้นเรื่อง :  ".$request->doc_origin_garuda."\n>เรื่อง : ".$request->doc_title_garuda."\n>เวลาแจ้งเตือน : ".date('Y-m-d H:i')." ";
                        functionController::line_notify($message,$tokens_Check->group_token);
                    }
                    return redirect()->route('documents_admission_inside_work_retrun_all')->with('success',"ตอบการเอกสารเรียบร้อย");
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
                $update_sub3_docs = sub3_doc::where('sub3_id', $request->sub3_id)->update([
                    'sub3_status' =>'0',
                    'sub3_inspector_0'=>$userS_0->id,
                    'sub3_updated_at'=>date('Y-m-d H:i:s')
                ]);
                
                $update_sub3_detail = sub3_detail::where('sub3d_id', $request->sub3d_id)->update([
                    'sub3d_government'=>$request->sub3d_government,
                    'sub3d_draft'=>$request->sub3d_draft,
                    'sub3d_date'=>$request->sub3d_date,
                    'sub3d_topic'=>$request->sub3d_topic,
                    'sub3d_podium' =>$request->sub3d_podium
                ]);

                $request->request->add(['sub3d_id' => $request->sub3d_id,'action' => 'respond']);
                event(new functionController($full_path = functionController::funtion_PDFRespond($request)));
                if(!$full_path){
                    return redirect('member_dashboard')->with('error','พบปัญหาบางอย่างผิดพลาด [funtion_PDFRespond] !');
                }
                $update_sub3_detail_full_path = sub3_detail::where('sub3d_id', $request->sub3d_id)->update([
                    'sub3d_file'=>$full_path
                ]);
                if($update_sub3_docs && $update_sub3_detail && $update_sub3_detail_full_path){
                    //linetoken
                    $tokens_Check = Groupmem::where('group_site_id', Auth::user()->site_id)
                    ->where('group_id', Auth::user()->group)
                    ->first();
                    if($tokens_Check){
                        $message = "\n⚠️ ตอบกลับเอกสารภายในอีกครั้ง ⚠️\n>เลขที่หนังสือ :  ".$request->doc_docnum."\n>หน่วยงานต้นเรื่อง :  ".$request->doc_origin."\n>เรื่อง : ".$request->doc_title."\n>เวลาแจ้งเตือน : ".date('Y-m-d H:i')." ";
                        functionController::line_notify($message,$tokens_Check->group_token);
                    }
                    return redirect()->route('documents_admission_inside_work_retrun_all')->with('success',"ตอบการเอกสารเรียบร้อย");
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
