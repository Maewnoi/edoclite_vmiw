<?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.action-section','data' => []]); ?>
<?php $component->withName('jet-action-section'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('title', null, []); ?> 
        <?php echo e(__('เซสชันเบราว์เซอร์')); ?>

     <?php $__env->endSlot(); ?>

     <?php $__env->slot('description', null, []); ?> 
        <?php echo e(__('จัดการและออกจากระบบเซสชันที่ใช้งานอยู่ของคุณบนเบราว์เซอร์และอุปกรณ์อื่น.')); ?>

     <?php $__env->endSlot(); ?>

     <?php $__env->slot('content', null, []); ?> 
        <div class="max-w-xl text-sm text-gray-600">
            <?php echo e(__('หากจำเป็น คุณอาจออกจากระบบของเซสชันเบราว์เซอร์อื่นๆ ทั้งหมดบนอุปกรณ์ทุกเครื่องของคุณ เซสชันล่าสุดบางส่วนของคุณแสดงอยู่ด้านล่าง อย่างไรก็ตาม รายการนี้อาจไม่ครบถ้วนสมบูรณ์ หากคุณรู้สึกว่าบัญชีของคุณถูกบุกรุก คุณควรอัปเดตรหัสผ่านด้วย.')); ?>

        </div>

        <?php if(count($this->sessions) > 0): ?>
            <div class="mt-5 space-y-6">
                <!-- Other Browser Sessions -->
                <?php $__currentLoopData = $this->sessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="flex items-center">
                        <div>
                            <?php if($session->agent->isDesktop()): ?>
                                <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="w-8 h-8 text-gray-500">
                                    <path d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            <?php else: ?>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8 text-gray-500">
                                    <path d="M0 0h24v24H0z" stroke="none"></path><rect x="7" y="4" width="10" height="16" rx="1"></rect><path d="M11 5h2M12 17v.01"></path>
                                </svg>
                            <?php endif; ?>
                        </div>

                        <div class="ml-3">
                            <div class="text-sm text-gray-600">
                                <?php echo e($session->agent->platform()); ?> - <?php echo e($session->agent->browser()); ?>

                            </div>

                            <div>
                                <div class="text-xs text-gray-500">
                                    <?php echo e($session->ip_address); ?>,

                                    <?php if($session->is_current_device): ?>
                                        <span class="text-green-500 font-semibold"><?php echo e(__('This device')); ?></span>
                                    <?php else: ?>
                                        <?php echo e(__('Last active')); ?> <?php echo e($session->last_active); ?>

                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>

        <div class="flex items-center mt-5">
            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.button','data' => ['wire:click' => 'confirmLogout','wire:loading.attr' => 'disabled']]); ?>
<?php $component->withName('jet-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['wire:click' => 'confirmLogout','wire:loading.attr' => 'disabled']); ?>
                <?php echo e(__('ออกจากระบบ เซสชันเบราว์เซอร์อื่นๆ')); ?>

             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.action-message','data' => ['class' => 'ml-3','on' => 'loggedOut']]); ?>
<?php $component->withName('jet-action-message'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'ml-3','on' => 'loggedOut']); ?>
                <?php echo e(__('เสร็จแล้ว.')); ?>

             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
        </div>

        <!-- Logout Other Devices Confirmation Modal -->
        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.dialog-modal','data' => ['wire:model' => 'confirmingLogout']]); ?>
<?php $component->withName('jet-dialog-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['wire:model' => 'confirmingLogout']); ?>
             <?php $__env->slot('title', null, []); ?> 
                <?php echo e(__('ออกจากระบบ เซสชันเบราว์เซอร์อื่นๆ')); ?>

             <?php $__env->endSlot(); ?>

             <?php $__env->slot('content', null, []); ?> 
                <?php echo e(__('โปรดป้อนรหัสผ่านของคุณเพื่อยืนยันว่าคุณต้องการออกจากเซสชันเบราว์เซอร์อื่นๆ ของคุณในทุกอุปกรณ์.')); ?>


                <div class="mt-4" x-data="{}" x-on:confirming-logout-other-browser-sessions.window="setTimeout(() => $refs.password.focus(), 250)">
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.input','data' => ['type' => 'password','class' => 'mt-1 block w-3/4','placeholder' => ''.e(__('Password')).'','xRef' => 'password','wire:model.defer' => 'password','wire:keydown.enter' => 'logoutOtherBrowserSessions']]); ?>
<?php $component->withName('jet-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['type' => 'password','class' => 'mt-1 block w-3/4','placeholder' => ''.e(__('Password')).'','x-ref' => 'password','wire:model.defer' => 'password','wire:keydown.enter' => 'logoutOtherBrowserSessions']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.input-error','data' => ['for' => 'password','class' => 'mt-2']]); ?>
<?php $component->withName('jet-input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['for' => 'password','class' => 'mt-2']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                </div>
             <?php $__env->endSlot(); ?>

             <?php $__env->slot('footer', null, []); ?> 
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.secondary-button','data' => ['wire:click' => '$toggle(\'confirmingLogout\')','wire:loading.attr' => 'disabled']]); ?>
<?php $component->withName('jet-secondary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['wire:click' => '$toggle(\'confirmingLogout\')','wire:loading.attr' => 'disabled']); ?>
                    <?php echo e(__('ปิด')); ?>

                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.button','data' => ['class' => 'ml-2','wire:click' => 'logoutOtherBrowserSessions','wire:loading.attr' => 'disabled']]); ?>
<?php $component->withName('jet-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'ml-2','wire:click' => 'logoutOtherBrowserSessions','wire:loading.attr' => 'disabled']); ?>
                    <?php echo e(__('ออกจากระบบ เซสชันเบราว์เซอร์อื่นๆ')); ?>

                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
             <?php $__env->endSlot(); ?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
     <?php $__env->endSlot(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\edoclite\resources\views/profile/logout-other-browser-sessions-form.blade.php ENDPATH**/ ?>