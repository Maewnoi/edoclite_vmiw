@php
use App\Http\Controllers\functionController;

$check_s = 0;
foreach($sub_docsS as $row_check_sub_docs){
    if($row_check_sub_docs->sub_status != '0'){
        $check_s = 1;
    }
}

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
                                        เลขที่รับส่วนงาน : 
                                        <font class="text-primary">{{$document_detail->doc_recnum}}</font>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        เลขที่หนังสือ :
                                        <font class="text-primary">{{$document_detail->doc_docnum}}</font>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        วันที่ : 
                                        <font class="text-primary">{{$document_detail->doc_date}}</font>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        ลงวันที่ : 
                                        <font class="text-primary">{{$document_detail->doc_date}}</font>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        เวลา : 
                                        <font class="text-primary">{{$document_detail->doc_time}}</font>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        ชั้นความเร็ว/สถานะ : 
                                        {!! functionController::funtion_doc_speed($document_detail->doc_speed) !!}
                                        {!! functionController::funtion_doc_status($document_detail->doc_status) !!}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        เรื่อง : 
                                        <font class="text-primary">{{$document_detail->doc_title}}</font>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <x-jet-label class="text-md" for="doc_filedirec"
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
                            @if($document_detail->doc_status == 'waiting')
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{route('documents_pending_pending')}}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="card card-body">
                                            <x-jet-label class="text-lg"
                                                value="{{ __('พิจารณาเลือกกองที่เกี่ยวข้อง') }}" />
                                            <div class="form-group">
                                                <select name="sub_recid[]" id="selected_multiple" multiple="multiple"
                                                    required class=" @error('sub_recid') is-invalid @enderror">
                                                    @foreach($GroupmemS as $row_Groupmem)
                                                    <option value="{{$row_Groupmem->group_id}}">
                                                        {{$row_Groupmem->group_name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('sub_recid')
                                                <div class="my-2">
                                                    <p class="mt-2 text-sm text-red-600">
                                                        {{$message}}</p>
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <textarea name="seal_deteil" rows="4" cols="50"
                                                    class="form-control @error('seal_deteil') is-invalid @enderror"
                                                    ></textarea>
                                                @error('seal_deteil')
                                                <div class="my-2">
                                                    <p class="mt-2 text-sm text-red-600">
                                                        {{$message}}</p>
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="pos" value="{{Auth::user()->pos}}"
                                                    class="form-control @error('pos') is-invalid @enderror" required>
                                                @error('pos')
                                                <div class="my-2">
                                                    <p class="mt-2 text-sm text-red-600">
                                                        {{$message}}</p>
                                                </div>
                                                @enderror
                                            </div>
                                            <input type="hidden" name="doc_id" value="{{$document_detail->doc_id}}" >
                                            <input type="hidden" name="doc_recnum" value="{{$document_detail->doc_recnum}}" >
                                            <input type="hidden" name="doc_date" value="{{$document_detail->doc_date}}" >
                                            <input type="hidden" name="doc_time" value="{{$document_detail->doc_time}}" >
                                            <input type="hidden" name="doc_filedirec" value="{{$document_detail->doc_filedirec}}" >
                                            <input type="hidden" name="seal_point" value="{{$document_detail->seal_point}}" > 
                                            <input type="hidden" name="doc_docnum" value="{{$document_detail->doc_docnum}}" >
                                            <input type="hidden" name="doc_origin" value="{{$document_detail->doc_origin}}" >
                                            <input type="hidden" name="doc_title" value="{{$document_detail->doc_title}}" >
                                            <x-jet-button onclick="submitForm(this);">
                                                {{ __('save') }}
                                            </x-jet-button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @elseif($document_detail->doc_status == 'success' && $check_s == '0')
                            <div class="flex items-center justify-center mt-20">
                                <x-jet-button type="button"  data-toggle="modal" data-target="#modal-update-groupmems{{$document_detail->doc_id}}"><i class="fa fa-edit"></i> แก้ไขกองงานที่เกี่ยวข้อง</x-jet-button>
                            </div>
                            @endif
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @if($document_detail->doc_status == 'success' && $check_s == '0')
    <div class="modal fade" id="modal-update-groupmems{{$document_detail->doc_id}}">
        <div class="modal-dialog modal-l">
            <div class="modal-content">
                <div class="modal-header">
                    <label class="modal-title">แก้ไขกองงานที่เกี่ยวข้อง
                    </label>
                </div>
                <div class="modal-body">
                    <form action="{{route('documents_pending_updateGroupmem')}}" method="post" enctype="multipart/form-data">
                    @csrf
                        <div class="card card-body">
                            <x-jet-label class="text-lg" value="{{ __('พิจารณาเลือกกองที่เกี่ยวข้อง') }}" />
                            <div class="form-group">
                                <select name="sub_recid[]" id="documents_admission_allController_update-groupmems_selected_multiple" multiple="multiple"
                                    required class=" @error('sub_recid') is-invalid @enderror">
                                    @foreach($sub_docsS as $row_sub_docs)
                                        <option selected value="{{$row_sub_docs->sub_recid}}">
                                        {{ functionController::funtion_groupmem_name($row_sub_docs->sub_recid) }}</option>
                                    @endforeach
                                    @foreach($GroupmemS_success as $row_Groupmem_success)
                                    <option value="{{$row_Groupmem_success->group_id}}">
                                        {{ $row_Groupmem_success->group_name }}</option>
                                    @endforeach
                                </select>
                                @error('sub_recid')
                                    <div class="my-2">
                                        <p class="mt-2 text-sm text-red-600">
                                            {{$message}}</p>
                                    </div>
                                @enderror
                            </div>
                            <select name="sub_recid_old[]" multiple="multiple" class="hide">
                                @foreach($sub_docsS as $row_sub_docs)
                                    <option selected value="{{$row_sub_docs->sub_recid}}">
                                    {{ functionController::funtion_groupmem_name($row_sub_docs->sub_recid) }}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="doc_id" class="form-control" value="{{$document_detail->doc_id}}">

                            <input type="hidden" name="doc_recnum" class="form-control" value="{{$document_detail->doc_recnum}}">
                            <input type="hidden" name="doc_docnum" class="form-control" value="{{$document_detail->doc_docnum}}">
                            <input type="hidden" name="doc_title" class="form-control" value="{{$document_detail->doc_title}}">
                            
                            <x-jet-button onclick="submitForm(this);">
                                {{ __('save') }}
                            </x-jet-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
</x-app-layout>