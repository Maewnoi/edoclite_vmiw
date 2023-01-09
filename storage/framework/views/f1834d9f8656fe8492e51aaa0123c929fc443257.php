<?php
use App\Http\Controllers\functionController;
?>
<div class="flex flex-col items-center min-h-screen pt-6 bg-gradient-to-b from-<?php echo e(functionController::get_site_color_not_auth()); ?>-200 to-<?php echo e(functionController::get_site_color_not_auth()); ?>-400 sm:justify-center sm:pt-0">
    <div>
        <?php echo e($logo); ?>

    </div>

    <div class="w-full px-6 py-4 mt-6 overflow-hidden bg-white shadow-md sm:max-w-md sm:rounded-lg">
        <?php echo e($slot); ?>

    </div>
</div><?php /**PATH C:\xampp\htdocs\edoclite\vendor\laravel\jetstream\src/../resources/views/components/authentication-card.blade.php ENDPATH**/ ?>