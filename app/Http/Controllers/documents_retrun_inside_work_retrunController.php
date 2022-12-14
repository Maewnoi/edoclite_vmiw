<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\sites;
use Illuminate\Support\Facades\DB;
use App\Models\Groupmem;
use App\Models\User;
use App\Models\documents_retrun;
use App\Models\documents_retrun_detail;
use Illuminate\Support\Str;

class documents_retrun_inside_work_retrunController extends Controller
{
    //
    public function index(){
        if(Auth::user()->level=='7'){
            return view('member.documents_retrun_inside_work_retrun.index');
        }else{
            return redirect('member_dashboard')->with('error','คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }

    public function detail($id){
        if(Auth::user()->level=='7'){
            $document_retrun_inside_detail = documents_retrun::join('documents_retrun_details','documents_retrun_details.docrtdt_docrt_id','documents_retruns.docrt_id')
            ->where('docrt_id',$id)
            ->where('docrt_sites_id',Auth::user()->site_id)
            ->where('docrt_status', 'C')
            ->first();
            return view('member.documents_retrun_inside_work_retrun.detail',compact('document_retrun_inside_detail'));
        }else{
            return redirect('member_dashboard')->with('error','คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }

    public function respond(Request $request){
        if($request->bt_respond == 'respond_normal'){
            //หาหัวหน้าฝ่าย
            $userS_0 = User::where('level', '5')
            ->where('site_id',Auth::user()->site_id)
            ->where('group', Auth::user()->group)
            ->where('cotton', Auth::user()->cotton)
            ->first();
            if($userS_0){
                $update_documents_retrun = documents_retrun::where('docrt_id', $request->docrt_id_normal)->update([
                    'docrt_status' =>'0',
                    'docrt_inspector_0' => $userS_0->id,
                    'docrt_updated_at' => date('Y-m-d H:i:s')
                ]);

                $sites= sites::where('sites.site_id', Auth::user()->site_id)->first();
                $random = Str::random(5);
                $date_new = date('Y-m-d');
                $year_new = date('Y');
                //การเข้ารหัสไฟล์_doc_filedirec
                $docrtdt_file = $request->file('docrtdt_file');
                //Generate ชื่อไฟล์
                $name_gen_new = $request->sub3_id_normal."_".$date_new."_".$random;
                // ดึงนามสกุลไฟล์
                $docrtdt_file_img_ext = strtolower($docrtdt_file->getClientOriginalExtension());
                $docrtdt_file_img_name = $name_gen_new.'.'.$docrtdt_file_img_ext;
                //อัพโหลดและบันทึกข้อมูล
                $upload_location = 'image/'.$sites->site_path_folder.'/'.$year_new.'/respond/';
                $full_path = $upload_location.$docrtdt_file_img_name;
                $docrtdt_file->move($upload_location,$docrtdt_file_img_name);

                if($full_path != null){
                    $update_documents_retrun_detail = documents_retrun_detail::where('docrtdt_docrt_id', $request->docrt_id_normal)->update([
                        'docrtdt_government'=>$request->docrtdt_government_normal,
                        'docrtdt_draft'=>$request->docrtdt_draft_normal,
                        'docrtdt_date'=>$request->docrtdt_date_normal,
                        'docrtdt_topic'=>$request->docrtdt_topic_normal,
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
                        return redirect()->route('documents_retrun_inside_work_retrun_all')->with('success',"ตอบการเอกสารเรียบร้อย");
                    }else{
                        return redirect('member_dashboard')->with('error','พบปัญหาบางอย่างผิดพลาด [insert] !');
                    }
                }else{
                    return redirect('member_dashboard')->with('error','พบปัญหาบางอย่างผิดพลาด [full_path] !');
                }
            }else{
                return redirect('member_dashboard')->with('error','พบปัญหาบางอย่างผิดพลาด [userS_0] !');
            }

        }else if($request->bt_respond == 'respond_garuda'){
            //หาหัวหน้าฝ่าย
            $userS_0 = User::where('level', '5')
            ->where('site_id',Auth::user()->site_id)
            ->where('group', Auth::user()->group)
            ->where('cotton', Auth::user()->cotton)
            ->first();
            if($userS_0){
                $update_documents_retrun = documents_retrun::where('docrt_id', $request->docrt_id_garuda)->update([
                    'docrt_status' =>'0',
                    'docrt_inspector_0' => $userS_0->id,
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
                    return redirect()->route('documents_retrun_inside_work_retrun_all')->with('success',"ตอบการเอกสารเรียบร้อย");
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
                $update_documents_retrun = documents_retrun::where('docrt_id', $request->docrt_id)->update([
                    'docrt_status' =>'0',
                    'docrt_inspector_0'=>$userS_0->id,
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
                    return redirect()->route('documents_retrun_inside_work_retrun_all')->with('success',"ตอบการเอกสารเรียบร้อย");
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
