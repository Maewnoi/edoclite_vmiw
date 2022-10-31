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

class documents_admission_work_inside_allController extends Controller
{
    //

     //งานเอกสารรับเข้าที่ยังไม่อ่าน
     public function index_0(){
        if(Auth::user()->level=='7'){
            //สารบรรณกอง
            $document_admission_all_work_inside = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
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
            ->get();
            return view('member.documents_admission_work_inside_all.index',compact('document_admission_all_work_inside'));
        }else{
            return redirect('member_dashboard')->with('error','คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }

    //งานเอกสารรับเข้าที่อ่านแล้ว
    public function index_1(){
        if(Auth::user()->level=='7'){
            //สารบรรณกอง
            $document_admission_all_work_inside = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
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
            ->get();
            return view('member.documents_admission_work_inside_all.index',compact('document_admission_all_work_inside'));
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
//dd($document_detail);
            if($document_detail->sub2_status == '0'){
                //document_update_sub2_status อ่าน
                $document_update_sub2_status = sub2_doc::where('sub2_id', $document_detail->sub2_id)
                    ->update([
                        'sub2_status'=>'1',
                        'sub2_updated_at'=> date('Y-m-d H:i:s')
                    ]);
                return view('member.documents_admission_work_inside_all.detail',compact('document_detail'))->with('success','อ่านเอกสารเรียบร้อย !');
            }else{
                return view('member.documents_admission_work_inside_all.detail',compact('document_detail'));
            }
        }else{
            return redirect('member_dashboard')->with('error','คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }
}
