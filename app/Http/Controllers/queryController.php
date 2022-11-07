<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\document;
use App\Models\reserve_number;
use App\Models\sub_doc;
use DataTables;

class queryController extends Controller
{
    //
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
            ->ORDERBY('doc_date' ,'DESC')
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
            ->ORDERBY('doc_date' ,'DESC')
            ->ORDERBY('doc_recnum' ,'DESC')
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
            ->ORDERBY('doc_date' ,'DESC')
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
