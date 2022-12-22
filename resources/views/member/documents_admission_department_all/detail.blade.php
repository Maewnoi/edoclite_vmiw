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
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <x-jet-label class="text-md" for="doc_filedirec_1"
                                            value="{{ __('ไฟล์เอกสาร') }}" />
                                            @if($document_detail->sub_status == '0')
                                        {!!functionController::display_pdf($document_detail->doc_filedirec_1)!!}
                                        @else
                                        {!!functionController::display_pdf($document_detail->seal_file)!!}
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
                            @if($document_detail->sub_status == '1')
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{route('documents_admission_department_takedown')}}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="card card-body">
                                            <div class="row">
                                                @if($document_detail->seal_id_1 == '')
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <x-jet-label class="text-md"
                                                            value="{{ __('เลือกผู้พิจารณา') }}" />
                                                        <select
                                                            class="form-control select2bs4 @error('sign_goup_1') is-invalid @enderror"
                                                            name="sign_goup_1"
                                                            id="documents_admission_department_allController_sign_goup_1">
                                                            <option value="">ไม่มีผู้พิจารณา</option>
                                                                @foreach($userS_0 as $row_userS_0)
                                                                <option
                                                                    value="{{$row_userS_0->id}}">
                                                                    หัวหน้ากอง {{$row_userS_0->name}}</option>
                                                                @endforeach
                                                        </select>
                                                        @error('sign_goup_1')
                                                        <div class="my-2">
                                                            <p class="mt-2 text-sm text-red-600">
                                                                {{$message}}</p>
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                @else
                                                <input type="hidden" name="sign_goup_1" class="form-control">
                                                @endif
                                                <div class="col-md-6">
                                                    <div class="form-group"
                                                        id="documents_admission_department_allController_form-group_selected_multiple_sub2_recid">
                                                        <x-jet-label class="text-md" value="{{ __('เลือกผู้รับ') }}" />
                                                        <select name="sub2_recid[]"
                                                            id="documents_admission_department_allController_selected_multiple_sub2_recid"
                                                            multiple="multiple" required
                                                            class=" @error('sub2_recid') is-invalid @enderror">
                                                            @foreach($userS_2 as $row_userS_2)
                                                            <option value="{{$row_userS_2->id}}">
                                                                {{$row_userS_2->name}} {{functionController::funtion_cottons($row_userS_2->cotton)}}</option>
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
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <textarea name="seal_detail_0" rows="4" cols="50"
                                                            class="form-control @error('seal_detail_0') is-invalid @enderror"></textarea>
                                                        @error('seal_detail_0')
                                                        <div class="my-2">
                                                            <p class="mt-2 text-sm text-red-600">
                                                                {{$message}}</p>
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" name="seal_pos_0"
                                                            value="{{Auth::user()->pos}}"
                                                            class="form-control @error('seal_pos_0') is-invalid @enderror"
                                                            required>
                                                        @error('seal_pos_0')
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
                                            <input type="hidden" name="seal_point"
                                                value="{{$document_detail->seal_point}}" class="form-control">

                                            <input type="hidden" name="seal_date_1"
                                                value="{{$document_detail->seal_date_1}}" class="form-control">
                                            <input type="hidden" name="seal_date_0"
                                                value="{{$document_detail->seal_date_0}}" class="form-control">

                                            <input type="hidden" name="seal_id_1"
                                                value="{{$document_detail->seal_id_1}}" class="form-control">
                                            <input type="hidden" name="seal_id_0"
                                                value="{{Auth::user()->id}}" class="form-control">

                                            <input type="hidden" name="seal_detail_1"
                                                value="{{$document_detail->seal_detail_1}}" class="form-control">

                                            <input type="hidden" name="seal_pos_1"
                                                value="{{$document_detail->seal_pos_1}}" class="form-control">
                                                
                                            <input type="hidden" name="doc_filedirec_1"
                                                value="{{$document_detail->doc_filedirec_1}}" class="form-control">

                                            <input type="hidden" name="seal_file"
                                                value="{{$document_detail->seal_file}}" class="form-control">
                                                
                                            <input type="hidden" name="sub_recnum"
                                                value="{{$document_detail->sub_recnum}}" class="form-control">
                                            <input type="hidden" name="sub_date"
                                                value="{{$document_detail->sub_date}}" class="form-control">
                                            <input type="hidden" name="sub_time"
                                                value="{{$document_detail->sub_time}}" class="form-control">
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