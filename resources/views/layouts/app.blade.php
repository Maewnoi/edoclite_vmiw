@php
use App\Http\Controllers\functionController;
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="{{functionController::get_site_color()}}" />

    <title>edoclite</title>
    <!-- icon -->
    <link rel="apple-touch-icon" href="{{ asset(functionController::get_site_img()) }}" />
    <link rel="icon" href="{!! asset(functionController::get_site_img()) !!}" />
    <!-- load -->
    <link rel="stylesheet" href="{{ asset('/css/load.css') }}">
    <div class="loader">
        <img src="{{ asset('/image/load.gif') }}" alt="load_IMG" />
    </div>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <!-- <link rel="stylesheet" href="{{ asset('/plugins/jqvmap/jqvmap.min.css') }}"> -->
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('/plugins/toastr/toastr.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('/plugins/summernote/summernote-bs4.min.css') }}">

    <!-- fullCalendar -->
    <link rel="stylesheet" href="{{ asset('/plugins/fullcalendar/main.css') }}">
    <!-- Ekko Lightbox -->
    <link rel="stylesheet" href="{{ asset('/plugins/ekko-lightbox/ekko-lightbox.css') }}">

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="{{ asset('/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
    <!-- BS Stepper -->
    <link rel="stylesheet" href="{{ asset('/plugins/bs-stepper/css/bs-stepper.min.css') }}">
    <!-- dropzonejs -->
    <link rel="stylesheet" href="{{ asset('/plugins/dropzone/min/dropzone.min.css') }}">
    <!-- map -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
        integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
        crossorigin="" />
    <!-- ------------------------------------------------------------------------------------------------------- -->
    <!-- Styles -->
    <!-- <link rel="stylesheet" href="{{ mix('css/app.css') }}"> -->
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('/css/cssController.css') }}">
    <!-- ------------------------------------------------------------------------------------------------------- -->
    @livewireStyles

    <!-- ------------------------------------------------------------------------------------------------------- -->
</head>

<body class="font-sans antialiased">
    <x-jet-banner />

    <div class="min-h-screen bg-gradient-to-b from-{{functionController::get_site_color()}}-200 to-{{functionController::get_site_color()}}-400">
        @livewire('navigation-menu')
        
        <!-- Page Heading -->
        <!-- <header class="bg-white shadow">
                <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header> -->

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    @stack('modals')

    @livewireScripts


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
    <div class="p-2 text-center">
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
<script src="{{ asset('/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
$.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<!-- <script src="{{ asset('/plugins/chart.js/Chart.min.js') }}"></script> -->
<!-- Sparkline -->
<script src="{{ asset('/plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<!-- <script src="{{ asset('/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script> -->
<!-- jQuery Knob Chart -->
<script src="{{ asset('/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('/dist/js/demo.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="{{ asset('/dist/js/pages/dashboard.js') }}"></script> -->
<script src="{{ asset('/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
<script src="{{ asset('/plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
<script src="{{ asset('/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="{{ asset('/dist/js/pages/dashboard2.js') }}"></script> -->

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="{{ asset('/dist/js/pages/dashboard3.js') }}"></script> -->

<!-- Ekko Lightbox -->
<script src="{{ asset('/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
<!-- Filterizr-->
<script src="{{ asset('/plugins/filterizr/jquery.filterizr.min.js') }}"></script>
<!-- fullCalendar 2.2.5 -->
<script src="{{ asset('/plugins/fullcalendar/main.js') }}"></script>

<!-- DataTables  & Plugins -->
<script src="{{ asset('/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<!-- canvasjs -->
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

<!-- SweetAlert2 -->
<!-- <script src="{{ asset('/plugins/sweetalert2/sweetalert2.min.js') }}"></script> -->
<script src="https://unpkg.com/sweetalert@2.1.2/dist/sweetalert.min.js"></script>
@if (session('error'))
    <script>
        swal({
            title: "{{ session('error') }}",
            icon: "error",
        });
    </script>
@endif

@if (session('success'))
    <script>
        swal({
            title: "{{ session('success') }}",
            icon: "success",
        });
    </script>
@endif

@if ($errors->any())
@foreach ($errors->all() as $error)
    <script>
        swal({
            title: "{{ $error }}",
            icon: "error",
        });
    </script>
@endforeach
@endif

@if(functionController::get_bytes(Auth::user()->site_id) != 0 && functionController::get_bytes(Auth::user()->site_id) <= functionController::folder_Size("image/".functionController::funtion_sites_site_path_folder(Auth::user()->site_id)))
    <script>
        setInterval( function () {
            swal({
                    title: "พื้นที่เต็ม",
                    icon: "error",
            });
        }, 30000 );
    </script>
    <!-- 60000 -->
@endif
<!-- Toastr -->
<script src="{{ asset('/plugins/toastr/toastr.min.js') }}"></script>
<!-- search -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>

<!-- Select2 -->
<script src="{{ asset('/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="{{ asset('/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
<!-- InputMask -->
<script src="{{ asset('/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
<!-- bootstrap color picker -->
<script src="{{ asset('/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<!-- Bootstrap Switch -->
<script src="{{ asset('/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
<!-- BS-Stepper -->
<script src="{{ asset('/plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>
<!-- dropzonejs -->
<script src="{{ asset('/plugins/dropzone/min/dropzone.min.js') }}"></script>

<!-- Scripts -->
<!-- <script src="{{ mix('js/app.js') }}" defer></script> -->
<script src="{{ asset('/js/app.js') }}"></script>
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

<script src="{{ asset('/js/jsController.js') }}"></script>
<script src="{{ asset('/js/query.js') }}"></script>

<script>
    window.addEventListener("offline", (event) => {
        swal({
            title: "ไม่พบการเชื่อมต่อ (offline)",
            icon: "error",
        });
    });

    window.addEventListener("online", (event) => {
        swal({
            title: "กลับมาออนไลน์ปกติ (online)",
            icon: "success",
        });
    });
</script>

<!-- ปิดระบบ -->
<!-- <script>
setInterval( function () {
    swal({
            title: "ปิดปรับปรุงระบบสักครู่ (offline)",
            icon: "error",
    });
}, 1000 );
</script> -->