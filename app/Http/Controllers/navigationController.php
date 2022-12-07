<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\reserve_number;
use App\Models\sub_doc;
use App\Models\document;
use App\Models\sub2_doc;
use App\Models\sub3_doc;
use App\Models\sub3_detail;
use App\Models\Groupmem;
use App\Models\User;
use App\Models\documents_retrun;
use App\Models\documents_retrun_detail;

class navigationController extends Controller
{
    public static function funtion_documents_retrun_inside_department_sign_count_level_5() {
        if(Auth::user()->level=='5'){
            $documents_retrun_inside_department_sign_count = documents_retrun::join('Documents_retrun_details','Documents_retrun_details.docrtdt_docrt_id','Documents_retruns.docrt_id')
            ->where('docrt_sites_id',Auth::user()->site_id)
            ->where('docrt_status', '0')
            ->where('docrt_inspector_0', Auth::user()->id)
            ->count();
            return $documents_retrun_inside_department_sign_count;
                     
        }else{
            return 0;
        }
    }

    public static function funtion_documents_retrun_inside_department_count_level_5() {
        if(Auth::user()->level=='5'){
            $documents_retrun_inside_department_count = documents_retrun::join('Documents_retrun_details','Documents_retrun_details.docrtdt_docrt_id','Documents_retruns.docrt_id')
            ->where('docrt_owner',Auth::user()->id)
            ->where('docrt_sites_id',Auth::user()->site_id)
            ->count();
            return $documents_retrun_inside_department_count;
        }else{
            return 0;
        }
    }

    public static function funtion_documents_retrun_inside_work_count_level_7() {
        if(Auth::user()->level=='7'){
            $documents_retrun_inside_work_count = documents_retrun::join('Documents_retrun_details','Documents_retrun_details.docrtdt_docrt_id','Documents_retruns.docrt_id')
            ->where('docrt_owner',Auth::user()->id)
            ->where('docrt_sites_id',Auth::user()->site_id)
            ->count();
            return $documents_retrun_inside_work_count;
        }else{
            return 0;
        }
    }

    public static function funtion_documents_admission_inside_work_retrun_all_count_1_level_7() {
        if(Auth::user()->level=='7'){
            $documents_admission_inside_work_retrun_count = document::join('sub_docs','sub_docs.sub_docid','documents.doc_id')
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
            ->count();
            return $documents_admission_inside_work_retrun_count;
        }else{
            return 0;
        }
    }

    public static function funtion_documents_admission_inside_deputy_sign_count_1_level_2() {
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
            ->whereNotNull('sub3_sealdate_1')
            ->where(function ($query) {
                $query->where('sub3_status', '!=', '3')
                      ->orWhere('sub3_status', '!=', '4');
            })
            ->count();

            return $document_admission_inside_deputy_sign_0 + $document_admission_inside_deputy_sign_1;
        }else{
            return 0;
        }
    }

    public static function funtion_documents_admission_inside_deputy_sign_count_0_level_2() {
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

            return $document_admission_inside_deputy_sign_0 + $document_admission_inside_deputy_sign_1;
        }else{
            return 0;
        }
    }

    public static function funtion_documents_admission_inside_minister_sign_count_1_level_1() {
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
            ->whereNotNull('sub3_sealdate_2')
            ->where('sub3_status', '!=', '5')
            ->count();

            return $document_admission_inside_minister_sign_count;
        }else{
            return 0;
        }
    }
    public static function funtion_documents_admission_inside_minister_sign_count_0_level_1() {
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

            return $document_admission_inside_minister_sign_count;
        }else{
            return 0;
        }
    }

    public static function funtion_document_documents_admission_inside_jurisprudence_all_count(){
        if(Auth::user()->jurisprudence=='1'){
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
            return $document_admission_inside_jurisprudence_count;
        }else{
            return 0;
        }

    }

    public static function funtion_document_admission_division_inside_retrun_count_level_4() {
        if(Auth::user()->level=='4'){
            $documents_admission_division_retrun_count =document::join('sub_docs','sub_docs.sub_docid','documents.doc_id')
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
            ->count();
            return $documents_admission_division_retrun_count;

        }else{
            return 0;
        }
    }

    public static function funtion_document_admission_department_inside_retrun_count_level_5() {
        if(Auth::user()->level=='5'){
            $documents_admission_department_retrun_count = document::join('sub_docs','sub_docs.sub_docid','documents.doc_id')
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
            ->count();
            return $documents_admission_department_retrun_count;
        }else{
            return 0;
        }
    }

    public static function funtion_documents_admission_work_retrun_all_count_1_level_7() {
        if(Auth::user()->level=='7'){
            $documents_admission_work_retrun_count = document::join('sub_docs','sub_docs.sub_docid','documents.doc_id')
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
            ->count();
            return $documents_admission_work_retrun_count;
        }else{
            return 0;
        }
    }

    public static function funtion_documents_admission_minister_sign_count_1_level_1() {
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
            ->whereNotNull('sub3_sealdate_2')
            ->where('sub3_status', '!=', '5')
            ->count();

            return $document_admission_minister_sign_count;
        }else{
            return 0;
        }
    }
    public static function funtion_documents_admission_minister_sign_count_0_level_1() {
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
    public static function funtion_documents_admission_deputy_sign_count_1_level_2() {
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
            ->whereNotNull('sub3_sealdate_1')
            ->where(function ($query) {
                $query->where('sub3_status', '!=', '3')
                      ->orWhere('sub3_status', '!=', '4');
            })
            ->count();

            return $document_admission_deputy_sign_0 + $document_admission_deputy_sign_1;
        }else{
            return 0;
        }
    }

    public static function funtion_documents_admission_deputy_sign_count_0_level_2() {
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

    public static function funtion_document_documents_admission_jurisprudence_all_count() {
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
            return $document_admission_jurisprudence_count;
        }else{
            return 0;
        }
    }

    //------------------------------------------------------------------------------------------------------------------miw
     //หน้ากลัก
    public static function funtion_reserved_numbersS_level_3($id){
        if($id == '3'){
            //หาตัวเลขที่จองไว้
            $reserved_numbersS = reserve_number::where('reserve_site',Auth::user()->site_id)
            ->where('reserve_owner',Auth::user()->id)
            ->where('reserve_type', '0')
            ->where('reserve_template', 'A')
            ->where('reserve_status', '0')
            ->get();

            return $reserved_numbersS;
        }else{
            return 0;
        }
    }

    public static function funtion_dropped_numbersS_level_3($id){
        if($id == '3'){
            //หาตัวเลขที่หลุดจอง
            $dropped_numbersS = reserve_number::where('reserve_site',Auth::user()->site_id)
            ->where('reserve_type', '0')
            ->where('reserve_template', 'A')
            ->where('reserve_status', '2')
            ->get();

            return $dropped_numbersS;
        }else{
            return 0;
        }
    }

    public static function funtion_GroupmemS_level_6($id){
        if($id == '6'){
            //หาชื่อและไอดี กอง miw
            $GroupmemS = Groupmem::where('group_site_id',Auth::user()->site_id)
            ->where('group_id','!=',Auth::user()->group)
            ->get();

            return $GroupmemS;
        }else{
            return 0;
        }
    }

    public static function funtion_UserS_level_6($id){
        if($id == '6'){
             //หาชื่อและไอดี พนักงาน miw
             $UserS = User::where('group',Auth::user()->group)
             ->get();

             return $UserS;
        }else{
            return 0;
        }
    }
    

    //*************************************************************************************************************************** */
    public static function funtion_document_admission_all_work_inside_count_1_level_7($id) {
        if($id == '7'){
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
            ->where('sub2_status', '1')
            ->where('sub2_recid', Auth::user()->id)
            ->count();
            return $document_admission_all_work_inside_count_0;
        }else{
            return 0;
        }
    }

    public static function funtion_document_admission_all_work_inside_count_0_level_7($id) {
        if($id == '7'){
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

    public static function funtion_document_admission_department_inside_all_count_1_level_5($id) {
        if($id == '5'){
             //นับจำนวนงานพิจารณาแล้ว
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
             return $document_admission_department_inside_all_count_1;
        }else{
            return 0;
        }
    }

    public static function funtion_document_admission_department_inside_all_count_0_level_5($id) {
        if($id == '5'){
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

    public static function funtion_document_admission_division_inside_all_count_1_level_4($id) {
        if($id == '4'){
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
            ->where('sub_status', '!=','2')
            ->where('seal_id_1', Auth::user()->id)
            ->where('seal_date_1', '!=', NULL)
            ->count();
            return $document_admission_division_inside_all_count_0;
        }else{
            return 0;
        }
    }

    public static function funtion_document_admission_division_inside_all_count_0_level_4($id) {
        if($id == '4'){
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

    public static function funtion_document_admission_all_group_inside_count_2_level_6($id) {
        if($id == '6'){
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
            ->where('sub_status', '8')
            ->count();
            return $document_admission_all_group_inside_count_0;
        }else{
            return 0;
        }
    }

    public static function funtion_document_admission_all_group_inside_count_1_level_6($id) {
        if($id == '6'){
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
            ->where('sub_status','!=','0')
            ->where('sub_status','!=','8')
            ->count();
            return $document_admission_all_group_inside_count_0;
        }else{
            return 0;
        }
    }

    public static function funtion_document_admission_all_group_inside_count_0_level_6($id) {
        if($id == '6'){
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
    public static function funtion_document_admission_division_retrun_count_level_4($id) {
        if($id == '4'){
            $document_admission_division_retrun_count = document::join('sub_docs','sub_docs.sub_docid','documents.doc_id')
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
            ->count();
            return $document_admission_division_retrun_count;
        }else{
            return 0;
        }
    }

    public static function funtion_document_admission_department_retrun_count_level_5($id) {
        if($id == '5'){
            $document_admission_department_retrun_count = document::join('sub_docs','sub_docs.sub_docid','documents.doc_id')
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
            ->count();
            return $document_admission_department_retrun_count;
        }else{
            return 0;
        }
    }

    public static function funtion_document_admission_all_count_level_3($id) {
        //นับจำนวนงานรับเข้าทั้งหมดภายนอก
        if($id == '3'){
            $document_admission_all_count = document::where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '0')
            ->where('doc_template', 'A')
            ->count();
            return $document_admission_all_count;
        }else{
            return 0;
        }
    }

    public static function funtion_Groupmem_check_group_name_level_4($id) {
        if($id == '4'){
            $Groupmem = Groupmem::where('group_site_id',Auth::user()->site_id)
            ->where('group_id',Auth::user()->group)
            ->first();
            return $Groupmem->group_name;
        }else{
            return 0;
        }
    }

    public static function funtion_document_waiting_count_level_4($id) {
        if($id == '4'){
            //นับจำนวนงานรอพิจารณาภายนอก
            $document_waiting_count = document::where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '0')
            ->where('doc_template', 'A')
            ->where('doc_status', 'waiting')
            ->count();
            return $document_waiting_count;
        }else{
            return 0;
        }
    }

    public static function funtion_document_waiting_level4_count_0_level_4($id) {
        if($id == '4'){
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
    public static function funtion_document_admission_division_all_count_0_level_4($id) {
        if($id == '4'){
            //นับจำนวนงานรอพิจารณา
            $document_admission_division_all_count_0 = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '0')
            ->where('doc_template', 'A')
            ->where('doc_status', 'success')
            ->where('sub_recid', Auth::user()->group)
            ->where('sub_status', '2')
            ->where('seal_id_1', Auth::user()->id)
            ->count();
            return $document_admission_division_all_count_0;
        }else{
            return 0;
        }
    }

    public static function funtion_document_admission_division_all_count_1_level_4($id) {
        if($id == '4'){
            //นับจำนวนงานพิจารณาแล้ว
            $document_admission_division_all_count_1 = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '0')
            ->where('doc_template', 'A')
            ->where('doc_status', 'success')
            ->where('sub_recid', Auth::user()->group)
            ->where('sub_status', '!=','2')
            ->where('seal_id_1', Auth::user()->id)
            ->where('seal_date_1', '!=', NULL)
            ->count();
            return $document_admission_division_all_count_1;
        }else{
            return 0;
        }
    }

    public static function funtion_document_admission_department_all_count_0_level_5($id) {
        if($id == '5'){
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
    public static function funtion_document_admission_department_all_count_1_level_5($id) {
        if($id == '5'){
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
             return $document_admission_department_all_count_1;
        }else{
            return 0;
        }
    }

    public static function funtion_document_admission_all_group_count_0_level_6($id) {
        if($id == '6'){
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

    public static function funtion_document_admission_all_group_count_1_level_6($id) {
        if($id == '6'){
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
            return $document_admission_all_group_count_1;
        }else{
            return 0;
        }
    }

    public static function funtion_document_admission_all_group_count_2_level_6($id) {
        if($id == '6'){
            //นับจำนวนงานภายนอกดำเนินการแล้ว
            $document_admission_all_group_count_2 = document::leftJoin('sub_docs','sub_docs.sub_docid','documents.doc_id')
            ->where('doc_site_id',Auth::user()->site_id)
            ->where('doc_type', '0')
            ->where('doc_template', 'A')
            ->where('doc_status', 'success')
            ->where('sub_recid', Auth::user()->group)
            ->where('sub_status', '8')
            ->count();
            return $document_admission_all_group_count_2;
        }else{
            return 0;
        }
    }

    public static function funtion_document_admission_all_work_count_0_level_7($id) {
        if($id == '7'){
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

    public static function funtion_document_admission_all_work_count_1_level_7($id) {
        if($id == '7'){
            //นักจำนวนงานอ่านแล้ว
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
            return $document_admission_all_work_count_1;
        }else{
            return 0;
        }
    }


}
