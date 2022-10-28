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
                    @if(session("success"))
                    <div class="shadow alert alert-success">{{session('success')}}</div>
                    @endif
                    @if ($errors->any())
                    @foreach ($errors->all() as $error)
                    <div class="shadow alert alert-danger">{{ $error }}</div>
                    @endforeach
                    @endif
                    <div class="shadow card">
                        <div class="text-lg card-header bg-primary">
                            <x-jet-nav-link href="{{url('/documents_pending/all')}}">
                                <i class="fa fa-arrow-left"></i>
                            </x-jet-nav-link>
                            เอกสารรับเข้าภายนอกรายละเอียด : {{$document_detail->doc_origin}}
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
                            @if($document_detail->doc_status == 'success')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="callout callout-danger">
                                            <x-jet-label class="text-lg" value="{{ __('สถานะการลงรับหนังสือ') }}" />
                                            <table>
                                                @foreach($sub_docsS as $row_sub_docs)
                                                <tr>
                                                    <td>{{ functionController::funtion_groupmem_name($row_sub_docs->sub_recid) }}</td>
                                                    <td>{!! functionController::funtion_sub_status_detail($row_sub_docs->sub_status) !!}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            @endif

                            @if($document_detail->sub_status == '0')
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{route('documents_admission_group_takedown')}}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="card card-body">
                                            <x-jet-label class="text-lg" value="{{ __('ตำแหน่งประทับตรา') }}" />
                                            <div class="form-group">
                                               <!-- <input type="range" name="seal_point" class="form-range" min="10" value="20"
                                                    max="160" step="1"> -->
                                                    <input type="radio" id="seal_point" name="seal_point" value="1"> ตำแหน่งที่ 1 &nbsp;&nbsp;
                                                    <input type="radio" id="seal_point" name="seal_point" value="2"> ตำแหน่งที่ 2 &nbsp;&nbsp;
                                                    <input type="radio" id="seal_point" name="seal_point" value="3"> ตำแหน่งที่ 3 &nbsp;&nbsp;
                                                    <input type="radio" id="seal_point" name="seal_point" value="4" checked > ตำแหน่งที่ 4  &nbsp;&nbsp;
                                                    <input type="radio" id="seal_point" name="seal_point" value="5"> ตำแหน่งที่ 5 &nbsp;&nbsp;<br/>
                                                    <img src="{{ asset('/image/seal_point.jpg') }}" alt="Girl in a jacket" width="500" height="auto">
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
                                                            <p class="mt-2 text-sm text-red-600">
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
                                                            <p class="mt-2 text-sm text-red-600">
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
                                                        <p class="mt-2 text-sm text-red-600">
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
                                                            <p class="mt-2 text-sm text-red-600">
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