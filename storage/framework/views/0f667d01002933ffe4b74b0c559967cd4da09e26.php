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
                <div class="col-md-9">

                    <div class="border shadow card border-info">
                        <div class="card-header">ตารางข้อมูล Sites</div>
                        <div class="card-body table-responsive">
                            <table id="example1" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">ลำดับ</th>
                                        <th scope="col">ชื่อ</th>
                                        <th scope="col">เส้นทางเก็บไฟล์ (แก้ไขไม่ได้)</th>
                                        <th scope="col">ขนาดการใช้งาน</th>
                                        <th scope="col">วันที่สร้าง</th>
                                        <th scope="col">วันที่อัพเดต</th>
                                        <th scope="col">ระบบเข้ารหัสเอกสารด้วย CA</th>
                                        <th scope="col">จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $sitesrS; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $site_size_ltd_explode = explode(" ", $row->site_size_ltd); ?>
                                    <tr>
                                        <th><?php echo e($loop->index+1); ?></th>
                                        <td><?php echo e($row->site_name); ?></td>
                                        <td><p class="text-sm text-muted"><?php echo e(substr($row->site_path_folder, 0, -25)); ?></p></td>
                                        <td><span class="badge bg-secondary"><?php echo functionController::format_Size(functionController::folder_Size("image/".$row->site_path_folder)); ?> / <?php if($row->site_size_ltd == '-'): ?> <?php echo e('ไม่จำกัด'); ?> <?php else: ?> <?php echo e($row->site_size_ltd); ?> <?php endif; ?> </span></td>
                                        <td>
                                            <?php if($row->site_created_at != NULL): ?>
                                            <span
                                                class="badge bg-secondary"><?php echo e($row->site_created_at); ?></span>
                                            <p class="text-sm text-muted">
                                                <i class="mr-1 far fa-clock"></i>
                                                <?php echo e(Carbon\Carbon::parse($row->site_created_at)->diffForHumans()); ?>

                                            </p>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($row->site_updated_at != NULL): ?>
                                            <span
                                                class="badge bg-secondary"><?php echo e($row->site_updated_at); ?></span>
                                            <p class="text-sm text-muted">
                                                <i class="mr-1 far fa-clock"></i>
                                                <?php echo e(Carbon\Carbon::parse($row->site_updated_at)->diffForHumans()); ?>

                                            </p>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input check_site_ca" type="checkbox" <?php echo e($row->site_ca == '1' ? 'checked="checked"' : ''); ?>

                                                 name="site_ca" id="check_site_ca" data-id="<?php echo e($row->site_id); ?>" data-token="<?php echo e(csrf_token()); ?>">
                                                <label class="form-check-label" for=check_site_ca">
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <button type="button" data-toggle="modal"
                                                data-target="#modal-update<?php echo e($row->site_id); ?>"
                                                class="btn btn-outline-warning btn-sm"><i
                                                    class="fa fa-edit"></i></button>
                                            <hr>
                                            <button type="button" data-toggle="modal" disabled
                                                data-target="#modal-delete<?php echo e($row->site_id); ?>"
                                                class="btn btn-outline-danger btn-sm"><i
                                                    class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="modal-delete<?php echo e($row->site_id); ?>">
                                        <div class="modal-dialog modal-l">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">คุณต้องการลบกองนี้หรือไม่ ?
                                                    </h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="<?php echo e(route('deleteSites')); ?>" method="post">
                                                        <?php echo csrf_field(); ?>
                                                        <input type="hidden" name="site_id" class="form-control"
                                                            value="<?php echo e($row->site_id); ?>">
                                                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.button','data' => ['onclick' => 'submitForm(this);']]); ?>
<?php $component->withName('jet-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['onclick' => 'submitForm(this);']); ?>
                                                            <?php echo e(__('delete')); ?>

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
                                    <div class="modal fade" id="modal-update<?php echo e($row->site_id); ?>">
                                        <div class="modal-dialog modal-l">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">แก้ไข Sites
                                                    </h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="<?php echo e(route('updateSites')); ?>" method="post" enctype="multipart/form-data">
                                                        <?php echo csrf_field(); ?>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['for' => 'site_name','value' => ''.e(__('ชื่อ')).'']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['for' => 'site_name','value' => ''.e(__('ชื่อ')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                                                    <input type="text" name="site_name" required
                                                                        value="<?php echo e($row->site_name); ?>"
                                                                        class="form-control <?php $__errorArgs = ['site_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                                    <?php $__errorArgs = ['site_name'];
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
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['for' => 'site_img','value' => ''.e(__('โลโก้')).'']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['for' => 'site_img','value' => ''.e(__('โลโก้')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                                                    <input type="file" name="site_img"
                                                                        class="form-control <?php $__errorArgs = ['site_img'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                                    required accept="image/*">
                                                                <?php $__errorArgs = ['site_img'];
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
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['for' => 'site_color','value' => ''.e(__('ธีม')).'']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['for' => 'site_color','value' => ''.e(__('ธีม')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                                                    <select class="form-control select2bs4 <?php $__errorArgs = ['site_color'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                                        name="site_color" required>
                                                                        <option value="<?php echo e($row->site_color); ?>"><?php echo e($row->site_color); ?>

                                                                        </option>    
                                                                        <option value="blue">blue
                                                                        </option>      
                                                                        <option value="red">red
                                                                        </option>   
                                                                        <option value="green">green
                                                                        </option>   
                                                                    </select>
                                                                    <?php $__errorArgs = ['site_color'];
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
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['for' => 'site_size_ltd','value' => ''.e(__('ขนาดพื้นที่')).'']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['for' => 'site_size_ltd','value' => ''.e(__('ขนาดพื้นที่')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                                                    <div class="row">
                                                                        <div class="col-sm-6">
                                                                            <select class="form-control select2bs4 <?php $__errorArgs = ['site_size_ltd_0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                                                name="site_size_ltd_0" required>
                                                                                <option value="<?php if($row->site_size_ltd == '-'): ?> <?php echo e('-'); ?> <?php else: ?> <?php echo e($site_size_ltd_explode[0]); ?> <?php endif; ?>"><?php if($row->site_size_ltd == '-'): ?> <?php echo e('-'); ?> <?php else: ?> <?php echo e($site_size_ltd_explode[0]); ?> <?php endif; ?>
                                                                                </option>
                                                                                <option value="-">เลือก ไม่จำกัด
                                                                                </option>
                                                                                <?php for($i = 1; $i <= 1024; $i++): ?>
                                                                                <option value="<?php echo e($i); ?>"><?php echo e($i); ?>

                                                                                </option>
                                                                                <?php endfor; ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <select class="form-control select2bs4 <?php $__errorArgs = ['site_size_ltd_1'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                                                name="site_size_ltd_1" required>
                                                                                
                                                                                <option value="<?php if($row->site_size_ltd == '-'): ?> <?php echo e('KB'); ?> <?php else: ?> <?php echo e($site_size_ltd_explode[1]); ?> <?php endif; ?>"><?php if($row->site_size_ltd == '-'): ?> <?php echo e('KB'); ?> <?php else: ?> <?php echo e($site_size_ltd_explode[1]); ?> <?php endif; ?>
                                                                                </option>
                                                                                <option value="KB">KB
                                                                                </option>
                                                                                <option value="MB">MB
                                                                                </option>
                                                                                <option value="GB">GB
                                                                                </option>
                                                                                <option value="TB">TB
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <?php $__errorArgs = ['site_size_ltd_0'];
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
                                                        <hr>
                                                        <input type="hidden" name="site_id" value="<?php echo e($row->site_id); ?>">
                                                        <input type="hidden" name="old_site_img" value="<?php echo e($row->site_img); ?>">
                                                      
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
                    <div class="border shadow card border-info">
                        <div class="card-header">เพิ่ม Sites</div>
                        <div class="card-body">
                            <form action="<?php echo e(route('addSites')); ?>" method="post" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['for' => 'site_name','value' => ''.e(__('ชื่อ')).'']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['for' => 'site_name','value' => ''.e(__('ชื่อ')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                            <input type="text" name="site_name"
                                            required class="form-control <?php $__errorArgs = ['site_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                            <?php $__errorArgs = ['site_name'];
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
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['for' => 'site_img','value' => ''.e(__('โลโก้')).'']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['for' => 'site_img','value' => ''.e(__('โลโก้')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                            <input type="file" name="site_img"
                                                class="form-control <?php $__errorArgs = ['site_img'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            required accept="image/*">
                                           <?php $__errorArgs = ['site_img'];
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
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['for' => 'site_color','value' => ''.e(__('ธีม')).'']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['for' => 'site_color','value' => ''.e(__('ธีม')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                            <select class="form-control select2bs4 <?php $__errorArgs = ['site_color'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                name="site_color" required>
                                                <option value="">บังคับเลือก
                                                </option>
                                                <option value="blue">blue
                                                </option>      
                                                <option value="red">red
                                                </option>   
                                                <option value="green">green
                                                </option>     
                                            </select>
                                            <?php $__errorArgs = ['site_color'];
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
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['for' => 'site_size_ltd','value' => ''.e(__('ขนาดพื้นที่')).'']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['for' => 'site_size_ltd','value' => ''.e(__('ขนาดพื้นที่')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <select class="form-control select2bs4 <?php $__errorArgs = ['site_size_ltd_0'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                        name="site_size_ltd_0" required>
                                                        <option value="-">เลือก ไม่จำกัด
                                                        </option>
                                                        <?php for($i = 1; $i <= 1024; $i++): ?>
                                                        <option value="<?php echo e($i); ?>"><?php echo e($i); ?>

                                                        </option>
                                                        <?php endfor; ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <select class="form-control select2bs4 <?php $__errorArgs = ['site_size_ltd_1'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                        name="site_size_ltd_1" required>
                                                        <option value="KB">KB
                                                        </option>
                                                        <option value="MB">MB
                                                        </option>
                                                        <option value="GB">GB
                                                        </option>
                                                        <option value="TB">TB
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <?php $__errorArgs = ['site_size_ltd_0'];
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
                                <hr>
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
                            </form>
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
<?php endif; ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/edoclite_vmiw/resources/views/admin/sites/index.blade.php ENDPATH**/ ?>