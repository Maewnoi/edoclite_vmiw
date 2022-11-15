@php
use App\Http\Controllers\navigationController;
use App\Http\Controllers\functionController;
@endphp
<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow">
    <!-- Primary Navigation Menu -->
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex items-center flex-shrink-0">
                    <a href="{{ route('dashboard') }}" class="home-link router-link-active">
                        <img src="{{ asset('/image/logo_lei.png') }}" alt="" class="brand-image img-circle elevation-3"
                            width="40" height="40">
                    </a>
                </div>
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">

                    @if(Auth::user()->level=='0')
                    <!-- admin -->
                    <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')"
                        class="text-decoration-none">
                        หน้าหลัก
                    </x-jet-nav-link>
                    <x-jet-nav-link href="{{ route('sites') }}" :active="request()->routeIs('sites')"
                        class="text-decoration-none">
                        Sites
                    </x-jet-nav-link>
                    <x-jet-nav-link href="{{ route('groupmem') }}" :active="request()->routeIs('groupmem')"
                        class="text-decoration-none">
                        กลุ่มงาน
                    </x-jet-nav-link>
                    <x-jet-nav-link href="{{ route('cottons_all') }}" :active="request()->routeIs('cottons_all')"
                        class="text-decoration-none">
                        ฝ่าย
                    </x-jet-nav-link>
                    <x-jet-nav-link href="{{ route('member') }}" :active="request()->routeIs('member')"
                        class="text-decoration-none">
                        ชื่อผู้ใช้
                    </x-jet-nav-link>
                    <!-- <x-jet-nav-link href="{{ route('department') }} " :active="request()->routeIs('department')">
                        Department
                    </x-jet-nav-link>
                    <x-jet-nav-link href="{{ route('services') }}" :active="request()->routeIs('services')">
                        Services
                    </x-jet-nav-link> -->
                    @elseif(Auth::user()->level !='0')
                    <!-- user -->
                    <x-jet-nav-link href="{{ route('member_dashboard') }}"
                        :active="request()->routeIs('member_dashboard')" class="text-decoration-none">
                        หน้าหลัก
                    </x-jet-nav-link>

                    <!-- Dropdown ทะเบียนหนังสือภายนอก -->
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <div class="relative ml-1">
                            <x-jet-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <span class="inline-flex rounded-md">
                                        <button type="button"
                                            class="inline-flex items-center px-3 py-1 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white rounded-md hover:text-gray-700 focus:outline-none">
                                            {{ __('ทะเบียนหนังสือภายนอก ') }}
                                            
                                            <!-- หัวหน้ากอง -->
                                            @if(Auth::user()->level == '4')
                                            <span class="badge badge-pill badge-danger ml-2 -mr-0.5" id="funtion_document_admission_division_all_count_0_level_4">
                                            </span>
                                            @endif
                                            
                                            <!-- หัวหน้าฝ่าย -->
                                            @if(Auth::user()->level == '5')
                                            <span class="badge badge-pill badge-danger ml-2 -mr-0.5" id="funtion_document_admission_department_all_count_0_level_5">
                                            </span>
                                            @endif
                                            
                                            <!-- สารบรรกอง -->
                                            @if(Auth::user()->level == '6')
                                            <span class="badge badge-pill badge-danger ml-2 -mr-0.5" id="funtion_document_admission_all_group_count_0_level_6">
                                            </span>
                                            @endif
                                            
                                            
                                            <!-- งาน -->
                                            @if(Auth::user()->level == '7')
                                            <span class="badge badge-pill badge-danger ml-2 -mr-0.5" id="funtion_document_admission_all_work_count_0_level_7">
                                            </span>
                                            @endif
                                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </span>
                                </x-slot>
                                <x-slot name="content">
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('เมนู') }}
                                    </div>
                                    <div class="border-t border-gray-100"></div>

                                    <!-- สารบรรณกลาง -->
                                    @if(Auth::user()->level == '3')
                                    <x-jet-dropdown-link type="button" data-toggle="modal" class="text-decoration-none"
                                        data-target="#modal-Create-new-document">
                                        {{ __('สร้างเอกสารลงรับ') }}
                                    </x-jet-dropdown-link>
                                    <div class="border-t border-gray-100"></div>
                                    <x-jet-dropdown-link href="{{ route('documents_admission_all') }}"
                                        class="text-decoration-none">
                                        {{ __('เอกสารรับเข้าทั้งหมด ( ') }}
                                        {{navigationController::funtion_document_admission_all_count_level_3(Auth::user()->level)}}
                                        {{ __(' ) เรื่อง') }}
                                    </x-jet-dropdown-link>
                                    @endif

                                    <!-- หัวหน้ากอง -->
                                    @if(Auth::user()->level == '4')
                                    @if(navigationController::funtion_Groupmem_check_group_name_level_4(Auth::user()->level)
                                    == 'สำนักปลัด')
                                    <!-- สำนักปลัดเท่านั้น -->
                                    <x-jet-dropdown-link href="{{ route('documents_pending_all') }}"
                                        class="text-decoration-none">
                                        {{ __('เอกสารรอพิจารณาจากสารบรรณกลาง ( ') }}
                                        {{navigationController::funtion_document_waiting_count_level_4(Auth::user()->level)}}
                                        {{ __(' ) เรื่อง') }}
                                    </x-jet-dropdown-link>
                                    <div class="border-t border-gray-100"></div>
                                    @endif
                                    <x-jet-dropdown-link href="{{ route('documents_admission_division_all_0') }}"
                                        class="text-decoration-none">
                                        {{ __('มีเอกสารภายนอกรอพิจารณา ( ') }}
                                        {{navigationController::funtion_document_admission_division_all_count_0_level_4(Auth::user()->level)}}
                                        {{ __(' ) เรื่อง') }}
                                    </x-jet-dropdown-link>
                                    <div class="border-t border-gray-100"></div>
                                    <x-jet-dropdown-link href="{{ route('documents_admission_division_all_1') }}"
                                        class="text-decoration-none">
                                        {{ __('เอกสารที่เซ็นแล้ว ( ') }}
                                        {{navigationController::funtion_document_admission_division_all_count_1_level_4(Auth::user()->level)}}
                                        {{ __(' ) เรื่อง') }}
                                    </x-jet-dropdown-link>
                                    <x-jet-dropdown-link href="{{ route('documents_admission_division_retrun') }}"
                                        class="text-decoration-none">
                                        {{ __('บันทึกข้อความ ( ') }}
                                        {{navigationController::funtion_document_admission_division_retrun_count_level_4(Auth::user()->level)}}
                                        {{ __(' ) รายการ') }}
                                    </x-jet-dropdown-link>
                                    @endif

                                    <!-- หัวหน้าฝ่าย -->
                                    @if(Auth::user()->level == '5')
                                    <x-jet-dropdown-link href="{{ route('documents_admission_department_all_0') }}"
                                        class="text-decoration-none">
                                        {{ __('มีเอกสารภายนอกรอพิจารณา ( ') }}
                                        {{navigationController::funtion_document_admission_department_all_count_0_level_5(Auth::user()->level)}}
                                        {{ __(' ) เรื่อง') }}
                                    </x-jet-dropdown-link>
                                    <div class="border-t border-gray-100"></div>
                                    <x-jet-dropdown-link href="{{ route('documents_admission_department_all_1') }}"
                                        class="text-decoration-none">
                                        {{ __('เอกสารที่เซ็นแล้ว ( ') }}
                                        {{navigationController::funtion_document_admission_department_all_count_1_level_5(Auth::user()->level)}}
                                        {{ __(' ) เรื่อง') }}
                                    </x-jet-dropdown-link>
                                    <div class="border-t border-gray-100"></div>
                                    <x-jet-dropdown-link href="{{ route('documents_admission_department_retrun') }}"
                                        class="text-decoration-none">
                                        {{ __('บันทึกข้อความ ( ') }}
                                        {{navigationController::funtion_document_admission_department_retrun_count_level_5(Auth::user()->level)}}
                                        {{ __(' ) รายการ') }}
                                    </x-jet-dropdown-link>
                                    @endif

                                    <!-- สารบรรณกอง -->
                                    @if(Auth::user()->level == '6')
                                    <x-jet-dropdown-link href="{{ route('documents_admission_group_all_0') }}"
                                        class="text-decoration-none">
                                        {{ __('มีเอกสารใหม่ ( ') }}
                                        {{navigationController::funtion_document_admission_all_group_count_0_level_6(Auth::user()->level)}}
                                        {{ __(' ) เรื่อง') }}
                                    </x-jet-dropdown-link>
                                    <div class="border-t border-gray-100"></div>
                                    <x-jet-dropdown-link href="{{ route('documents_admission_group_all_1') }}"
                                        class="text-decoration-none">
                                        {{ __('มีเอกสารรอดำเนินการ ( ') }}
                                        {{navigationController::funtion_document_admission_all_group_count_1_level_6(Auth::user()->level)}}
                                        {{ __(' ) เรื่อง') }}
                                    </x-jet-dropdown-link>
                                    <div class="border-t border-gray-100"></div>
                                    <x-jet-dropdown-link href="{{ route('documents_admission_group_all_2') }}"
                                        class="text-decoration-none">
                                        {{ __('มีเอกสารที่ดำเนินการแล้ว ( ') }}
                                        {{navigationController::funtion_document_admission_all_group_count_2_level_6(Auth::user()->level)}}
                                        {{ __(' ) เรื่อง') }}
                                    </x-jet-dropdown-link>
                                    @endif

                                    <!-- งาน -->
                                    @if(Auth::user()->level == '7')
                                    <x-jet-dropdown-link href="{{ route('documents_admission_work_all_0') }}"
                                        class="text-decoration-none">
                                        {{ __('เอกสารรับเข้าที่ยังไม่อ่าน ( ') }}
                                        {{navigationController::funtion_document_admission_all_work_count_0_level_7(Auth::user()->level)}}
                                        {{ __(' ) เรื่อง') }}
                                    </x-jet-dropdown-link>
                                    <div class="border-t border-gray-100"></div>
                                    <x-jet-dropdown-link href="{{ route('documents_admission_work_all_1') }}"
                                        class="text-decoration-none">
                                        {{ __('เอกสารรับเข้าที่อ่านแล้ว ( ') }}
                                        {{navigationController::funtion_document_admission_all_work_count_1_level_7(Auth::user()->level)}}
                                        {{ __(' ) เรื่อง') }}
                                    </x-jet-dropdown-link>
                                    @endif

                                    <!-- นายก -->
                                    @if(Auth::user()->level == '1')
                                    <x-jet-dropdown-link href="{{ route('documents_admission_minister_all_0') }}"
                                        class="text-decoration-none">
                                        {{ __('เอกสารรอพิจารณา ( ') }}
                                        {{navigationController::funtion_documents_admission_minister_all_count_0_level_1(Auth::user()->level)}}
                                        {{ __(' ) เรื่อง') }}
                                    </x-jet-dropdown-link>
                                    <div class="border-t border-gray-100"></div>
                                    <x-jet-dropdown-link href="{{ route('documents_admission_minister_all_1') }}"
                                        class="text-decoration-none">
                                        {{ __('เอกสารที่เซ็นแล้ว ( ') }}
                                        {{navigationController::funtion_documents_admission_minister_all_count_1_level_1(Auth::user()->level)}}
                                        {{ __(' ) เรื่อง') }}
                                    </x-jet-dropdown-link>
                                    @endif
                                </x-slot>
                            </x-jet-dropdown>
                        </div>
                    </div>
                    @if(Auth::user()->level == '3' || Auth::user()->level == '6')
                    <!-- Dropdown ระบบจองเลข -->
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <div class="relative ml-1">
                            <x-jet-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <span class="inline-flex rounded-md">
                                        <button type="button"
                                            class="inline-flex items-center px-3 py-1 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white rounded-md hover:text-gray-700 focus:outline-none">
                                            {{ __('ระบบจองเลข') }}

                                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </span>
                                </x-slot>
                                <x-slot name="content">
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('เมนู') }}
                                    </div>
                                    <div class="border-t border-gray-100"></div>
                                    <!-- สารบรรณกลาง -->
                                    @if(Auth::user()->level == '3')
                                    <x-jet-dropdown-link href="{{ route('reserve_number_receive_all') }}"
                                        class="text-decoration-none">
                                        {{ __('จองเลขรับ') }}
                                    </x-jet-dropdown-link>
                                    <!-- <x-jet-dropdown-link class="disabled" href="{{ route('reserve_number_delivery_all') }}">
                                        {{ __('จองเลขส่ง') }}
                                    </x-jet-dropdown-link>
                                    -->
                                    @endif

                                    <!-- สารบรรณกอง -->
                                    @if(Auth::user()->level == '6')
                                    <x-jet-dropdown-link href="{{ route('reserve_number_receive_inside_all') }}"
                                        class="text-decoration-none">
                                        {{ __('จองเลขรับ') }}
                                    </x-jet-dropdown-link>
                                    <div class="border-t border-gray-100"></div>
                                    <x-jet-dropdown-link href="{{ route('reserve_number_delivery_inside_all') }}"
                                        class="text-decoration-none">
                                        {{ __('จองเลขส่ง') }}
                                    </x-jet-dropdown-link>
                                    <div class="border-t border-gray-100"></div>
                                    <x-jet-dropdown-link href="{{ route('reserve_number_announce_all') }}" class="text-decoration-none">
                                        {{ __('จองเลขประกาศ') }}
                                    </x-jet-dropdown-link>
                                    <div class="border-t border-gray-100"></div>
                                    <x-jet-dropdown-link href="{{ route('reserve_number_order_all') }}" class="text-decoration-none">
                                        {{ __('จองเลขคำสั่ง') }}
                                    </x-jet-dropdown-link>
                                    <div class="border-t border-gray-100"></div>
                                    <x-jet-dropdown-link href="{{ route('reserve_number_certificate_all') }}" class="text-decoration-none">
                                        {{ __('จองเลขหนังสือรับรอง') }}
                                    </x-jet-dropdown-link>
                                    @endif
                                </x-slot>
                            </x-jet-dropdown>
                        </div>
                    </div>
                    @endif
                    @if(Auth::user()->level != '3')
                    <!-- Dropdown ทะเบียนหนังสือภายใน -->
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <div class="relative ml-1">
                            <x-jet-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <span class="inline-flex rounded-md">
                                        <button type="button"
                                            class="inline-flex items-center px-3 py-1 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white rounded-md hover:text-gray-700 focus:outline-none">
                                            {{ __('ทะเบียนหนังสือภายใน') }}
                                            
                                            
                                            <!-- หัวหน้ากอง -->
                                            @if(Auth::user()->level == '4')
                                            <span class="badge badge-pill badge-danger ml-2 -mr-0.5" id="funtion_document_admission_division_inside_all_count_0_level_4">
                                            </span>
                                            @endif
                                            
                                            <!-- หัวหน้าฝ่าย -->
                                            @if(Auth::user()->level == '5')
                                            <span class="badge badge-pill badge-danger ml-2 -mr-0.5" id="funtion_document_admission_department_inside_all_count_0_level_5">
                                            </span>
                                            @endif
                                            
                                            <!-- สารบรรกอง -->
                                            @if(Auth::user()->level == '6')
                                            <span class="badge badge-pill badge-danger ml-2 -mr-0.5" id="funtion_document_admission_all_group_inside_count_0_level_6">
                                            </span>
                                            @endif
                                            
                                            
                                            <!-- งาน -->
                                            @if(Auth::user()->level == '7')
                                            <span class="badge badge-pill badge-danger ml-2 -mr-0.5" id="funtion_document_admission_all_work_inside_count_0_level_7">
                                            </span>
                                            @endif


                                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </span>
                                </x-slot>
                                <x-slot name="content">
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('เมนู') }}
                                    </div>
                                    <div class="border-t border-gray-100"></div>
                                    <!-- สารบรรณกอง -->
                                    @if(Auth::user()->level == '6')
                                    <x-jet-dropdown-link type="button" data-toggle="modal" class="text-decoration-none"
                                        data-target="#modal-Create-new-document-inside">
                                        {{ __('สร้างเอกสารภายใน') }}
                                    </x-jet-dropdown-link>
                                    <div class="border-t border-gray-100"></div> 
                                    
                                    <x-jet-dropdown-link href="{{ route('documents_admission_all_inside') }}" class="text-decoration-none">
                                        {{ __('เอกสารภายในทั้งหมด') }}
                                    </x-jet-dropdown-link>
                                    <div class="border-t border-gray-100"></div>

                                    <x-jet-dropdown-link href="{{ route('documents_admission_group_inside_all_0') }}" class="text-decoration-none">
                                        {{ __('มีเอกสารใหม่ (') }}
                                        {{navigationController::funtion_document_admission_all_group_inside_count_0_level_6(Auth::user()->level)}}
                                        {{ __(' ) เรื่อง') }}
                                    </x-jet-dropdown-link>
                                    <x-jet-dropdown-link href="{{ route('documents_admission_group_inside_all_1') }}"
                                        class="text-decoration-none">
                                        {{ __('มีเอกสารรอดำเนินการ ( ') }}
                                        {{navigationController::funtion_document_admission_all_group_inside_count_1_level_6(Auth::user()->level)}}
                                        {{ __(' ) เรื่อง') }}
                                    </x-jet-dropdown-link>
                                    <x-jet-dropdown-link href="{{ route('documents_admission_group_inside_all_2') }}"
                                        class="text-decoration-none">
                                        {{ __('มีเอกสารที่ดำเนินการแล้ว ( ') }}
                                        {{navigationController::funtion_document_admission_all_group_inside_count_2_level_6(Auth::user()->level)}}
                                        {{ __(' ) เรื่อง') }}
                                    </x-jet-dropdown-link>
                                    @endif
                                    <!-- หัวหน้ากอง -->
                                    @if(Auth::user()->level == '4')
                                    <x-jet-dropdown-link href="{{ route('documents_admission_division_inside_all_0') }}" class="text-decoration-none">
                                        {{ __('มีเอกสารภายในรอพิจารณา (') }}
                                        {{navigationController::funtion_document_admission_division_inside_all_count_0_level_4(Auth::user()->level)}}
                                        {{ __(' ) เรื่อง') }}
                                    </x-jet-dropdown-link>
                                    <div class="border-t border-gray-100"></div>
                                    <x-jet-dropdown-link href="{{ route('documents_admission_division_inside_all_1') }}" class="text-decoration-none">
                                        {{ __('เอกสารที่เซ็นแล้ว (') }}
                                        {{navigationController::funtion_document_admission_division_inside_all_count_1_level_4(Auth::user()->level)}}
                                        {{ __(' ) เรื่อง') }}
                                    </x-jet-dropdown-link>
                                    @endif

                                    <!-- หัวหน้าฝ่าย -->
                                    @if(Auth::user()->level == '5')
                                    <x-jet-dropdown-link href="{{ route('documents_admission_department_inside_all_0') }}" class="text-decoration-none">
                                        {{ __('มีเอกสารภายในรอพิจารณา (') }}
                                        {{navigationController::funtion_document_admission_department_inside_all_count_0_level_5(Auth::user()->level)}}
                                        {{ __(' ) เรื่อง') }}
                                    </x-jet-dropdown-link>
                                    <div class="border-t border-gray-100"></div>
                                    <x-jet-dropdown-link href="{{ route('documents_admission_department_inside_all_1') }}" class="text-decoration-none">
                                        {{ __('เอกสารที่เซ็นแล้ว (') }}
                                        {{navigationController::funtion_document_admission_department_inside_all_count_1_level_5(Auth::user()->level)}}
                                        {{ __(' ) เรื่อง') }}
                                    </x-jet-dropdown-link>
                                    @endif

                                    <!-- งาน -->
                                    @if(Auth::user()->level == '7')
                                    <x-jet-dropdown-link href="{{ route('documents_admission_work_inside_all_0') }}"
                                        class="text-decoration-none">
                                        {{ __('เอกสารรับเข้าที่ยังไม่อ่าน ( ') }}
                                        {{navigationController::funtion_document_admission_all_work_inside_count_0_level_7(Auth::user()->level)}}
                                        {{ __(' ) เรื่อง') }}
                                    </x-jet-dropdown-link>
                                    <div class="border-t border-gray-100"></div>
                                    <x-jet-dropdown-link href="{{ route('documents_admission_work_inside_all_1') }}"
                                        class="text-decoration-none">
                                        {{ __('เอกสารรับเข้าที่อ่านแล้ว ( ') }}
                                        {{navigationController::funtion_document_admission_all_work_inside_count_1_level_7(Auth::user()->level)}}
                                        {{ __(' ) เรื่อง') }}
                                    </x-jet-dropdown-link>
                                    @endif
                                </x-slot>
                            </x-jet-dropdown>
                        </div>
                    </div>
                    @endif
                    @if(Auth::user()->jurisprudence == '1')
                    <!-- Dropdown นิติการ -->
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <div class="relative ml-1">
                            <x-jet-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <span class="inline-flex rounded-md">
                                        <button type="button"
                                            class="inline-flex items-center px-3 py-1 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white rounded-md hover:text-gray-700 focus:outline-none">
                                            {{ __('นิติการ') }}


                                            <span class="badge badge-pill badge-danger ml-2 -mr-0.5" id="funtion_document_documents_admission_jurisprudence_all_count">
                                            </span>

                                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </span>
                                </x-slot>
                                <x-slot name="content">
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('เมนู') }}
                                    </div>
                                    <div class="border-t border-gray-100"></div>
                                        <x-jet-dropdown-link href="{{ route('documents_admission_jurisprudence_all') }}"
                                            class="text-decoration-none">
                                            {{ __('อนุมัติเอกสารตอบกลับภายนอก ( ') }}  
                                            {{navigationController::funtion_document_documents_admission_jurisprudence_all_count()}}
                                            {{ __(' ) เรื่อง') }}
                                        </x-jet-dropdown-link>
                                </x-slot>
                            </x-jet-dropdown>
                        </div>
                    </div>
                    @endif

                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Teams Dropdown -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                <div class="relative ml-3">
                    <x-jet-dropdown align="right" width="60">
                        <x-slot name="trigger">
                            <span class="inline-flex rounded-md">
                                <button type="button"
                                    class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50">
                                    {{ Auth::user()->currentTeam->name }}

                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </span>
                        </x-slot>

                        <x-slot name="content">
                            <div class="w-60">
                                <!-- Team Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Manage Team') }}
                                </div>

                                <!-- Team Settings -->
                                <x-jet-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                    {{ __('Team Settings') }}
                                </x-jet-dropdown-link>

                                @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                <x-jet-dropdown-link href="{{ route('teams.create') }}">
                                    {{ __('Create New Team') }}
                                </x-jet-dropdown-link>
                                @endcan

                                <div class="border-t border-gray-100"></div>

                                <!-- Team Switcher -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Switch Teams') }}
                                </div>

                                @foreach (Auth::user()->allTeams() as $team)
                                <x-jet-switchable-team :team="$team" />
                                @endforeach
                            </div>
                        </x-slot>
                    </x-jet-dropdown>
                </div>
                @endif

                <!-- Settings Dropdown -->
                <div class="relative ml-3">
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">



                            <span class="inline-flex rounded-md">
                                <button type="button"
                                    class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md hover:text-gray-700 focus:outline-none">
                                    {{ __('คุณ') }} {{ Auth::user()->name }}
                                    <div class="block px-1 py-1 text-gray-400">
                                        {{ __(' : ') }} {{ Auth::user()->pos }}
                                    </div>
                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                        <button
                                            class="flex text-sm transition duration-150 ease-in-out border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300">
                                            <img class="object-cover w-8 h-8 rounded-full"
                                                src="{{ Auth::user()->profile_photo_url }}"
                                                alt="{{ Auth::user()->name }}" />
                                        </button>
                                    </svg>
                                </button>
                            </span>

                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('โปรไฟล์ของฉัน') }}
                            </div>

                            <x-jet-dropdown-link href="{{ route('profile.show') }}" class="text-decoration-none">
                                {{ __('โปรไฟล์') }}
                            </x-jet-dropdown-link>
                            @if(Auth::user()->level == '4')
                            <x-jet-dropdown-link href="{{ route('replace') }}" class="text-decoration-none">
                                {{ __('รักษาการแทน') }}
                            </x-jet-dropdown-link>
                            @endif

                            @if(Auth::user()->level == '3')
                            <x-jet-dropdown-link href="{{ route('s_groupmem') }}" class="text-decoration-none">
                                {{ __('จัดการกองงาน') }}
                            </x-jet-dropdown-link>
                            @endif
                            @if(Auth::user()->level == '3' || Auth::user()->level == '6')
                            <x-jet-dropdown-link href="{{ route('s_member') }}" class="text-decoration-none">
                                {{ __('จัดการสมาชิก') }}
                            </x-jet-dropdown-link>
                            @endif

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                            <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                {{ __('API Tokens') }}
                            </x-jet-dropdown-link>
                            @endif

                            <div class="border-t border-gray-100"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-jet-dropdown-link href="#" class="text-decoration-none" onclick="logout(this);">
                                {{ __('ออกจากระบบ') }}
                                </x-jet-dropdown-link>
                            </form>
                        </x-slot>
                    </x-jet-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="flex items-center -mr-2 sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">


            @if(Auth::user()->level=='0')
            <!-- admin -->

            <x-jet-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')"
                class="text-decoration-none">
                {{ __('หน้าหลัก') }}
            </x-jet-responsive-nav-link>
            <div class="border-t border-gray-100"></div>
            <x-jet-responsive-nav-link href="{{ route('sites') }}" :active="request()->routeIs('sites')"
                class="text-decoration-none">
                {{ __('site') }}
            </x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link href="{{ route('groupmem') }}" :active="request()->routeIs('groupmem')"
                class="text-decoration-none">
                {{ __('กลุ่มงาน') }}
            </x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link href="{{ route('cottons_all') }}" :active="request()->routeIs('cottons_all')"
                class="text-decoration-none">
                {{ __('ฝ่าย') }}
            </x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link href="{{ route('member') }}" :active="request()->routeIs('member')"
                class="text-decoration-none">
                {{ __('ชื่อผู้ใช้') }}
            </x-jet-responsive-nav-link>

            @elseif(Auth::user()->level !='0')
            <!-- user -->
            <x-jet-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')"
                class="text-decoration-none">
                {{ __('หน้าหลัก') }}
            </x-jet-responsive-nav-link>
            <div class="border-t border-gray-100"></div>
            <!-- สารบรรณกลาง -->
            @if(Auth::user()->level == '3')
            <x-jet-responsive-nav-link type="button" data-toggle="modal" class="text-decoration-none"
                data-target="#modal-Create-new-document">
                {{ __('สร้างเอกสารลงรับ') }}
            </x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link href="{{ route('documents_admission_all') }}" class="text-decoration-none">
                {{ __('เอกสารรับเข้าทั้งหมด ( ') }}
                {{navigationController::funtion_document_admission_all_count_level_3(Auth::user()->level)}}
                {{ __(' ) เรื่อง') }}
            </x-jet-responsive-nav-link>
            <div class="border-t border-gray-100"></div>
            <x-jet-responsive-nav-link href="{{ route('reserve_number_receive_all') }}" class="text-decoration-none">
                {{ __('จองเลขรับ') }}
            </x-jet-responsive-nav-link>
            @endif

            <!-- หัวหน้ากอง -->
            @if(Auth::user()->level == '4')
            @if(navigationController::funtion_Groupmem_check_group_name_level_4(Auth::user()->level)
            == 'สำนักปลัด')
            <!-- สำนักปลัดเท่านั้น -->
            <x-jet-responsive-nav-link href="{{ route('documents_pending_all') }}" class="text-decoration-none">
                {{ __('เอกสารรอพิจารณาจากสารบรรณกลาง ( ') }}
                {{navigationController::funtion_document_waiting_count_level_4(Auth::user()->level)}}
                {{ __(' ) เรื่อง') }}
            </x-jet-responsive-nav-link>
            <div class="border-t border-gray-100"></div>
            @endif
            <x-jet-responsive-nav-link href="{{ route('documents_admission_division_all_0') }}"
                class="text-decoration-none">
                {{ __('มีเอกสารภายนอกรอพิจารณา ( ') }}
                {{navigationController::funtion_document_admission_division_all_count_0_level_4(Auth::user()->level)}}
                {{ __(' ) เรื่อง') }}
            </x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link href="{{ route('documents_admission_division_all_1') }}"
                class="text-decoration-none">
                {{ __('เอกสารที่เซ็นแล้ว ( ') }}
                {{navigationController::funtion_document_admission_division_all_count_1_level_4(Auth::user()->level)}}
                {{ __(' ) เรื่อง') }}
            </x-jet-responsive-nav-link>
            <div class="border-t border-gray-100"></div>
            <x-jet-responsive-nav-link href="{{ route('documents_admission_division_retrun') }}"
            class="text-decoration-none">
                {{ __('บันทึกข้อความ ( ') }}
                {{navigationController::funtion_document_admission_division_retrun_count_level_4(Auth::user()->level)}}
                {{ __(' ) รายการ') }}
            </x-jet-responsive-nav-link>
            <div class="border-t border-gray-100"></div>
            <x-jet-responsive-nav-link href="{{ route('documents_admission_division_inside_all_0') }}"
                class="text-decoration-none">
                {{ __('มีเอกสารภายในรอพิจารณา ( ') }}
                {{navigationController::funtion_document_admission_division_inside_all_count_0_level_4(Auth::user()->level)}}
                {{ __(' ) เรื่อง') }}
            </x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link href="{{ route('documents_admission_division_inside_all_1') }}"
                class="text-decoration-none">
                {{ __('เอกสารที่เซ็นแล้ว ( ') }}
                {{navigationController::funtion_document_admission_division_inside_all_count_1_level_4(Auth::user()->level)}}
                {{ __(' ) เรื่อง') }}
            </x-jet-responsive-nav-link>
            @endif

            <!-- หัวหน้าฝ่าย -->
            @if(Auth::user()->level == '5')
            <x-jet-responsive-nav-link href="{{ route('documents_admission_department_all_0') }}"
                class="text-decoration-none">
                {{ __('มีเอกสารภายนอกรอพิจารณา ( ') }}
                {{navigationController::funtion_document_admission_department_all_count_0_level_5(Auth::user()->level)}}
                {{ __(' ) เรื่อง') }}
            </x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link href="{{ route('documents_admission_department_all_1') }}"
                class="text-decoration-none">
                {{ __('เอกสารที่เซ็นแล้ว ( ') }}
                {{navigationController::funtion_document_admission_department_all_count_1_level_5(Auth::user()->level)}}
                {{ __(' ) เรื่อง') }}
            </x-jet-responsive-nav-link>
            <div class="border-t border-gray-100"></div>
            <x-jet-responsive-nav-link href="{{ route('documents_admission_department_retrun') }}"
            class="text-decoration-none">
                {{ __('บันทึกข้อความ ( ') }}
                {{navigationController::funtion_document_admission_department_retrun_count_level_5(Auth::user()->level)}}
                {{ __(' ) รายการ') }}
            </x-jet-responsive-nav-link>
            <div class="border-t border-gray-100"></div>
            <x-jet-responsive-nav-link href="{{ route('documents_admission_department_inside_all_0') }}"
                class="text-decoration-none">
                {{ __('มีเอกสารภายในรอพิจารณา ( ') }}
                {{navigationController::funtion_document_admission_department_inside_all_count_0_level_5(Auth::user()->level)}}
                {{ __(' ) เรื่อง') }}
            </x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link href="{{ route('documents_admission_department_inside_all_1') }}"
                class="text-decoration-none">
                {{ __('เอกสารที่เซ็นแล้ว ( ') }}
                {{navigationController::funtion_document_admission_department_inside_all_count_1_level_5(Auth::user()->level)}}
                {{ __(' ) เรื่อง') }}
            </x-jet-responsive-nav-link>            
            @endif

            <!-- สารบรรณกอง -->
            @if(Auth::user()->level == '6')
            <x-jet-responsive-nav-link href="{{ route('documents_admission_group_all_0') }}"
                class="text-decoration-none">
                {{ __('มีเอกสารภายนอกใหม่ ( ') }}
                {{navigationController::funtion_document_admission_all_group_count_0_level_6(Auth::user()->level)}}
                {{ __(' ) เรื่อง') }}
            </x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link href="{{ route('documents_admission_group_all_1') }}"
                class="text-decoration-none">
                {{ __('มีเอกสารภายนอกรอดำเนินการ ( ') }}
                {{navigationController::funtion_document_admission_all_group_count_1_level_6(Auth::user()->level)}}
                {{ __(' ) เรื่อง') }}
            </x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link href="{{ route('documents_admission_group_all_2') }}"
                class="text-decoration-none">
                {{ __('มีเอกสารภายนอกที่ดำเนินการแล้ว ( ') }}
                {{navigationController::funtion_document_admission_all_group_count_2_level_6(Auth::user()->level)}}
                {{ __(' ) เรื่อง') }}
            </x-jet-responsive-nav-link>
            <div class="border-t border-gray-100"></div>
            <x-jet-responsive-nav-link href="{{ route('reserve_number_receive_inside_all') }}"
                class="text-decoration-none">
                {{ __('จองเลขรับ') }}
            </x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link href="{{ route('reserve_number_delivery_inside_all') }}"
                class="text-decoration-none">
                {{ __('จองเลขส่ง') }}
            </x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link href="{{ route('reserve_number_announce_all') }}"
                class="text-decoration-none">
                {{ __('จองเลขประกาศ') }}
            </x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link href="{{ route('reserve_number_order_all') }}"
                class="text-decoration-none">
                {{ __('จองเลขคำสั่ง') }}
            </x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link href="{{ route('reserve_number_certificate_all') }}"
                class="text-decoration-none">
                {{ __('จองเลขหนังสือรับรอง') }}
            </x-jet-responsive-nav-link>
            <div class="border-t border-gray-100"></div>
            <x-jet-responsive-nav-link type="button" data-toggle="modal" class="text-decoration-none"
                data-target="#modal-Create-new-document-inside">
                {{ __('สร้างเอกสารภายใน') }}
            </x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link href="{{ route('documents_admission_group_inside_all_0') }}"
                class="text-decoration-none">
                {{ __('มีเอกสารภายในใหม่ (') }}
                {{navigationController::funtion_document_admission_all_group_inside_count_0_level_6(Auth::user()->level)}}
                {{ __(' ) เรื่อง') }}
            </x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link href="{{ route('documents_admission_group_inside_all_1') }}"
                class="text-decoration-none">
                {{ __('มีเอกสารภายในรอดำเนินการ ( ') }}
                {{navigationController::funtion_document_admission_all_group_inside_count_1_level_6(Auth::user()->level)}}
                {{ __(' ) เรื่อง') }}
            </x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link href="{{ route('documents_admission_group_inside_all_2') }}"
                class="text-decoration-none">
                {{ __('มีเอกสารภายในที่ดำเนินการแล้ว ( ') }}
                {{navigationController::funtion_document_admission_all_group_inside_count_2_level_6(Auth::user()->level)}}
                {{ __(' ) เรื่อง') }}
            </x-jet-responsive-nav-link>
            @endif

            <!-- งาน -->
            @if(Auth::user()->level == '7')
            <x-jet-responsive-nav-link href="{{ route('documents_admission_work_all_0') }}"
                class="text-decoration-none">
                {{ __('เอกสารรับเข้าภายนอกที่ยังไม่อ่าน ( ') }}
                {{navigationController::funtion_document_admission_all_work_count_0_level_7(Auth::user()->level)}}
                {{ __(' ) เรื่อง') }}
            </x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link href="{{ route('documents_admission_work_all_1') }}"
                class="text-decoration-none">
                {{ __('เอกสารรับเข้าภายนอกที่อ่านแล้ว ( ') }}
                {{navigationController::funtion_document_admission_all_work_count_1_level_7(Auth::user()->level)}}
                {{ __(' ) เรื่อง') }}
            </x-jet-responsive-nav-link>
            <div class="border-t border-gray-100"></div>
            <x-jet-responsive-nav-link href="{{ route('documents_admission_work_inside_all_0') }}"
                class="text-decoration-none">
                {{ __('เอกสารรับเข้าภายในที่ยังไม่อ่าน ( ') }}
                {{navigationController::funtion_document_admission_all_work_inside_count_0_level_7(Auth::user()->level)}}
                {{ __(' ) เรื่อง') }}
            </x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link href="{{ route('documents_admission_work_inside_all_1') }}"
                class="text-decoration-none">
                {{ __('เอกสารรับเข้าภายในที่อ่านแล้ว ( ') }}
                {{navigationController::funtion_document_admission_all_work_inside_count_1_level_7(Auth::user()->level)}}
                {{ __(' ) เรื่อง') }}
            </x-jet-responsive-nav-link>
            @endif

            <!-- นายก -->
            @if(Auth::user()->level == '1')
            <x-jet-responsive-nav-link href="{{ route('documents_admission_minister_all_0') }}" class="text-decoration-none">
                {{ __('เอกสารรอพิจารณา ( ') }}
                {{navigationController::funtion_documents_admission_minister_all_count_0_level_1(Auth::user()->level)}}
                {{ __(' ) เรื่อง') }}
            </x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link href="{{ route('documents_admission_minister_all_1') }}" class="text-decoration-none">
                {{ __('เอกสารที่เซ็นแล้ว ( ') }}
                {{navigationController::funtion_documents_admission_minister_all_count_1_level_1(Auth::user()->level)}}
                {{ __(' ) เรื่อง') }}
            </x-jet-responsive-nav-link>
            @endif
           
            <!-- นิติการ -->
            @if(Auth::user()->jurisprudence == '1')
            <div class="border-t border-gray-100"></div>
            <x-jet-responsive-nav-link href="{{ route('documents_admission_jurisprudence_all') }}" class="text-decoration-none">
                {{ __('อนุมัติเอกสารตอบกลับภายนอก ( ') }}
                {{ __(' ) เรื่อง') }}
            </x-jet-responsive-nav-link>
            @endif

            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <div class="flex-shrink-0 mr-3">
                    <img class="object-cover w-10 h-10 rounded-full" src="{{ Auth::user()->profile_photo_url }}"
                        alt="{{ Auth::user()->name }}" />
                </div>
                @endif

                <div>
                    <div class="text-base font-medium text-gray-800">{{ __('คุณ ') }}{{ Auth::user()->name }}</div>
                    <div class="text-sm font-medium text-gray-500">{{ __(' : ') }} {{ Auth::user()->pos }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-jet-responsive-nav-link href="{{ route('profile.show') }}" class="text-decoration-none"
                    :active="request()->routeIs('profile.show')">
                    {{ __('โปรไฟล์') }}
                </x-jet-responsive-nav-link>
                
                <x-jet-responsive-nav-link href="{{ route('s_member') }}" class="text-decoration-none"
                    :active="request()->routeIs('s_member')">
                    {{ __('จัดการสมาชิก') }}
                </x-jet-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                <x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}"
                    :active="request()->routeIs('api-tokens.index')">
                    {{ __('API Tokens') }}
                </x-jet-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-jet-responsive-nav-link href="#" class="text-decoration-none" onclick="logout(this);">
                        {{ __('ออกจากระบบ') }}
                    </x-jet-responsive-nav-link>
                </form>

                <!-- Team Management -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                <div class="border-t border-gray-200"></div>

                <div class="block px-4 py-2 text-xs text-gray-400">
                    {{ __('Manage Team') }}
                </div>

                <!-- Team Settings -->
                <x-jet-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}"
                    :active="request()->routeIs('teams.show')">
                    {{ __('Team Settings') }}
                </x-jet-responsive-nav-link>

                @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                <x-jet-responsive-nav-link href="{{ route('teams.create') }}"
                    :active="request()->routeIs('teams.create')">
                    {{ __('Create New Team') }}
                </x-jet-responsive-nav-link>
                @endcan

                <div class="border-t border-gray-200"></div>

                <!-- Team Switcher -->
                <div class="block px-4 py-2 text-xs text-gray-400">
                    {{ __('Switch Teams') }}
                </div>

                @foreach (Auth::user()->allTeams() as $team)
                <x-jet-switchable-team :team="$team" component="jet-responsive-nav-link" />
                @endforeach
                @endif
            </div>
        </div>
    </div>

    <!-- สร้างเอกสารใหม่ -->
    @if(Auth::user()->level == '3')
    <div class="modal fade" id="modal-Create-new-document">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title"><i class="nav-icon fas fa-file-signature"></i>
                        สร้างเอกสารใหม่
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('document_accepting_new')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <x-jet-label for="doc_recnum" value="{{ __('เลขที่รับส่วนงาน') }}" />
                                    <select class="form-control select2bs4 @error('doc_recnum') is-invalid @enderror"
                                        name="doc_recnum" id="member_dashoardController_doc_recnum" required>
                                        <optgroup label="เลขรันปกติ">
                                            <option
                                                value="{{functionController::funtion_documents_doc_recnum_plus(Auth::user()->site_id)}}">
                                                (
                                                {{functionController::funtion_documents_doc_recnum_plus(Auth::user()->site_id)}}
                                                )
                                            </option>
                                        </optgroup>
                                        <optgroup label="เลขที่จองไว้">
                                            @foreach(navigationController::funtion_reserved_numbersS_level_3(Auth::user()->level) as $row_reserved_numbers)
                                            <option value="{{$row_reserved_numbers->reserve_number}}"
                                                data-id="{{$row_reserved_numbers->reserve_id}}">
                                                ( {{$row_reserved_numbers->reserve_number}} )
                                                {{functionController::funtion_date_format($row_reserved_numbers->reserve_date)}}
                                            </option>
                                            @endforeach
                                        </optgroup>
                                        <optgroup label="เลขที่หลุดจอง">
                                            @foreach(navigationController::funtion_dropped_numbersS_level_3(Auth::user()->level) as $row_dropped_numbers)
                                            <option value="{{$row_dropped_numbers->reserve_number}}"
                                                data-id="{{$row_dropped_numbers->reserve_id}}">
                                                ( {{$row_dropped_numbers->reserve_number}} )
                                                {{functionController::funtion_date_format($row_dropped_numbers->reserve_date)}}
                                            </option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                    @error('doc_recnum')
                                    <div class="my-2">
                                        <p class="mt-2 text-sm text-red-600">
                                            {{$message}}</p>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <x-jet-label for="doc_docnum" value="{{ __('เลขที่หนังสือ') }}" />
                                    <input type="text" name="doc_docnum"
                                        class="form-control @error('doc_docnum') is-invalid @enderror" required>
                                    @error('doc_docnum')
                                    <div class="my-2">
                                        <p class="mt-2 text-sm text-red-600">
                                            {{$message}}</p>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <x-jet-label for="doc_date" value="{{ __('วันที่') }}" />
                                    <input type="date" name="doc_date" value="{{date('Y-m-d')}}"
                                        class="form-control @error('doc_date') is-invalid @enderror" required>
                                    @error('doc_date')
                                    <div class="my-2">
                                        <p class="mt-2 text-sm text-red-600">
                                            {{$message}}</p>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <x-jet-label for="doc_date_2" value="{{ __('ลงวันที่') }}" />
                                    <input type="date" name="doc_date_2" value="{{date('Y-m-d')}}"
                                        id="member_dashoardController_doc_date_2"
                                        class="form-control @error('doc_date_2') is-invalid @enderror" required>
                                    @error('doc_date_2')
                                    <div class="my-2">
                                        <p class="mt-2 text-sm text-red-600">
                                            {{$message}}</p>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <x-jet-label for="doc_time" value="{{ __('เวลา') }}" />
                                    <input type="time" name="doc_time" value="{{date('H:i')}}"
                                        class="form-control @error('doc_time') is-invalid @enderror" required>
                                    @error('doc_time')
                                    <div class="my-2">
                                        <p class="mt-2 text-sm text-red-600">
                                            {{$message}}</p>
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <x-jet-label for="seal_point" value="{{ __('ตำแหน่งประทับตรา') }}" />
                                  <!--  <input type="range" name="seal_point" class="form-range hide" value="150" min="10"
                                        max="160" id="member_dashoardController_seal_point" step="1"> -->
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="seal_point" id="seal_point1" value="1">
                                                    <label class="form-check-label" for="seal_point1">
                                                        ตำแหน่งที่ 1
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="seal_point" id="seal_point2" value="2">
                                                    <label class="form-check-label" for="seal_point2">
                                                        ตำแหน่งที่ 2
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="seal_point" id="seal_point3" value="3">
                                                    <label class="form-check-label" for="seal_point3">
                                                        ตำแหน่งที่ 3
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="seal_point" id="seal_point4" value="4">
                                                    <label class="form-check-label" for="seal_point4">
                                                        ตำแหน่งที่ 4
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="seal_point" id="seal_point5" value="5" checked>
                                                    <label class="form-check-label" for="seal_point5" >
                                                        ตำแหน่งที่ 5
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <table class="table table-bordered table-hover">
                                            <tbody>
                                                <tr data-widget="expandable-table" aria-expanded="false">
                                                    <td><center>ดูรูปตัวอย่างตำแหน่งประทับตรา </center></td>
                                                </tr>
                                                <tr class="expandable-body">
                                                    <td colspan="1">
                                                        <p style="">
                                                            <img src="{{ asset('/image/seal_point.jpg') }}" width="850" height="auto">
                                                        </p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <x-jet-label for="doc_origin" value="{{ __('หน่วยงานเจ้าของเรื่อง') }}" />
                                    <input type="text" name="doc_origin"
                                        class="form-control @error('doc_origin') is-invalid @enderror" required>
                                    @error('doc_origin')
                                    <div class="my-2">
                                        <p class="mt-2 text-sm text-red-600">
                                            {{$message}}</p>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <x-jet-label for="doc_title" value="{{ __('เรื่อง') }}" />
                                    <textarea name="doc_title" rows="4" cols="50"
                                        class="form-control @error('doc_title') is-invalid @enderror"
                                        required></textarea>
                                    @error('doc_title')
                                    <div class="my-2">
                                        <p class="mt-2 text-sm text-red-600">
                                            {{$message}}</p>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <x-jet-label for="doc_filedirec" value="{{ __('อัพโหลดไฟล์เอกสาร') }}" />
                                    <input type="file" name="doc_filedirec" accept="application/pdf"
                                        class="form-control @error('doc_filedirec') is-invalid @enderror" required>
                                    @error('doc_filedirec')
                                    <div class="my-2">
                                        <p class="mt-2 text-sm text-red-600">
                                            {{$message}}</p>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-check">
                                            <input class="form-check-input  @error('') is-invalid @enderror" value="0"
                                                type="radio" name="RadioAttachments"
                                                id="member_dashoardController_RadioAttachments_0" checked>
                                            <label class="form-check-label"
                                                for="member_dashoardController_RadioAttachments_0">
                                                <x-jet-label for="member_dashoardController_RadioAttachments_0"
                                                    value="{{ __('ไม่มีไฟล์แนบ') }}" />
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-check">
                                            <input class="form-check-input  @error('') is-invalid @enderror" value="1"
                                                type="radio" name="RadioAttachments"
                                                id="member_dashoardController_RadioAttachments_1">
                                            <label class="form-check-label"
                                                for="member_dashoardController_RadioAttachments_1">
                                                <x-jet-label for="member_dashoardController_RadioAttachments_1"
                                                    value="{{ __('มีไฟล์แนบ') }}" />
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                    </div>
                                    @error('')
                                    <div class="my-2">
                                        <p class="mt-2 text-sm text-red-600">
                                            {{$message}}</p>
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group hide"
                                    id="member_dashoardController_doc_attached_file_form-group_group">
                                    <x-jet-label for="doc_attached_file" class="text-primary"
                                        value="{{ __('(เพิ่มไฟล์แนบ)') }}" />
                                    <input type="file" name="doc_attached_file"
                                        id="member_dashoardController_doc_attached_file"
                                        class="form-control @error('doc_attached_file') is-invalid @enderror">
                                    <p class="text-sm text-primary">
                                        ไฟล์เอกสารที่สามารถแนบกับไฟล์เอกสารอัพโหลดได้ต้องมีนามสกุล .gif, .jpg,
                                        .jpeg,
                                        .pdf, .png, .csv, .xls, .xlsx, .doc และ .docx เท่านั้น
                                        หากมีไฟล์แนบมากกว่า 1 ไฟล์ กรุณา zip ก่อนอัพโหลด</p>
                                    @error('doc_attached_file')
                                    <div class="my-2">
                                        <p class="mt-2 text-sm text-red-600">
                                            {{$message}}</p>
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <x-jet-label for="doc_speed" value="{{ __('ชั้นความเร็ว') }}" />
                                    <select class="form-control select2bs4 @error('doc_speed') is-invalid @enderror"
                                        required name="doc_speed">
                                        <option value="0">ปกติ</option>
                                        <option value="1">ด่วน</option>
                                        <option value="2">ด่วนมาก</option>
                                        <option value="3">ด่วนที่สุด</option>
                                    </select>
                                    @error('doc_speed')
                                    <div class="my-2">
                                        <p class="mt-2 text-sm text-red-600">
                                            {{$message}}</p>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <x-jet-label for="doc_secret" value="{{ __('ชั้นความลับ') }}" />
                                    <select class="form-control select2bs4 @error('doc_secret') is-invalid @enderror"
                                        required name="doc_secret">
                                        <option value="0">ปกติ</option>
                                        <option value="1">ลับ</option>
                                        <option value="2">ลับมาก</option>
                                        <option value="3">ลับที่สุด</option>
                                    </select>
                                    @error('doc_secret')
                                    <div class="my-2">
                                        <p class="mt-2 text-sm text-red-600">
                                            {{$message}}</p>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <x-jet-button onclick="submitForm(this);">
                            {{ __('save') }}
                        </x-jet-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!--  สร้างเอกสารภายใน -->
    @if(Auth::user()->level == '6')
    <div class="modal fade" id="modal-Create-new-document-inside">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title"><i class="nav-icon fas fa-file-signature"></i>
                        สร้างเอกสารใหม่ภายใน
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('document_accepting_new_inside')}}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <x-jet-label for="doc_template_inside" value="{{ __('ประเภทเอกสาร') }}" />
                                    <select
                                        class="form-control select2bs4 @error('doc_template_inside') is-invalid @enderror"
                                        name="doc_template_inside" id="member_dashoardController_doc_template_inside"
                                        required>
                                        <option value="">
                                            เลือก ประเภทเอกสาร
                                        </option>
                                        <option value="B">
                                            เลขส่งออกภายใน
                                        </option>
                                        <option value="C">
                                            เลขประกาศ
                                        </option>
                                        <option value="D">
                                            เลขส่งคำสั่ง
                                        </option>
                                        <option value="E">
                                            เลขส่งหนังสือรับรอง
                                        </option>
                                    </select>
                                    @error('doc_template_inside')
                                    <div class="my-2">
                                        <p class="mt-2 text-sm text-red-600">
                                            {{$message}}</p>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <x-jet-label for="doc_recnum_inside" value="{{ __('เลขส่ง') }}" />
                                    <select class="form-control" name="doc_recnum_inside" required
                                        id="member_dashoardController_doc_recnum_inside">
                                    </select>
                                    @error('doc_recnum_inside')
                                    <div class="my-2">
                                        <p class="mt-2 text-sm text-red-600">
                                            {{$message}}</p>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <x-jet-label for="doc_docnum_inside" value="{{ __('เลขที่หนังสือ') }}" />
                                    <input type="text" name="doc_docnum_inside"
                                        class="form-control @error('doc_docnum_inside') is-invalid @enderror" required>
                                    @error('doc_docnum_inside')
                                    <div class="my-2">
                                        <p class="mt-2 text-sm text-red-600">
                                            {{$message}}</p>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <x-jet-label for="doc_date_inside" value="{{ __('วันที่') }}" />
                                    <input type="date" name="doc_date_inside" value="{{date('Y-m-d')}}"
                                        class="form-control @error('doc_date_inside') is-invalid @enderror" required>
                                    @error('doc_date_inside')
                                    <div class="my-2">
                                        <p class="mt-2 text-sm text-red-600">
                                            {{$message}}</p>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <x-jet-label for="doc_date_2_inside" value="{{ __('ลงวันที่') }}" />
                                    <input type="date" name="doc_date_2_inside" value="{{date('Y-m-d')}}"
                                        id="member_dashoardController_doc_date_2_inside"
                                        class="form-control @error('doc_date_2_inside') is-invalid @enderror" required>
                                    @error('doc_date_2_inside')
                                    <div class="my-2">
                                        <p class="mt-2 text-sm text-red-600">
                                            {{$message}}</p>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <x-jet-label for="doc_time_inside" value="{{ __('เวลา') }}" />
                                    <input type="time" name="doc_time_inside" value="{{date('H:i')}}"
                                        class="form-control @error('doc_time_inside') is-invalid @enderror" required>
                                    @error('doc_time_inside')
                                    <div class="my-2">
                                        <p class="mt-2 text-sm text-red-600">
                                            {{$message}}</p>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <x-jet-label for="doc_title_inside" value="{{ __('เรื่อง') }}" />
                                    <textarea name="doc_title_inside" rows="4" cols="50"
                                        class="form-control @error('doc_title_inside') is-invalid @enderror"
                                        required></textarea>
                                    @error('doc_title_inside')
                                    <div class="my-2">
                                        <p class="mt-2 text-sm text-red-600">
                                            {{$message}}</p>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <x-jet-label for="doc_filedirec_inside" value="{{ __('อัพโหลดไฟล์เอกสาร') }}" />
                                    <input type="file" name="doc_filedirec_inside" accept="application/pdf"
                                        class="form-control @error('doc_filedirec_inside') is-invalid @enderror"
                                        required>
                                    @error('doc_filedirec_inside')
                                    <div class="my-2">
                                        <p class="mt-2 text-sm text-red-600">
                                            {{$message}}</p>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-check">
                                            <input class="form-check-input  @error('') is-invalid @enderror" value="0"
                                                type="radio" name="RadioAttachments_inside"
                                                id="member_dashoardController_RadioAttachments_inside_0" checked>
                                            <label class="form-check-label"
                                                for="member_dashoardController_RadioAttachments_inside_0">
                                                <x-jet-label for="member_dashoardController_RadioAttachments_inside_0"
                                                    value="{{ __('ไม่มีไฟล์แนบ') }}" />
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-check">
                                            <input class="form-check-input  @error('') is-invalid @enderror" value="1"
                                                type="radio" name="RadioAttachments_inside"
                                                id="member_dashoardController_RadioAttachments_inside_1">
                                            <label class="form-check-label"
                                                for="member_dashoardController_RadioAttachments_inside_1">
                                                <x-jet-label for="member_dashoardController_RadioAttachments_inside_1"
                                                    value="{{ __('มีไฟล์แนบ') }}" />
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                    </div>
                                    @error('')
                                    <div class="my-2">
                                        <p class="mt-2 text-sm text-red-600">
                                            {{$message}}</p>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group hide"
                                    id="member_dashoardController_doc_attached_file_inside_form-group_group">
                                    <x-jet-label for="doc_attached_file_inside" class="text-primary"
                                        value="{{ __('(เพิ่มไฟล์แนบ)') }}" />
                                    <input type="file" name="doc_attached_file_inside"
                                        id="member_dashoardController_doc_attached_file_inside"
                                        class="form-control @error('doc_attached_file_inside') is-invalid @enderror">
                                    <p class="text-sm text-primary">
                                        ไฟล์เอกสารที่สามารถแนบกับไฟล์เอกสารอัพโหลดได้ต้องมีนามสกุล .gif, .jpg,
                                        .jpeg,
                                        .pdf, .png, .csv, .xls, .xlsx, .doc และ .docx เท่านั้น
                                        หากมีไฟล์แนบมากกว่า 1 ไฟล์ กรุณา zip ก่อนอัพโหลด</p>
                                    @error('doc_attached_file_inside')
                                    <div class="my-2">
                                        <p class="mt-2 text-sm text-red-600">
                                            {{$message}}</p>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <x-jet-label for="doc_speed_inside" value="{{ __('ชั้นความเร็ว') }}" />
                                    <select
                                        class="form-control select2bs4 @error('doc_speed_inside') is-invalid @enderror"
                                        required name="doc_speed_inside">
                                        <option value="0">ปกติ</option>
                                        <option value="1">ด่วน</option>
                                        <option value="2">ด่วนมาก</option>
                                        <option value="3">ด่วนที่สุด</option>
                                    </select>
                                    @error('doc_speed_inside')
                                    <div class="my-2">
                                        <p class="mt-2 text-sm text-red-600">
                                            {{$message}}</p>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <x-jet-label for="doc_secret_inside" value="{{ __('ชั้นความลับ') }}" />
                                    <select
                                        class="form-control select2bs4 @error('doc_secret_inside') is-invalid @enderror"
                                        required name="doc_secret_inside">
                                        <option value="0">ปกติ</option>
                                        <option value="1">ลับ</option>
                                        <option value="2">ลับมาก</option>
                                        <option value="3">ลับที่สุด</option>
                                    </select>
                                    @error('doc_secret_inside')
                                    <div class="my-2">
                                        <p class="mt-2 text-sm text-red-600">
                                            {{$message}}</p>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <x-jet-label for="send_inside" value="{{ __('เลือกส่ง') }}" />
                                    <select class="form-control select2bs4 @error('send_inside') is-invalid @enderror"
                                        id="member_dashoardController_send_inside" required name="send_inside">
                                        <option value="">เลือกส่ง</option>
                                        <option value="0">ภายในกอง</option>
                                        <option value="1">กองอื่น</option>
                                    </select>
                                    @error('send_inside')
                                    <div class="my-2">
                                        <p class="mt-2 text-sm text-red-600">
                                            {{$message}}</p>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group hide"
                                    id="documents_admission_group_allController_selected_multiple_sub_recid_inside_form-group">
                                    <x-jet-label for="sub_recid_inside" value="{{ __('เลือกกอง') }}" />
                                    <select name="sub_recid_inside[]"
                                        id="documents_admission_group_allController_selected_multiple_sub_recid_inside"
                                        multiple="multiple" class=" @error('sub_recid_inside') is-invalid @enderror">
                                        @foreach(navigationController::funtion_GroupmemS_level_6(Auth::user()->level) as $row_GroupmemS)
                                        <option value="{{$row_GroupmemS->group_id}}">
                                            {{$row_GroupmemS->group_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('sub_recid_inside')
                                    <div class="my-2">
                                        <p class="mt-2 text-sm text-red-600">
                                            {{$message}}</p>
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group hide"
                                    id="documents_admission_group_allController_selected_multiple_sub2_recid_inside_form-group">
                                    <x-jet-label for="sub2_recid_inside" value="{{ __('เลือกผู้รับ') }}" />
                                    <select name="sub2_recid_inside[]"
                                        id="documents_admission_group_allController_selected_multiple_sub2_recid_inside"
                                        multiple="multiple" class=" @error('sub2_recid_inside') is-invalid @enderror">
                                        @foreach(navigationController::funtion_UserS_level_6(Auth::user()->level) as $row_UserS)
                                        <option value="{{$row_UserS->id}}">
                                            {{$row_UserS ->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('sub2_recid_inside')
                                    <div class="my-2">
                                        <p class="mt-2 text-sm text-red-600">
                                            {{$message}}</p>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <x-jet-button onclick="submitForm(this);">
                            {{ __('save') }}
                        </x-jet-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif 
</nav>

    
