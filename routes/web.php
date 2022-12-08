<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\member_dashboardController;
use App\Http\Controllers\sitesController;
use App\Http\Controllers\GroupmemController;
use App\Http\Controllers\memberController;
use App\Http\Controllers\documents_admission_allController;
use App\Http\Controllers\documents_admission_all_insideController;
use App\Http\Controllers\functionController;
use App\Http\Controllers\reserve_number_receive_allController;
use App\Http\Controllers\documents_pendingController;
use App\Http\Controllers\documents_admission_group_allController;
use App\Http\Controllers\documents_admission_department_allController;
use App\Http\Controllers\cottonController;
use App\Http\Controllers\documents_admission_division_allController;
use App\Http\Controllers\documents_admission_work_allController;
use App\Http\Controllers\documents_admission_minister_allController;
use App\Http\Controllers\reserve_number_receive_inside_allController;
use App\Http\Controllers\reserve_number_delivery_allController;
use App\Http\Controllers\reserve_number_announce_allController;
use App\Http\Controllers\reserve_number_order_allController;
use App\Http\Controllers\reserve_number_certificate_allController;
use App\Http\Controllers\documents_admission_department_retrunController;
use App\Http\Controllers\documents_admission_division_retrunController;
use App\Http\Controllers\reserve_number_delivery_inside_allController;
use App\Http\Controllers\documents_admission_group_inside_allController;
use App\Http\Controllers\documents_admission_division_inside_allController;
use App\Http\Controllers\documents_admission_department_inside_allController;
use App\Http\Controllers\documents_admission_work_inside_allController;
use App\Http\Controllers\queryController;
use App\Http\Controllers\documents_admission_jurisprudenceController;
use App\Http\Controllers\documents_admission_deputy_signController;
use App\Http\Controllers\documents_admission_minister_signController;
use App\Http\Controllers\documents_admission_work_retrunController;
use App\Http\Controllers\documents_admission_department_inside_retrunController;
use App\Http\Controllers\documents_admission_division_inside_retrunController;
use App\Http\Controllers\documents_admission_inside_jurisprudenceController;
use App\Http\Controllers\documents_admission_inside_deputy_signController;
use App\Http\Controllers\documents_admission_inside_minister_signController;
use App\Http\Controllers\documents_admission_inside_work_retrunController;
use App\Http\Controllers\documents_retrun_inside_workController;
use App\Http\Controllers\documents_retrun_inside_departmentController;
use App\Http\Controllers\documents_retrun_inside_department_signController;
use App\Http\Controllers\documents_retrun_inside_divisionController;
use App\Http\Controllers\documents_retrun_inside_division_signController;
use App\Http\Controllers\documents_retrun_inside_jurisprudenceController;
use App\Http\Controllers\documents_retrun_inside_deputy_signController;
use App\Http\Controllers\documents_retrun_inside_minister_signController;
use App\Http\Controllers\documents_retrun_inside_work_retrunController;
use App\Http\Controllers\documents_retrun_inside_department_retrunController;
use App\Http\Controllers\documents_retrun_inside_division_retrunController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//เมนูหลัก
Route::get('/', function () {
    if(isset(Auth::user()->level)){
        if(Auth::user()->level == '0'){
            return redirect('dashboard');
        }else if(Auth::user()->level == '1'||Auth::user()->level == '2'||Auth::user()->level == '3'||Auth::user()->level == '4'||Auth::user()->level == '5'||Auth::user()->level == '6'||Auth::user()->level == '7'){
            return redirect('member_dashboard');
        }
    }else{
        return view('auth.login');
    }
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     $users=DB::table('users')->get();
//     return view('dashboard',compact('users'));
// })->name('dashboard');


// Route::get('/dashboard',[dashboardController::class,'index'])->name('dashboard')->middleware(['auth:sanctum', 'verified']);

//เมนูที่ต้อง login
Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    //functionController
    //add_sign
    Route::post('/sign/add',[functionController::class,'addSign'])->name('addSign');
    //cottons
    Route::get('/cottons/{id}', [functionController::class , 'getcottons' ]);
    //calendar
    Route::get('/calendarReserve/{id}', [functionController::class , 'funtion_calendarReserve' ]);
    //pdf_preview
    //Route::get('/PDFRespond/{sub3d_government}/{sub3d_draft}/{sub3d_date}/{sub3d_topic}/{sub3d_podium}/{sub3d_therefore}/{sub3d_pos}/{action}/{sub3d_id}', [functionController::class , 'funtion_PDFRespond' ]);
    Route::post('/PDFRespond',[functionController::class , 'funtion_PDFRespond' ]);
    Route::post('/PDFRespond_garuda',[functionController::class , 'funtion_PDFRespond_garuda' ]);

    Route::post('/PDFRespond_retrun',[functionController::class , 'funtion_PDFRespond_retrun' ]);
    Route::post('/PDFRespond_garuda_retrun',[functionController::class , 'funtion_PDFRespond_garuda_retrun' ]);

    //doc_recnum_inside_run
    Route::get('/get_doc_recnum_inside_run/{id}', [functionController::class , 'getdoc_recnum_inside_run' ]);
    //doc_recnum_inside_reserve
    Route::get('/get_doc_recnum_inside_reserve/{id}', [functionController::class , 'getdoc_recnum_inside_reserve' ]);
    //doc_recnum_inside_dropped
    Route::get('/get_doc_recnum_inside_dropped/{id}', [functionController::class , 'getdoc_recnum_inside_dropped' ]);

    Route::post('/jurisprudence/update',[functionController::class , 'funtion_jurisprudence_update' ]);

    Route::post('/navigation/search',[functionController::class , 'funtion_navigation_search' ]);


    // //users_level_1_0
    // Route::get('/users_level_1_0/{id}',[functionController::class,'getuserS_1_documents_admission_division_allController_0']);
    // //users_level_2_0
    // Route::get('/users_level_2_0/{id}',[functionController::class,'getuserS_2_documents_admission_division_allController_0']);
    // //users_level_1_1
    // Route::get('/users_level_1_1/{id}/{id_1}',[functionController::class,'getuserS_1_documents_admission_division_allController_1']);
    // //users_level_2_1
    // Route::get('/users_level_2_1/{id}/{id_1}',[functionController::class,'getuserS_2_documents_admission_division_allController_1']);
    // //users_level_1_2
    // Route::get('/users_level_1_2/{id}/{id_1}/{id_2}',[functionController::class,'getuserS_1_documents_admission_division_allController_2']);
    // //users_level_2_2
    // Route::get('/users_level_2_2/{id}/{id_1}/{id_2}',[functionController::class,'getuserS_2_documents_admission_division_allController_2']);
    //---------------------------------------------------------------------------------------------------
    //query
    Route::get('/documents_admission_all/all/query',[queryController::class,'funtion_query_documents_admission_allController_level_3']);
    Route::get('/documents_pending/all/query',[queryController::class,'funtion_query_documents_pendingController_level_4']);
    Route::get('/documents_admission_division_all/all/0/query',[queryController::class,'funtion_query_documents_admission_division_all_0_Controller_level_4']);
    Route::get('/documents_admission_division_all/all/1/query',[queryController::class,'funtion_query_documents_admission_division_all_1_Controller_level_4']);
    Route::get('/documents_admission_division_retrun/all/query',[queryController::class,'funtion_query_documents_admission_division_retrunController_level_4']);
    Route::get('/documents_admission_division_inside_all/all/0/query',[queryController::class,'funtion_query_documents_admission_division_inside_all_0_Controller_level_4']);
    Route::get('/documents_admission_division_inside_all/all/1/query',[queryController::class,'funtion_query_documents_admission_division_inside_all_1_Controller_level_4']);
    Route::get('/documents_admission_department_all/all/0/query',[queryController::class,'funtion_query_documents_admission_department_all_0_Controller_level_5']);
    Route::get('/documents_admission_department_all/all/1/query',[queryController::class,'funtion_query_documents_admission_department_all_1_Controller_level_5']);
    Route::get('/documents_admission_department_retrun/all/query',[queryController::class,'funtion_query_documents_admission_department_retrunController_level_5']);
    Route::get('/documents_admission_department_inside_all/all/0/query',[queryController::class,'funtion_query_documents_admission_department_inside_all_0_Controller_level_5']);
    Route::get('/documents_admission_department_inside_all/all/1/query',[queryController::class,'funtion_query_documents_admission_department_inside_all_1_Controller_level_5']);
    Route::get('/documents_admission_group/all/0/query',[queryController::class,'funtion_query_documents_admission_group_0_Controller_level_6']);
    Route::get('/documents_admission_group/all/1/query',[queryController::class,'funtion_query_documents_admission_group_1_Controller_level_6']);
    Route::get('/documents_admission_group/all/2/query',[queryController::class,'funtion_query_documents_admission_group_2_Controller_level_6']);
    Route::get('/documents_admission_group_inside/all/0/query',[queryController::class,'funtion_query_documents_admission_group_inside_0_Controller_level_6']);
    Route::get('/documents_admission_group_inside/all/1/query',[queryController::class,'funtion_query_documents_admission_group_inside_1_Controller_level_6']);
    Route::get('/documents_admission_group_inside/all/2/query',[queryController::class,'funtion_query_documents_admission_group_inside_2_Controller_level_6']);
    Route::get('/documents_admission_all_inside/all/query',[queryController::class,'funtion_query_documents_admission_all_insideController_level_6']);
    Route::get('/documents_admission_work_all/all/0/query',[queryController::class,'funtion_query_documents_admission_work_all_0_Controller_level_7']);
    Route::get('/documents_admission_work_all/all/1/query',[queryController::class,'funtion_query_documents_admission_work_all_1_Controller_level_7']);
    Route::get('/documents_admission_work_inside_all/all/0/query',[queryController::class,'funtion_query_documents_admission_work_inside_all_0_Controller_level_7']);
    Route::get('/documents_admission_work_inside_all/all/1/query',[queryController::class,'funtion_query_documents_admission_work_inside_all_1_Controller_level_7']);
    Route::get('/document_admission_all_work_inside/count/0/query',[queryController::class,'funtion_query_nav_document_admission_all_work_inside_count_0_level_7']);
    Route::get('/document_admission_all_work/count/0/query',[queryController::class,'funtion_query_nav_document_admission_all_work_count_0_level_7']);
    Route::get('/document_admission_all_group_inside/count/0/query',[queryController::class,'funtion_query_nav_document_admission_all_group_inside_count_0_level_6']);
    Route::get('/document_admission_all_group/count/0/query',[queryController::class,'funtion_query_nav_document_admission_all_group_count_0_level_6']);
    Route::get('/document_admission_department/count/0/query',[queryController::class,'funtion_query_nav_document_admission_department_all_count_0_level_5']);
    Route::get('/document_admission_department_inside/count/0/query',[queryController::class,'funtion_query_nav_document_admission_department_inside_all_count_0_level_5']);
    Route::get('/document_admission_division_inside/count/0/query',[queryController::class,'funtion_query_nav_document_admission_division_inside_all_count_0_level_4']);
    Route::get('/document_admission_division/count/0/query',[queryController::class,'funtion_query_nav_document_admission_division_all_count_0_level_4']);
    Route::get('/dashboard/count/sites/query',[queryController::class,'funtion_query_dashboard_count_sites_level_0']);
    Route::get('/dashboard/count/groupmem/query',[queryController::class,'funtion_query_dashboard_count_groupmem_level_0']);
    Route::get('/dashboard/count/cottons/query',[queryController::class,'funtion_query_dashboard_count_cottons_level_0']);
    Route::get('/dashboard/count/member/query',[queryController::class,'funtion_query_dashboard_count_member_level_0']);
    Route::get('/dashboard/count/sub2_docs/query',[queryController::class,'funtion_query_dashboard_count_sub2_docs_level_0']);
    Route::get('/member_dashboard/count/chart/3/query',[queryController::class,'funtion_query_member_dashboard_chart_level_3']);
    Route::get('/member_dashboard/count/chart/4/query',[queryController::class,'funtion_query_member_dashboard_chart_level_4']);
    Route::get('/member_dashboard/count/chart_inside/4/query',[queryController::class,'funtion_query_member_dashboard_chart_inside_level_4']);
    Route::get('/member_dashboard/count/chart/5/query',[queryController::class,'funtion_query_member_dashboard_chart_level_5']);
    Route::get('/member_dashboard/count/chart_inside/5/query',[queryController::class,'funtion_query_member_dashboard_chart_inside_level_5']);
    Route::get('/member_dashboard/count/chart/6/query',[queryController::class,'funtion_query_member_dashboard_chart_level_6']);
    Route::get('/member_dashboard/count/chart_inside/6/query',[queryController::class,'funtion_query_member_dashboard_chart_inside_level_6']);
    Route::get('/member_dashboard/count/chart/7/query',[queryController::class,'funtion_query_member_dashboard_chart_level_7']);
    Route::get('/member_dashboard/count/chart_inside/7/query',[queryController::class,'funtion_query_member_dashboard_chart_inside_level_7']);
    Route::get('/documents_admission_jurisprudence/all/query',[queryController::class,'funtion_query_documents_admission_jurisprudenceController_level_5_7']);
    Route::get('/documents_admission_jurisprudence/count/query',[queryController::class,'funtion_query_documents_admission_jurisprudence']);
    Route::get('/documents_admission_deputy_sign/all/0/query',[queryController::class,'funtion_query_documents_admission_deputy_sign_0_Controller_level_2']);
    Route::get('/documents_admission_deputy_sign/all/1/query',[queryController::class,'funtion_query_documents_admission_deputy_sign_1_Controller_level_2']);
    Route::get('/documents_admission_deputy_sign/count/query',[queryController::class,'funtion_query_documents_admission_deputy_sign_count_level_2']);
    Route::get('/documents_admission_deputy_sign/chart/2/query',[queryController::class,'funtion_query_documents_admission_deputy_sign_chart_level_2']);
    Route::get('/documents_admission_minister_sign/all/0/query',[queryController::class,'funtion_query_documents_admission_minister_sign_0_Controller_level_1']);
    Route::get('/documents_admission_minister_sign/all/1/query',[queryController::class,'funtion_query_documents_admission_minister_sign_1_Controller_level_1']);
    Route::get('/documents_admission_minister_sign/count/query',[queryController::class,'funtion_query_documents_admission_minister_sign_count_level_1']);
    Route::get('/documents_admission_minister_sign/chart/1/query',[queryController::class,'funtion_query_documents_admission_minister_sign_chart_level_1']);
    Route::get('/documents_admission_work_retrun/all/query',[queryController::class,'funtion_query_documents_admission_work_retrunController_level_7']);
    Route::get('/documents_admission_department_inside_retrun/all/query',[queryController::class,'funtion_query_documents_admission_department_inside_retrunController_level_5']);
    Route::get('/documents_admission_division_inside_retrun/all/query',[queryController::class,'funtion_query_documents_admission_division_inside_retrunController_level_4']);
    Route::get('/documents_admission_inside_jurisprudence/all/query',[queryController::class,'funtion_query_documents_admission_inside_jurisprudenceController_level_5_7']);
    Route::get('/documents_admission_inside_minister_sign/count/query',[queryController::class,'funtion_query_documents_admission_inside_minister_sign_count_level_1']);
    Route::get('/documents_admission_inside_deputy_sign/count/query',[queryController::class,'funtion_query_documents_admission_inside_deputy_sign_count_level_2']);
    Route::get('/documents_admission_inside_deputy_sign/chart/2/query',[queryController::class,'funtion_query_documents_admission_inside_deputy_sign_chart_level_2']);
    Route::get('/documents_admission_inside_minister_sign/chart/1/query',[queryController::class,'funtion_query_documents_admission_inside_minister_sign_chart_level_1']);
    Route::get('/documents_admission_inside_deputy_sign/all/0/query',[queryController::class,'funtion_query_documents_admission_inside_deputy_sign_0_Controller_level_2']);
    Route::get('/documents_admission_inside_deputy_sign/all/1/query',[queryController::class,'funtion_query_documents_admission_inside_deputy_sign_1_Controller_level_2']);
    Route::get('/documents_admission_inside_minister_sign/all/0/query',[queryController::class,'funtion_query_documents_admission_inside_minister_sign_0_Controller_level_1']);
    Route::get('/documents_admission_inside_minister_sign/all/1/query',[queryController::class,'funtion_query_documents_admission_inside_minister_sign_1_Controller_level_1']);
    Route::get('/documents_admission_inside_work_retrun/all/query',[queryController::class,'funtion_query_documents_admission_inside_work_retrunController_level_7']);
    Route::get('/documents_retrun_inside_work/all/query',[queryController::class,'funtion_query_documents_retrun_inside_work_Controller_level_7']);
    Route::get('/documents_retrun_inside_department/all/query',[queryController::class,'funtion_query_documents_retrun_inside_department_Controller_level_5']);
    Route::get('/documents_retrun_inside_department_sign/all/query',[queryController::class,'funtion_query_documents_retrun_inside_department_sign_Controller_level_5']);
    Route::get('/documents_retrun_inside_division/all/query',[queryController::class,'funtion_query_documents_retrun_inside_division_Controller_level_4']);
    Route::get('/documents_retrun_inside_division_sign/all/query',[queryController::class,'funtion_query_documents_retrun_inside_division_sign_Controller_level_4']);
    Route::get('/documents_retrun_inside_jurisprudence/all/query',[queryController::class,'funtion_query_documents_retrun_inside_jurisprudenceController_level_5_7']);
    Route::get('/documents_retrun_inside_deputy_sign/all/0/query',[queryController::class,'funtion_query_documents_retrun_inside_deputy_sign_0_Controller_level_2']);
    Route::get('/documents_retrun_inside_deputy_sign/all/1/query',[queryController::class,'funtion_query_documents_retrun_inside_deputy_sign_1_Controller_level_2']);
    Route::get('/documents_retrun_inside_minister_sign/all/0/query',[queryController::class,'funtion_query_documents_retrun_inside_minister_sign_0_Controller_level_1']);
    Route::get('/documents_retrun_inside_minister_sign/all/1/query',[queryController::class,'funtion_query_documents_retrun_inside_minister_sign_1_Controller_level_1']);
    Route::get('/documents_retrun_inside_work_retrun/all/query',[queryController::class,'funtion_query_documents_retrun_inside_work_retrunController_level_7']);

    Route::get('/documents_retrun_inside_department_retrun/all/query',[queryController::class,'funtion_query_documents_retrun_inside_department_retrunController_level_5']);
    Route::get('/documents_retrun_inside_division_retrun/all/query',[queryController::class,'funtion_query_documents_retrun_inside_division_retrunController_level_4']);

    //---------------------------------------------------------------------------------------------------
    
    //admin
    Route::get('/dashboard',[dashboardController::class,'index'])->name('dashboard');
    //groupmem
    Route::get('/groupmem/all',[GroupmemController::class,'index'])->name('groupmem');
    Route::post('/groupmem/add',[GroupmemController::class,'add'])->name('addGroupmem');
    Route::post('/groupmem/delete',[GroupmemController::class,'delete'])->name('deleteGroupmem');
    Route::post('/groupmem/update',[GroupmemController::class,'update'])->name('updateGroupmem');
    //member
    Route::get('/member/all',[memberController::class,'index'])->name('member');
    Route::post('/member/add',[memberController::class,'add'])->name('addMember');
    Route::post('/member/delete',[memberController::class,'delete'])->name('deleteMember');
    Route::post('/member/update',[memberController::class,'update'])->name('updateMember');
    //sites
    Route::get('/sites/all',[sitesController::class,'index'])->name('sites');
    Route::post('/sites/add',[sitesController::class,'add'])->name('addSites');
    Route::post('/sites/delete',[sitesController::class,'delete'])->name('deleteSites');
    Route::post('/sites/update',[sitesController::class,'update'])->name('updateSites');
    //cottons
    Route::get('/cottons_all/all',[cottonController::class,'index'])->name('cottons_all');
    Route::post('/cottons_all/add',[cottonController::class,'add'])->name('addcottons');
    Route::post('/cottons_all/delete',[cottonController::class,'delete'])->name('deletecottons');
    Route::post('/cottons_all/update',[cottonController::class,'update'])->name('updatecottons');

    //Department
    Route::get('/department/all',[DepartmentController::class,'index'])->name('department');
    Route::post('/department/add',[DepartmentController::class,'store'])->name('addDepartment');
    Route::get('/department/edit/{id}',[DepartmentController::class,'edit']);
    Route::post('/department/update/{id}',[DepartmentController::class,'update']);

    //SoftDelete
    Route::get('/department/softdelete/{id}',[DepartmentController::class,'softdelete']);
    Route::get('/department/restore/{id}',[DepartmentController::class,'restore']);
    Route::get('/department/delete/{id}',[DepartmentController::class,'delete']);

    //Service
    Route::get('/service/all',[ServiceController::class,'index'])->name('services');
    Route::post('/service/add',[ServiceController::class,'store'])->name('addService');

    Route::get('/service/edit/{id}',[ServiceController::class,'edit']);
    Route::post('/service/update/{id}',[ServiceController::class,'update']);
    Route::get('/service/delete/{id}',[ServiceController::class,'delete']);
    //---------------------------------------------------------------------------------------------------
    //replace รักษาการแทน
    Route::get('/replace/all',[replaceController::class,'index'])->name('replace');
    Route::post('/replace/update',[replaceController::class,'update'])->name('updateReplace');
    //member 
    Route::get('/member_dashboard',[member_dashboardController::class,'index'])->name('member_dashboard');
    Route::post('/member_dashboard/document_accepting_new',[member_dashboardController::class,'document_accepting_new'])->name('document_accepting_new');
    Route::get('/getdoc_recnum/{id}',[member_dashboardController::class,'getdoc_recnum']);
    Route::post('/member_dashboard/document_accepting_new_inside',[member_dashboardController::class,'document_accepting_new_inside'])->name('document_accepting_new_inside');
    Route::post('/member_dashboard/document_accepting_new_inside_retrun',[member_dashboardController::class,'document_accepting_new_inside_retrun'])->name('document_accepting_new_inside_retrun');

    Route::get('/member/s_all',[memberController::class,'index'])->name('s_member');
    Route::post('/member/s_add',[memberController::class,'add'])->name('s_addMember');
    Route::post('/member/s_delete',[memberController::class,'delete'])->name('s_deleteMember');
    Route::post('/member/s_update',[memberController::class,'update'])->name('s_updateMember');

    //groupmem
    Route::get('/groupmem/s_all',[GroupmemController::class,'index'])->name('s_groupmem');
    Route::post('/groupmem/s_add',[GroupmemController::class,'add'])->name('s_addGroupmem');
    Route::post('/groupmem/s_delete',[GroupmemController::class,'delete'])->name('s_deleteGroupmem');
    Route::post('/groupmem/s_update',[GroupmemController::class,'update'])->name('s_updateGroupmem');
        
    //All admission documents เอกสารรับเข้าทั้งหมด ภายนอก
    Route::get('/documents_admission_all/all',[documents_admission_allController::class,'index'])->name('documents_admission_all');
    Route::get('/documents_admission_all/detail/{id}',[documents_admission_allController::class,'detail'])->name('documents_admission_detail')->middleware(['password.confirm']);
    Route::post('/documents_admission_all/updateGeneral',[documents_admission_allController::class,'updateGeneral'])->name('updateGeneral');
    Route::post('/documents_admission_all/updateFile',[documents_admission_allController::class,'updateFile'])->name('updateFile');
    Route::post('/documents_admission_all/delete',[documents_admission_allController::class,'delete'])->name('delete');
    Route::post('/documents_admission_all/updateGroupmem',[documents_admission_allController::class,'updateGroupmem'])->name('updateGroupmem');

    //reserve number receive จองเลขรับ ภายนอก
    Route::get('/reserve_number_receive/all',[reserve_number_receive_allController::class,'index'])->name('reserve_number_receive_all');
    Route::post('/reserve_number_receive/add',[reserve_number_receive_allController::class,'add'])->name('add_reserve_number_receive_all');
    Route::post('/reserve_number_receive/cancel',[reserve_number_receive_allController::class,'cancel'])->name('cancel_reserve_number_receive_all');

    //pending documents เอกสารรอพิจารณาจากหัวหน้าสำนักปลัดเท่านั้น ภายนอก
    Route::get('/documents_pending/all',[documents_pendingController::class,'index'])->name('documents_pending_all');
    Route::get('/documents_pending/detail/{id}',[documents_pendingController::class,'detail'])->name('documents_pending_detail')->middleware(['password.confirm']);
    Route::post('/documents_pending/pending',[documents_pendingController::class,'pending'])->name('documents_pending_pending');
    
    //All admission documents group เอกสารรับเข้ากองงานทั้งหมด ภายนอก
    Route::get('/documents_admission_group/all/0',[documents_admission_group_allController::class,'index_0'])->name('documents_admission_group_all_0');
    Route::get('/documents_admission_group/all/1',[documents_admission_group_allController::class,'index_1'])->name('documents_admission_group_all_1');
    Route::get('/documents_admission_group/all/2',[documents_admission_group_allController::class,'index_2'])->name('documents_admission_group_all_2');
    Route::get('/documents_admission_group/detail/{id}',[documents_admission_group_allController::class,'detail'])->name('documents_admission_group_detail')->middleware(['password.confirm']);
    Route::post('/documents_admission_group/takedown',[documents_admission_group_allController::class,'takedown'])->name('documents_admission_group_takedown');
    Route::get('/getdoc_recnum_inside/{id}',[documents_admission_group_allController::class,'getdoc_recnum_inside']);

    //All admission documents department เอกสารรับเข้าหัวหน้าฝ่ายทั้งหมด ภายนอก
    Route::get('/documents_admission_department_all/all/0',[documents_admission_department_allController::class,'index_0'])->name('documents_admission_department_all_0');
    Route::get('/documents_admission_department_all/all/1',[documents_admission_department_allController::class,'index_1'])->name('documents_admission_department_all_1');
    Route::get('/documents_admission_department_all/detail/{id}',[documents_admission_department_allController::class,'detail'])->name('documents_admission_department_detail')->middleware(['password.confirm']);
    Route::post('/documents_admission_department_all/takedown',[documents_admission_department_allController::class,'takedown'])->name('documents_admission_department_takedown');
    
    //All admission documents division เอกสารรับเข้าหัวหน้ากองทั้งหมด ภายนอก
    Route::get('/documents_admission_division_all/all/0',[documents_admission_division_allController::class,'index_0'])->name('documents_admission_division_all_0');
    Route::get('/documents_admission_division_all/all/1',[documents_admission_division_allController::class,'index_1'])->name('documents_admission_division_all_1');
    Route::get('/documents_admission_division_all/detail/{id}',[documents_admission_division_allController::class,'detail'])->name('documents_admission_division_detail')->middleware(['password.confirm']);
    Route::post('/documents_admission_division_all/takedown',[documents_admission_division_allController::class,'takedown'])->name('documents_admission_division_takedown');
    
    //All admission documents work เอกสารรับเข้าคนทำงานทั้งหมด ภายนอก
    Route::get('/documents_admission_work_all/all/0',[documents_admission_work_allController::class,'index_0'])->name('documents_admission_work_all_0');
    Route::get('/documents_admission_work_all/all/1',[documents_admission_work_allController::class,'index_1'])->name('documents_admission_work_all_1');
    Route::get('/documents_admission_work_all/detail/{id}',[documents_admission_work_allController::class,'detail'])->name('documents_admission_work_detail')->middleware(['password.confirm']);
    Route::post('/documents_admission_work_all/respond',[documents_admission_work_allController::class,'respond'])->name('documents_admission_work_detail_respond');

    //All admission documents Minister  เอกสารรับเข้ารอนายกพิจารณาทั้งหมด ภายนอก
    Route::get('/documents_admission_minister_all/all/0',[documents_admission_minister_allController::class,'index_0'])->name('documents_admission_minister_all_0');
    Route::get('/documents_admission_minister_all/all/1',[documents_admission_minister_allController::class,'index_1'])->name('documents_admission_minister_all_1');
    Route::get('/documents_admission_minister_all/detail/{id}',[documents_admission_minister_allController::class,'detail'])->name('documents_admission_minister_detail')->middleware(['password.confirm']);
    
    //reserve number delivery จองเลขส่ง
    Route::get('/reserve_number_delivery/all',[reserve_number_delivery_allController::class,'index'])->name('reserve_number_delivery_all');
    Route::post('/reserve_number_delivery/add',[reserve_number_delivery_allController::class,'add'])->name('add_reserve_number_delivery_all');
    Route::post('/reserve_number_delivery/cancel',[reserve_number_delivery_allController::class,'cancel'])->name('cancel_reserve_number_delivery_all');

    //reserve number announce จองเลขประกาศ
    Route::get('/reserve_number_announce/all',[reserve_number_announce_allController::class,'index'])->name('reserve_number_announce_all');
    Route::post('/reserve_number_announce/add',[reserve_number_announce_allController::class,'add'])->name('add_reserve_number_announce_all');
    Route::post('/reserve_number_announce/cancel',[reserve_number_announce_allController::class,'cancel'])->name('cancel_reserve_number_announce_all');

    //reserve number order จองเลขคำสั่ง
    Route::get('/reserve_number_order/all',[reserve_number_order_allController::class,'index'])->name('reserve_number_order_all');
    Route::post('/reserve_number_order/add',[reserve_number_order_allController::class,'add'])->name('add_reserve_number_order_all');
    Route::post('/reserve_number_order/cancel',[reserve_number_order_allController::class,'cancel'])->name('cancel_reserve_number_order_all');

    //reserve number certificate จองเลขหนังสือรับรอง
    Route::get('/reserve_number_certificate/all',[reserve_number_certificate_allController::class,'index'])->name('reserve_number_certificate_all');
    Route::post('/reserve_number_certificate/add',[reserve_number_certificate_allController::class,'add'])->name('add_reserve_number_certificate_all');
    Route::post('/reserve_number_certificate/cancel',[reserve_number_certificate_allController::class,'cancel'])->name('cancel_reserve_number_certificate_all');

    //reserve number receive inside จองเลขรับ ภายในกอง
    Route::get('/reserve_number_receive_inside/all',[reserve_number_receive_inside_allController::class,'index'])->name('reserve_number_receive_inside_all');
    Route::post('/reserve_number_receive_inside/add',[reserve_number_receive_inside_allController::class,'add'])->name('add_reserve_number_receive_inside_all');
    Route::post('/reserve_number_receive_inside/cancel',[reserve_number_receive_inside_allController::class,'cancel'])->name('cancel_reserve_number_receive_inside_all');
    
    //All admission documents department retrun 
    Route::get('/documents_admission_department_retrun/all',[documents_admission_department_retrunController::class,'index'])->name('documents_admission_department_retrun');
    Route::get('/documents_admission_department_retrun/detail/{id}',[documents_admission_department_retrunController::class,'detail'])->name('documents_admission_department_retrun_detail')->middleware(['password.confirm']);
    Route::post('/documents_admission_department_retrun/understand',[documents_admission_department_retrunController::class,'understand'])->name('documents_admission_department_retrun_understand');

    //All admission documents division retrun 
    Route::get('/documents_admission_division_retrun/all',[documents_admission_division_retrunController::class,'index'])->name('documents_admission_division_retrun');
    Route::get('/documents_admission_division_retrun/detail/{id}',[documents_admission_division_retrunController::class,'detail'])->name('documents_admission_division_retrun_detail')->middleware(['password.confirm']);
    Route::post('/documents_admission_division_retrun/understand',[documents_admission_division_retrunController::class,'understand'])->name('documents_admission_division_retrun_understand');

    //reserve number delivery inside จองเลขส่งภายใน
    Route::get('/reserve_number_delivery_inside/all',[reserve_number_delivery_inside_allController::class,'index'])->name('reserve_number_delivery_inside_all');
    Route::post('/reserve_number_delivery_inside/add',[reserve_number_delivery_inside_allController::class,'add'])->name('add_reserve_number_delivery_inside_all');
    Route::post('/reserve_number_delivery_inside/cancel',[reserve_number_delivery_inside_allController::class,'cancel'])->name('cancel_reserve_number_delivery_inside_all');

    //All admission documents เอกสารส่งออกภายใน
    Route::get('/documents_admission_all_inside/all',[documents_admission_all_insideController::class,'index'])->name('documents_admission_all_inside');
    Route::get('/documents_admission_all_inside/detail/{id}',[documents_admission_all_insideController::class,'detail'])->name('documents_admission_detail_inside')->middleware(['password.confirm']);
    // Route::post('/documents_admission_all_inside/updateGeneral',[documents_admission_allController::class,'updateGeneral'])->name('updateGeneral');
    // Route::post('/documents_admission_all_inside/updateFile',[documents_admission_allController::class,'updateFile'])->name('updateFile');
    // Route::post('/documents_admission_all_inside/delete',[documents_admission_allController::class,'delete'])->name('delete');

    //All admission documents group inside เอกสารรับเข้ากองงานทั้งหมด ภายใน
    Route::get('/documents_admission_group_inside/all/0',[documents_admission_group_inside_allController::class,'index_0'])->name('documents_admission_group_inside_all_0');
    Route::get('/documents_admission_group_inside/all/1',[documents_admission_group_inside_allController::class,'index_1'])->name('documents_admission_group_inside_all_1');
    Route::get('/documents_admission_group_inside/all/2',[documents_admission_group_inside_allController::class,'index_2'])->name('documents_admission_group_inside_all_2');
    Route::get('/documents_admission_group_inside/detail/{id}',[documents_admission_group_inside_allController::class,'detail'])->name('documents_admission_group_inside_detail')->middleware(['password.confirm']);
    Route::get('/getdoc_recnum_inside_s/{id}',[documents_admission_group_inside_allController::class,'getdoc_recnum_inside']);
    Route::post('/documents_admission_group_inside/takedown',[documents_admission_group_inside_allController::class,'takedown'])->name('documents_admission_group_inside_takedown');

    //All admission documents division inside เอกสารรับเข้าหัวหน้ากองทั้งหมด ภายใน
    Route::get('/documents_admission_division_inside_all/all/0',[documents_admission_division_inside_allController::class,'index_0'])->name('documents_admission_division_inside_all_0');
    Route::get('/documents_admission_division_inside_all/all/1',[documents_admission_division_inside_allController::class,'index_1'])->name('documents_admission_division_inside_all_1');
    Route::get('/documents_admission_division_inside_all/detail/{id}',[documents_admission_division_inside_allController::class,'detail'])->name('documents_admission_division_inside_detail')->middleware(['password.confirm']);
    Route::post('/documents_admission_division_inside_all/takedown',[documents_admission_division_inside_allController::class,'takedown'])->name('documents_admission_division_inside_takedown');

    //All admission documents department inside เอกสารรับเข้าหัวหน้าฝ่ายทั้งหมด ภายใน
    Route::get('/documents_admission_department_inside_all/all/0',[documents_admission_department_inside_allController::class,'index_0'])->name('documents_admission_department_inside_all_0');
    Route::get('/documents_admission_department_inside_all/all/1',[documents_admission_department_inside_allController::class,'index_1'])->name('documents_admission_department_inside_all_1');
    Route::get('/documents_admission_department_inside_all/detail/{id}',[documents_admission_department_inside_allController::class,'detail'])->name('documents_admission_department_inside_detail')->middleware(['password.confirm']);
    Route::post('/documents_admission_department_inside_all/takedown',[documents_admission_department_inside_allController::class,'takedown'])->name('documents_admission_department_inside_takedown');

    //All admission documents work เอกสารรับเข้าคนทำงานทั้งหมด ภายใน
    Route::get('/documents_admission_work_inside_all/all/0',[documents_admission_work_inside_allController::class,'index_0'])->name('documents_admission_work_inside_all_0');
    Route::get('/documents_admission_work_inside_all/all/1',[documents_admission_work_inside_allController::class,'index_1'])->name('documents_admission_work_inside_all_1');
    Route::get('/documents_admission_work_inside_all/detail/{id}',[documents_admission_work_inside_allController::class,'detail'])->name('documents_admission_work_inside_detail')->middleware(['password.confirm']);
    Route::post('/documents_admission_work_inside_all/respond',[documents_admission_work_inside_allController::class,'respond'])->name('documents_admission_work_inside_detail_respond');

    //documents admission jurisprudence
    Route::get('/documents_admission_jurisprudence/all',[documents_admission_jurisprudenceController::class,'index'])->name('documents_admission_jurisprudence_all');
    Route::get('/documents_admission_jurisprudence/detail/{id}',[documents_admission_jurisprudenceController::class,'detail'])->name('documents_admission_jurisprudence_detail')->middleware(['password.confirm']);
    Route::post('/documents_admission_jurisprudence/understand',[documents_admission_jurisprudenceController::class,'understand'])->name('documents_admission_jurisprudence_understand');
    Route::post('/documents_admission_jurisprudence/do_not_understand',[documents_admission_jurisprudenceController::class,'do_not_understand'])->name('documents_admission_jurisprudence_do_not_understand');

    //documents admission deputy sign ปลัด รองปลัด ลงนาม
    Route::get('/documents_admission_deputy_sign/all/0',[documents_admission_deputy_signController::class,'index_0'])->name('documents_admission_deputy_sign_all_0');
    Route::get('/documents_admission_deputy_sign/all/1',[documents_admission_deputy_signController::class,'index_1'])->name('documents_admission_deputy_sign_all_1');
    Route::get('/documents_admission_deputy_sign/detail/{id}',[documents_admission_deputy_signController::class,'detail'])->name('documents_admission_deputy_sign_detail')->middleware(['password.confirm']);
    Route::post('/documents_admission_deputy_sign/understand',[documents_admission_deputy_signController::class,'understand'])->name('documents_admission_deputy_sign_understand');


    //documents admission minister sign นายก รองนายก ลงนาม
    Route::get('/documents_admission_minister_sign/all/0',[documents_admission_minister_signController::class,'index_0'])->name('documents_admission_minister_sign_all_0');
    Route::get('/documents_admission_minister_sign/all/1',[documents_admission_minister_signController::class,'index_1'])->name('documents_admission_minister_sign_all_1');
    Route::get('/documents_admission_minister_sign/detail/{id}',[documents_admission_minister_signController::class,'detail'])->name('documents_admission_minister_sign_detail')->middleware(['password.confirm']);
    Route::post('/documents_admission_minister_sign/understand',[documents_admission_minister_signController::class,'understand'])->name('documents_admission_minister_sign_understand');

    //All admission documents work งานตอยกลับที่ไม่ได้รับการอนุมัติ
    Route::get('/documents_admission_work_retrun/all',[documents_admission_work_retrunController::class,'index'])->name('documents_admission_work_retrun_all');
    Route::get('/documents_admission_work_retrun/detail/{id}',[documents_admission_work_retrunController::class,'detail'])->name('documents_admission_work_retrun_detail')->middleware(['password.confirm']);
    Route::post('/documents_admission_work_retrun/respond',[documents_admission_work_retrunController::class,'respond'])->name('documents_admission_work_retrun_respond');

     //All admission documents department inside retrun 
     Route::get('/documents_admission_department_inside_retrun/all',[documents_admission_department_inside_retrunController::class,'index'])->name('documents_admission_department_inside_retrun');
     Route::get('/documents_admission_department_inside_retrun/detail/{id}',[documents_admission_department_inside_retrunController::class,'detail'])->name('documents_admission_department_inside_retrun_detail')->middleware(['password.confirm']);
     Route::post('/documents_admission_department_inside_retrun/understand',[documents_admission_department_inside_retrunController::class,'understand'])->name('documents_admission_department_inside_retrun_understand');
 
    //All admission documents division inside retrun 
    Route::get('/documents_admission_division_inside_retrun/all',[documents_admission_division_inside_retrunController::class,'index'])->name('documents_admission_division_inside_retrun');
    Route::get('/documents_admission_division_inside_retrun/detail/{id}',[documents_admission_division_inside_retrunController::class,'detail'])->name('documents_admission_division_inside_retrun_detail')->middleware(['password.confirm']);
    Route::post('/documents_admission_division_inside_retrun/understand',[documents_admission_division_inside_retrunController::class,'understand'])->name('documents_admission_division_inside_retrun_understand');

    //documents admission inside jurisprudence
    Route::get('/documents_admission_inside_jurisprudence/all',[documents_admission_inside_jurisprudenceController::class,'index'])->name('documents_admission_inside_jurisprudence_all');
    Route::get('/documents_admission_inside_jurisprudence/detail/{id}',[documents_admission_inside_jurisprudenceController::class,'detail'])->name('documents_admission_inside_jurisprudence_detail')->middleware(['password.confirm']);
    Route::post('/documents_admission_inside_jurisprudence/understand',[documents_admission_inside_jurisprudenceController::class,'understand'])->name('documents_admission_inside_jurisprudence_understand');
    Route::post('/documents_admission_inside_jurisprudence/do_not_understand',[documents_admission_inside_jurisprudenceController::class,'do_not_understand'])->name('documents_admission_inside_jurisprudence_do_not_understand');
    
    //documents admission inside deputy sign ปลัด รองปลัด ลงนาม
    Route::get('/documents_admission_inside_deputy_sign/all/0',[documents_admission_inside_deputy_signController::class,'index_0'])->name('documents_admission_inside_deputy_sign_all_0');
    Route::get('/documents_admission_inside_deputy_sign/all/1',[documents_admission_inside_deputy_signController::class,'index_1'])->name('documents_admission_inside_deputy_sign_all_1');
    Route::get('/documents_admission_inside_deputy_sign/detail/{id}',[documents_admission_inside_deputy_signController::class,'detail'])->name('documents_admission_inside_deputy_sign_detail')->middleware(['password.confirm']);
    Route::post('/documents_admission_inside_deputy_sign/understand',[documents_admission_inside_deputy_signController::class,'understand'])->name('documents_admission_inside_deputy_sign_understand');
    
    //documents admission inside minister sign นายก รองนายก ลงนาม
    Route::get('/documents_admission_inside_minister_sign/all/0',[documents_admission_inside_minister_signController::class,'index_0'])->name('documents_admission_inside_minister_sign_all_0');
    Route::get('/documents_admission_inside_minister_sign/all/1',[documents_admission_inside_minister_signController::class,'index_1'])->name('documents_admission_inside_minister_sign_all_1');
    Route::get('/documents_admission_inside_minister_sign/detail/{id}',[documents_admission_inside_minister_signController::class,'detail'])->name('documents_admission_inside_minister_sign_detail')->middleware(['password.confirm']);
    Route::post('/documents_admission_inside_minister_sign/understand',[documents_admission_inside_minister_signController::class,'understand'])->name('documents_admission_inside_minister_sign_understand');
    
     //All admission documents _inside work งานตอยกลับที่ไม่ได้รับการอนุมัติ
     Route::get('/documents_admission_inside_work_retrun/all',[documents_admission_inside_work_retrunController::class,'index'])->name('documents_admission_inside_work_retrun_all');
     Route::get('/documents_admission_inside_work_retrun/detail/{id}',[documents_admission_inside_work_retrunController::class,'detail'])->name('documents_admission_inside_work_retrun_detail')->middleware(['password.confirm']);
     Route::post('/documents_admission_inside_work_retrun/respond',[documents_admission_inside_work_retrunController::class,'respond'])->name('documents_admission_inside_work_retrun_respond');
 
    //documents retrun inside work เอกสารตอบกลับท้ั้งหมด ของงาน
    Route::get('/documents_retrun_inside_work/all',[documents_retrun_inside_workController::class,'index'])->name('documents_retrun_inside_work_all');
    Route::get('/documents_retrun_inside_work/detail/{id}',[documents_retrun_inside_workController::class,'detail'])->name('documents_retrun_inside_work_detail')->middleware(['password.confirm']);

    //documents retrun inside department เอกสารตอบกลับท้ั้งหมด ของหัวหน้าฝ่าย
    Route::get('/documents_retrun_inside_department/all',[documents_retrun_inside_departmentController::class,'index'])->name('documents_retrun_inside_department_all');
    Route::get('/documents_retrun_inside_department/detail/{id}',[documents_retrun_inside_departmentController::class,'detail'])->name('documents_retrun_inside_department_detail')->middleware(['password.confirm']);

    //documents retrun inside department sign เอกสารตอบกลับรอพิจารณาท้ั้งหมด ของหัวหน้าฝ่าย
    Route::get('/documents_retrun_inside_department_sign/all',[documents_retrun_inside_department_signController::class,'index'])->name('documents_retrun_inside_department_sign_all');
    Route::get('/documents_retrun_inside_department_sign/detail/{id}',[documents_retrun_inside_department_signController::class,'detail'])->name('documents_retrun_inside_department_sign_detail')->middleware(['password.confirm']);
    Route::post('/documents_retrun_inside_department_sign/understand',[documents_retrun_inside_department_signController::class,'understand'])->name('documents_retrun_inside_department_sign_understand');

    //documents retrun inside division เอกสารตอบกลับท้ั้งหมด ของหัวหน้ากอง
    Route::get('/documents_retrun_inside_division/all',[documents_retrun_inside_divisionController::class,'index'])->name('documents_retrun_inside_division_all');
    Route::get('/documents_retrun_inside_division/detail/{id}',[documents_retrun_inside_divisionController::class,'detail'])->name('documents_retrun_inside_division_detail')->middleware(['password.confirm']);
 
    //documents retrun inside division sign เอกสารตอบกลับรอพิจารณาท้ั้งหมด ของหัวหน้ากอง
    Route::get('/documents_retrun_inside_division_sign/all',[documents_retrun_inside_division_signController::class,'index'])->name('documents_retrun_inside_division_sign_all');
    Route::get('/documents_retrun_inside_division_sign/detail/{id}',[documents_retrun_inside_division_signController::class,'detail'])->name('documents_retrun_inside_division_sign_detail')->middleware(['password.confirm']);
    Route::post('/documents_retrun_inside_division_sign/understand',[documents_retrun_inside_division_signController::class,'understand'])->name('documents_retrun_inside_division_sign_understand');
 
    //documents retrun inside jurisprudence
    Route::get('/documents_retrun_inside_jurisprudence/all',[documents_retrun_inside_jurisprudenceController::class,'index'])->name('documents_retrun_inside_jurisprudence_all');
    Route::get('/documents_retrun_inside_jurisprudence/detail/{id}',[documents_retrun_inside_jurisprudenceController::class,'detail'])->name('documents_retrun_inside_jurisprudence_detail')->middleware(['password.confirm']);
    Route::post('/documents_retrun_inside_jurisprudence/understand',[documents_retrun_inside_jurisprudenceController::class,'understand'])->name('documents_retrun_inside_jurisprudence_understand');
    Route::post('/documents_retrun_inside_jurisprudence/do_not_understand',[documents_retrun_inside_jurisprudenceController::class,'do_not_understand'])->name('documents_retrun_inside_jurisprudence_do_not_understand');
        
    //documents retrun inside deputy sign ปลัด รองปลัด ลงนาม
    Route::get('/documents_retrun_inside_deputy_sign/all/0',[documents_retrun_inside_deputy_signController::class,'index_0'])->name('documents_retrun_inside_deputy_sign_all_0');
    Route::get('/documents_retrun_inside_deputy_sign/all/1',[documents_retrun_inside_deputy_signController::class,'index_1'])->name('documents_retrun_inside_deputy_sign_all_1');
    Route::get('/documents_retrun_inside_deputy_sign/detail/{id}',[documents_retrun_inside_deputy_signController::class,'detail'])->name('documents_retrun_inside_deputy_sign_detail')->middleware(['password.confirm']);
    Route::post('/documents_retrun_inside_deputy_sign/understand',[documents_retrun_inside_deputy_signController::class,'understand'])->name('documents_retrun_inside_deputy_sign_understand');
        
    //documents retrun inside minister sign นายก รองนายก ลงนาม
    Route::get('/documents_retrun_inside_minister_sign/all/0',[documents_retrun_inside_minister_signController::class,'index_0'])->name('documents_retrun_inside_minister_sign_all_0');
    Route::get('/documents_retrun_inside_minister_sign/all/1',[documents_retrun_inside_minister_signController::class,'index_1'])->name('documents_retrun_inside_minister_sign_all_1');
    Route::get('/documents_retrun_inside_minister_sign/detail/{id}',[documents_retrun_inside_minister_signController::class,'detail'])->name('documents_retrun_inside_minister_sign_detail')->middleware(['password.confirm']);
    Route::post('/documents_retrun_inside_minister_sign/understand',[documents_retrun_inside_minister_signController::class,'understand'])->name('documents_retrun_inside_minister_sign_understand');
        
    //All admission retrun inside work งานตอยกลับที่ไม่ได้รับการอนุมัติ
    Route::get('/documents_retrun_inside_work_retrun/all',[documents_retrun_inside_work_retrunController::class,'index'])->name('documents_retrun_inside_work_retrun_all');
    Route::get('/documents_retrun_inside_work_retrun/detail/{id}',[documents_retrun_inside_work_retrunController::class,'detail'])->name('documents_retrun_inside_work_retrun_detail')->middleware(['password.confirm']);
    Route::post('/documents_retrun_inside_work_retrun/respond',[documents_retrun_inside_work_retrunController::class,'respond'])->name('documents_retrun_inside_work_retrun_respond');
     
    //All admission retrun inside department งานตอยกลับที่ไม่ได้รับการอนุมัติ
    Route::get('/documents_retrun_inside_department_retrun/all',[documents_retrun_inside_department_retrunController::class,'index'])->name('documents_retrun_inside_department_retrun_all');
    Route::get('/documents_retrun_inside_department_retrun/detail/{id}',[documents_retrun_inside_department_retrunController::class,'detail'])->name('documents_retrun_inside_department_retrun_detail')->middleware(['password.confirm']);
    Route::post('/documents_retrun_inside_department_retrun/respond',[documents_retrun_inside_department_retrunController::class,'respond'])->name('documents_retrun_inside_department_retrun_respond');
     
    //All admission retrun inside division งานตอยกลับที่ไม่ได้รับการอนุมัติ
    Route::get('/documents_retrun_inside_division_retrun/all',[documents_retrun_inside_division_retrunController::class,'index'])->name('documents_retrun_inside_division_retrun_all');
    Route::get('/documents_retrun_inside_division_retrun/detail/{id}',[documents_retrun_inside_division_retrunController::class,'detail'])->name('documents_retrun_inside_division_retrun_detail')->middleware(['password.confirm']);
    Route::post('/documents_retrun_inside_division_retrun/respond',[documents_retrun_inside_division_retrunController::class,'respond'])->name('documents_retrun_inside_division_retrun_respond');
     
    //---------------------------------------------------------------------------------------------------
});
