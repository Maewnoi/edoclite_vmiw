@php
use App\Http\Controllers\functionController;
@endphp
<x-app-layout>
    <!-- <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
        </h2>
    </x-slot> -->
    <div class="py-12">
        <div class="container">
            <div class="container-fluid">
                <div class="row">
                    @if(session("success"))
                    <div class="shadow alert alert-success">{{session('success')}}</div>
                    @endif
                    @if ($errors->any())
                    @foreach ($errors->all() as $error)
                    <div class="shadow alert alert-danger">{{ $error }}</div>
                    @endforeach
                    @endif
                    <!-- สารบรรณกลาง -->
                    @if(Auth::user()->level == '3')
                    <div class="col-md-5">
                        <div class="shadow card">
                            <div class="card-header bg-primary">
                                <h5 class="card-title">เอกสารรับเข้าภายนอกทั้งหมด</h5>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <input type="hidden"
                                    id="member_dashboard_input_documents_admission_all_waiting_count_level_3"
                                    value="{{$document_admission_all_waiting_count}}" class="form-control">
                                <input type="hidden"
                                    id="member_dashboard_input_documents_admission_all_success_count_level_3"
                                    value="{{$document_admission_all_success_count}}" class="form-control">
                                <div id="chart_level_3" style="height: 250px; width: 100%;"></div>
                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="shadow card">
                            <div class="card-header bg-primary">
                                <h5 class="card-title">ปฏิทินเลขที่จอง</h5>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <input type="hidden" id="member_dashboard_input_calendar_reserve_numbers"
                                    value="{{Auth::user()->id}}" class="form-control">
                                <div id="calendar"></div>
                                <div id="external-events"></div>
                            </div>
                            <div class="card-footer">
                                <span class="badge badge-info">เลขรับภายนอก</span> <span
                                    class="badge badge-secondary">เลขรับภายใน</span>
                            </div>
                        </div>
                    </div>
                    @endif
                    <!-- หัวหน้ากอง -->
                    @if(Auth::user()->level == '4')
                    <div class="col-md-6">
                        <div class="shadow card">
                            <div class="card-header bg-primary">
                                <h5 class="card-title">ทะเบียนหนังสือภายนอก</h5>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <input type="hidden"
                                    id="member_dashboard_input_documents_admission_division_all_count_0_level_4"
                                    value="{{$documents_admission_division_all_count_0}}" class="form-control">
                                <input type="hidden"
                                    id="member_dashboard_input_documents_admission_division_all_count_1_level_4"
                                    value="{{$documents_admission_division_all_count_1}}" class="form-control">
                                <div id="chart_level_4" style="height: 250px; width: 100%;"></div>
                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="shadow card">
                            <div class="card-header bg-primary">
                                <h5 class="card-title">ทะเบียนหนังสือภายใน</h5>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <input type="hidden"
                                    id="member_dashboard_input_documents_admission_division_inside_all_count_0_level_4"
                                    value="{{$documents_admission_division_inside_all_count_0}}" class="form-control">
                                <input type="hidden"
                                    id="member_dashboard_input_documents_admission_division_inside_all_count_1_level_4"
                                    value="{{$documents_admission_division_inside_all_count_1}}" class="form-control">
                                <div id="chart_inside_level_4" style="height: 250px; width: 100%;"></div>
                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                    @endif
                    <!-- หัวหน้าฝ่าย -->
                    @if(Auth::user()->level == '5')
                    <div class="col-md-6">
                        <div class="shadow card">
                            <div class="card-header bg-primary">
                                <h5 class="card-title">ทะเบียนหนังสือภายนอก</h5>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <input type="hidden"
                                    id="member_dashboard_input_document_admission_department_all_count_0_level_5"
                                    value="{{$document_admission_department_all_count_0}}" class="form-control">
                                <input type="hidden"
                                    id="member_dashboard_input_document_admission_department_all_count_1_level_5"
                                    value="{{$document_admission_department_all_count_1}}" class="form-control">
                                <div id="chart_level_5" style="height: 250px; width: 100%;"></div>
                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="shadow card">
                            <div class="card-header bg-primary">
                                <h5 class="card-title">ทะเบียนหนังสือภายใน</h5>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <input type="hidden"
                                    id="member_dashboard_input_document_admission_department_inside_all_count_0_level_5"
                                    value="{{$document_admission_department_inside_all_count_0}}" class="form-control">
                                <input type="hidden"
                                    id="member_dashboard_input_document_admission_department_inside_all_count_1_level_5"
                                    value="{{$document_admission_department_inside_all_count_1}}" class="form-control">
                                <div id="chart_inside_level_5" style="height: 250px; width: 100%;"></div>

                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- สารบรรณกอง -->
                    @if(Auth::user()->level == '6')
                    <div class="col-md-5">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="shadow card">
                                    <div class="card-header bg-primary">
                                        <h5 class="card-title">เอกสารรับเข้าภายนอกทั้งหมด</h5>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <input type="hidden"
                                            id="member_dashboard_input_document_admission_all_group_count_0_level_6"
                                            value="{{$document_admission_all_group_count_0}}" class="form-control">
                                        <input type="hidden"
                                            id="member_dashboard_input_document_admission_all_group_count_1_level_6"
                                            value="{{$document_admission_all_group_count_1}}" class="form-control">
                                        <input type="hidden"
                                            id="member_dashboard_input_document_admission_all_group_count_2_level_6"
                                            value="{{$document_admission_all_group_count_2}}" class="form-control">
                                        <div id="chart_level_6" style="height: 250px; width: 100%;"></div>
                                    </div>
                                    <div class="card-footer">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="shadow card">
                                    <div class="card-header bg-primary">
                                        <h5 class="card-title">เอกสารรับเข้าภายในทั้งหมด</h5>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <input type="hidden"
                                            id="member_dashboard_input_document_admission_all_group_inside_count_0_level_6"
                                            value="{{$document_admission_all_group_inside_count_0}}"
                                            class="form-control">
                                        <input type="hidden"
                                            id="member_dashboard_input_document_admission_all_group_inside_count_1_level_6"
                                            value="{{$document_admission_all_group_inside_count_1}}"
                                            class="form-control">
                                        <input type="hidden"
                                            id="member_dashboard_input_document_admission_all_group_inside_count_2_level_6"
                                            value="{{$document_admission_all_group_inside_count_2}}"
                                            class="form-control">
                                        <div id="chart_inside_level_6" style="height: 250px; width: 100%;"></div>
                                    </div>
                                    <div class="card-footer">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="shadow card">
                            <div class="card-header bg-primary">
                                <h5 class="card-title">ปฏิทินเลขที่จอง</h5>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <input type="hidden" id="member_dashboard_input_calendar_reserve_numbers"
                                    value="{{Auth::user()->id}}" class="form-control">
                                <div id="calendar"></div>
                                <div id="external-events"></div>
                            </div>
                            <div class="card-footer">
                                <span class="badge badge-info">เลขรับภายนอก</span> 
                                <span class="badge badge-secondary">เลขรับภายใน</span>
                                <span class="badge badge-primary">เลขส่งภายใน</span>
                                <span class="badge badge-success">เลขประกาศ</span>
                                <span class="badge badge-danger">เลขคำสั่ง</span>
                                <span class="badge badge-warning">เลขหนังสือรับรอง</span>
                            </div>
                        </div>
                    </div>

                    @endif

                    <!-- งาน -->
                    @if(Auth::user()->level == '7')
                    <div class="col-md-6">
                        <div class="shadow card">
                            <div class="card-header bg-primary">
                                <h5 class="card-title">ทะเบียนหนังสือภายนอก</h5>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <input type="hidden"
                                    id="member_dashboard_input_document_admission_all_work_count_0_level_7"
                                    value="{{$document_admission_all_work_count_0}}" class="form-control">
                                <input type="hidden"
                                    id="member_dashboard_input_document_admission_all_work_count_1_level_7"
                                    value="{{$document_admission_all_work_count_1}}" class="form-control">
                                <div id="chart_level_7" style="height: 250px; width: 100%;"></div>
                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="shadow card">
                            <div class="card-header bg-primary">
                                <h5 class="card-title">ทะเบียนหนังสือภายใน</h5>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <input type="hidden"
                                    id="member_dashboard_input_document_admission_all_work_inside_count_0_level_7"
                                    value="{{$document_admission_all_work_inside_count_0}}" class="form-control">
                                <input type="hidden"
                                    id="member_dashboard_input_document_admission_all_work_inside_count_1_level_7"
                                    value="{{$document_admission_all_work_inside_count_1}}" class="form-control">
                                <div id="chart_inside_level_7" style="height: 250px; width: 100%;"></div>
                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
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
                                            @foreach($reserved_numbersS as $row_reserved_numbers)
                                            <option value="{{$row_reserved_numbers->reserve_number}}"
                                                data-id="{{$row_reserved_numbers->reserve_id}}">
                                                ( {{$row_reserved_numbers->reserve_number}} )
                                                {{functionController::funtion_date_format($row_reserved_numbers->reserve_date)}}
                                            </option>
                                            @endforeach
                                        </optgroup>
                                        <optgroup label="เลขที่หลุดจอง">
                                            @foreach($dropped_numbersS as $row_dropped_numbers)
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
                                        <input type="radio" id="seal_point" name="seal_point" value="1"> ตำแหน่งที่ 1 &nbsp;&nbsp;
                                        <input type="radio" id="seal_point" name="seal_point" value="2"> ตำแหน่งที่ 2 &nbsp;&nbsp;
                                        <input type="radio" id="seal_point" name="seal_point" value="3"> ตำแหน่งที่ 3 &nbsp;&nbsp;
                                        <input type="radio" id="seal_point" name="seal_point" value="4"> ตำแหน่งที่ 4  &nbsp;&nbsp;
                                        <input type="radio" id="seal_point" name="seal_point" value="5" checked > ตำแหน่งที่ 5 &nbsp;&nbsp;<br/>
                                        <img src="{{ asset('/image/seal_point.jpg') }}" alt="Girl in a jacket" width="500" height="auto">
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
                        <x-jet-button>
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
                                        @foreach($GroupmemS as $row_GroupmemS)
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
                                        @foreach($UserS as $row_UserS)
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
                        <x-jet-button>
                            {{ __('save') }}
                        </x-jet-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif 
</x-app-layout>