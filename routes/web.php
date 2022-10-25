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
    Route::get('/PDFRespond/{sub3d_government}/{sub3d_draft}/{sub3d_date}/{sub3d_topic}/{sub3d_podium}/{sub3d_therefore}/{sub3d_pos}/{action}/{sub3d_id}', [functionController::class , 'funtion_PDFRespond' ]);
    //doc_recnum_inside_run
    Route::get('/get_doc_recnum_inside_run/{id}', [functionController::class , 'getdoc_recnum_inside_run' ]);
    //doc_recnum_inside_reserve
    Route::get('/get_doc_recnum_inside_reserve/{id}', [functionController::class , 'getdoc_recnum_inside_reserve' ]);
    //doc_recnum_inside_dropped
    Route::get('/get_doc_recnum_inside_dropped/{id}', [functionController::class , 'getdoc_recnum_inside_dropped' ]);


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

    //member 
    Route::get('/member_dashboard',[member_dashboardController::class,'index'])->name('member_dashboard');
    Route::post('/member_dashboard/document_accepting_new',[member_dashboardController::class,'document_accepting_new'])->name('document_accepting_new');
    Route::get('/getdoc_recnum/{id}',[member_dashboardController::class,'getdoc_recnum']);
    Route::post('/member_dashboard/document_accepting_new_inside',[member_dashboardController::class,'document_accepting_new_inside'])->name('document_accepting_new_inside');

    //All admission documents เอกสารรับเข้าทั้งหมด ภายนอก
    Route::get('/documents_admission_all/all',[documents_admission_allController::class,'index'])->name('documents_admission_all');
    Route::get('/documents_admission_all/detail/{id}',[documents_admission_allController::class,'detail'])->name('documents_admission_detail');
    Route::post('/documents_admission_all/updateGeneral',[documents_admission_allController::class,'updateGeneral'])->name('updateGeneral');
    Route::post('/documents_admission_all/updateFile',[documents_admission_allController::class,'updateFile'])->name('updateFile');
    Route::post('/documents_admission_all/delete',[documents_admission_allController::class,'delete'])->name('delete');

    //reserve number receive จองเลขรับ ภายนอก
    Route::get('/reserve_number_receive/all',[reserve_number_receive_allController::class,'index'])->name('reserve_number_receive_all');
    Route::post('/reserve_number_receive/add',[reserve_number_receive_allController::class,'add'])->name('add_reserve_number_receive_all');
    Route::post('/reserve_number_receive/cancel',[reserve_number_receive_allController::class,'cancel'])->name('cancel_reserve_number_receive_all');

    //pending documents เอกสารรอพิจารณาจากหัวหน้าสำนักปลัดเท่านั้น ภายนอก
    Route::get('/documents_pending/all',[documents_pendingController::class,'index'])->name('documents_pending_all');
    Route::get('/documents_pending/detail/{id}',[documents_pendingController::class,'detail'])->name('documents_pending_detail');
    Route::post('/documents_pending/pending',[documents_pendingController::class,'pending'])->name('documents_pending_pending');
    
    //All admission documents group เอกสารรับเข้ากองงานทั้งหมด ภายนอก
    Route::get('/documents_admission_group/all/0',[documents_admission_group_allController::class,'index_0'])->name('documents_admission_group_all_0');
    Route::get('/documents_admission_group/all/1',[documents_admission_group_allController::class,'index_1'])->name('documents_admission_group_all_1');
    Route::get('/documents_admission_group/all/2',[documents_admission_group_allController::class,'index_2'])->name('documents_admission_group_all_2');
    Route::get('/documents_admission_group/detail/{id}',[documents_admission_group_allController::class,'detail'])->name('documents_admission_group_detail');
    Route::post('/documents_admission_group/takedown',[documents_admission_group_allController::class,'takedown'])->name('documents_admission_group_takedown');
    Route::get('/getdoc_recnum_inside/{id}',[documents_admission_group_allController::class,'getdoc_recnum_inside']);

    //All admission documents department เอกสารรับเข้าหัวหน้าฝ่ายทั้งหมด ภายนอก
    Route::get('/documents_admission_department_all/all/0',[documents_admission_department_allController::class,'index_0'])->name('documents_admission_department_all_0');
    Route::get('/documents_admission_department_all/all/1',[documents_admission_department_allController::class,'index_1'])->name('documents_admission_department_all_1');
    Route::get('/documents_admission_department_all/detail/{id}',[documents_admission_department_allController::class,'detail'])->name('documents_admission_department_detail');
    Route::post('/documents_admission_department_all/takedown',[documents_admission_department_allController::class,'takedown'])->name('documents_admission_department_takedown');
    
    //All admission documents division เอกสารรับเข้าหัวหน้ากองทั้งหมด ภายนอก
    Route::get('/documents_admission_division_all/all/0',[documents_admission_division_allController::class,'index_0'])->name('documents_admission_division_all_0');
    Route::get('/documents_admission_division_all/all/1',[documents_admission_division_allController::class,'index_1'])->name('documents_admission_division_all_1');
    Route::get('/documents_admission_division_all/detail/{id}',[documents_admission_division_allController::class,'detail'])->name('documents_admission_division_detail');
    Route::post('/documents_admission_division_all/takedown',[documents_admission_division_allController::class,'takedown'])->name('documents_admission_division_takedown');
    
    //All admission documents work เอกสารรับเข้าคนทำงานทั้งหมด ภายนอก
    Route::get('/documents_admission_work_all/all/0',[documents_admission_work_allController::class,'index_0'])->name('documents_admission_work_all_0');
    Route::get('/documents_admission_work_all/all/1',[documents_admission_work_allController::class,'index_1'])->name('documents_admission_work_all_1');
    Route::get('/documents_admission_work_all/detail/{id}',[documents_admission_work_allController::class,'detail'])->name('documents_admission_work_detail');
    Route::post('/documents_admission_work_all/respond',[documents_admission_work_allController::class,'respond'])->name('documents_admission_work_detail_respond');

    //All admission documents Minister  เอกสารรับเข้ารอนายกพิจารณาทั้งหมด ภายนอก
    Route::get('/documents_admission_minister_all/all/0',[documents_admission_minister_allController::class,'index_0'])->name('documents_admission_minister_all_0');
    Route::get('/documents_admission_minister_all/all/1',[documents_admission_minister_allController::class,'index_1'])->name('documents_admission_minister_all_1');
    Route::get('/documents_admission_minister_all/detail/{id}',[documents_admission_minister_allController::class,'detail'])->name('documents_admission_minister_detail');
    
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
    Route::get('/documents_admission_department_retrun/detail/{id}',[documents_admission_department_retrunController::class,'detail'])->name('documents_admission_department_retrun_detail');
    Route::post('/documents_admission_department_retrun/understand',[documents_admission_department_retrunController::class,'understand'])->name('documents_admission_department_retrun_understand');

    //All admission documents division retrun 
    Route::get('/documents_admission_division_retrun/all',[documents_admission_division_retrunController::class,'index'])->name('documents_admission_division_retrun');
    Route::get('/documents_admission_division_retrun/detail/{id}',[documents_admission_division_retrunController::class,'detail'])->name('documents_admission_division_retrun_detail');

    //reserve number delivery inside จองเลขส่งภายใน
    Route::get('/reserve_number_delivery_inside/all',[reserve_number_delivery_inside_allController::class,'index'])->name('reserve_number_delivery_inside_all');
    Route::post('/reserve_number_delivery_inside/add',[reserve_number_delivery_inside_allController::class,'add'])->name('add_reserve_number_delivery_inside_all');
    Route::post('/reserve_number_delivery_inside/cancel',[reserve_number_delivery_inside_allController::class,'cancel'])->name('cancel_reserve_number_delivery_inside_all');

    //All admission documents group inside เอกสารรับเข้ากองงานทั้งหมด ภายใน
    Route::get('/documents_admission_group_inside/all/0',[documents_admission_group_inside_allController::class,'index_0'])->name('documents_admission_group_inside_all_0');
    Route::get('/documents_admission_group_inside/all/1',[documents_admission_group_inside_allController::class,'index_1'])->name('documents_admission_group_inside_all_1');
    Route::get('/documents_admission_group_inside/all/2',[documents_admission_group_inside_allController::class,'index_2'])->name('documents_admission_group_inside_all_2');
    Route::get('/documents_admission_group_inside/detail/{id}',[documents_admission_group_inside_allController::class,'detail'])->name('documents_admission_group_inside_detail');
    Route::get('/getdoc_recnum_inside_s/{id}',[documents_admission_group_inside_allController::class,'getdoc_recnum_inside']);
    Route::post('/documents_admission_group_inside/takedown',[documents_admission_group_inside_allController::class,'takedown'])->name('documents_admission_group_inside_takedown');

    //All admission documents division inside เอกสารรับเข้าหัวหน้ากองทั้งหมด ภายใน
    Route::get('/documents_admission_division_inside_all/all/0',[documents_admission_division_inside_allController::class,'index_0'])->name('documents_admission_division_inside_all_0');
    Route::get('/documents_admission_division_inside_all/all/1',[documents_admission_division_inside_allController::class,'index_1'])->name('documents_admission_division_inside_all_1');
    Route::get('/documents_admission_division_inside_all/detail/{id}',[documents_admission_division_inside_allController::class,'detail'])->name('documents_admission_division_inside_detail');
    Route::post('/documents_admission_division_inside_all/takedown',[documents_admission_division_inside_allController::class,'takedown'])->name('documents_admission_division_inside_takedown');

    //All admission documents department inside เอกสารรับเข้าหัวหน้าฝ่ายทั้งหมด ภายใน
    Route::get('/documents_admission_department_inside_all/all/0',[documents_admission_department_inside_allController::class,'index_0'])->name('documents_admission_department_inside_all_0');
    Route::get('/documents_admission_department_inside_all/all/1',[documents_admission_department_inside_allController::class,'index_1'])->name('documents_admission_department_inside_all_1');
    Route::get('/documents_admission_department_inside_all/detail/{id}',[documents_admission_department_inside_allController::class,'detail'])->name('documents_admission_department_inside_detail');
    Route::post('/documents_admission_department_inside_all/takedown',[documents_admission_department_inside_allController::class,'takedown'])->name('documents_admission_department_inside_takedown');

    //All admission documents work เอกสารรับเข้าคนทำงานทั้งหมด ภายนอก
    Route::get('/documents_admission_work_inside_all/all/0',[documents_admission_work_inside_allController::class,'index_0'])->name('documents_admission_work_inside_all_0');
    Route::get('/documents_admission_work_inside_all/all/1',[documents_admission_work_inside_allController::class,'index_1'])->name('documents_admission_work_inside_all_1');
    Route::get('/documents_admission_work_inside_all/detail/{id}',[documents_admission_work_inside_allController::class,'detail'])->name('documents_admission_work_inside_detail');
 
    //---------------------------------------------------------------------------------------------------
});