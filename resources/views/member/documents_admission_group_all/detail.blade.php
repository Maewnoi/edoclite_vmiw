@php
use App\Http\Controllers\functionController;
@endphp
<x-app-layout>
    <!-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            สวัสดี , {{Auth::user()->name}}
        </h2>
    </x-slot> -->
    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @if(session("success"))
                    <div class="alert shadow alert-success">{{session('success')}}</div>
                    @endif
                    @if ($errors->any())
                    @foreach ($errors->all() as $error)
                    <div class="alert shadow alert-danger">{{ $error }}</div>
                    @endforeach
                    @endif
                    <div class="card shadow">
                        <div class="card-header text-lg bg-primary">
                            <x-jet-nav-link href="{{url('/documents_pending/all')}}">
                                <i class="fa fa-arrow-left"></i>
                            </x-jet-nav-link>
                            เอกสารรับเข้าภายนอกรายละเอียด : {{$document_detail->doc_origin}}
                        </div>
                        <div class="card-body table-responsive">
                            <div class="card card-body">
                                <x-jet-label class="text-lg" value="{{ __('ข้อมูลทั่วไป') }}" />
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <x-jet-label class="text-md" for="doc_recnum"
                                            value="{{ __('เลขที่รับส่วนงาน') }}" />
                                        <label class="text-primary">{{$document_detail->doc_recnum}}</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <x-jet-label class="text-md" for="doc_docnum"
                                            value="{{ __('เลขที่หนังสือ') }}" />
                                        <label class="text-primary">{{$document_detail->doc_docnum}}</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <x-jet-label class="text-md" for="doc_date" value="{{ __('วันที่') }}" />
                                        <label class="text-primary">{{$document_detail->doc_date}}</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <x-jet-label class="text-md" for="doc_date_2" value="{{ __('ลงวันที่') }}" />
                                        <label class="text-primary">{{$document_detail->doc_date}}</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <x-jet-label class="text-md" for="doc_time" value="{{ __('เวลา') }}" />
                                        <label class="text-primary">{{$document_detail->doc_time}}</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <x-jet-label class="text-md" for="doc_title" value="{{ __('เรื่อง') }}" />
                                        <label class="text-primary">{{$document_detail->doc_title}}</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <x-jet-label class="text-md" for="" value="{{ __('ชั้นความเร็ว/สถานะ') }}" />
                                        {!! functionController::funtion_doc_speed($document_detail->doc_speed) !!}
                                        {!! functionController::funtion_sub_status($document_detail->sub_status) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="card card-body">
                                <x-jet-label class="text-lg" value="{{ __('ข้อมูลเอกสาร') }}" />
                                @error('doc_filedirec')
                                <div class="my-2">
                                    <p class="text-sm text-red-600 mt-2">
                                        {{$message}}</p>
                                </div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <x-jet-label class="text-md" for="doc_filedirec_1"
                                            value="{{ __('ไฟล์เอกสาร') }}" />
                                        @if($document_detail->sub_status == '8')
                                        {!!functionController::display_pdf($document_detail->seal_file)!!}
                                        @else
                                        {!!functionController::display_pdf($document_detail->doc_filedirec_1)!!}
                                        @endif

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
                            @if($document_detail->sub_status == '0')
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{route('documents_admission_group_takedown')}}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="card card-body">
                                            <x-jet-label class="text-lg" value="{{ __('ตำแหน่งประทับตรา') }}" />
                                            <div class="form-group">
                                                <input type="range" name="seal_point" class="form-range" min="10" value="20"
                                                    max="160" step="1">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <x-jet-label class="text-md" value="{{ __('เลขที่รับ') }}" />
                                                        <select
                                                            class="form-control select2bs4 @error('sub_recnum') is-invalid @enderror"
                                                            name="sub_recnum" required id="documents_admission_group_allController_sub_recnum">
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
                                                        @error('sub_recnum')
                                                        <div class="my-2">
                                                            <p class="text-sm text-red-600 mt-2">
                                                                {{$message}}</p>
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <x-jet-label class="text-md" value="{{ __('วันที่') }}" />
                                                        <input type="date" name="sub_date" value="{{date('Y-m-d')}}"
                                                            id="documents_admission_group_allController_sub_date"
                                                            class="form-control @error('sub_date') is-invalid @enderror"
                                                            required>
                                                        @error('sub_date')
                                                        <div class="my-2">
                                                            <p class="text-sm text-red-600 mt-2">
                                                                {{$message}}</p>
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <x-jet-label class="text-md" value="{{ __('เวลา') }}" />
                                                        <input type="time" name="sub_time" value="{{date('H:i')}}"
                                                            class="form-control @error('sub_time') is-invalid @enderror"
                                                            required>
                                                        @error('sub_time')
                                                        <div class="my-2">
                                                            <p class="text-sm text-red-600 mt-2">
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
                                                            class="form-control select2bs4 @error('sign_goup_0') is-invalid @enderror"
                                                            name="sign_goup_0"
                                                            id="documents_admission_group_allController_sign_goup_0">
                                                            <option value="">ไม่มีผู้พิจารณา</option>
                                                            <optgroup label="หัวหน้าฝ่าย">
                                                                @foreach($userS_0 as $row_userS_0)
                                                                <option value="{{$row_userS_0->id}}">
                                                                    {{$row_userS_0->name}}</option>
                                                                @endforeach
                                                            </optgroup>
                                                            <optgroup label="หัวหน้ากอง">
                                                                @foreach($userS_1 as $row_userS_1)
                                                                <option value="{{$row_userS_1->id}}">
                                                                    {{$row_userS_1->name}}</option>
                                                                @endforeach
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                    @error('sign_goup_0')
                                                    <div class="my-2">
                                                        <p class="text-sm text-red-600 mt-2">
                                                            {{$message}}</p>
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group"
                                                        id="documents_admission_group_allController_form-group_selected_multiple_sub2_recid">
                                                        <x-jet-label class="text-md" value="{{ __('เลือกผู้รับ') }}" />
                                                        <select name="sub2_recid[]"
                                                            id="documents_admission_group_allController_selected_multiple_sub2_recid"
                                                            multiple="multiple" required
                                                            class=" @error('sub2_recid') is-invalid @enderror">
                                                            @foreach($userS_2 as $row_userS_2)
                                                            <option value="{{$row_userS_2->id}}">
                                                                {{$row_userS_2->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('sub2_recid')
                                                        <div class="my-2">
                                                            <p class="text-sm text-red-600 mt-2">
                                                                {{$message}}</p>
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="doc_id" value="{{$document_detail->doc_id}}"
                                                class="form-control" required>
                                            <input type="hidden" name="sub_id" value="{{$document_detail->sub_id}}"
                                                class="form-control" required>

                                            <input type="hidden" name="doc_docnum"
                                                value="{{$document_detail->doc_docnum}}" class="form-control">
                                            <input type="hidden" name="doc_origin"
                                                value="{{$document_detail->doc_origin}}" class="form-control">
                                            <input type="hidden" name="doc_title"
                                                value="{{$document_detail->doc_title}}" class="form-control">

                                            <input type="hidden" name="doc_recnum"
                                                value="{{$document_detail->doc_recnum}}" class="form-control">
                                            <input type="hidden" name="doc_date" value="{{$document_detail->doc_date}}"
                                                class="form-control">
                                            <input type="hidden" name="doc_time" value="{{$document_detail->doc_time}}"
                                                class="form-control">

                                            <input type="hidden" name="doc_filedirec_1"
                                                value="{{$document_detail->doc_filedirec_1}}" class="form-control">

                                            <x-jet-button>
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