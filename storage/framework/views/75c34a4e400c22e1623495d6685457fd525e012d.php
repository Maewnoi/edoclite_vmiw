<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <!-- meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="theme-color" content="#0066CC" />

    <title>edoclite</title>
    <!-- icon -->
    <link rel="apple-touch-icon" href="<?php echo e(asset('/image/logo_lei.png')); ?>" />
    <link rel="icon" href="<?php echo asset('/image/logo_lei.png'); ?>" />
    <!-- load -->
    <link rel="stylesheet" href="<?php echo e(asset('/css/load.css')); ?>">
    <div class="loader">
        <img src="<?php echo e(asset('/image/load.gif')); ?>" alt="load_IMG" />
    </div>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo e(asset('/plugins/fontawesome-free/css/all.min.css')); ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="<?php echo e(asset('/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')); ?>">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo e(asset('/plugins/icheck-bootstrap/icheck-bootstrap.min.css')); ?>">
    <!-- JQVMap -->
    <!-- <link rel="stylesheet" href="<?php echo e(asset('/plugins/jqvmap/jqvmap.min.css')); ?>"> -->
    <!-- Toastr -->
    <link rel="stylesheet" href="<?php echo e(asset('/plugins/toastr/toastr.min.css')); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo e(asset('/dist/css/adminlte.min.css')); ?>">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?php echo e(asset('/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')); ?>">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo e(asset('/plugins/daterangepicker/daterangepicker.css')); ?>">
    <!-- summernote -->
    <link rel="stylesheet" href="<?php echo e(asset('/plugins/summernote/summernote-bs4.min.css')); ?>">

    <!-- fullCalendar -->
    <link rel="stylesheet" href="<?php echo e(asset('/plugins/fullcalendar/main.css')); ?>">
    <!-- Ekko Lightbox -->
    <link rel="stylesheet" href="<?php echo e(asset('/plugins/ekko-lightbox/ekko-lightbox.css')); ?>">

    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo e(asset('/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')); ?>">

    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo e(asset('/plugins/select2/css/select2.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')); ?>">

    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="<?php echo e(asset('/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')); ?>">
    <!-- BS Stepper -->
    <link rel="stylesheet" href="<?php echo e(asset('/plugins/bs-stepper/css/bs-stepper.min.css')); ?>">
    <!-- dropzonejs -->
    <link rel="stylesheet" href="<?php echo e(asset('/plugins/dropzone/min/dropzone.min.css')); ?>">
    <!-- map -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
        integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
        crossorigin="" />
    <!-- ------------------------------------------------------------------------------------------------------- -->
    <!-- Styles -->
    <!-- <link rel="stylesheet" href="<?php echo e(mix('css/app.css')); ?>"> -->
    <link href="<?php echo e(asset('/css/app.css')); ?>" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <link rel="stylesheet" href="<?php echo e(asset('/css/cssController.css')); ?>">
    <!-- ------------------------------------------------------------------------------------------------------- -->
    <?php echo \Livewire\Livewire::styles(); ?>


    <!-- ------------------------------------------------------------------------------------------------------- -->
</head>

<body class="font-sans antialiased">
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.banner','data' => []]); ?>
<?php $component->withName('jet-banner'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>

    <div class="min-h-screen bg-gradient-to-b from-blue-200 to-blue-400">
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('navigation-menu')->html();
} elseif ($_instance->childHasBeenRendered('6BqPMR3')) {
    $componentId = $_instance->getRenderedChildComponentId('6BqPMR3');
    $componentTag = $_instance->getRenderedChildComponentTagName('6BqPMR3');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('6BqPMR3');
} else {
    $response = \Livewire\Livewire::mount('navigation-menu');
    $html = $response->html();
    $_instance->logRenderedChild('6BqPMR3', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>

        <!-- Page Heading -->
        <!-- <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <?php echo e($header); ?>

                </div>
            </header> -->

        <!-- Page Content -->
        <main>
            <?php echo e($slot); ?>

        </main>
    </div>

    <?php echo $__env->yieldPushContent('modals'); ?>

    <?php echo \Livewire\Livewire::scripts(); ?>



</body>

<!-- ติดต่อสอบถาม -->
<input type="checkbox" id="contact-problem-check">
<label class="shadow contact-problem-btn" for="contact-problem-check">
    <i class="fa fa-solid fa-comment contact-problem-comment"></i>
    <i class="fa fa-solid fa-comment contact-problem-close"></i>
</label>
<div class="shadow contact-problem-wrapper">
    <div class="contact-problem-header">
        <h6>ติดต่อปัญหาและคู่มือการใช้งาน</h6>
    </div>
    <div class="text-center p-2">
        <span>043245265 , 043245261</span>
    </div>
</div>
<!-- จบติดต่อสอบถาม -->

</html>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-FZVNG8FL27"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-FZVNG8FL27');
</script>
<!-- jQuery -->
<script src="<?php echo e(asset('/plugins/jquery/jquery.min.js')); ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo e(asset('/plugins/jquery-ui/jquery-ui.min.js')); ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
$.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo e(asset('/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
<!-- ChartJS -->
<!-- <script src="<?php echo e(asset('/plugins/chart.js/Chart.min.js')); ?>"></script> -->
<!-- Sparkline -->
<script src="<?php echo e(asset('/plugins/sparklines/sparkline.js')); ?>"></script>
<!-- JQVMap -->
<!-- <script src="<?php echo e(asset('/plugins/jqvmap/jquery.vmap.min.js')); ?>"></script>
<script src="<?php echo e(asset('/plugins/jqvmap/maps/jquery.vmap.usa.js')); ?>"></script> -->
<!-- jQuery Knob Chart -->
<script src="<?php echo e(asset('/plugins/jquery-knob/jquery.knob.min.js')); ?>"></script>
<!-- daterangepicker -->
<script src="<?php echo e(asset('/plugins/moment/moment.min.js')); ?>"></script>
<script src="<?php echo e(asset('/plugins/daterangepicker/daterangepicker.js')); ?>"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo e(asset('/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')); ?>"></script>
<!-- Summernote -->
<script src="<?php echo e(asset('/plugins/summernote/summernote-bs4.min.js')); ?>"></script>
<!-- overlayScrollbars -->
<script src="<?php echo e(asset('/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo e(asset('/dist/js/adminlte.js')); ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo e(asset('/dist/js/demo.js')); ?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="<?php echo e(asset('/dist/js/pages/dashboard.js')); ?>"></script> -->
<script src="<?php echo e(asset('/plugins/jquery-mousewheel/jquery.mousewheel.js')); ?>"></script>
<script src="<?php echo e(asset('/plugins/raphael/raphael.min.js')); ?>"></script>
<script src="<?php echo e(asset('/plugins/jquery-mapael/jquery.mapael.min.js')); ?>"></script>
<script src="<?php echo e(asset('/plugins/jquery-mapael/maps/usa_states.min.js')); ?>"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="<?php echo e(asset('/dist/js/pages/dashboard2.js')); ?>"></script> -->

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="<?php echo e(asset('/dist/js/pages/dashboard3.js')); ?>"></script> -->

<!-- Ekko Lightbox -->
<script src="<?php echo e(asset('/plugins/ekko-lightbox/ekko-lightbox.min.js')); ?>"></script>
<!-- Filterizr-->
<script src="<?php echo e(asset('/plugins/filterizr/jquery.filterizr.min.js')); ?>"></script>
<!-- fullCalendar 2.2.5 -->
<script src="<?php echo e(asset('/plugins/fullcalendar/main.js')); ?>"></script>

<!-- DataTables  & Plugins -->
<script src="<?php echo e(asset('/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('/plugins/datatables-responsive/js/dataTables.responsive.min.js')); ?>"></script>
<script src="<?php echo e(asset('/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('/plugins/datatables-buttons/js/dataTables.buttons.min.js')); ?>"></script>
<script src="<?php echo e(asset('/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('/plugins/jszip/jszip.min.js')); ?>"></script>
<script src="<?php echo e(asset('/plugins/pdfmake/pdfmake.min.js')); ?>"></script>
<script src="<?php echo e(asset('/plugins/pdfmake/vfs_fonts.js')); ?>"></script>
<script src="<?php echo e(asset('/plugins/datatables-buttons/js/buttons.html5.min.js')); ?>"></script>
<script src="<?php echo e(asset('/plugins/datatables-buttons/js/buttons.print.min.js')); ?>"></script>
<script src="<?php echo e(asset('/plugins/datatables-buttons/js/buttons.colVis.min.js')); ?>"></script>

<!-- canvasjs -->
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

<!-- SweetAlert2 -->
<script src="<?php echo e(asset('/plugins/sweetalert2/sweetalert2.min.js')); ?>"></script>
<!-- Toastr -->
<script src="<?php echo e(asset('/plugins/toastr/toastr.min.js')); ?>"></script>
<!-- search -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>

<!-- Select2 -->
<script src="<?php echo e(asset('/plugins/select2/js/select2.full.min.js')); ?>"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="<?php echo e(asset('/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')); ?>"></script>
<!-- InputMask -->
<script src="<?php echo e(asset('/plugins/inputmask/jquery.inputmask.min.js')); ?>"></script>
<!-- bootstrap color picker -->
<script src="<?php echo e(asset('/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')); ?>"></script>
<!-- Bootstrap Switch -->
<script src="<?php echo e(asset('/plugins/bootstrap-switch/js/bootstrap-switch.min.js')); ?>"></script>
<!-- BS-Stepper -->
<script src="<?php echo e(asset('/plugins/bs-stepper/js/bs-stepper.min.js')); ?>"></script>
<!-- dropzonejs -->
<script src="<?php echo e(asset('/plugins/dropzone/min/dropzone.min.js')); ?>"></script>

<!-- Scripts -->
<!-- <script src="<?php echo e(mix('js/app.js')); ?>" defer></script> -->
<script src="<?php echo e(asset('/js/app.js')); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
</script>
<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
    integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
    crossorigin=""></script>

<!-- multi-select -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/multi-select/0.9.12/js/jquery.multi-select.min.js"
    integrity="sha512-vSyPWqWsSHFHLnMSwxfmicOgfp0JuENoLwzbR+Hf5diwdYTJraf/m+EKrMb4ulTYmb/Ra75YmckeTQ4sHzg2hg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="<?php echo e(asset('/js/jsController.js')); ?>"></script><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/edoclite/resources/views/layouts/app.blade.php ENDPATH**/ ?>