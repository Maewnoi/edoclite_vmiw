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
                            เอกสารรับเข้าภายนอกรายละเอียด 
                        </div>
                        <div class="card-body table-responsive">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        ส่วนราชการ : <font class="text-primary"><?php echo e($document_retrun_inside_detail->docrtdt_government); ?></font>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        ที่ร่าง : <font class="text-primary"><?php echo e($document_retrun_inside_detail->docrtdt_draft); ?></font>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        วันที่ : <font class="text-primary"><?php echo e($document_retrun_inside_detail->docrtdt_date); ?></font>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        เรื่อง : <font class="text-primary"><?php echo e($document_retrun_inside_detail->docrtdt_topic); ?></font>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        ชั้นความเร็ว/สถานะ : 
                                        <?php echo functionController::funtion_docrtdt_speed($document_retrun_inside_detail->docrtdt_speed); ?>

                                        <?php echo functionController::funtion_docrt_status($document_retrun_inside_detail->docrt_status); ?>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        ประเภทเอกสาร : 
                                        <?php echo functionController::funtion_docrt_type($document_retrun_inside_detail->docrt_type); ?>

                                        
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
                                            <?php echo functionController::display_pdf($document_retrun_inside_detail->docrtdt_file); ?>

                                          

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="<?php echo e(route('documents_retrun_inside_work_retrun_respond')); ?>" method="post"
                                        enctype="multipart/form-data">
                                       <?php echo csrf_field(); ?>
                                        <div class="card card-body">
                                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['class' => 'text-lg','value' => ''.e(__('แก้ไขการตอบกลับ v45.65')).'']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'text-lg','value' => ''.e(__('แก้ไขการตอบกลับ v45.65')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                            <div class="row">
                                                <div class="col-md-12 table-responsive">
                                                <?php if($document_retrun_inside_detail->docrt_type == '0'): ?>
                                                <!-- //บันทึกข้อความ -->
                                                <div class="form-group"
                                                    id="documents_retrun_inside_work_retrunController_form-group_tb-docrt_details-message-memo">
                                                    <page id="documents_retrun_inside_work_retrunController_page"
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
                                                                    id="documents_retrun_inside_work_retrunController_docrtdt_government"
                                                                    name="docrtdt_government" type="text" value="<?php echo e($document_retrun_inside_detail->docrtdt_government); ?>">
                                                            </div>
                                                            <!-- // -->
                                                            <div class="col-2">
                                                                <p class="mt-3">ที่ร่าง</p>
                                                            </div>
                                                            <div class="col-4">
                                                                <input class="form-control form-control-border"
                                                                    id="documents_retrun_inside_work_retrunController_docrtdt_draft"
                                                                    name="docrtdt_draft" type="text" value="<?php echo e($document_retrun_inside_detail->docrtdt_draft); ?>">
                                                            </div>
                                                            <div class="col-2">
                                                                <p class="mt-3">วันที่</p>
                                                            </div>
                                                            <div class="col-4">
                                                                <input class="form-control form-control-border"
                                                                    id="documents_retrun_inside_work_retrunController_docrtdt_date"
                                                                    name="docrtdt_date" type="text" value="<?php echo e($document_retrun_inside_detail->docrtdt_date); ?>">
                                                            </div>
                                                            <!-- // -->
                                                            <div class="col-2">
                                                                <p class="mt-3">เรื่อง</p>
                                                            </div>
                                                            <div class="col-10">
                                                                <input class="form-control form-control-border"
                                                                    id="documents_retrun_inside_work_retrunController_docrtdt_topic"
                                                                    name="docrtdt_topic" type="text" value="<?php echo e($document_retrun_inside_detail->docrtdt_topic); ?>">
                                                            </div>
                                                            <!-- // -->
                                                            <div class="col-12">
                                                                <div class="mt-3 mb-14">
                                                                    <textarea id="documents_retrun_inside_work_retrunController_docrtdt_podium" class="form-control" rows="25" cols="75"name="docrtdt_podium"><?php echo e($document_retrun_inside_detail->docrtdt_podium); ?></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </page>
                                                    <input type="hidden" name="docrt_id" value="<?php echo e($document_retrun_inside_detail->docrt_id); ?>">
                                                    <input type="hidden" name="docrtdt_id"
                                                                        value="<?php echo e($document_retrun_inside_detail->docrtdt_id); ?>">
                                                    <input type="hidden" name="_token" id="_token" value="<?php echo e(csrf_token()); ?>" />

                                                    <input type="hidden" name="bt_respond" value="respond">
                                                    <div class="flex items-center justify-center mt-20">
                                                        <button type="button"
                                                            id="documents_retrun_inside_work_retrunController_bt_preview"
                                                            class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-900 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:shadow-outline-blue disabled:opacity-25">
                                                            <?php echo e(__('แสดงตัวอย่าง')); ?>

                                                        </button>
                                                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.button','data' => ['onclick' => 'submitForm(this);','id' => 'documents_retrun_inside_work_retrunController_bt_respond','disabled' => true]]); ?>
<?php $component->withName('jet-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['onclick' => 'submitForm(this);','id' => 'documents_retrun_inside_work_retrunController_bt_respond','disabled' => true]); ?>
                                                            <?php echo e(__('ตอบกลับอีกครั้ง')); ?>

                                                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                                    </div>
                                                    <label class="mt-2">หมายเหตุ : การตอบกลับนี้เอกสารจะเข้าหัวหน้าฝ่าย</label>
                                                </div>
                                                <?php elseif($document_retrun_inside_detail->docrt_type == '1'): ?>
                                                <!-- ตราครุฑ -->
                                                <div class="form-group"
                                                    id="documents_retrun_inside_work_retrunController_form-group_tb-docrt_details-garuda">
                                                    <page id="documents_retrun_inside_work_retrunController_page"
                                                        class="items-center block p-24 mx-auto bg-white shadow-2xl">
                                                        <div class="row">
                                                            <div class="col-3 pt-14">
                                                                <input class="form-control form-control-border"
                                                                    id="documents_retrun_inside_work_retrunController_docrtdt_draft-garuda"
                                                                    name="docrtdt_draft_garuda" type="text" value="ที่ร่าง">
                                                            </div>
                                                            <div class="col-5">
                                                                <img class="w-24 h-24 ml-20"
                                                                    src="<?php echo e(asset('/image/Garuda.jpeg')); ?>" alt="">
                                                            </div>
                                                            <div class="col-4 pt-14">
                                                                   <input class="form-control form-control-border"
                                                                    id="documents_retrun_inside_work_retrunController_docrtdt_government-garuda"
                                                                    name="docrtdt_government_garuda" type="text" value="<?php echo e($document_retrun_inside_detail->docrtdt_government); ?>">
                                                            </div>
                                                            <div class="col-5">
                                                            </div>
                                                            <div class="col-3">
                                                                <input class="mt-3 form-control form-control-border"
                                                                    id="documents_retrun_inside_work_retrunController_docrtdt_date-garuda"
                                                                    name="docrtdt_date_garuda" type="text" value="<?php echo e($document_retrun_inside_detail->docrtdt_date); ?>">
                                                            </div>
                                                            <div class="col-4">
                                                            </div>
                                                            <div class="col-2">
                                                                <p class="mt-3">เรื่อง</p>
                                                            </div>
                                                            <div class="col-10">
                                                                <input class="form-control form-control-border"
                                                                    id="documents_retrun_inside_work_retrunController_docrtdt_topic-garuda"
                                                                    name="docrtdt_topic_garuda" type="text" value="<?php echo e($document_retrun_inside_detail->docrtdt_topic); ?>">
                                                            </div>   
                                                            <div class="col-12">
                                                                <div class="mt-3 mb-14">
                                                                    <textarea id="documents_retrun_inside_work_retrunController_docrtdt_podium-garuda" class="form-control" rows="25" cols="75" name="docrtdt_podium_garuda"><?php echo e($document_retrun_inside_detail->docrtdt_podium); ?></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </page>
                                                    <input type="hidden" name="docrt_id_garuda" value="<?php echo e($document_retrun_inside_detail->docrt_id); ?>">
                                                    <input type="hidden" name="docrtdt_id_garuda"
                                                                        value="<?php echo e($document_retrun_inside_detail->docrtdt_id); ?>">
                                                    <input type="hidden" name="_token" id="_token" value="<?php echo e(csrf_token()); ?>" />

                                                    <input type="hidden" name="bt_respond" value="respond_garuda">
                                                    <div class="flex items-center justify-center mt-20">
                                                        <button type="button"
                                                            id="documents_retrun_inside_work_retrunController_bt_preview-garuda"
                                                            class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-900 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:shadow-outline-blue disabled:opacity-25">
                                                            <?php echo e(__('แสดงตัวอย่าง')); ?>

                                                        </button>
                                                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.button','data' => ['onclick' => 'submitForm(this);','id' => 'documents_retrun_inside_work_retrunController_bt_respond-garuda','disabled' => true]]); ?>
<?php $component->withName('jet-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['onclick' => 'submitForm(this);','id' => 'documents_retrun_inside_work_retrunController_bt_respond-garuda','disabled' => true]); ?>
                                                            <?php echo e(__('ตอบกลับอีกครั้ง')); ?>

                                                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                                    </div>
                                                    <label class="mt-2">หมายเหตุ : การตอบกลับนี้เอกสารจะเข้าหัวหน้าฝ่าย</label>
                                                </div>
                                                <?php elseif($document_retrun_inside_detail->docrt_type == '2'): ?>
                                                <div class="form-group"
                                                    id="documents_retrun_inside_work_retrunController_form-group_tb-docrt_details-normal">
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['class' => 'text-md','for' => 'docrtdt_government_normal','value' => ''.e(__('ส่วนราชการ')).'']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'text-md','for' => 'docrtdt_government_normal','value' => ''.e(__('ส่วนราชการ')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                                                <input class="form-control"
                                                                    name="docrtdt_government_normal" type="text" value="<?php echo e($document_retrun_inside_detail->docrtdt_government); ?>">
                                                        </div>
                                                        <div class="col-3">
                                                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['class' => 'text-md','for' => 'docrtdt_draft_normal','value' => ''.e(__('ที่ร่าง')).'']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'text-md','for' => 'docrtdt_draft_normal','value' => ''.e(__('ที่ร่าง')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                                                <input class="form-control"
                                                                    name="docrtdt_draft_normal" type="text" value="<?php echo e($document_retrun_inside_detail->docrtdt_draft); ?>">
                                                        </div>
                                                        <div class="col-3">
                                                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['class' => 'text-md','for' => 'docrtdt_date_normal','value' => ''.e(__('วันที่')).'']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'text-md','for' => 'docrtdt_date_normal','value' => ''.e(__('วันที่')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                                                <input class="form-control"
                                                                    name="docrtdt_date_normal" type="text" value="<?php echo e($document_retrun_inside_detail->docrtdt_date); ?>">
                                                        </div>
                                                        <div class="col-3">
                                                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['class' => 'text-md','for' => 'docrtdt_topic_normal','value' => ''.e(__('เรื่อง')).'']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'text-md','for' => 'docrtdt_topic_normal','value' => ''.e(__('เรื่อง')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                                                <input class="form-control"
                                                                    name="docrtdt_topic_normal" type="text" value="<?php echo e($document_retrun_inside_detail->docrtdt_topic); ?>">
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="docrt_id_normal" value="<?php echo e($document_retrun_inside_detail->docrt_id); ?>">
                                                    <input type="hidden" name="docrtdt_id_normal"
                                                                        value="<?php echo e($document_retrun_inside_detail->docrtdt_id); ?>">
                                                    <input type="hidden" name="_token" id="_token" value="<?php echo e(csrf_token()); ?>" />
                                                        
                                                    <div class="items-center justify-center mt-10">
                                                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['class' => 'text-md','for' => 'docrtdt_file','value' => ''.e(__('เอกสาร')).'']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'text-md','for' => 'docrtdt_file','value' => ''.e(__('เอกสาร')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                                        <input type="file" name="docrtdt_file" accept="application/pdf"
                                                            id="documents_retrun_inside_work_retrunController_docrtdt_file_normal"
                                                            class="form-control <?php $__errorArgs = ['docrtdt_file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                    </div>
                                                    <input type="hidden" name="bt_respond" value="respond_normal">
                                                    <div class="flex items-center justify-center mt-20">
                                                    
                                                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.button','data' => ['onclick' => 'submitForm(this);','id' => 'documents_retrun_inside_work_retrunController_bt_respond-normal','disabled' => true]]); ?>
<?php $component->withName('jet-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['onclick' => 'submitForm(this);','id' => 'documents_retrun_inside_work_retrunController_bt_respond-normal','disabled' => true]); ?>
                                                            <?php echo e(__('ตอบกลับอีกครั้ง')); ?>

                                                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                                    </div>
                                                        
                                                    <label class="mt-2">หมายเหตุ : การตอบกลับนี้เอกสารจะเข้าหัวหน้าฝ่าย</label>
                                                </div>
                                                <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>  
                                    </form>
                                </div>
                            </div>
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
                        id="documents_retrun_inside_work_retrunController_close-modal-preview">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <iframe id="documents_retrun_inside_work_retrunController_pdf_preview" frameborder="0" height="800px"
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
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/edoclite_vmiw/resources/views/member/documents_retrun_inside_work_retrun/detail.blade.php ENDPATH**/ ?>