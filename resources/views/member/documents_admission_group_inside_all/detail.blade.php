@php
use App\Http\Controllers\functionController;
@endphp
<x-app-layout>
    <!-- <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            สวัสดี , {{Auth::user()->name}}
        </h2>
    </x-slot> -->
    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                 
                    <div class="border shadow card border-info">
                        <div class="text-lg card-header bg-primary">
                            <x-jet-nav-link href="{{url('/documents_pending/all')}}">
                                <i class="fa fa-arrow-left"></i>
                            </x-jet-nav-link>
                            เอกสารรับเข้าภายในรายละเอียด : {{$document_detail->doc_origin}}
                        </div>
                        <div class="card-body table-responsive">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        เลขที่รับส่วนงาน : <font class="text-primary">{{$document_detail->doc_recnum}}</font>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                       เลขที่หนังสือ : <font class="text-primary">{{$document_detail->doc_docnum}}</font>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                       วันที่ : <font class="text-primary">{{$document_detail->doc_date}}</font>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        ลงวันที่ : <font class="text-primary">{{$document_detail->doc_date}}</font>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        เวลา : <font class="text-primary">{{$document_detail->doc_time}}</font>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        ชั้นความเร็ว/สถานะ : 
                                        {!! functionController::funtion_doc_speed($document_detail->doc_speed) !!}
                                        {!! functionController::funtion_sub_status($document_detail->sub_status) !!}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        เรื่อง : <font class="text-primary">{{$document_detail->doc_title}}</font>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <x-jet-label class="text-md" for="doc_filedirec_1"
                                            value="{{ __('ไฟล์เอกสาร') }}" />
                                     
                                        {!!functionController::display_pdf($document_detail->doc_filedirec)!!}
             

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <x-jet-label class="text-md" for="" value="{{ __('ไฟล์เอกสารแนบ') }}" />
                                        @if($document_detail->doc_attached_file != '')
                                        <button type="button" id="open_doc_attached_file"
                                            value="{{asset($document_detail->doc_attached_file)}}"
                                            class="btn btn-outline-primary col start">
                                            <i class="fas fa-upload"></i>
                                            <span>open & download</span>
                                        </button>
                                        @else
                                        <label class="text-danger">{{ __('--ไม่พบไฟล์เอกสารแนบ--') }}</label>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <hr>
                           
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="callout callout-danger">
                                            <x-jet-label class="text-lg" value="{{ __('สถานะการลงรับหนังสือ') }}" />
                                            @if($document_detail->doc_status == 'success')
                                            <table>
                                            
                                                <tr>
                                                    <td>{{ functionController::funtion_groupmem_name($document_detail->sub_recid) }}</td>
                                                    <td>{!! functionController::funtion_sub_status_detail($document_detail->sub_status) !!}
                                                    </td>
                                                    

                                                </tr>
                                       
                                                
                                               
                                            </table>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                           

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="callout callout-danger"> 
                                            <x-jet-label class="text-lg" value="{{ __('ผู้รับ') }}" />
                                            @if($document_detail->sub_status == '8')
                                            <table>
                                                @foreach($sub2_docs as $row_sub2_docs)
                                                <tr>
                                                    <td>{{ functionController::funtion_users($row_sub2_docs->sub2_recid) }}</td>
                                                    <td>**</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                            @else
                                            <x-jet-label class="text-red-500 text-md"
                                                            value="{{ __('--ยังไม่ถึงผู้รับงาน--') }}" />
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if($document_detail->sub_status == '0')
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{route('documents_admission_group_inside_takedown')}}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="card card-body">
                                            <div class="form-group">
                                                <x-jet-label class="text-lg" value="{{ __('ตำแหน่งประทับตรา') }}" />
                                                <!-- <input type="range" name="seal_point_inside" class="form-range" min="10" value="20"
                                                    max="160" step="1"> -->
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="seal_point_inside" id="seal_point_inside1" value="1">
                                                                <label class="form-check-label" for="seal_point_inside1">
                                                                    ตำแหน่งที่ 1
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="seal_point_inside" id="seal_point_inside2" value="2">
                                                                <label class="form-check-label" for="seal_point_inside2">
                                                                    ตำแหน่งที่ 2
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="seal_point_inside" id="seal_point_inside3" value="3">
                                                                <label class="form-check-label" for="seal_point_inside3">
                                                                    ตำแหน่งที่ 3
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="seal_point_inside" id="seal_point_inside4" value="4" checked>
                                                                <label class="form-check-label" for="seal_point_inside4" >
                                                                    ตำแหน่งที่ 4
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="seal_point_inside" id="seal_point_inside5" value="5">
                                                                <label class="form-check-label" for="seal_point_inside5" >
                                                                    ตำแหน่งที่ 5
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <table class="w-100 table-bordered table-hover">
                                                        <tbody>
                                                            <tr data-widget="expandable-table" aria-expanded="false">
                                                                <td class="text-primary"><center>ดูรูปตัวอย่างตำแหน่งประทับตรา </center></td>
                                                            </tr>
                                                            <tr class="expandable-body">
                                                                <td colspan="1">
                                                                    <p style="">
                                                                        <img src="{{ asset('/image/seal_point.jpg') }}" width="900" height="auto">
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <x-jet-label class="text-md" value="{{ __('เลขที่รับ') }}" />
                                                        <select
                                                            class="form-control select2bs4 @error('sub_recnum_inside') is-invalid @enderror"
                                                            name="sub_recnum_inside" required id="documents_admission_group_inside_allController_sub_recnum">
                                                            <optgroup label="เลขรันปกติ">
                                                                <option
                                                                    value="{{functionController::funtion_documents_doc_recnum_inside_plus(Auth::user()->site_id)}}">
                                                                    ( {{functionController::funtion_documents_doc_recnum_inside_plus(Auth::user()->site_id)}} )
                                                                </option>
                                                            </optgroup>
                                                            <optgroup label="เลขที่จองไว้">
                                                                @foreach($reserved_numbersS as $row_reserved_numbers)
                                                                <option
                                                                    value="{{$row_reserved_numbers->reserve_number}}" data-id="{{$row_reserved_numbers->reserve_id}}">
                                                                    ( {{$row_reserved_numbers->reserve_number}} ) {{functionController::funtion_date_format($row_reserved_numbers->reserve_date)}}
                                                                </option>
                                                                @endforeach
                                                            </optgroup>
                                                            <optgroup label="เลขที่หลุดจอง">
                                                                @foreach($dropped_numbersS as $row_dropped_numbers)
                                                                <option
                                                                    value="{{$row_dropped_numbers->reserve_number}}" data-id="{{$row_dropped_numbers->reserve_id}}">
                                                                    ( {{$row_dropped_numbers->reserve_number}} ) {{functionController::funtion_date_format($row_dropped_numbers->reserve_date)}}
                                                                </option>
                                                                @endforeach
                                                            </optgroup>
                                                        </select>
                                                        @error('sub_recnum_inside')
                                                        <div class="my-2">
                                                            <p class="mt-2 text-sm text-red-600">
                                                                {{$message}}</p>
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <x-jet-label class="text-md" value="{{ __('วันที่') }}" />
                                                        <input type="date" name="sub_date_inside" value="{{date('Y-m-d')}}"
                                                            id="documents_admission_group_inside_allController_sub_date"
                                                            class="form-control @error('sub_date_inside') is-invalid @enderror"
                                                            required>
                                                        @error('sub_date_inside')
                                                        <div class="my-2">
                                                            <p class="mt-2 text-sm text-red-600">
                                                                {{$message}}</p>
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <x-jet-label class="text-md" value="{{ __('เวลา') }}" />
                                                        <input type="time" name="sub_time_inside" value="{{date('H:i')}}"
                                                            class="form-control @error('sub_time_inside') is-invalid @enderror"
                                                            required>
                                                        @error('sub_time_inside')
                                                        <div class="my-2">
                                                            <p class="mt-2 text-sm text-red-600">
                                                                {{$message}}</p>
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <x-jet-label class="text-md"
                                                            value="{{ __('เลือกผู้พิจารณา') }}" />
                                                        <select
                                                            class="form-control select2bs4 @error('sign_goup_0_inside') is-invalid @enderror"
                                                            name="sign_goup_0_inside"
                                                            id="documents_admission_group_inside_allController_sign_goup_0">
                                                            <option value="">ไม่มีผู้พิจารณา</option>
                                                            <option value="cottons">หัวหน้าฝ่าย</option>
                                                            <option value="groupmems">หัวหน้ากอง {{$user_Groupmem->name}}</option>
                                                        </select>
                                                    </div>
                                                    @error('sign_goup_0_inside')
                                                    <div class="my-2">
                                                        <p class="mt-2 text-sm text-red-600">
                                                            {{$message}}</p>
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group"
                                                        id="documents_admission_group_inside_allController_form-group_selected_multiple_sub2_recid">
                                                        <x-jet-label class="text-md" value="{{ __('เลือกผู้รับ') }}" />
                                                        <select name="sub2_recid_inside[]"
                                                            id="documents_admission_group_inside_allController_selected_multiple_sub2_recid"
                                                            multiple="multiple" required
                                                            class=" @error('sub2_recid_inside') is-invalid @enderror">
                                                            @foreach($userS_2 as $row_userS_2)
                                                            <option value="{{$row_userS_2->id}}">
                                                                {{$row_userS_2->name}} {{functionController::funtion_cottons($row_userS_2->cotton)}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('sub2_recid_inside')
                                                        <div class="my-2">
                                                            <p class="mt-2 text-sm text-red-600">
                                                                {{$message}}</p>
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group"
                                                        id="documents_admission_group_inside_allController_form-group_selected_multiple_sub2_recid_cottons" style="display: none;">
                                                        <x-jet-label class="text-md" value="{{ __('เลือกหัวหน้าฝ่าย') }}" />
                                                        <select name="sub2_recid_inside_cottons[]"
                                                            id="documents_admission_group_inside_allController_selected_multiple_sub2_recid_cottons"
                                                            multiple="multiple" required
                                                            class=" @error('sub2_recid_inside_cottons') is-invalid @enderror">
                                                            @foreach($cottons_S as $row_cottons_S)
                                                                <option value="{{$row_cottons_S->cottons_id}}">
                                                                {{$row_cottons_S->name}} {{$row_cottons_S->cottons_name}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('sub2_recid_inside_cottons')
                                                        <div class="my-2">
                                                            <p class="mt-2 text-sm text-red-600">
                                                                {{$message}}</p>
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="doc_id_inside" value="{{$document_detail->doc_id}}"
                                                class="form-control" required>
                                            <input type="hidden" name="sub_id_inside" value="{{$document_detail->sub_id}}"
                                                class="form-control" required>

                                            <input type="hidden" name="doc_docnum_inside"
                                                value="{{$document_detail->doc_docnum}}" class="form-control">
                                            <input type="hidden" name="doc_origin_inside"
                                                value="{{$document_detail->doc_origin}}" class="form-control">
                                            <input type="hidden" name="doc_title_inside"
                                                value="{{$document_detail->doc_title}}" class="form-control">

                                            <input type="hidden" name="doc_recnum_inside"
                                                value="{{$document_detail->doc_recnum}}" class="form-control">
                                            <input type="hidden" name="doc_date_inside" value="{{$document_detail->doc_date}}"
                                                class="form-control">
                                            <input type="hidden" name="doc_time_inside" value="{{$document_detail->doc_time}}"
                                                class="form-control">

                                            <input type="hidden" name="doc_filedirec_inside"
                                                value="{{$document_detail->doc_filedirec}}" class="form-control">

                                            <x-jet-button onclick="submitForm(this);">
                                                {{ __('save') }}
                                            </x-jet-button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endif
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>