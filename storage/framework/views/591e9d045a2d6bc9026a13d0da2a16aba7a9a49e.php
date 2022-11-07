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
            สวัสดี , <?php echo e(Auth::user()->name); ?>

        </h2>
     <?php $__env->endSlot(); ?> -->
    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="shadow card">
                        <div class="card-header bg-primary">
                            <div class="clearfix">
                            เอกสารรับเข้าภายนอก (หัวหน้ากอง) 
                                <div class="float-right spinner-grow spinner-grow-sm text-warning" role="status" id="processingIndicator"> 
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                        </div>
                
                        <div class="card-body table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">ลำดับ</th>
                                        <th scope="col">หน่วยงานต้นเรื่อง</th>
                                        <th scope="col">เลขที่รับส่วนงาน</th>
                                        <th scope="col">เลขที่หนังสือ</th>
                                        <th scope="col">วันที่</th>
                                        <th scope="col">วันที่ลง</th>
                                        <th scope="col">เรื่อง</th>
                                        <th scope="col">ชั้นความเร็ว</th>
                                        <th scope="col">สถานะ</th>
                                        <th scope="col">รายละเอียด</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/edoclite_vmiw/resources/views/member/documents_admission_division_all/index.blade.php ENDPATH**/ ?>