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
                  
                    <div class="border shadow card border-info">
                        <div class="text-lg card-header bg-primary">
                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.nav-link','data' => ['href' => ''.e(url('/documents_admission_all/all')).'']]); ?>
<?php $component->withName('jet-nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['href' => ''.e(url('/documents_admission_all/all')).'']); ?>
                                <i class="fa fa-arrow-left"></i>
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                            เอกสารรับเข้าภายนอก : <?php echo e($document_detail->doc_origin); ?>

                        </div>
                        <div class="card-body table-responsive">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        เลขที่รับส่วนงาน : 
                                        <font class="text-primary"><?php echo e($document_detail->doc_recnum); ?></font>
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <div class="form-group">
                                        เลขที่หนังสือ : 
                                        <font class="text-primary"><?php echo e($document_detail->doc_docnum); ?></font>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        วันที่ :
                                        <font class="text-primary"><?php echo e($document_detail->doc_date); ?></font>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        ลงวันที่ : 
                                        <font class="text-primary"><?php echo e($document_detail->doc_date); ?></font>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        เวลา : 
                                        <font class="text-primary"><?php echo e($document_detail->doc_time); ?></font>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        ชั้นความเร็ว/สถานะ : 
                                        <?php echo functionController::funtion_doc_speed($document_detail->doc_speed); ?>

                                        <?php echo functionController::funtion_doc_status($document_detail->doc_status); ?>

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        เรื่อง : 
                                        <font class="text-primary"><?php echo e($document_detail->doc_title); ?></font>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                   <div class="col-md-12">
                                    <div class="form-group">
                                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['class' => 'text-md','for' => 'doc_filedirec','value' => ''.e(__('ไฟล์เอกสาร')).'']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'text-md','for' => 'doc_filedirec','value' => ''.e(__('ไฟล์เอกสาร')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                        <?php echo functionController::display_pdf($document_detail->doc_filedirec); ?>

                                            
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        ไฟล์เอกสารแนบ : 
                                        <?php if($document_detail->doc_attached_file != ''): ?>
                                        <button type="button" id="open_doc_attached_file"
                                            value="<?php echo e(asset($document_detail->doc_attached_file)); ?>"
                                            class="btn btn-outline-primary col start">
                                            <i class="fas fa-upload"></i>
                                            <span>open & download</span>
                                        </button>
                                        <?php else: ?>
                                        <label class="text-danger"><?php echo e(__('--ไม่พบไฟล์เอกสารแนบ--')); ?></label>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                         
                            <hr>
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
<?php endif; ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/edoclite_vmiw/resources/views/member/documents_transmission_all/detail.blade.php ENDPATH**/ ?>