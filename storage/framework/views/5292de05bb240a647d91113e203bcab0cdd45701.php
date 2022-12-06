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
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.nav-link','data' => ['href' => ''.e(url('/documents_pending/all')).'']]); ?>
<?php $component->withName('jet-nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['href' => ''.e(url('/documents_pending/all')).'']); ?>
                                <i class="fa fa-arrow-left"></i>
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                            เอกสารรับเข้าภายนอกรายละเอียด : <?php echo e($document_detail->doc_origin); ?>

                        </div>
                        <div class="card-body table-responsive">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        เลขที่รับส่วนงาน : <font class="text-primary"><?php echo e($document_detail->doc_recnum); ?></font>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                       เลขที่หนังสือ : <font class="text-primary"><?php echo e($document_detail->doc_docnum); ?></font>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        วันที่ : <font class="text-primary"><?php echo e($document_detail->doc_date); ?></font>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        ลงวันที่ : <font class="text-primary"><?php echo e($document_detail->doc_date); ?></font>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        เวลา : <font class="text-primary"><?php echo e($document_detail->doc_time); ?></font>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        ชั้นความเร็ว/สถานะ : 
                                        <?php echo functionController::funtion_doc_speed($document_detail->doc_speed); ?>

                                        <?php echo functionController::funtion_sub2_status($document_detail->sub2_status); ?>

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        เรื่อง : <font class="text-primary"><?php echo e($document_detail->doc_title); ?></font>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['class' => 'text-md','for' => 'doc_filedirec_1','value' => ''.e(__('ไฟล์เอกสาร')).'']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'text-md','for' => 'doc_filedirec_1','value' => ''.e(__('ไฟล์เอกสาร')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                        <?php if($document_detail->sub_status == '8'): ?>
                                        <?php echo functionController::display_pdf($document_detail->seal_file); ?>

                                        <?php else: ?>
                                        <?php echo functionController::display_pdf($document_detail->doc_filedirec_1); ?>

                                        <?php endif; ?>

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['class' => 'text-md','for' => '','value' => ''.e(__('ไฟล์เอกสารแนบ')).'']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'text-md','for' => '','value' => ''.e(__('ไฟล์เอกสารแนบ')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
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
                                <?php if(functionController::display_pdf_sub3_doc($document_detail->sub_id) != ''): ?>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['class' => 'text-md','for' => 'doc_filedirec_1','value' => ''.e(__('บันทึกข้อความตอบกลับ')).'']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'text-md','for' => 'doc_filedirec_1','value' => ''.e(__('บันทึกข้อความตอบกลับ')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                        <?php echo functionController::display_pdf(functionController::display_pdf_sub3_doc($document_detail->sub_id)); ?>


                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="callout callout-danger"> 
                                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['class' => 'text-lg','value' => ''.e(__('สถานะ')).'']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'text-lg','value' => ''.e(__('สถานะ')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                            <?php if($document_detail->sub2_status == '0'): ?>
                                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['class' => 'text-red-500 text-md','value' => ''.e(__('--ยังไม่อ่าน--')).'']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'text-red-500 text-md','value' => ''.e(__('--ยังไม่อ่าน--')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                            <?php elseif($document_detail->sub2_status == '1'): ?>
                                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['class' => 'text-green-500 text-md','value' => ''.e(__('--อ่านแล้ว--')).'']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'text-green-500 text-md','value' => ''.e(__('--อ่านแล้ว--')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="callout callout-danger"> 
                                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['class' => 'text-lg','value' => ''.e(__('สถานะตอบกลับ')).'']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'text-lg','value' => ''.e(__('สถานะตอบกลับ')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                            <?php if($sub3_doc_detail): ?>
                                            <?php echo functionController::funtion_sub3_status($sub3_doc_detail->sub3_status); ?>

                                            <?php else: ?>
                                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['class' => 'text-green-500 text-md','value' => ''.e(__('--ไม่ตอบกลับ--')).'']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'text-green-500 text-md','value' => ''.e(__('--ไม่ตอบกลับ--')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if($document_detail->sub2_status == '0'): ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="<?php echo e(route('documents_admission_work_detail_respond')); ?>" method="post"
                                        enctype="multipart/form-data">
                                       <?php echo csrf_field(); ?>
                                       <input type="hidden" id="documents_admission_work_allController_check_respond" name="bt_respond" value="">
                                        <div class="card card-body">
                                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['class' => 'text-lg','value' => ''.e(__('ตอบกลับ v45.65')).'']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'text-lg','value' => ''.e(__('ตอบกลับ v45.65')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <select name="sub3_type"
                                                            id="documents_admission_work_allController_sub3_type"
                                                            required
                                                            class="form-control select2bs4 <?php $__errorArgs = ['sub3_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                            <option value="">
                                                                เลือกประเภท
                                                            </option>
                                                            <option value="0">
                                                                บันทึกข้อความ
                                                            </option>
                                                            <option value="1">
                                                                ตราครุฑ
                                                            </option>
                                                        </select>
                                                        <?php $__errorArgs = ['sub3_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <div class="my-2">
                                                            <p class="mt-2 text-sm text-red-600">
                                                                <?php echo e($message); ?></p>
                                                        </div>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <select name="sub3d_speed" required
                                                            class="form-control select2bs4 <?php $__errorArgs = ['sub3d_speed'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                            id="documents_admission_work_allController_sub3d_speed">
                                                            <option value="">
                                                                เลือกชั้นความเร็ว
                                                            </option>
                                                            <option value="0">ปกติ</option>
                                                            <option value="1">ด่วน</option>
                                                            <option value="2">ด่วนมาก</option>
                                                            <option value="3">ด่วนที่สุด</option>
                                                        </select>
                                                        <?php $__errorArgs = ['sub3d_speed'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <div class="my-2">
                                                            <p class="mt-2 text-sm text-red-600">
                                                                <?php echo e($message); ?></p>
                                                        </div>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 table-responsive">
                                                    <div class="form-group hide"
                                                        id="documents_admission_work_allController_form-group_tb-sub3_details-garuda">
                                                        <page id="documents_admission_work_allController_page"
                                                            class="items-center block p-24 mx-auto bg-white shadow-2xl">
                                                            <div class="row">
                                                                <div class="col-3 pt-14">
                                                                    <input class="form-control form-control-border"
                                                                        id="documents_admission_work_allController_sub3d_draft-garuda"
                                                                        name="sub3d_draft_garuda" type="text" value="ที่ร่าง">
                                                                </div>
                                                                <div class="col-5">
                                                                    <img class="w-24 h-24 ml-20"
                                                                        src="<?php echo e(asset('/image/Garuda.jpeg')); ?>" alt="">
                                                                </div>
                                                                <div class="col-4 pt-14">
                                                                    <input class="form-control form-control-border"
                                                                        id="documents_admission_work_allController_sub3d_government-garuda"
                                                                        name="sub3d_government_garuda" type="text" value="องค์การบริหาร">
                                                                </div>
                                                                <div class="col-5">
                                                                </div>
                                                                <div class="col-3">
                                                                    <input class="mt-3 form-control form-control-border"
                                                                        id="documents_admission_work_allController_sub3d_date-garuda"
                                                                        name="sub3d_date_garuda" type="text" value="21 oct 1988">
                                                                </div>
                                                                <div class="col-4">
                                                                </div>
                                                                <div class="col-2">
                                                                    <p class="mt-3">เรื่อง</p>
                                                                </div>
                                                                <div class="col-10">
                                                                    <input class="form-control form-control-border"
                                                                        id="documents_admission_work_allController_sub3d_topic-garuda"
                                                                        name="sub3d_topic_garuda" type="text" value="">
                                                                </div>   
                                                                <div class="col-12">
                                                                    <div class="mt-3 mb-14">
                                                                        <textarea id="documents_admission_work_allController_sub3d_podium-garuda" class="form-control" rows="25" cols="75" name="sub3d_podium_garuda">เรียน ...</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </page>
                                                        <input type="hidden" name="doc_id_garuda" value="<?php echo e($document_detail->doc_id); ?>">
                                                        <input type="hidden" name="sub_id_garuda" value="<?php echo e($document_detail->sub_id); ?>">
                                                        <input type="hidden" name="sub2_id_garuda" value="<?php echo e($document_detail->sub2_id); ?>">
                                                        <input type="hidden" name="doc_docnum_garuda" value="<?php echo e($document_detail->doc_docnum); ?>">
                                                        <input type="hidden" name="doc_origin_garuda" value="<?php echo e($document_detail->doc_origin); ?>">
                                                        <input type="hidden" name="doc_title_garuda" value="<?php echo e($document_detail->doc_title); ?>">

                                                        <div class="flex items-center justify-center mt-20">
                                                            <button type="button"
                                                                id="documents_admission_work_allController_bt_preview-garuda"
                                                                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-900 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:shadow-outline-blue disabled:opacity-25">
                                                                <?php echo e(__('แสดงตัวอย่าง')); ?>

                                                            </button>
                                                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.button','data' => ['onclick' => 'submitForm(this);','id' => 'documents_admission_work_allController_bt_respond-garuda','disabled' => true]]); ?>
<?php $component->withName('jet-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['onclick' => 'submitForm(this);','id' => 'documents_admission_work_allController_bt_respond-garuda','disabled' => true]); ?>
                                                                <?php echo e(__('ตอบกลับ')); ?>

                                                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                                        </div>
                                                        
                                                        <label class="mt-2">หมายเหตุ : การตอบกลับนี้เอกสารจะเข้าหัวหน้าฝ่าย</label>
                                                    </div>
                                                    <div class="form-group hide"
                                                        id="documents_admission_work_allController_form-group_tb-sub3_details-message-memo">
                                                        <page id="documents_admission_work_allController_page"
                                                            class="items-center block p-24 mx-auto bg-white shadow-2xl">
                                                            <div class="row">
                                                                <div class="col-5">
                                                                    <img class="w-16 h-16"
                                                                        src="<?php echo e(asset('/image/Garuda.jpeg')); ?>" alt="">
                                                                </div>
                                                                <div class="col-7">
                                                                    <label class="mt-6">บันทึกข้อความ</label>
                                                                </div>
                                                                <!-- // -->
                                                                <div class="col-3">
                                                                    <p class="mt-6">ส่วนราชการ</p>
                                                                </div>
                                                                <div class="col-9">
                                                                    <input class="mt-2 form-control form-control-border"
                                                                        id="documents_admission_work_allController_sub3d_government"
                                                                        name="sub3d_government" type="text" value="">
                                                                </div>
                                                                <!-- // -->
                                                                <div class="col-2">
                                                                    <p class="mt-3">ที่ร่าง</p>
                                                                </div>
                                                                <div class="col-4">
                                                                    <input class="form-control form-control-border"
                                                                        id="documents_admission_work_allController_sub3d_draft"
                                                                        name="sub3d_draft" type="text" value="">
                                                                </div>
                                                                <div class="col-2">
                                                                    <p class="mt-3">วันที่</p>
                                                                </div>
                                                                <div class="col-4">
                                                                    <input class="form-control form-control-border"
                                                                        id="documents_admission_work_allController_sub3d_date"
                                                                        name="sub3d_date" type="text" value="">
                                                                </div>
                                                                <!-- // -->
                                                                <div class="col-2">
                                                                    <p class="mt-3">เรื่อง</p>
                                                                </div>
                                                                <div class="col-10">
                                                                    <input class="form-control form-control-border"
                                                                        id="documents_admission_work_allController_sub3d_topic"
                                                                        name="sub3d_topic" type="text" value="">
                                                                </div>
                                                                <!-- // -->
                                                                <div class="col-12">
                                                                    <div class="mt-3 mb-14">
                                                                        <textarea id="documents_admission_work_allController_sub3d_podium" class="form-control" rows="25" cols="75"name="sub3d_podium">เรียน ...</textarea>
                                                                    </div>
                                                                </div>
                                                                <!-- // -->
                                                                <!-- <div class="col-12">
                                                                    <div class="col-3">
                                                                        <select
                                                                            class="ml-32 form-control form-control-border"
                                                                            id="documents_admission_work_allController_sub3d_therefore"
                                                                            name="sub3d_therefore">
                                                                            <option value="test">
                                                                                test
                                                                            </option>
                                                                            <option value="test2">
                                                                                test2
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="col-3">
                                                                        <select
                                                                            class="ml-64 form-control form-control-border"
                                                                            id="documents_admission_work_allController_sub3d_pos"
                                                                            name="sub3d_pos">

                                                                            <option value="test">
                                                                                test
                                                                            </option>
                                                                            <option value="test2">
                                                                                test2
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                </div> -->
                                                            </div>
                                                        </page>
                                                        <input type="hidden" name="doc_id" value="<?php echo e($document_detail->doc_id); ?>">
                                                        <input type="hidden" name="sub_id" value="<?php echo e($document_detail->sub_id); ?>">
                                                        <input type="hidden" name="sub2_id" value="<?php echo e($document_detail->sub2_id); ?>">
                                                        <input type="hidden" name="doc_docnum" value="<?php echo e($document_detail->doc_docnum); ?>">
                                                        <input type="hidden" name="doc_origin" value="<?php echo e($document_detail->doc_origin); ?>">
                                                        <input type="hidden" name="doc_title" value="<?php echo e($document_detail->doc_title); ?>">
                                                        <input type="hidden" name="_token" id="_token" value="<?php echo e(csrf_token()); ?>" />
                                                       
                                                   
                                                        <div class="flex items-center justify-center mt-20">
                                                            <button type="button"
                                                                id="documents_admission_work_allController_bt_preview"
                                                                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-900 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:shadow-outline-blue disabled:opacity-25">
                                                                <?php echo e(__('แสดงตัวอย่าง')); ?>

                                                            </button>
                                                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.button','data' => ['onclick' => 'submitForm(this);','id' => 'documents_admission_work_allController_bt_respond','disabled' => true]]); ?>
<?php $component->withName('jet-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['onclick' => 'submitForm(this);','id' => 'documents_admission_work_allController_bt_respond','disabled' => true]); ?>
                                                                <?php echo e(__('ตอบกลับ')); ?>

                                                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                                        </div>
                                                        
                                                        <label class="mt-2">หมายเหตุ : การตอบกลับนี้เอกสารจะเข้าหัวหน้าฝ่าย</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <?php endif; ?>
                            <hr>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal preview -->
    <div class="modal fade" id="modal-preview">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="bg-indigo-300 modal-header">
                    <label class="modal-title">ตัวอย่างเอกสาร
                    </label>
                    <button type="button"
                        id="documents_admission_work_allController_close-modal-preview">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <iframe id="documents_admission_work_allController_pdf_preview" frameborder="0" height="800px"
                            width="100%">
                        </iframe>
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
<?php endif; ?>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/edoclite_vmiw/resources/views/member/documents_admission_work_all/detail.blade.php ENDPATH**/ ?>