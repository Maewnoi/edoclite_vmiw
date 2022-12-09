<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\document;
use App\Models\reserve_number;
use App\Models\sub_doc;
use App\Models\sub2_doc;
use App\Models\sites;
use App\Models\Groupmem;
use App\Models\cottons;
use App\Models\User;
use DataTables;
use App\Models\documents_retrun;
use App\Models\documents_retrun_detail;

class queryController extends Controller
{
    //
    public static function funtion_query_documents_retrun_inside_division_retrunController_level_4() {
        if(Auth::user()->level=='4'){
            $documents_retrun_inside_division_retrun= documents_retrun::join('documents_retrun_details','documents_retrun_details.docrtdt_docrt_id','documents_retruns.docrt_id')
            ->where('docrt_status', 'C')
            ->where('docrt_owner', Auth::user()->id)
            ->get();
            return $documents_retrun_inside_division_retrun;
        }else{
            return 0;
        }
    }

    public static function funtion_query_documents_retrun_inside_department_retrunController_level_5() {
        if(Auth::user()->level=='5'){
            $documents_retrun_inside_department_retrun = documents_retrun::join('documents_retrun_details','documents_retrun_details.docrtdt_docrt_id','documents_retruns.docrt_id')
            ->where('docrt_status', 'C')
            ->where('docrt_owner', Auth::user()->id)
            ->get();
            return $documents_retrun_inside_department_retrun;
        }else{
            return 0;
        }
    }

    public static function funtion_query_documents_retrun_inside_work_retrunController_level_7() {
        if(Auth::user()->level=='7'){
            $documents_retrun_inside_work_retrun = documents_retrun::join('documents_retrun_details','documents_retrun_details.docrtdt_docrt_id','documents_retruns.docrt_id')
            ->where('docrt_status', 'C')
            ->where('docrt_owner', Auth::user()->id)
            ->get();
     
            return $documents_retrun_inside_work_retrun;
        }else{
            return 0;
        }
    }

    public static function funtion_query_documents_retrun_inside_minister_sign_1_Controller_level_1() {
        if(Auth::user()->level=='1'){
            $document_retrun_inside_minister_sign = documents_retrun::join('documents_retrun_details','documents_retrun_details.docrtdt_docrt_id','documents_retruns.docrt_id')
            ->where('docrt_sealid_2', Auth::user()->id)
            ->whereNotNull('docrt_sealdate_2')
            ->where('docrt_status', '!=', '5')
            ->get();

            return $document_retrun_inside_minister_sign;
        }else{
            return 0;
        }
    }

    public static function funtion_query_documents_retrun_inside_minister_sign_0_Controller_level_1() {
        if(Auth::user()->level=='1'){
            $document_retrun_inside_minister_sign = documents_retrun::join('documents_retrun_details','documents_retrun_details.docrtdt_docrt_id','documents_retruns.docrt_id')
            ->where('docrt_sealid_2', Auth::user()->id)
            ->whereNull('docrt_sealdate_2')
            ->where('docrt_status', '5')
            ->get();

            return $document_retrun_inside_minister_sign;
        }else{
            return 0;
        }
    }

    public static function funtion_query_documents_retrun_inside_deputy_sign_1_Controller_level_2() {
        if(Auth::user()->level=='2'){
            $document_retrun_inside_deputy_sign_0 = documents_retrun::join('documents_retrun_details','documents_retrun_details.docrtdt_docrt_id','documents_retruns.docrt_id')
            ->where('docrt_sealid_0', Auth::user()->id)
            ->whereNotNull('docrt_sealdate_0')
            ->where(function ($query) {
                $query->where('docrt_status', '!=', '3')
                      ->orWhere('docrt_status', '!=', '4');
            })
            ->get()->toArray();

            $document_retrun_inside_deputy_sign_1 = documents_retrun::join('documents_retrun_details','documents_retrun_details.docrtdt_docrt_id','documents_retruns.docrt_id')
            ->where('docrt_sealid_1', Auth::user()->id)
            ->whereNotNull('docrt_sealdate_1')
            ->where(function ($query) {
                $query->where('docrt_status', '!=', '3')
                      ->orWhere('docrt_status', '!=', '4');
            })
            ->get()->toArray();
            $array_push = array_merge($document_retrun_inside_deputy_sign_0,$document_retrun_inside_deputy_sign_1);
  
            return $array_push;
        }else{
            return 0;
        }
    }

    public static function funtion_query_documents_retrun_inside_deputy_sign_0_Controller_level_2() {
        if(Auth::user()->level=='2'){
            $document_retrun_inside_deputy_sign_0 = documents_retrun::join('documents_retrun_details','documents_retrun_details.docrtdt_docrt_id','documents_retruns.docrt_id')
            ->where('docrt_sealid_0', Auth::user()->id)
            ->whereNull('docrt_sealdate_0')
            ->where(function ($query) {
                $query->where('docrt_status', '3')
                      ->orWhere('docrt_status', '4');
            })
            ->get()->toArray();
            $document_retrun_inside_deputy_sign_1 = documents_retrun::join('documents_retrun_details','documents_retrun_details.docrtdt_docrt_id','documents_retruns.docrt_id')
            ->where('docrt_sealid_1', Auth::user()->id)
            ->whereNull('docrt_sealdate_1')
            ->where(function ($query) {
                $query->where('docrt_status', '3')
                      ->orWhere('docrt_status', '4');
            })
            ->get()->toArray();
            $array_push = array_merge($document_retrun_inside_deputy_sign_0,$document_retrun_inside_deputy_sign_1);

            return $array_push;
        }else{
            return 0;
        }
    }

    public static function funtion_query_documents_retrun_inside_jurisprudenceController_level_5_7() {
        if(Auth::user()->jurisprudence=='1'){
            $documents_retrun_inside_jurisprudence = documents_retrun::join('documents_retrun_details','documents_retrun_details.docrtdt_docrt_id','documents_retruns.docrt_id')
            ->where('docrt_sites_id',Auth::user()->site_id)
            ->where('docrt_status', '2')
            ->get();
            return $documents_retrun_inside_jurisprudence;
        }else{
            return 0;
        }
    }
    public static function funtion_query_documents_retrun_inside_division_sign_Controller_level_4() {
        if(Auth::user()->level=='4'){
            $documents_retrun_inside_division_sign = documents_retrun::join('documents_retrun_details','documents_retrun_details.docrtdt_docrt_id','documents_retruns.docrt_id')
            ->where('docrt_sites_id',Auth::user()->site_id)
            ->where('docrt_status', '1')
            ->where('docrt_inspector_1', Auth::user()->id)
            ->get();
            return $documents_retrun_inside_division_sign;
        }else{
            return 0;
        }
    }

    public static function funtion_query_documents_retrun_inside_division_Controller_level_4() {
        if(Auth::user()->level=='4'){
            $documents_retrun_inside_division = documents_retrun::join('documents_retrun_details','documents_retrun_details.docrtdt_docrt_id','documents_retruns.docrt_id')
            ->where('docrt_owner',Auth::user()->id)
            ->where('docrt_sites_id',Auth::user()->site_id)
            ->get();
            return $documents_retrun_inside_division;
        }else{
            return 0;
        }
    }

    public static function funtion_query_documents_retrun_inside_department_sign_Controller_level_5() {
        if(Auth::user()->level=='5'){
            $documents_retrun_inside_department_sign = documents_retrun::join('documents_retrun_details','documents_retrun_details.docrtdt_docrt_id','documents_retruns.docrt_id')
            ->where('docrt_sites_id',Auth::user()->site_id)
            ->where('docrt_status', '0')
            ->where('docrt_inspector_0', Auth::user()->id)
            ->get();
            return $documents_retrun_inside_department_sign;
        }else{
            return 0;
        }
    }

    public static function funtion_query_documents_retrun_inside_department_Controller_level_5() {
        if(Auth::user()->level=='5'){
            $documents_retrun_inside_department = documents_retrun::join('documents_retrun_details','documents_retrun_details.docrtdt_docrt_id','documents_retruns.docrt_id')
            ->where('docrt_owner',Auth::user()->id)
            ->where('docrt_sites_id',Auth::user()->site_id)
            ->get();
            return $documents_retrun_inside_department;
        }else{
            return 0;
        }
    }


    public static function funtion_query_documents_retrun_inside_work_Controller_level_7() {
        if(Auth::user()->level=='7'){
            $documents_retrun_inside_work = documents_retrun::join('documents_retrun_details','documents_retrun_details.docrtdt_docrt_id','documents_retruns.docrt_id')
            ->where('docrt_owner',Auth::user()->id)
            ->where('docrt_sites_id',Auth::user()->site_id)
            ->get();
            return $documents_retrun_inside_work;
        }else{
            return 0;
        }
    }

    public static function funtion_query_documents_admission_inside_work_retrunController_level_7() {
        if(Auth::user()->level=='7'){
            $documents_admission_inside_work_retrun = document::join('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->join('sub2_docs','sub2_docs.sub2_subid','sub_docs.sub_id')
            ->join('sub3_docs','sub3_docs.sub3_sub_2id','sub2_docs.sub2_id')
            ->join('sub3_details','sub3_details.sub3d_sub_3id','sub3_docs.sub3_id')
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
            ->where('sub3_status', 'C')
            ->where('sub2_recid', Auth::user()->id)
            ->get();
            return $documents_admission_inside_work_retrun;
        }else{
            return 0;
        }
    }

    public static function funtion_query_documents_admission_inside_minister_sign_1_Controller_level_1() {
        if(Auth::user()->level=='1'){
            $document_admission_inside_minister_sign = document::join('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->join('sub2_docs','sub2_docs.sub2_subid','sub_docs.sub_id')
            ->join('sub3_docs','sub3_docs.sub3_sub_2id','sub2_docs.sub2_id')
            ->join('sub3_details','sub3_details.sub3d_sub_3id','sub3_docs.sub3_id')
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '1')
            ->where(function ($query) {
                $query->where('doc_template', 'B')
                      ->orWhere('doc_template', 'C')
                      ->orWhere('doc_template', 'D')
                      ->orWhere('doc_template', 'E');
            })
            ->where('doc_status', 'success')
            ->where('sub_status', '8')
            ->where('sub2_status', '1')
            ->where('sub3_sealid_2', Auth::user()->id)
            ->whereNotNull('sub3_sealdate_2')
            ->where('sub3_status', '!=', '5')
            ->get();

            return $document_admission_inside_minister_sign;
        }else{
            return 0;
        }
    }

    public static function funtion_query_documents_admission_inside_minister_sign_0_Controller_level_1() {
        if(Auth::user()->level=='1'){
            $document_admission_inside_minister_sign = document::join('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->join('sub2_docs','sub2_docs.sub2_subid','sub_docs.sub_id')
            ->join('sub3_docs','sub3_docs.sub3_sub_2id','sub2_docs.sub2_id')
            ->join('sub3_details','sub3_details.sub3d_sub_3id','sub3_docs.sub3_id')
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '1')
            ->where(function ($query) {
                $query->where('doc_template', 'B')
                      ->orWhere('doc_template', 'C')
                      ->orWhere('doc_template', 'D')
                      ->orWhere('doc_template', 'E');
            })
            ->where('doc_status', 'success')
            ->where('sub_status', '8')
            ->where('sub2_status', '1')
            ->where('sub3_sealid_2', Auth::user()->id)
            ->whereNull('sub3_sealdate_2')
            ->where('sub3_status', '5')
            ->get();

            return $document_admission_inside_minister_sign;
        }else{
            return 0;
        }
    }

    public static function funtion_query_documents_admission_inside_deputy_sign_1_Controller_level_2() {
        if(Auth::user()->level=='2'){
            $document_admission_inside_deputy_sign_0 = document::join('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->join('sub2_docs','sub2_docs.sub2_subid','sub_docs.sub_id')
            ->join('sub3_docs','sub3_docs.sub3_sub_2id','sub2_docs.sub2_id')
            ->join('sub3_details','sub3_details.sub3d_sub_3id','sub3_docs.sub3_id')
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '1')
            ->where(function ($query) {
                $query->where('doc_template', 'B')
                      ->orWhere('doc_template', 'C')
                      ->orWhere('doc_template', 'D')
                      ->orWhere('doc_template', 'E');
            })
            ->where('doc_status', 'success')
            ->where('sub_status', '8')
            ->where('sub2_status', '1')
            ->where('sub3_sealid_0', Auth::user()->id)
            ->whereNotNull('sub3_sealdate_0')
            ->where(function ($query) {
                $query->where('sub3_status', '!=', '3')
                      ->orWhere('sub3_status', '!=', '4');
            })
            ->get()->toArray();

            $document_admission_inside_deputy_sign_1 = document::join('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->join('sub2_docs','sub2_docs.sub2_subid','sub_docs.sub_id')
            ->join('sub3_docs','sub3_docs.sub3_sub_2id','sub2_docs.sub2_id')
            ->join('sub3_details','sub3_details.sub3d_sub_3id','sub3_docs.sub3_id')
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '1')
            ->where(function ($query) {
                $query->where('doc_template', 'B')
                      ->orWhere('doc_template', 'C')
                      ->orWhere('doc_template', 'D')
                      ->orWhere('doc_template', 'E');
            })
            ->where('doc_status', 'success')
            ->where('sub_status', '8')
            ->where('sub2_status', '1')
            ->where('sub3_sealid_1', Auth::user()->id)
            ->whereNotNull('sub3_sealdate_1')
            ->where(function ($query) {
                $query->where('sub3_status', '!=', '3')
                      ->orWhere('sub3_status', '!=', '4');
            })
            ->get()->toArray();

            $array_push = array_merge($document_admission_inside_deputy_sign_0,$document_admission_inside_deputy_sign_1);

            return $array_push;
        }else{
            return 0;
        }
    }

    public static function funtion_query_documents_admission_inside_deputy_sign_0_Controller_level_2() {
        if(Auth::user()->level=='2'){
            $document_admission_inside_deputy_sign_0 = document::join('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->join('sub2_docs','sub2_docs.sub2_subid','sub_docs.sub_id')
            ->join('sub3_docs','sub3_docs.sub3_sub_2id','sub2_docs.sub2_id')
            ->join('sub3_details','sub3_details.sub3d_sub_3id','sub3_docs.sub3_id')
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '1')
            ->where(function ($query) {
                $query->where('doc_template', 'B')
                      ->orWhere('doc_template', 'C')
                      ->orWhere('doc_template', 'D')
                      ->orWhere('doc_template', 'E');
            })
            ->where('doc_status', 'success')
            ->where('sub_status', '8')
            ->where('sub2_status', '1')
            ->where('sub3_sealid_0', Auth::user()->id)
            ->whereNull('sub3_sealdate_0')
            ->where(function ($query) {
                $query->where('sub3_status', '3')
                      ->orWhere('sub3_status', '4');
            })
            ->get()->toArray();

            $document_admission_inside_deputy_sign_1 = document::join('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->join('sub2_docs','sub2_docs.sub2_subid','sub_docs.sub_id')
            ->join('sub3_docs','sub3_docs.sub3_sub_2id','sub2_docs.sub2_id')
            ->join('sub3_details','sub3_details.sub3d_sub_3id','sub3_docs.sub3_id')
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '1')
            ->where(function ($query) {
                $query->where('doc_template', 'B')
                      ->orWhere('doc_template', 'C')
                      ->orWhere('doc_template', 'D')
                      ->orWhere('doc_template', 'E');
            })
            ->where('doc_status', 'success')
            ->where('sub_status', '8')
            ->where('sub2_status', '1')
            ->where('sub3_sealid_1', Auth::user()->id)
            ->whereNull('sub3_sealdate_1')
            ->where(function ($query) {
                $query->where('sub3_status', '3')
                      ->orWhere('sub3_status', '4');
            })
            ->get()->toArray();

            $array_push = array_merge($document_admission_inside_deputy_sign_0,$document_admission_inside_deputy_sign_1);

            return $array_push;
        }else{
            return 0;
        }
    }

    public static function funtion_query_documents_admission_inside_minister_sign_chart_level_1() {
        if(Auth::user()->level=='1'){
            $document_admission_inside_minister_sign_count_0 = document::join('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->join('sub2_docs','sub2_docs.sub2_subid','sub_docs.sub_id')
            ->join('sub3_docs','sub3_docs.sub3_sub_2id','sub2_docs.sub2_id')
            ->join('sub3_details','sub3_details.sub3d_sub_3id','sub3_docs.sub3_id')
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '1')
            ->where(function ($query) {
                $query->where('doc_template', 'B')
                      ->orWhere('doc_template', 'C')
                      ->orWhere('doc_template', 'D')
                      ->orWhere('doc_template', 'E');
            })
            ->where('doc_status', 'success')
            ->where('sub_status', '8')
            ->where('sub2_status', '1')
            ->where('sub3_sealid_2', Auth::user()->id)
            ->whereNull('sub3_sealdate_2')
            ->where('sub3_status', '5')
            ->count();

            $document_admission_inside_minister_sign_count_1 = document::join('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->join('sub2_docs','sub2_docs.sub2_subid','sub_docs.sub_id')
            ->join('sub3_docs','sub3_docs.sub3_sub_2id','sub2_docs.sub2_id')
            ->join('sub3_details','sub3_details.sub3d_sub_3id','sub3_docs.sub3_id')
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '1')
            ->where(function ($query) {
                $query->where('doc_template', 'B')
                      ->orWhere('doc_template', 'C')
                      ->orWhere('doc_template', 'D')
                      ->orWhere('doc_template', 'E');
            })
            ->where('doc_status', 'success')
            ->where('sub_status', '8')
            ->where('sub2_status', '1')
            ->where('sub3_sealid_2', Auth::user()->id)
            ->whereNotNull('sub3_sealdate_2')
            ->where('sub3_status', '!=', '5')
            ->count();

            return $array_count = array('เอกสารรอลงนาม' => $document_admission_inside_minister_sign_count_0,'เอกสารที่ลงนามแล้ว' => $document_admission_inside_minister_sign_count_1);
        }else{
            return 0;
        }
    }
    
    public static function funtion_query_documents_admission_inside_deputy_sign_chart_level_2() {
        if(Auth::user()->level=='2'){
            $document_admission_inside_deputy_sign_0_0 = document::join('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->join('sub2_docs','sub2_docs.sub2_subid','sub_docs.sub_id')
            ->join('sub3_docs','sub3_docs.sub3_sub_2id','sub2_docs.sub2_id')
            ->join('sub3_details','sub3_details.sub3d_sub_3id','sub3_docs.sub3_id')
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '1')
            ->where(function ($query) {
                $query->where('doc_template', 'B')
                      ->orWhere('doc_template', 'C')
                      ->orWhere('doc_template', 'D')
                      ->orWhere('doc_template', 'E');
            })
            ->where('doc_status', 'success')
            ->where('sub_status', '8')
            ->where('sub2_status', '1')
            ->where('sub3_sealid_0', Auth::user()->id)
            ->whereNull('sub3_sealdate_0')
            ->where(function ($query) {
                $query->where('sub3_status', '3')
                      ->orWhere('sub3_status', '4');
            })
            ->count();

            $document_admission_inside_deputy_sign_1_0 = document::join('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->join('sub2_docs','sub2_docs.sub2_subid','sub_docs.sub_id')
            ->join('sub3_docs','sub3_docs.sub3_sub_2id','sub2_docs.sub2_id')
            ->join('sub3_details','sub3_details.sub3d_sub_3id','sub3_docs.sub3_id')
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '1')
            ->where(function ($query) {
                $query->where('doc_template', 'B')
                      ->orWhere('doc_template', 'C')
                      ->orWhere('doc_template', 'D')
                      ->orWhere('doc_template', 'E');
            })
            ->where('doc_status', 'success')
            ->where('sub_status', '8')
            ->where('sub2_status', '1')
            ->where('sub3_sealid_1', Auth::user()->id)
            ->whereNull('sub3_sealdate_1')
            ->where(function ($query) {
                $query->where('sub3_status', '3')
                      ->orWhere('sub3_status', '4');
            })
            ->count();

            $count_0 = $document_admission_inside_deputy_sign_0_0 + $document_admission_inside_deputy_sign_1_0;

            $document_admission_inside_deputy_sign_0_1 = document::join('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->join('sub2_docs','sub2_docs.sub2_subid','sub_docs.sub_id')
            ->join('sub3_docs','sub3_docs.sub3_sub_2id','sub2_docs.sub2_id')
            ->join('sub3_details','sub3_details.sub3d_sub_3id','sub3_docs.sub3_id')
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '1')
            ->where(function ($query) {
                $query->where('doc_template', 'B')
                      ->orWhere('doc_template', 'C')
                      ->orWhere('doc_template', 'D')
                      ->orWhere('doc_template', 'E');
            })
            ->where('doc_status', 'success')
            ->where('sub_status', '8')
            ->where('sub2_status', '1')
            ->where('sub3_sealid_0', Auth::user()->id)
            ->whereNotNull('sub3_sealdate_0')
            ->where(function ($query) {
                $query->where('sub3_status', '!=', '3')
                      ->orWhere('sub3_status', '!=', '4');
            })
            ->count();

            $document_admission_inside_deputy_sign_1_1 = document::join('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->join('sub2_docs','sub2_docs.sub2_subid','sub_docs.sub_id')
            ->join('sub3_docs','sub3_docs.sub3_sub_2id','sub2_docs.sub2_id')
            ->join('sub3_details','sub3_details.sub3d_sub_3id','sub3_docs.sub3_id')
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '1')
            ->where(function ($query) {
                $query->where('doc_template', 'B')
                      ->orWhere('doc_template', 'C')
                      ->orWhere('doc_template', 'D')
                      ->orWhere('doc_template', 'E');
            })
            ->where('doc_status', 'success')
            ->where('sub_status', '8')
            ->where('sub2_status', '1')
            ->where('sub3_sealid_1', Auth::user()->id)
            ->whereNotNull('sub3_sealdate_1')
            ->where(function ($query) {
                $query->where('sub3_status', '!=', '3')
                      ->orWhere('sub3_status', '!=', '4');
            })
            ->count();

            $count_1 = $document_admission_inside_deputy_sign_0_1 + $document_admission_inside_deputy_sign_1_1;

            return $array_count = array('เอกสารรอลงนาม' => $count_0,'เอกสารที่ลงนามแล้ว' => $count_1);

        }else{
            return 0;
        }
    }

    public static function funtion_query_documents_admission_inside_deputy_sign_count_level_2() {
        if(Auth::user()->level=='2'){
            $document_admission_inside_deputy_sign_0 = document::join('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->join('sub2_docs','sub2_docs.sub2_subid','sub_docs.sub_id')
            ->join('sub3_docs','sub3_docs.sub3_sub_2id','sub2_docs.sub2_id')
            ->join('sub3_details','sub3_details.sub3d_sub_3id','sub3_docs.sub3_id')
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '1')
            ->where(function ($query) {
                $query->where('doc_template', 'B')
                      ->orWhere('doc_template', 'C')
                      ->orWhere('doc_template', 'D')
                      ->orWhere('doc_template', 'E');
            })
            ->where('doc_status', 'success')
            ->where('sub_status', '8')
            ->where('sub2_status', '1')
            ->where('sub3_sealid_0', Auth::user()->id)
            ->whereNull('sub3_sealdate_0')
            ->where(function ($query) {
                $query->where('sub3_status', '3')
                      ->orWhere('sub3_status', '4');
            })
            ->count();

            $document_admission_inside_deputy_sign_1 = document::join('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->join('sub2_docs','sub2_docs.sub2_subid','sub_docs.sub_id')
            ->join('sub3_docs','sub3_docs.sub3_sub_2id','sub2_docs.sub2_id')
            ->join('sub3_details','sub3_details.sub3d_sub_3id','sub3_docs.sub3_id')
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '1')
            ->where(function ($query) {
                $query->where('doc_template', 'B')
                      ->orWhere('doc_template', 'C')
                      ->orWhere('doc_template', 'D')
                      ->orWhere('doc_template', 'E');
            })
            ->where('doc_status', 'success')
            ->where('sub_status', '8')
            ->where('sub2_status', '1')
            ->where('sub3_sealid_1', Auth::user()->id)
            ->whereNull('sub3_sealdate_1')
            ->where(function ($query) {
                $query->where('sub3_status', '3')
                      ->orWhere('sub3_status', '4');
            })
            ->count();

            $document_retrun_inside_deputy_sign_0 = documents_retrun::join('documents_retrun_details','documents_retrun_details.docrtdt_docrt_id','documents_retruns.docrt_id')
            ->where('docrt_sealid_0', Auth::user()->id)
            ->whereNull('docrt_sealdate_0')
            ->where(function ($query) {
                $query->where('docrt_status', '3')
                      ->orWhere('docrt_status', '4');
            })
            ->count();
            $document_retrun_inside_deputy_sign_1 = documents_retrun::join('documents_retrun_details','documents_retrun_details.docrtdt_docrt_id','documents_retruns.docrt_id')
            ->where('docrt_sealid_1', Auth::user()->id)
            ->whereNull('docrt_sealdate_1')
            ->where(function ($query) {
                $query->where('docrt_status', '3')
                      ->orWhere('docrt_status', '4');
            })
            ->count();
            return $document_admission_inside_deputy_sign_0 + $document_admission_inside_deputy_sign_1 + $document_retrun_inside_deputy_sign_0 + $document_retrun_inside_deputy_sign_1;
        }else{
            return 0;
        }
    }
    
    public static function funtion_query_documents_admission_inside_minister_sign_count_level_1() {
        if(Auth::user()->level=='1'){
            $document_admission_inside_minister_sign_count = document::join('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->join('sub2_docs','sub2_docs.sub2_subid','sub_docs.sub_id')
            ->join('sub3_docs','sub3_docs.sub3_sub_2id','sub2_docs.sub2_id')
            ->join('sub3_details','sub3_details.sub3d_sub_3id','sub3_docs.sub3_id')
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '1')
            ->where(function ($query) {
                $query->where('doc_template', 'B')
                      ->orWhere('doc_template', 'C')
                      ->orWhere('doc_template', 'D')
                      ->orWhere('doc_template', 'E');
            })
            ->where('doc_status', 'success')
            ->where('sub_status', '8')
            ->where('sub2_status', '1')
            ->where('sub3_sealid_2', Auth::user()->id)
            ->whereNull('sub3_sealdate_2')
            ->where('sub3_status', '5')
            ->count();

            $document_retrun_inside_minister_sign_count = documents_retrun::join('documents_retrun_details','documents_retrun_details.docrtdt_docrt_id','documents_retruns.docrt_id')
            ->where('docrt_sealid_2', Auth::user()->id)
            ->whereNull('docrt_sealdate_2')
            ->where('docrt_status', '5')
            ->count();

            return $document_admission_inside_minister_sign_count + $document_retrun_inside_minister_sign_count;
        }else{
            return 0;
        }
    }

    public static function funtion_query_documents_admission_inside_jurisprudenceController_level_5_7() {
        if(Auth::user()->jurisprudence=='1'){
            $document_admission_inside_jurisprudence = document::join('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->join('sub2_docs','sub2_docs.sub2_subid','sub_docs.sub_id')
            ->join('sub3_docs','sub3_docs.sub3_sub_2id','sub2_docs.sub2_id')
            ->join('sub3_details','sub3_details.sub3d_sub_3id','sub3_docs.sub3_id')
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
            ->where('sub3_status', '2')
            ->get();
            return $document_admission_inside_jurisprudence;
        }else{
            return 0;
        }
    }
    
    public static function funtion_query_documents_admission_division_inside_retrunController_level_4(){
        if(Auth::user()->level=='4'){
            $document_admission_division_inside_retrun = document::join('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->join('sub2_docs','sub2_docs.sub2_subid','sub_docs.sub_id')
            ->join('sub3_docs','sub3_docs.sub3_sub_2id','sub2_docs.sub2_id')
            ->join('sub3_details','sub3_details.sub3d_sub_3id','sub3_docs.sub3_id')
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
            ->where('sub3_status', '1')
            ->where('sub3_inspector_1', Auth::user()->id)
            ->get();
            return $document_admission_division_inside_retrun;
        }else{
            return 0;
        }

    }

    public static function funtion_query_documents_admission_department_inside_retrunController_level_5(){
        if(Auth::user()->level=='5'){
            $document_admission_department_inside_retrun = document::join('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->join('sub2_docs','sub2_docs.sub2_subid','sub_docs.sub_id')
            ->join('sub3_docs','sub3_docs.sub3_sub_2id','sub2_docs.sub2_id')
            ->join('sub3_details','sub3_details.sub3d_sub_3id','sub3_docs.sub3_id')
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
            ->where('sub3_status', '0')
            ->where('sub3_inspector_0', Auth::user()->id)
            ->get();
            return $document_admission_department_inside_retrun;
        }else{
            return 0;
        }

    }

    public static function funtion_query_documents_admission_work_retrunController_level_7() {
        if(Auth::user()->level=='7'){
            $documents_admission_work_retrun = document::join('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->join('sub2_docs','sub2_docs.sub2_subid','sub_docs.sub_id')
            ->join('sub3_docs','sub3_docs.sub3_sub_2id','sub2_docs.sub2_id')
            ->join('sub3_details','sub3_details.sub3d_sub_3id','sub3_docs.sub3_id')
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '0')
            ->where('doc_template', 'A')
            ->where('doc_status', 'success')
            ->where('sub_recid', Auth::user()->group)
            ->where('sub_status', '8')
            ->where('sub2_status', '1')
            ->where('sub3_status', 'C')
            ->where('sub2_recid', Auth::user()->id)
            ->get();
            return $documents_admission_work_retrun;
        }else{
            return 0;
        }
    }

    public static function funtion_query_documents_admission_minister_sign_chart_level_1() {
        if(Auth::user()->level=='1'){
            $document_admission_minister_sign_count_0 = document::join('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->join('sub2_docs','sub2_docs.sub2_subid','sub_docs.sub_id')
            ->join('sub3_docs','sub3_docs.sub3_sub_2id','sub2_docs.sub2_id')
            ->join('sub3_details','sub3_details.sub3d_sub_3id','sub3_docs.sub3_id')
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '0')
            ->where('doc_template', 'A')
            ->where('doc_status', 'success')
            ->where('sub_status', '8')
            ->where('sub2_status', '1')
            ->where('sub3_sealid_2', Auth::user()->id)
            ->whereNull('sub3_sealdate_2')
            ->where('sub3_status', '5')
            ->count();

            $document_admission_minister_sign_count_1 = document::join('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->join('sub2_docs','sub2_docs.sub2_subid','sub_docs.sub_id')
            ->join('sub3_docs','sub3_docs.sub3_sub_2id','sub2_docs.sub2_id')
            ->join('sub3_details','sub3_details.sub3d_sub_3id','sub3_docs.sub3_id')
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '0')
            ->where('doc_template', 'A')
            ->where('doc_status', 'success')
            ->where('sub_status', '8')
            ->where('sub2_status', '1')
            ->where('sub3_sealid_2', Auth::user()->id)
            ->whereNotNull('sub3_sealdate_2')
            ->where('sub3_status', '!=', '5')
            ->count();

            return $array_count = array('เอกสารรอลงนาม' => $document_admission_minister_sign_count_0,'เอกสารที่ลงนามแล้ว' => $document_admission_minister_sign_count_1);
        }else{
            return 0;
        }
    }

    public static function funtion_query_documents_admission_minister_sign_count_level_1() {
        if(Auth::user()->level=='1'){
            $document_admission_minister_sign_count = document::join('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->join('sub2_docs','sub2_docs.sub2_subid','sub_docs.sub_id')
            ->join('sub3_docs','sub3_docs.sub3_sub_2id','sub2_docs.sub2_id')
            ->join('sub3_details','sub3_details.sub3d_sub_3id','sub3_docs.sub3_id')
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '0')
            ->where('doc_template', 'A')
            ->where('doc_status', 'success')
            ->where('sub_status', '8')
            ->where('sub2_status', '1')
            ->where('sub3_sealid_2', Auth::user()->id)
            ->whereNull('sub3_sealdate_2')
            ->where('sub3_status', '5')
            ->count();

            return $document_admission_minister_sign_count;
        }else{
            return 0;
        }
    }
    
    public static function funtion_query_documents_admission_minister_sign_1_Controller_level_1() {
        if(Auth::user()->level=='1'){
            $document_admission_minister_sign = document::join('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->join('sub2_docs','sub2_docs.sub2_subid','sub_docs.sub_id')
            ->join('sub3_docs','sub3_docs.sub3_sub_2id','sub2_docs.sub2_id')
            ->join('sub3_details','sub3_details.sub3d_sub_3id','sub3_docs.sub3_id')
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '0')
            ->where('doc_template', 'A')
            ->where('doc_status', 'success')
            ->where('sub_status', '8')
            ->where('sub2_status', '1')
            ->where('sub3_sealid_2', Auth::user()->id)
            ->whereNotNull('sub3_sealdate_2')
            ->where('sub3_status', '!=', '5')
            ->get();

            return $document_admission_minister_sign;
        }else{
            return 0;
        }
    }

    public static function funtion_query_documents_admission_minister_sign_0_Controller_level_1() {
        if(Auth::user()->level=='1'){
            $document_admission_minister_sign = document::join('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->join('sub2_docs','sub2_docs.sub2_subid','sub_docs.sub_id')
            ->join('sub3_docs','sub3_docs.sub3_sub_2id','sub2_docs.sub2_id')
            ->join('sub3_details','sub3_details.sub3d_sub_3id','sub3_docs.sub3_id')
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '0')
            ->where('doc_template', 'A')
            ->where('doc_status', 'success')
            ->where('sub_status', '8')
            ->where('sub2_status', '1')
            ->where('sub3_sealid_2', Auth::user()->id)
            ->whereNull('sub3_sealdate_2')
            ->where('sub3_status', '5')
            ->get();

            return $document_admission_minister_sign;
        }else{
            return 0;
        }
    }

    public static function funtion_query_documents_admission_deputy_sign_chart_level_2() {
        if(Auth::user()->level=='2'){
            $document_admission_deputy_sign_0_0 = document::join('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->join('sub2_docs','sub2_docs.sub2_subid','sub_docs.sub_id')
            ->join('sub3_docs','sub3_docs.sub3_sub_2id','sub2_docs.sub2_id')
            ->join('sub3_details','sub3_details.sub3d_sub_3id','sub3_docs.sub3_id')
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '0')
            ->where('doc_template', 'A')
            ->where('doc_status', 'success')
            ->where('sub_status', '8')
            ->where('sub2_status', '1')
            ->where('sub3_sealid_0', Auth::user()->id)
            ->whereNull('sub3_sealdate_0')
            ->where(function ($query) {
                $query->where('sub3_status', '3')
                      ->orWhere('sub3_status', '4');
            })
            ->count();

            $document_admission_deputy_sign_1_0 = document::join('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->join('sub2_docs','sub2_docs.sub2_subid','sub_docs.sub_id')
            ->join('sub3_docs','sub3_docs.sub3_sub_2id','sub2_docs.sub2_id')
            ->join('sub3_details','sub3_details.sub3d_sub_3id','sub3_docs.sub3_id')
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '0')
            ->where('doc_template', 'A')
            ->where('doc_status', 'success')
            ->where('sub_status', '8')
            ->where('sub2_status', '1')
            ->where('sub3_sealid_1', Auth::user()->id)
            ->whereNull('sub3_sealdate_1')
            ->where(function ($query) {
                $query->where('sub3_status', '3')
                      ->orWhere('sub3_status', '4');
            })
            ->count();

            $count_0 = $document_admission_deputy_sign_0_0 + $document_admission_deputy_sign_1_0;

            $document_admission_deputy_sign_0_1 = document::join('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->join('sub2_docs','sub2_docs.sub2_subid','sub_docs.sub_id')
            ->join('sub3_docs','sub3_docs.sub3_sub_2id','sub2_docs.sub2_id')
            ->join('sub3_details','sub3_details.sub3d_sub_3id','sub3_docs.sub3_id')
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '0')
            ->where('doc_template', 'A')
            ->where('doc_status', 'success')
            ->where('sub_status', '8')
            ->where('sub2_status', '1')
            ->where('sub3_sealid_0', Auth::user()->id)
            ->whereNotNull('sub3_sealdate_0')
            ->where(function ($query) {
                $query->where('sub3_status', '!=', '3')
                      ->orWhere('sub3_status', '!=', '4');
            })
            ->count();

            $document_admission_deputy_sign_1_1 = document::join('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->join('sub2_docs','sub2_docs.sub2_subid','sub_docs.sub_id')
            ->join('sub3_docs','sub3_docs.sub3_sub_2id','sub2_docs.sub2_id')
            ->join('sub3_details','sub3_details.sub3d_sub_3id','sub3_docs.sub3_id')
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '0')
            ->where('doc_template', 'A')
            ->where('doc_status', 'success')
            ->where('sub_status', '8')
            ->where('sub2_status', '1')
            ->where('sub3_sealid_1', Auth::user()->id)
            ->whereNotNull('sub3_sealdate_1')
            ->where(function ($query) {
                $query->where('sub3_status', '!=', '3')
                      ->orWhere('sub3_status', '!=', '4');
            })
            ->count();

            $count_1 = $document_admission_deputy_sign_0_1 + $document_admission_deputy_sign_1_1;

            return $array_count = array('เอกสารรอลงนาม' => $count_0,'เอกสารที่ลงนามแล้ว' => $count_1);

        }else{
            return 0;
        }
    }

    public static function funtion_query_documents_admission_deputy_sign_count_level_2() {
        if(Auth::user()->level=='2'){
            $document_admission_deputy_sign_0 = document::join('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->join('sub2_docs','sub2_docs.sub2_subid','sub_docs.sub_id')
            ->join('sub3_docs','sub3_docs.sub3_sub_2id','sub2_docs.sub2_id')
            ->join('sub3_details','sub3_details.sub3d_sub_3id','sub3_docs.sub3_id')
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '0')
            ->where('doc_template', 'A')
            ->where('doc_status', 'success')
            ->where('sub_status', '8')
            ->where('sub2_status', '1')
            ->where('sub3_sealid_0', Auth::user()->id)
            ->whereNull('sub3_sealdate_0')
            ->where(function ($query) {
                $query->where('sub3_status', '3')
                      ->orWhere('sub3_status', '4');
            })
            ->count();

            $document_admission_deputy_sign_1 = document::join('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->join('sub2_docs','sub2_docs.sub2_subid','sub_docs.sub_id')
            ->join('sub3_docs','sub3_docs.sub3_sub_2id','sub2_docs.sub2_id')
            ->join('sub3_details','sub3_details.sub3d_sub_3id','sub3_docs.sub3_id')
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '0')
            ->where('doc_template', 'A')
            ->where('doc_status', 'success')
            ->where('sub_status', '8')
            ->where('sub2_status', '1')
            ->where('sub3_sealid_1', Auth::user()->id)
            ->whereNull('sub3_sealdate_1')
            ->where(function ($query) {
                $query->where('sub3_status', '3')
                      ->orWhere('sub3_status', '4');
            })
            ->count();

            return $document_admission_deputy_sign_0 + $document_admission_deputy_sign_1;
        }else{
            return 0;
        }
    }

    public static function funtion_query_documents_admission_deputy_sign_1_Controller_level_2() {
        if(Auth::user()->level=='2'){
            $document_admission_deputy_sign_0 = document::join('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->join('sub2_docs','sub2_docs.sub2_subid','sub_docs.sub_id')
            ->join('sub3_docs','sub3_docs.sub3_sub_2id','sub2_docs.sub2_id')
            ->join('sub3_details','sub3_details.sub3d_sub_3id','sub3_docs.sub3_id')
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '0')
            ->where('doc_template', 'A')
            ->where('doc_status', 'success')
            ->where('sub_status', '8')
            ->where('sub2_status', '1')
            ->where('sub3_sealid_0', Auth::user()->id)
            ->whereNotNull('sub3_sealdate_0')
            ->where(function ($query) {
                $query->where('sub3_status', '!=', '3')
                      ->orWhere('sub3_status', '!=', '4');
            })
            ->get()->toArray();

            $document_admission_deputy_sign_1 = document::join('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->join('sub2_docs','sub2_docs.sub2_subid','sub_docs.sub_id')
            ->join('sub3_docs','sub3_docs.sub3_sub_2id','sub2_docs.sub2_id')
            ->join('sub3_details','sub3_details.sub3d_sub_3id','sub3_docs.sub3_id')
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '0')
            ->where('doc_template', 'A')
            ->where('doc_status', 'success')
            ->where('sub_status', '8')
            ->where('sub2_status', '1')
            ->where('sub3_sealid_1', Auth::user()->id)
            ->whereNotNull('sub3_sealdate_1')
            ->where(function ($query) {
                $query->where('sub3_status', '!=', '3')
                      ->orWhere('sub3_status', '!=', '4');
            })
            ->get()->toArray();

            $array_push = array_merge($document_admission_deputy_sign_0,$document_admission_deputy_sign_1);

            return $array_push;
        }else{
            return 0;
        }
    }

    public static function funtion_query_documents_admission_deputy_sign_0_Controller_level_2() {
        if(Auth::user()->level=='2'){
            $document_admission_deputy_sign_0 = document::join('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->join('sub2_docs','sub2_docs.sub2_subid','sub_docs.sub_id')
            ->join('sub3_docs','sub3_docs.sub3_sub_2id','sub2_docs.sub2_id')
            ->join('sub3_details','sub3_details.sub3d_sub_3id','sub3_docs.sub3_id')
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '0')
            ->where('doc_template', 'A')
            ->where('doc_status', 'success')
            ->where('sub_status', '8')
            ->where('sub2_status', '1')
            ->where('sub3_sealid_0', Auth::user()->id)
            ->whereNull('sub3_sealdate_0')
            ->where(function ($query) {
                $query->where('sub3_status', '3')
                      ->orWhere('sub3_status', '4');
            })
            ->get()->toArray();

            $document_admission_deputy_sign_1 = document::join('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->join('sub2_docs','sub2_docs.sub2_subid','sub_docs.sub_id')
            ->join('sub3_docs','sub3_docs.sub3_sub_2id','sub2_docs.sub2_id')
            ->join('sub3_details','sub3_details.sub3d_sub_3id','sub3_docs.sub3_id')
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '0')
            ->where('doc_template', 'A')
            ->where('doc_status', 'success')
            ->where('sub_status', '8')
            ->where('sub2_status', '1')
            ->where('sub3_sealid_1', Auth::user()->id)
            ->whereNull('sub3_sealdate_1')
            ->where(function ($query) {
                $query->where('sub3_status', '3')
                      ->orWhere('sub3_status', '4');
            })
            ->get()->toArray();

            $array_push = array_merge($document_admission_deputy_sign_0,$document_admission_deputy_sign_1);

            return $array_push;
        }else{
            return 0;
        }
    }

    public static function funtion_query_documents_admission_jurisprudence() {
        if(Auth::user()->jurisprudence=='1'){
            $document_admission_jurisprudence_count = document::join('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->join('sub2_docs','sub2_docs.sub2_subid','sub_docs.sub_id')
            ->join('sub3_docs','sub3_docs.sub3_sub_2id','sub2_docs.sub2_id')
            ->join('sub3_details','sub3_details.sub3d_sub_3id','sub3_docs.sub3_id')
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '0')
            ->where('doc_template', 'A')
            ->where('doc_status', 'success')
            ->where('sub_recid', Auth::user()->group)
            ->where('sub_status', '8')
            ->where('sub2_status', '1')
            ->where('sub3_status', '2')
            ->count();

            $document_admission_inside_jurisprudence_count = document::join('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->join('sub2_docs','sub2_docs.sub2_subid','sub_docs.sub_id')
            ->join('sub3_docs','sub3_docs.sub3_sub_2id','sub2_docs.sub2_id')
            ->join('sub3_details','sub3_details.sub3d_sub_3id','sub3_docs.sub3_id')
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
            ->where('sub3_status', '2')
            ->count();

            $documents_retrun_inside_jurisprudence = documents_retrun::join('documents_retrun_details','documents_retrun_details.docrtdt_docrt_id','documents_retruns.docrt_id')
            ->where('docrt_sites_id',Auth::user()->site_id)
            ->where('docrt_status', '2')
            ->count();

            return $document_admission_jurisprudence_count+$document_admission_inside_jurisprudence_count+$documents_retrun_inside_jurisprudence;
        }else{
            return 0;
        }
    }

    public static function funtion_query_documents_admission_jurisprudenceController_level_5_7() {
        if(Auth::user()->jurisprudence=='1'){
            $document_admission_jurisprudence = document::join('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->join('sub2_docs','sub2_docs.sub2_subid','sub_docs.sub_id')
            ->join('sub3_docs','sub3_docs.sub3_sub_2id','sub2_docs.sub2_id')
            ->join('sub3_details','sub3_details.sub3d_sub_3id','sub3_docs.sub3_id')
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '0')
            ->where('doc_template', 'A')
            ->where('doc_status', 'success')
            ->where('sub_recid', Auth::user()->group)
            ->where('sub_status', '8')
            ->where('sub2_status', '1')
            ->where('sub3_status', '2')
            ->get();
            return $document_admission_jurisprudence;
        }else{
            return 0;
        }
    }

    public static function funtion_query_member_dashboard_chart_inside_level_7() {
        if(Auth::user()->level=='7'){
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
           return $array_count = array('เอกสารรับเข้ายังไม่อ่าน' => $document_admission_all_work_inside_count_0,'เอกสารรับเข้าอ่านแล้ว' => $document_admission_all_work_inside_count_1);

        }else{
            return 0;
        }
    }

    public static function funtion_query_member_dashboard_chart_level_7() {
        if(Auth::user()->level=='7'){
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
           return $array_count = array('เอกสารรับเข้ายังไม่อ่าน' => $document_admission_all_work_count_0,'เอกสารรับเข้าอ่านแล้ว' => $document_admission_all_work_count_1);

        }else{
            return 0;
        }
    }

    public static function funtion_query_member_dashboard_chart_inside_level_6() {
        if(Auth::user()->level=='6'){
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
             return $array_count = array('เอกสารใหม่' => $document_admission_all_group_inside_count_0,'เอกสารรอดำเนินการ' => $document_admission_all_group_inside_count_1,'เอกสารดำเนินการแล้ว' => $document_admission_all_group_inside_count_2);

        }else{
            return 0;
        }
    }

    public static function funtion_query_member_dashboard_chart_level_6() {
        if(Auth::user()->level=='6'){
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
             return $array_count = array('เอกสารใหม่' => $document_admission_all_group_count_0,'เอกสารรอดำเนินการ' => $document_admission_all_group_count_1,'เอกสารดำเนินการแล้ว' => $document_admission_all_group_count_2);

        }else{
            return 0;
        }
    }

    public static function funtion_query_member_dashboard_chart_inside_level_5() {
        if(Auth::user()->level=='5'){
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
            return $array_count = array('เอกสารรอพิจารณา' => $document_admission_department_inside_all_count_0,'เอกสารที่เซ็นแล้ว' => $document_admission_department_inside_all_count_1);

        }else{
            return 0;
        }
    }
    public static function funtion_query_member_dashboard_chart_level_5() {
        if(Auth::user()->level=='5'){
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
            return $array_count = array('เอกสารรอพิจารณา' => $document_admission_department_all_count_0,'เอกสารที่เซ็นแล้ว' => $document_admission_department_all_count_1);

        }else{
            return 0;
        }
    }
    public static function funtion_query_member_dashboard_chart_inside_level_4() {
        if(Auth::user()->level=='4'){
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
            return $array_count = array('เอกสารรอพิจารณา' => $documents_admission_division_inside_all_count_0,'เอกสารที่เซ็นแล้ว' => $documents_admission_division_inside_all_count_1);
        }else{
            return 0;
        }
    }

    public static function funtion_query_member_dashboard_chart_level_4() {
        if(Auth::user()->level=='4'){
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
            return $array_count = array('เอกสารรอพิจารณา' => $documents_admission_division_all_count_0,'เอกสารที่เซ็นแล้ว' => $documents_admission_division_all_count_1);
        }else{
            return 0;
        }

    }

    public static function funtion_query_member_dashboard_chart_level_3() {
        if(Auth::user()->level=='3'){
 
            $document_admission_all_waiting_count = document::where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '0')
            ->where('doc_template', 'A')
            ->where('doc_status', 'waiting')
            ->count();
            $document_admission_all_success_count = document::where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '0')
            ->where('doc_template', 'A')
            ->where('doc_status', 'success')
            ->count();
            return $array_count = array('เอกสารรอพิจารณา' => $document_admission_all_waiting_count,'เอกสารพิจารณาแล้ว' => $document_admission_all_success_count);
             
        }else{
            return 0;
        }
    }
    
    public static function funtion_query_dashboard_count_sub2_docs_level_0() {
        if(Auth::user()->level=='0'){
            $document_detail = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->leftJoin('sub2_docs','sub2_docs.sub2_subid','sub_docs.sub_id')
            ->selectRaw('count(sub2_id) as sub2_id, doc_date')
            ->groupBy('doc_date')
            ->get();
            return $document_detail;
        }else{
            return 0;
        }
    }
    public static function funtion_query_dashboard_count_sites_level_0() {
        if(Auth::user()->level=='0'){
            //นับจำนวน sites
            $sitesrS = sites::count();
            return $sitesrS;
        }else{
            return 0;
        }
    }
    public static function funtion_query_dashboard_count_groupmem_level_0() {
        if(Auth::user()->level=='0'){
            //นับจำนวน กลุ่ม
            $GroupmemS = Groupmem::count();
            return $GroupmemS;
        }else{
            return 0;
        }
    }
    public static function funtion_query_dashboard_count_cottons_level_0() {
        if(Auth::user()->level=='0'){
            //นับจำนวน ฝ่าย
            $cottonS = cottons::count();
            return $cottonS;
        }else{
            return 0;
        }
    }
    public static function funtion_query_dashboard_count_member_level_0() {
        if(Auth::user()->level=='0'){
            //นับจำนวนคน
            $memberS = User::where('users.level', '!=' , '0')->count();
            return $memberS;
        }else{
            return 0;
        }
    }
    public static function funtion_query_nav_document_admission_division_all_count_0_level_4() {
        if(Auth::user()->level=='4'){
            //นับจำนวนงานรอพิจารณาภายนอก
            $document_waiting_count = document::where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '0')
            ->where('doc_template', 'A')
            ->where('doc_status', 'waiting')
            ->count();
            $document_admission_division_all_count_0 = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '0')
            ->where('doc_template', 'A')
            ->where('doc_status', 'success')
            ->where('sub_recid', Auth::user()->group)
            ->where('sub_status', '2')
            ->where('seal_id_1', Auth::user()->id)
            ->count();
            $level4_count_0_level_4 = $document_admission_division_all_count_0+$document_waiting_count;
            return $level4_count_0_level_4;
            
        }else{
            return 0;
        }
    }
    
    public static function funtion_query_nav_document_admission_division_inside_all_count_0_level_4() {
        if(Auth::user()->level=='4'){
            //นับจำนวนงานรอพิจารณา
            $document_admission_division_inside_all_count_0 = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
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
            return $document_admission_division_inside_all_count_0;
        }else{
            return 0;
        }
    }

    public static function funtion_query_nav_document_admission_department_inside_all_count_0_level_5() {
        if(Auth::user()->level=='5'){
            //นับจำนวนงานพิจารณาแล้ว
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
            return $document_admission_department_inside_all_count_0;
        }else{
            return 0;
        }
    }
    public static function funtion_query_nav_document_admission_department_all_count_0_level_5() {
        if(Auth::user()->level=='5'){
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
            return $document_admission_department_all_count_0;
        }else{
            return 0;
        }
    }
    
    public static function funtion_query_nav_document_admission_all_group_count_0_level_6() {
        if(Auth::user()->level=='6'){
            //นับจำนวนงานภายนอกใหม่
            $document_admission_all_group_count_0 = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '0')
            ->where('doc_template', 'A')
            ->where('doc_status', 'success')
            ->where('sub_recid', Auth::user()->group)
            ->where('sub_status', '0')
            ->count();
            return $document_admission_all_group_count_0;
        }else{
            return 0;
        }
    }

    public static function funtion_query_nav_document_admission_all_group_inside_count_0_level_6() {
        if(Auth::user()->level=='6'){
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
            return $document_admission_all_group_inside_count_0;
        }else{
            return 0;
        }
    }

    public static function funtion_query_nav_document_admission_all_work_count_0_level_7() {
        if(Auth::user()->level=='7'){
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
             return $document_admission_all_work_count_0;
        }else{
            return 0;
        }
    }

    public static function funtion_query_nav_document_admission_all_work_inside_count_0_level_7() {
        if(Auth::user()->level=='7'){
            //นักจำนวนงานยังไม่อ่าน
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
            return $document_admission_all_work_inside_count_0;
        }else{
            return 0;
        }
      
    }

    public static function funtion_query_documents_admission_allController_level_3(){
        if(Auth::user()->level=='3'){
            $documents = document::where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '0')
            ->where('doc_template', 'A')
            ->orderby('doc_date','DESC')
            ->get();

            return $documents;
        }else{
            return 0;
        }

    }

    public static function funtion_query_documents_pendingController_level_4(){
        if(Auth::user()->level=='4'){
            $documents = document::where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '0')
            ->where('doc_template', 'A')
            ->where('doc_status', 'waiting')
            ->orderby('doc_date','DESC')
            ->get();

            return $documents;
        }else{
            return 0;
        }

    }

    public static function funtion_query_documents_admission_division_all_0_Controller_level_4(){
        if(Auth::user()->level=='4'){
            $document_admission_division_all = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '0')
            ->where('doc_template', 'A')
            ->where('doc_status', 'success')
            ->where('sub_recid', Auth::user()->group)
            ->where('sub_status', '2')
            ->where('seal_id_1', Auth::user()->id)
            ->orderby('doc_date','DESC')
            ->get();

            return $document_admission_division_all;
        }else{
            return 0;
        }

    }

    public static function funtion_query_documents_admission_division_all_1_Controller_level_4(){
        if(Auth::user()->level=='4'){
            $document_admission_division_all = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '0')
            ->where('doc_template', 'A')
            ->where('doc_status', 'success')
            ->where('sub_recid', Auth::user()->group)
            ->where('sub_status', '!=','2')
            ->where('seal_id_1', Auth::user()->id)
            ->where('seal_date_1', '!=', NULL)
            ->orderby('doc_date','DESC')
            ->get();

            return $document_admission_division_all;
        }else{
            return 0;
        }

    }

    public static function funtion_query_documents_admission_division_retrunController_level_4(){
        if(Auth::user()->level=='4'){
            $document_admission_division_retrun = document::join('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->join('sub2_docs','sub2_docs.sub2_subid','sub_docs.sub_id')
            ->join('sub3_docs','sub3_docs.sub3_sub_2id','sub2_docs.sub2_id')
            ->join('sub3_details','sub3_details.sub3d_sub_3id','sub3_docs.sub3_id')
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '0')
            ->where('doc_template', 'A')
            ->where('doc_status', 'success')
            ->where('sub_recid', Auth::user()->group)
            ->where('sub_status', '8')
            ->where('sub2_status', '1')
            ->where('sub3_status', '1')
            ->where('sub3_inspector_1', Auth::user()->id)
            ->orderby('doc_date','DESC')
            ->get();

            return $document_admission_division_retrun;
        }else{
            return 0;
        }

    }

    public static function funtion_query_documents_admission_division_inside_all_0_Controller_level_4(){
        if(Auth::user()->level=='4'){
            $document_admission_division_inside_all = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
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
            ->orderby('doc_date','DESC')
            ->get();

            return $document_admission_division_inside_all;
        }else{
            return 0;
        }

    }

    public static function funtion_query_documents_admission_division_inside_all_1_Controller_level_4(){
        if(Auth::user()->level=='4'){
            $document_admission_division_inside_all = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
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
            ->orderby('doc_date','DESC')
            ->get();

            return $document_admission_division_inside_all;
        }else{
            return 0;
        }

    }

    public static function funtion_query_documents_admission_department_all_0_Controller_level_5(){
        if(Auth::user()->level=='5'){
            $document_admission_department_all = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '0')
            ->where('doc_template', 'A')
            ->where('doc_status', 'success')
            ->where('sub_recid', Auth::user()->group)
            ->where('sub_status', '1')
            ->where('seal_id_0', Auth::user()->id)
            ->orderby('doc_date','DESC')
            ->get();
            return $document_admission_department_all;
        }else{
            return 0;
        }

    }

    public static function funtion_query_documents_admission_department_all_1_Controller_level_5(){
        if(Auth::user()->level=='5'){
            $document_admission_department_all = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '0')
            ->where('doc_template', 'A')
            ->where('doc_status', 'success')
            ->where('sub_recid', Auth::user()->group)
            ->where('sub_status', '!=','1')
            ->where('seal_id_0', Auth::user()->id)
            ->where('seal_date_0', '!=', NULL)
            ->orderby('doc_date','DESC')
            ->get();
            return $document_admission_department_all;
        }else{
            return 0;
        }

    }

    public static function funtion_query_documents_admission_department_retrunController_level_5(){
        if(Auth::user()->level=='5'){
            $document_admission_department_retrun = document::join('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->join('sub2_docs','sub2_docs.sub2_subid','sub_docs.sub_id')
            ->join('sub3_docs','sub3_docs.sub3_sub_2id','sub2_docs.sub2_id')
            ->join('sub3_details','sub3_details.sub3d_sub_3id','sub3_docs.sub3_id')
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '0')
            ->where('doc_template', 'A')
            ->where('doc_status', 'success')
            ->where('sub_recid', Auth::user()->group)
            ->where('sub_status', '8')
            ->where('sub2_status', '1')
            ->where('sub3_status', '0')
            ->where('sub3_inspector_0', Auth::user()->id)
            ->orderby('doc_date','DESC')
            ->get();
            return $document_admission_department_retrun;
        }else{
            return 0;
        }

    }

    public static function funtion_query_documents_admission_department_inside_all_0_Controller_level_5(){
        if(Auth::user()->level=='5'){
            $document_admission_department_inside_all = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
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
            ->orderby('doc_date','DESC')
            ->get();
            return $document_admission_department_inside_all;
        }else{
            return 0;
        }

    }

    public static function funtion_query_documents_admission_department_inside_all_1_Controller_level_5(){
        if(Auth::user()->level=='5'){
            $document_admission_department_inside_all = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
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
            ->orderby('doc_date','DESC')
            ->get();
            return $document_admission_department_inside_all;
        }else{
            return 0;
        }

    }

    public static function funtion_query_documents_admission_group_0_Controller_level_6(){
        if(Auth::user()->level=='6'){
            $document_admission_all_group = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '0')
            ->where('doc_template', 'A')
            ->where('doc_status', 'success')
            ->where('sub_recid', Auth::user()->group)
            ->where('sub_status', '0')
            ->orderby('doc_date','DESC')
            ->get();
            return $document_admission_all_group;
        }else{
            return 0;
        }

    }

    public static function funtion_query_documents_admission_group_1_Controller_level_6(){
        if(Auth::user()->level=='6'){
            $document_admission_all_group = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '0')
            ->where('doc_template', 'A')
            ->where('doc_status', 'success')
            ->where('sub_recid', Auth::user()->group)
            ->where('sub_status','!=','0')
            ->where('sub_status','!=','8')
            ->orderby('doc_date','DESC')
            ->get();
            return $document_admission_all_group;
        }else{
            return 0;
        }

    }

    public static function funtion_query_documents_admission_group_2_Controller_level_6(){
        if(Auth::user()->level=='6'){
            $document_admission_all_group = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '0')
            ->where('doc_template', 'A')
            ->where('doc_status', 'success')
            ->where('sub_recid', Auth::user()->group)
            ->where('sub_status', '8')
            ->orderby('doc_date','DESC')
            ->get();
            return $document_admission_all_group;
        }else{
            return 0;
        }

    }

    public static function funtion_query_documents_admission_group_inside_0_Controller_level_6(){
        if(Auth::user()->level=='6'){
            $document_admission_all_group_inside = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
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
            ->orderby('doc_date','DESC')
            ->get();
            return $document_admission_all_group_inside;
        }else{
            return 0;
        }

    }

    public static function funtion_query_documents_admission_group_inside_1_Controller_level_6(){
        if(Auth::user()->level=='6'){
            $document_admission_all_group_inside = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
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
            ->orderby('doc_date','DESC')
            ->get();
            return $document_admission_all_group_inside;
        }else{
            return 0;
        }

    }
    public static function funtion_query_documents_admission_group_inside_2_Controller_level_6(){
        if(Auth::user()->level=='6'){
            $document_admission_all_group_inside = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
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
            ->orderby('doc_date','DESC')
            ->get();
            return $document_admission_all_group_inside;
        }else{
            return 0;
        }

    }

    public static function funtion_query_documents_admission_work_all_0_Controller_level_7(){
        if(Auth::user()->level=='7'){
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
            ->orderby('doc_date','DESC')
            ->get();
            return $document_admission_all_work;
        }else{
            return 0;
        }

    }

    public static function funtion_query_documents_admission_work_all_1_Controller_level_7(){
        if(Auth::user()->level=='7'){
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
            ->orderby('doc_date','DESC')
            ->get();
            return $document_admission_all_work;
        }else{
            return 0;
        }

    }

    public static function funtion_query_documents_admission_work_inside_all_0_Controller_level_7(){
        if(Auth::user()->level=='7'){
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
            ->orderby('doc_date','DESC')
            ->get();
            return $document_admission_all_work_inside;
        }else{
            return 0;
        }

    }

    public static function funtion_query_documents_admission_work_inside_all_1_Controller_level_7(){
        if(Auth::user()->level=='7'){
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
            ->orderby('doc_date','DESC')
            ->get();
            return $document_admission_all_work_inside;
        }else{
            return 0;
        }

    }

    public static function funtion_query_documents_admission_all_insideController_level_6(){
        if(Auth::user()->level=='6'){
            $documents = document::where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type','!=', '0')
            ->where('doc_template','!=', 'A')
            ->orderby('doc_date','DESC')
            ->get();
            return $documents;
        }else{
            return 0;
        }

    }


    

    

    
}
