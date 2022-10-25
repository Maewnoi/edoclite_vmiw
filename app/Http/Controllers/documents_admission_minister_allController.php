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

class documents_admission_minister_allController extends Controller
{
    //

     //นักจำนวนงานรอพิจารณา
     public function index_0(){
        if(Auth::user()->level=='1'){
            //นายก
            $documents_admission_minister_all = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '0')
            ->where('doc_template', 'A')
            ->where('doc_status', 'success')
            ->whereRaw('CASE WHEN sub_docs.sub_status = "3" THEN sub_docs.seal_id_2 = '.Auth::user()->id.' WHEN sub_docs.sub_status = "4" THEN sub_docs.seal_id_3 = '.Auth::user()->id.' WHEN sub_docs.sub_status = "5" THEN sub_docs.seal_id_4 = '.Auth::user()->id.' WHEN sub_docs.sub_status = "6" THEN sub_docs.seal_id_5 = '.Auth::user()->id.' END')
            ->get();
            return view('member.documents_admission_minister_all.index',compact('documents_admission_minister_all'));
        }else{
            return redirect('member_dashboard')->withErrors('คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }

    //นักจำนวนงานเซ็นหรือพิจารณาแล้ว 
    public function index_1(){
        if(Auth::user()->level=='1'){
            //นายก
            $documents_admission_minister_all = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '0')
            ->where('doc_template', 'A')
            ->where('doc_status', 'success')
            ->whereRaw('CASE WHEN sub_docs.seal_id_2 = '.Auth::user()->id.' THEN sub_docs.seal_date_2 != "" WHEN sub_docs.seal_id_3 = '.Auth::user()->id.' THEN sub_docs.seal_date_3 != "" WHEN sub_docs.seal_id_4 = '.Auth::user()->id.' THEN sub_docs.seal_date_4 != "" WHEN sub_docs.seal_id_5 = '.Auth::user()->id.' THEN sub_docs.seal_date_5 != "" END')
            ->get();
            return view('member.documents_admission_minister_all.index',compact('documents_admission_minister_all'));
        }else{
            return redirect('member_dashboard')->withErrors('คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }
    public function detail($id){
        if(Auth::user()->level=='1'){
            //นายก
            $document_detail = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->where('doc_id', $id)
            ->where('doc_site_id',Auth::user()->site_id)
            ->first();
            return view('member.documents_admission_minister_all.detail',compact('document_detail'));
        }else{
            return redirect('member_dashboard')->withErrors('คุณไม่มีสิทธิ์เข้าเมนูนี้ในระบบ !');
        }
    }
}
