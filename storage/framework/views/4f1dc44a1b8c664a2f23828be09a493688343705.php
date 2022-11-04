<?php
use App\Http\Controllers\functionController;
?>
<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
    <!--  <?php $__env->slot('header', null, []); ?> 
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
        </h2>
     <?php $__env->endSlot(); ?> -->
    <div class="py-12">
        <div class="container">
            <div class="container-fluid">
                <div class="row">
                    <!-- สารบรรณกลาง -->
                    <?php if(Auth::user()->level == '3'): ?>
                    <div class="col-md-5">
                        <div class="shadow card">
                            <div class="card-header bg-primary">
                                <h5 class="card-title">เอกสารรับเข้าภายนอกทั้งหมด</h5>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <input type="hidden"
                                    id="member_dashboard_input_documents_admission_all_waiting_count_level_3"
                                    value="<?php echo e($document_admission_all_waiting_count); ?>" class="form-control">
                                <input type="hidden"
                                    id="member_dashboard_input_documents_admission_all_success_count_level_3"
                                    value="<?php echo e($document_admission_all_success_count); ?>" class="form-control">
                                <div id="chart_level_3" style="height: 250px; width: 100%;"></div>
                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="shadow card">
                            <div class="card-header bg-primary">
                                <h5 class="card-title">ปฏิทินเลขที่จอง</h5>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <input type="hidden" id="member_dashboard_input_calendar_reserve_numbers"
                                    value="<?php echo e(Auth::user()->id); ?>" class="form-control">
                                <div id="calendar"></div>
                                <div id="external-events"></div>
                            </div>
                            <div class="card-footer">
                                <span class="badge badge-info">เลขรับภายนอก</span> <span
                                    class="badge badge-secondary">เลขรับภายใน</span>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <!-- หัวหน้ากอง -->
                    <?php if(Auth::user()->level == '4'): ?>
                    <div class="col-md-6">
                        <div class="shadow card">
                            <div class="card-header bg-primary">
                                <h5 class="card-title">ทะเบียนหนังสือภายนอก</h5>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <input type="hidden"
                                    id="member_dashboard_input_documents_admission_division_all_count_0_level_4"
                                    value="<?php echo e($documents_admission_division_all_count_0); ?>" class="form-control">
                                <input type="hidden"
                                    id="member_dashboard_input_documents_admission_division_all_count_1_level_4"
                                    value="<?php echo e($documents_admission_division_all_count_1); ?>" class="form-control">
                                <div id="chart_level_4" style="height: 250px; width: 100%;"></div>
                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="shadow card">
                            <div class="card-header bg-primary">
                                <h5 class="card-title">ทะเบียนหนังสือภายใน</h5>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <input type="hidden"
                                    id="member_dashboard_input_documents_admission_division_inside_all_count_0_level_4"
                                    value="<?php echo e($documents_admission_division_inside_all_count_0); ?>" class="form-control">
                                <input type="hidden"
                                    id="member_dashboard_input_documents_admission_division_inside_all_count_1_level_4"
                                    value="<?php echo e($documents_admission_division_inside_all_count_1); ?>" class="form-control">
                                <div id="chart_inside_level_4" style="height: 250px; width: 100%;"></div>
                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <!-- หัวหน้าฝ่าย -->
                    <?php if(Auth::user()->level == '5'): ?>
                    <div class="col-md-6">
                        <div class="shadow card">
                            <div class="card-header bg-primary">
                                <h5 class="card-title">ทะเบียนหนังสือภายนอก</h5>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <input type="hidden"
                                    id="member_dashboard_input_document_admission_department_all_count_0_level_5"
                                    value="<?php echo e($document_admission_department_all_count_0); ?>" class="form-control">
                                <input type="hidden"
                                    id="member_dashboard_input_document_admission_department_all_count_1_level_5"
                                    value="<?php echo e($document_admission_department_all_count_1); ?>" class="form-control">
                                <div id="chart_level_5" style="height: 250px; width: 100%;"></div>
                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="shadow card">
                            <div class="card-header bg-primary">
                                <h5 class="card-title">ทะเบียนหนังสือภายใน</h5>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <input type="hidden"
                                    id="member_dashboard_input_document_admission_department_inside_all_count_0_level_5"
                                    value="<?php echo e($document_admission_department_inside_all_count_0); ?>" class="form-control">
                                <input type="hidden"
                                    id="member_dashboard_input_document_admission_department_inside_all_count_1_level_5"
                                    value="<?php echo e($document_admission_department_inside_all_count_1); ?>" class="form-control">
                                <div id="chart_inside_level_5" style="height: 250px; width: 100%;"></div>

                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- สารบรรณกอง -->
                    <?php if(Auth::user()->level == '6'): ?>
                    <div class="col-md-5">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="shadow card">
                                    <div class="card-header bg-primary">
                                        <h5 class="card-title">เอกสารรับเข้าภายนอกทั้งหมด</h5>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <input type="hidden"
                                            id="member_dashboard_input_document_admission_all_group_count_0_level_6"
                                            value="<?php echo e($document_admission_all_group_count_0); ?>" class="form-control">
                                        <input type="hidden"
                                            id="member_dashboard_input_document_admission_all_group_count_1_level_6"
                                            value="<?php echo e($document_admission_all_group_count_1); ?>" class="form-control">
                                        <input type="hidden"
                                            id="member_dashboard_input_document_admission_all_group_count_2_level_6"
                                            value="<?php echo e($document_admission_all_group_count_2); ?>" class="form-control">
                                        <div id="chart_level_6" style="height: 250px; width: 100%;"></div>
                                    </div>
                                    <div class="card-footer">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="shadow card">
                                    <div class="card-header bg-primary">
                                        <h5 class="card-title">เอกสารรับเข้าภายในทั้งหมด</h5>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <input type="hidden"
                                            id="member_dashboard_input_document_admission_all_group_inside_count_0_level_6"
                                            value="<?php echo e($document_admission_all_group_inside_count_0); ?>"
                                            class="form-control">
                                        <input type="hidden"
                                            id="member_dashboard_input_document_admission_all_group_inside_count_1_level_6"
                                            value="<?php echo e($document_admission_all_group_inside_count_1); ?>"
                                            class="form-control">
                                        <input type="hidden"
                                            id="member_dashboard_input_document_admission_all_group_inside_count_2_level_6"
                                            value="<?php echo e($document_admission_all_group_inside_count_2); ?>"
                                            class="form-control">
                                        <div id="chart_inside_level_6" style="height: 250px; width: 100%;"></div>
                                    </div>
                                    <div class="card-footer">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="shadow card">
                            <div class="card-header bg-primary">
                                <h5 class="card-title">ปฏิทินเลขที่จอง</h5>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <input type="hidden" id="member_dashboard_input_calendar_reserve_numbers"
                                    value="<?php echo e(Auth::user()->id); ?>" class="form-control">
                                <div id="calendar"></div>
                                <div id="external-events"></div>
                            </div>
                            <div class="card-footer">
                                <span class="badge badge-info">เลขรับภายนอก</span> 
                                <span class="badge badge-secondary">เลขรับภายใน</span>
                                <span class="badge badge-primary">เลขส่งภายใน</span>
                                <span class="badge badge-success">เลขประกาศ</span>
                                <span class="badge badge-danger">เลขคำสั่ง</span>
                                <span class="badge badge-warning">เลขหนังสือรับรอง</span>
                            </div>
                        </div>
                    </div>

                    <?php endif; ?>

                    <!-- งาน -->
                    <?php if(Auth::user()->level == '7'): ?>
                    <div class="col-md-6">
                        <div class="shadow card">
                            <div class="card-header bg-primary">
                                <h5 class="card-title">ทะเบียนหนังสือภายนอก</h5>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <input type="hidden"
                                    id="member_dashboard_input_document_admission_all_work_count_0_level_7"
                                    value="<?php echo e($document_admission_all_work_count_0); ?>" class="form-control">
                                <input type="hidden"
                                    id="member_dashboard_input_document_admission_all_work_count_1_level_7"
                                    value="<?php echo e($document_admission_all_work_count_1); ?>" class="form-control">
                                <div id="chart_level_7" style="height: 250px; width: 100%;"></div>
                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="shadow card">
                            <div class="card-header bg-primary">
                                <h5 class="card-title">ทะเบียนหนังสือภายใน</h5>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <input type="hidden"
                                    id="member_dashboard_input_document_admission_all_work_inside_count_0_level_7"
                                    value="<?php echo e($document_admission_all_work_inside_count_0); ?>" class="form-control">
                                <input type="hidden"
                                    id="member_dashboard_input_document_admission_all_work_inside_count_1_level_7"
                                    value="<?php echo e($document_admission_all_work_inside_count_1); ?>" class="form-control">
                                <div id="chart_inside_level_7" style="height: 250px; width: 100%;"></div>
                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>




 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/edoclite_vmiw/resources/views/member_dashboard.blade.php ENDPATH**/ ?>