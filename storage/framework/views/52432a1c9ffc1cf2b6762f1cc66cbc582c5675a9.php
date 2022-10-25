<?php
use App\Http\Controllers\functionController;
?>
<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
    <!--  <?php $__env->slot('header'); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            สวัสดี , <?php echo e(Auth::user()->name); ?>

        </h2>
     <?php $__env->endSlot(); ?> -->
    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-body table-responsive">
                            <ul class="nav nav-pills flex-row">
                                <li class="nav-item">
                                    <a href="<?php echo e(route('reserve_number_receive_all')); ?>" class="nav-link">
                                        <i class="fas fa-inbox"></i> เลขรับภายนอก
                                    </a>
                                </li>
                                <li class="nav-item active">
                                    <a href="#" class="nav-link active">
                                        <i class="far fa-envelope"></i> เลขรับภายใน
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <?php if(session("success")): ?>
                    <div class="alert shadow alert-success"><?php echo e(session('success')); ?></div>
                    <?php endif; ?>
                    <?php if($errors->any()): ?>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="alert shadow alert-danger"><?php echo e($error); ?></div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                    <div class="card shadow">
                        <div class="card-header">รายการจองเลขรับภายในทั้งหมด</div>
                        <div class="card-body table-responsive">
                            <table id="example1" class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">ลำดับ</th>
                                        <th scope="col">เลขที่ถูกจอง</th>
                                        <th scope="col">ผู้จอง</th>
                                        <th scope="col">วันที่จอง</th>
                                        <th scope="col">สถานะ</th>
                                        <th scope="col">กอง</th>
                                        <th scope="col">จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $reserve_inside_numberS; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <th><?php echo e($loop->index+1); ?></th>
                                        <td><?php echo e($row->reserve_number); ?></td>
                                        <td><?php echo e(functionController::funtion_users($row->reserve_owner)); ?></td>
                                        <td>
                                            <?php if($row->reserve_date != NULL): ?>
                                            <span class="badge bg-secondary"><?php echo e($row->reserve_date); ?></span>
                                            <p class="text-sm text-muted">
                                                <i class="far fa-clock mr-1"></i>
                                                <?php echo e(Carbon\Carbon::parse($row->reserve_date)->diffForHumans()); ?>

                                            </p>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php echo functionController::funtion_reserve_status($row->reserve_status); ?>

                                        </td>
                                        <td>
                                            <?php echo e(functionController::funtion_groupmem_name($row->reserve_group)); ?>

                                        </td>
                                        <td>
                                            <?php if($row->reserve_status == '0' && $row->reserve_owner != Auth::user()->id): ?>

                                            <?php elseif($row->reserve_status == '0' && $row->reserve_owner ==
                                            Auth::user()->id): ?> 
                                            <?php if(Auth::user()->level=='6'): ?>
                                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.button','data' => ['dataToggle' => 'modal','dataTarget' => '#modal-cancel'.e($row->reserve_id).'']]); ?>
<?php $component->withName('jet-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['data-toggle' => 'modal','data-target' => '#modal-cancel'.e($row->reserve_id).'']); ?>
                                                <?php echo e(__('ยกเลิก')); ?>

                                             <?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
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
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
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
                                                    <form action="<?php echo e(route('cancel_reserve_number_receive_inside_all')); ?>"
                                                        method="post">
                                                        <?php echo csrf_field(); ?>
                                                        <input type="hidden" name="reserve_id" class="form-control"
                                                            value="<?php echo e($row->reserve_id); ?>">
                                                        <input type="hidden" name="reserve_number" class="form-control"
                                                            value="<?php echo e($row->reserve_number); ?>">
                                                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.button','data' => []]); ?>
<?php $component->withName('jet-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
                                                            <?php echo e(__('ยืนยัน')); ?>

                                                         <?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
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
                    <div class="card shadow">
                        <div class="card-header">จองเลข</div>
                        <div class="card-body">
                            <?php if(Auth::user()->level=='6'): ?>
                            <form action="<?php echo e(route('add_reserve_number_receive_inside_all')); ?>" method="post">
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
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                                            <input type="number" name="reserve_number"
                                                min="<?php echo e(functionController::funtion_documents_doc_recnum_inside_plus(Auth::user()->site_id)); ?>"
                                                value="<?php echo e(functionController::funtion_documents_doc_recnum_inside_plus(Auth::user()->site_id)); ?>"
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
                                                <p class="text-sm text-red-600 mt-2"><?php echo e($message); ?></p>
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
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.button','data' => []]); ?>
<?php $component->withName('jet-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
                                    <?php echo e(__('จอง')); ?>

                                 <?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                                <?php endif; ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 <?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\edoclite\resources\views/member/reserve_number_receive_inside_all/index.blade.php ENDPATH**/ ?>