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
                        <div class="card-header bg-primary">
                            <div class="clearfix">
                            รักษาการแทน
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="example1" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">ลำดับ</th>
                                        <th scope="col">ชื่อ-นามสกุล</th>
                                        <th scope="col">ตำแหน่ง</th>
                                        <th scope="col">กองงาน</th>
                                        <th scope="col">ฝ่าย</th>
                                        <th scope="col">สิทธิ์การเข้าถึง</th>
                                        <th scope="col">จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <input type="hidden" name="replaceController_token" id="replaceController_token" value="<?php echo e(csrf_token()); ?>" />
                                    <?php $__currentLoopData = $memberS; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <th><?php echo e($loop->index+1); ?></th>
                                        <td><?php echo e($row['name']); ?></td>
                                        <td><?php echo e($row['pos']); ?></td>
                                        <td><?php echo e(functionController::funtion_groupmem_name($row['group'])); ?></td>
                                        <td><?php echo e(functionController::funtion_cottons($row['cotton'])); ?></td>
                                        <td><?php echo e(functionController::funtion_user_level($row['level'])); ?></td>
                                        <td>
                                            <div class="flex items-center mr-4">
                                                <input id="replaceController-checkbox" data-id="<?php echo e($row['id']); ?>" type="checkbox" class="w-4 h-4 text-purple-600 bg-gray-100 border-gray-300 rounded name-replaceController-checkbox focus:ring-purple-500 dark:focus:ring-purple-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                                <?php if(functionController::funtion_replaces($row['id']) == '1'): ?>
                                                checked
                                                <?php elseif(functionController::funtion_replaces($row['id']) == '0'): ?>
                                                <?php endif; ?>
                                                >
                                                <label for="replaceController-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">รักษาการแทนน</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
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
<?php endif; ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/edoclite_vmiw/resources/views/member/replace/index.blade.php ENDPATH**/ ?>