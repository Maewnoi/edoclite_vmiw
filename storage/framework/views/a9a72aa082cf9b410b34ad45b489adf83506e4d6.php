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
                        <div class="card-body table-responsive">
                            <ul class="flex-row nav nav-pills">
                                <li class="nav-item active">
                                    <a href="#" class="nav-link active">
                                        <i class="fas fa-inbox"></i> เลขส่งภายนอก
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('reserve_number_delivery_inside_all')); ?>" class="nav-link">
                                        <i class="far fa-envelope"></i> เลขส่งภายใน
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="border shadow card border-info">
                        <div class="card-header bg-primary">รายการจองเลขส่งภายนอกทั้งหมด</div>
                        <div class="card-body table-responsive">
                            <table id="example1" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">ลำดับ</th>
                                        <th scope="col">เลขที่ถูกจอง</th>
                                  
                                        <th scope="col">ผู้จอง</th>
                                        <th scope="col">วันที่จอง</th>
                                        <th scope="col">สถานะ</th>
                                        <th scope="col">จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $reserve_delivery_numberS; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <th><?php echo e($loop->index+1); ?></th>
                                        <td><?php echo e($row->reserve_number); ?></td>
                          
                                        <td><?php echo e(functionController::funtion_users($row->reserve_owner)); ?></td>
                                        <td>
                                            <?php if($row->reserve_date != NULL): ?>
                                            <span class="badge bg-secondary"><?php echo e($row->reserve_date); ?></span>
                                            <p class="text-sm text-muted">
                                                <i class="mr-1 far fa-clock"></i>
                                                <?php echo e(Carbon\Carbon::parse($row->reserve_date)->diffForHumans()); ?>

                                            </p>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php echo functionController::funtion_reserve_status($row->reserve_status); ?>

                                        </td>
                                        <td>
                                            <?php if($row->reserve_status == '0' && $row->reserve_owner != Auth::user()->id): ?>

                                            <?php elseif($row->reserve_status == '0' && $row->reserve_owner ==
                                            Auth::user()->id): ?>
                                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.button','data' => ['dataToggle' => 'modal','dataTarget' => '#modal-cancel'.e($row->reserve_id).'']]); ?>
<?php $component->withName('jet-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['data-toggle' => 'modal','data-target' => '#modal-cancel'.e($row->reserve_id).'']); ?>
                                                <?php echo e(__('ยกเลิก')); ?>

                                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                            <?php elseif($row->reserve_status == '2'): ?>
                                            <?php elseif($row->reserve_status == '1'): ?>
                                            <?php if($row->reserve_used != NULL): ?>
                                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['value' => 'ผู้ใช้งาน :'.e(functionController::funtion_users($row->reserve_used)).'']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['value' => 'ผู้ใช้งาน :'.e(functionController::funtion_users($row->reserve_used)).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                            <?php endif; ?>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="modal-cancel<?php echo e($row->reserve_id); ?>">
                                        <div class="modal-dialog modal-l">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">คุณต้องการยกเลิกเลขที่จองนี้หรือไม่ ?
                                                    </h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="<?php echo e(route('cancel_reserve_number_delivery_all')); ?>" method="post">
                                                        <?php echo csrf_field(); ?>
                                                        <input type="hidden" name="reserve_id" class="form-control"
                                                            value="<?php echo e($row->reserve_id); ?>">
                                                        <input type="hidden" name="reserve_number" class="form-control"
                                                            value="<?php echo e($row->reserve_number); ?>">
                                                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.button','data' => ['onclick' => 'submitForm(this);']]); ?>
<?php $component->withName('jet-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['onclick' => 'submitForm(this);']); ?>
                                                            <?php echo e(__('ยืนยัน')); ?>

                                                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="row">
                        <?php if(Auth::user()->level == 3 || Auth::user()->level == 6): ?>
                        <div class="col-md-12">
                            <div class="border shadow card border-info">
                                <div class="card-header bg-primary">จองเลข</div>
                                    <div class="card-body">
                                        <form action="<?php echo e(route('add_reserve_number_delivery_all')); ?>" method="post">
                                            <?php echo csrf_field(); ?>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['for' => 'reserve_number','value' => ''.e(__('เลขที่ต้องการ')).'']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['for' => 'reserve_number','value' => ''.e(__('เลขที่ต้องการ')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                                        <input type="number" name="reserve_number"
                                                            min="<?php echo e(functionController::funtion_documents_doc_recnum_delivery_plus(Auth::user()->site_id)); ?>"
                                                            value="<?php echo e(functionController::funtion_documents_doc_recnum_delivery_plus(Auth::user()->site_id)); ?>"
                                                            class="form-control <?php $__errorArgs = ['reserve_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                            required>
                                                        <?php $__errorArgs = ['reserve_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <div class="my-2">
                                                            <p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p>
                                                        </div>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.button','data' => ['onclick' => 'submitForm(this);']]); ?>
<?php $component->withName('jet-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['onclick' => 'submitForm(this);']); ?>
                                                <?php echo e(__('จอง')); ?>

                                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- จองเลขอัตโนมัติ -->
                        <?php if(Auth::user()->level == 3): ?>
                        <div class="col-md-12">
                            <div class="border shadow card border-info">
                                <div id="auto_reserve_number_header_card" class="card-header <?php if($check_auto_reserve_number): ?> <?php echo e('bg-success'); ?> <?php else: ?> <?php echo e('bg-danger'); ?>  <?php endif; ?> ">ตั้งค่าการจองเลขอัตโนมัติ</div>
                                    <div class="card-body">
                                        <div class="row">
                                            <!-- เปิด ปิด -->
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <input type="radio" class="btn-check" name="auto_reserve_number_options-radio" value="0"
                                                    id="auto_reserve_number_danger-radio" autocomplete="off" <?php if(!$check_auto_reserve_number): ?> checked <?php endif; ?> >
                                                    <label class="btn btn-outline-danger" for="auto_reserve_number_danger-radio">ปิด</label>

                                                    <input type="radio" class="btn-check" name="auto_reserve_number_options-radio" value="1"
                                                    id="auto_reserve_number_success-radio" autocomplete="on" <?php if($check_auto_reserve_number): ?> checked <?php endif; ?>>
                                                    <label class="btn btn-outline-success" for="auto_reserve_number_success-radio">เปิด</label>
                                                </div>
                                                <hr>
                                            </div>
                                         
                                            <div class="<?php if($check_auto_reserve_number): ?> <?php else: ?> <?php echo e('hide'); ?> <?php endif; ?> " id="auto_reserve_number_form_card">
                                                <!-- จำนวนเลข -->
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['for' => '','value' => ''.e(__('จำนวนเลขที่ต้องการจอง')).'']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['for' => '','value' => ''.e(__('จำนวนเลขที่ต้องการจอง')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                                        <select class="form-control select2bs4"
                                                            name="arn_quantity" id="auto_reserve_number_arn_quantity" required>
                                                            <?php if($check_auto_reserve_number): ?>
                                                            <option selected value="<?php echo e($check_auto_reserve_number->arn_quantity); ?>"><?php echo e($check_auto_reserve_number->arn_quantity); ?></option>
                                                            <option value="1">1</option>
                                                            <?php else: ?>
                                                            <option selected value="1">1</option>
                                                            <?php endif; ?>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                            <option value="7">7</option>
                                                            <option value="8">8</option>
                                                            <option value="9">9</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <input type="hidden" id="auto_reserve_number_arn_template" value="delivery">
                                                <input type="hidden" id="auto_reserve_number_arn_user_id" value="<?php echo e(Auth::user()->id); ?>">
                                                <input type="hidden" id="auto_reserve_number_csrf_token" value="<?php echo e(csrf_token()); ?>">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="mt-2 text-danger">หมายเหตุ : ระบบจะจองเลขอัตโนมัติเวลา 00.01 ของทุกวันเมื่อมีการเปิดใช้งาน</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
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
<?php endif; ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/edoclite_vmiw/resources/views/member/reserve_number_delivery_all/index.blade.php ENDPATH**/ ?>