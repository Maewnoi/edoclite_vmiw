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
                                <div class="col-md-3">
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

                                        <?php echo functionController::funtion_sub_status($document_detail->sub_status); ?>

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
                            </div>
                            <?php if($document_detail->doc_status == 'success'): ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="callout callout-danger">
                                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['class' => 'text-lg','value' => ''.e(__('สถานะการลงรับหนังสือ')).'']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'text-lg','value' => ''.e(__('สถานะการลงรับหนังสือ')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                            <table>
                                                <?php $__currentLoopData = $sub_docsS; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row_sub_docs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e(functionController::funtion_groupmem_name($row_sub_docs->sub_recid)); ?></td>
                                                    <td><?php echo functionController::funtion_sub_status_detail($row_sub_docs->sub_status); ?>

                                                    </td>
                                                    <?php if($row_sub_docs->sub_status == 8): ?>
                                                        <td><?php echo functionController::funtion_sub2_recid_name($row_sub_docs->sub_id); ?><hr></td>
                                                    <?php endif; ?>
                                                    

                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                
                                               
                                            </table>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <?php endif; ?>

                            <?php if($document_detail->sub_status == '0'): ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="<?php echo e(route('documents_admission_group_takedown')); ?>" method="post"
                                        enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        <div class="card card-body">
                                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['class' => 'text-lg','value' => ''.e(__('ตำแหน่งประทับตรา')).'']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'text-lg','value' => ''.e(__('ตำแหน่งประทับตรา')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                            <div class="form-group">
                                               <!-- <input type="range" name="seal_point" class="form-range" min="10" value="20"
                                                    max="160" step="1"> -->
                                                    <input type="radio" id="seal_point" name="seal_point" value="1"> ตำแหน่งที่ 1 &nbsp;&nbsp;
                                                    <input type="radio" id="seal_point" name="seal_point" value="2"> ตำแหน่งที่ 2 &nbsp;&nbsp;
                                                    <input type="radio" id="seal_point" name="seal_point" value="3"> ตำแหน่งที่ 3 &nbsp;&nbsp;
                                                    <input type="radio" id="seal_point" name="seal_point" value="4" checked > ตำแหน่งที่ 4  &nbsp;&nbsp;
                                                    <input type="radio" id="seal_point" name="seal_point" value="5"> ตำแหน่งที่ 5 &nbsp;&nbsp;<br/>
                                                    <img src="<?php echo e(asset('/image/seal_point.jpg')); ?>" alt="Girl in a jacket" width="500" height="auto">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['class' => 'text-md','value' => ''.e(__('เลขที่รับ')).'']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'text-md','value' => ''.e(__('เลขที่รับ')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                                        <select
                                                            class="form-control select2bs4 <?php $__errorArgs = ['sub_recnum'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                            name="sub_recnum" required id="documents_admission_group_allController_sub_recnum">
                                                            <optgroup label="เลขรันปกติ">
                                                                <option
                                                                    value="<?php echo e(functionController::funtion_documents_doc_recnum_inside_plus(Auth::user()->site_id)); ?>">
                                                                    ( <?php echo e(functionController::funtion_documents_doc_recnum_inside_plus(Auth::user()->site_id)); ?> )
                                                                </option>
                                                            </optgroup>
                                                            <optgroup label="เลขที่จองไว้">
                                                                <?php $__currentLoopData = $reserved_numbersS; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row_reserved_numbers): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option
                                                                    value="<?php echo e($row_reserved_numbers->reserve_number); ?>" data-id="<?php echo e($row_reserved_numbers->reserve_id); ?>">
                                                                    ( <?php echo e($row_reserved_numbers->reserve_number); ?> ) <?php echo e(functionController::funtion_date_format($row_reserved_numbers->reserve_date)); ?>

                                                                </option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </optgroup>
                                                            <optgroup label="เลขที่หลุดจอง">
                                                                <?php $__currentLoopData = $dropped_numbersS; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row_dropped_numbers): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option
                                                                    value="<?php echo e($row_dropped_numbers->reserve_number); ?>" data-id="<?php echo e($row_dropped_numbers->reserve_id); ?>">
                                                                    ( <?php echo e($row_dropped_numbers->reserve_number); ?> ) <?php echo e(functionController::funtion_date_format($row_dropped_numbers->reserve_date)); ?>

                                                                </option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </optgroup>
                                                        </select>
                                                        <?php $__errorArgs = ['sub_recnum'];
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
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['class' => 'text-md','value' => ''.e(__('วันที่')).'']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'text-md','value' => ''.e(__('วันที่')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                                        <input type="date" name="sub_date" value="<?php echo e(date('Y-m-d')); ?>"
                                                            id="documents_admission_group_allController_sub_date"
                                                            class="form-control <?php $__errorArgs = ['sub_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                            required>
                                                        <?php $__errorArgs = ['sub_date'];
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
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['class' => 'text-md','value' => ''.e(__('เวลา')).'']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'text-md','value' => ''.e(__('เวลา')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                                        <input type="time" name="sub_time" value="<?php echo e(date('H:i')); ?>"
                                                            class="form-control <?php $__errorArgs = ['sub_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                            required>
                                                        <?php $__errorArgs = ['sub_time'];
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
                                                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['class' => 'text-md','value' => ''.e(__('เลือกผู้พิจารณา')).'']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'text-md','value' => ''.e(__('เลือกผู้พิจารณา')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                                        <select
                                                            class="form-control select2bs4 <?php $__errorArgs = ['sign_goup_0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                            name="sign_goup_0"
                                                            id="documents_admission_group_allController_sign_goup_0">
                                                            <option value="">ไม่มีผู้พิจารณา</option>
                                                            <optgroup label="หัวหน้าฝ่าย">
                                                                <?php $__currentLoopData = $userS_0; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row_userS_0): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($row_userS_0->id); ?>">
                                                                    <?php echo e($row_userS_0->name." ".$row_userS_0->pos); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </optgroup>
                                                            <optgroup label="หัวหน้ากอง">
                                                                <?php $__currentLoopData = $userS_1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row_userS_1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($row_userS_1->id); ?>">
                                                                    <?php echo e($row_userS_1->name." ".$row_userS_0->pos); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                    <?php $__errorArgs = ['sign_goup_0'];
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
                                                <div class="col-md-6">
                                                    <div class="form-group"
                                                        id="documents_admission_group_allController_form-group_selected_multiple_sub2_recid">
                                                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['class' => 'text-md','value' => ''.e(__('เลือกผู้รับ')).'']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'text-md','value' => ''.e(__('เลือกผู้รับ')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                                        <select name="sub2_recid[]"
                                                            id="documents_admission_group_allController_selected_multiple_sub2_recid"
                                                            multiple="multiple" required
                                                            class=" <?php $__errorArgs = ['sub2_recid'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                            <?php $__currentLoopData = $userS_2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row_userS_2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($row_userS_2->id); ?>">
                                                                <?php echo e($row_userS_2->name); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                        <?php $__errorArgs = ['sub2_recid'];
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
                                            </div>
                                            <input type="hidden" name="doc_id" value="<?php echo e($document_detail->doc_id); ?>"
                                                class="form-control" required>
                                            <input type="hidden" name="sub_id" value="<?php echo e($document_detail->sub_id); ?>"
                                                class="form-control" required>

                                            <input type="hidden" name="doc_docnum"
                                                value="<?php echo e($document_detail->doc_docnum); ?>" class="form-control">
                                            <input type="hidden" name="doc_origin"
                                                value="<?php echo e($document_detail->doc_origin); ?>" class="form-control">
                                            <input type="hidden" name="doc_title"
                                                value="<?php echo e($document_detail->doc_title); ?>" class="form-control">

                                            <input type="hidden" name="doc_recnum"
                                                value="<?php echo e($document_detail->doc_recnum); ?>" class="form-control">
                                            <input type="hidden" name="doc_date" value="<?php echo e($document_detail->doc_date); ?>"
                                                class="form-control">
                                            <input type="hidden" name="doc_time" value="<?php echo e($document_detail->doc_time); ?>"
                                                class="form-control">

                                            <input type="hidden" name="doc_filedirec_1"
                                                value="<?php echo e($document_detail->doc_filedirec_1); ?>" class="form-control">

                                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.button','data' => ['onclick' => 'submitForm(this);']]); ?>
<?php $component->withName('jet-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['onclick' => 'submitForm(this);']); ?>
                                                <?php echo e(__('save')); ?>

                                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
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
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\edoclite\resources\views/member/documents_admission_group_all/detail.blade.php ENDPATH**/ ?>