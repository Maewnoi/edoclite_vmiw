<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Groupmem;
use App\Models\User;
use App\Models\documents_retrun;
use App\Models\documents_retrun_detail;

class documents_retrun_inside_department_retrunController extends Controller
{
    //
    public function index(){
        if(Auth::user()->level=='5'){
            return view('member.documents_retrun_inside_department_retrun.index');
        }else{
            return redirect('member_dashboard')->with('error','คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }

    public function detail($id){
        if(Auth::user()->level=='5'){
            $document_retrun_inside_detail = documents_retrun::join('Documents_retrun_details','Documents_retrun_details.docrtdt_docrt_id','Documents_retruns.docrt_id')
            ->where('docrt_id',$id)
            ->where('docrt_sites_id',Auth::user()->site_id)
            ->where('docrt_status', 'C')
            ->first();
            return view('member.documents_retrun_inside_department_retrun.detail',compact('document_retrun_inside_detail'));
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
                $update_documents_retrun = documents_retrun::where('docrt_id', $request->docrt_id_garuda)->update([
                    'docrt_status' =>'1',
                    'docrt_inspector_1' => $userS_0->id,
                    'docrt_updated_at' => date('Y-m-d H:i:s')
                ]);

                $request->request->add(['docrt_id_garuda' => $request->docrt_id_garuda,'action_garuda' => 'respond']);
                event(new functionController($full_path = functionController::funtion_PDFRespond_garuda_retrun($request)));
                if(!$full_path){
                    return redirect('member_dashboard')->with('error','พบปัญหาบางอย่างผิดพลาด [funtion_PDFRespond_garuda_retrun] !');
                }

                $update_documents_retrun_detail = documents_retrun_detail::where('docrtdt_id', $request->docrtdt_id_garuda)->update([
                    'docrtdt_government'=>$request->docrtdt_government_garuda,
                    'docrtdt_draft'=>$request->docrtdt_draft_garuda,
                    'docrtdt_date'=>$request->docrtdt_date_garuda,
                    'docrtdt_topic'=>$request->docrtdt_topic_garuda,
                    'docrtdt_podium' =>$request->docrtdt_podium_garuda,
                    'docrtdt_file'=>$full_path
                ]);

                if($update_documents_retrun && $update_documents_retrun_detail){
                    //linetoken
                    $tokens_Check = Groupmem::where('group_site_id', Auth::user()->site_id)
                    ->where('group_id', Auth::user()->group)
                    ->first();
                    if($tokens_Check){
                        $message = "\n⚠️ ตอบกลับเอกสารภายในอีกครั้ง ⚠️\n>เรื่อง :  ".$request->docrtdt_topic."\n>ที่ร่าง :  ".$request->docrtdt_draft."\n>วันที่ : ".$request->docrtdt_date."\n>เวลาแจ้งเตือน : ".date('Y-m-d H:i')." ";
                        functionController::line_notify($message,$tokens_Check->group_token);
                    }
                    return redirect()->route('documents_retrun_inside_department_retrun_all')->with('success',"ตอบการเอกสารเรียบร้อย");
                }else{
                    return redirect('member_dashboard')->with('error','พบปัญหาบางอย่างผิดพลาด [insert respond_garuda] !');
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
                $update_documents_retrun = documents_retrun::where('docrt_id', $request->docrt_id)->update([
                    'docrt_status' =>'1',
                    'docrt_inspector_1'=>$userS_0->id,
                    'docrt_updated_at'=>date('Y-m-d H:i:s')
                ]);

                $request->request->add(['docrt_id' => $request->docrt_id,'action' => 'respond']);
                event(new functionController($full_path = functionController::funtion_PDFRespond_retrun($request)));
                if(!$full_path){
                    return redirect('member_dashboard')->with('error','พบปัญหาบางอย่างผิดพลาด [funtion_PDFRespond_retrun] !');
                }

                $update_documents_retrun_detail = documents_retrun_detail::where('docrtdt_id', $request->docrtdt_id)->update([
                    'docrtdt_government'=>$request->docrtdt_government,
                    'docrtdt_draft'=>$request->docrtdt_draft,
                    'docrtdt_date'=>$request->docrtdt_date,
                    'docrtdt_topic'=>$request->docrtdt_topic,
                    'docrtdt_podium' =>$request->docrtdt_podium,
                    'docrtdt_file'=>$full_path
                ]);

                if($update_documents_retrun && $update_documents_retrun_detail){
                    //linetoken
                    $tokens_Check = Groupmem::where('group_site_id', Auth::user()->site_id)
                    ->where('group_id', Auth::user()->group)
                    ->first();
                    if($tokens_Check){
                        $message = "\n⚠️ ตอบกลับเอกสารภายในอีกครั้ง ⚠️\n>เรื่อง :  ".$request->docrtdt_topic."\n>ที่ร่าง :  ".$request->docrtdt_draft."\n>วันที่ : ".$request->docrtdt_date."\n>เวลาแจ้งเตือน : ".date('Y-m-d H:i')." ";
                        functionController::line_notify($message,$tokens_Check->group_token);
                    }
                    return redirect()->route('documents_retrun_inside_department_retrun_all')->with('success',"ตอบการเอกสารเรียบร้อย");
                }else{
                    return redirect('member_dashboard')->with('error','พบปัญหาบางอย่างผิดพลาด [insert respond] !');
                }
            }else{
                return redirect('member_dashboard')->with('error','พบปัญหาบางอย่างผิดพลาด [userS_level_5] !');
            }
        }else{
            return redirect('member_dashboard')->with('error','พบปัญหาบางอย่างผิดพลาด [bt_respond] !');
        }
    }
}
