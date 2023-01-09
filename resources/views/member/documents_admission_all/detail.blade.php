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
                            <x-jet-nav-link href="{{url('/documents_admission_all/all')}}">
                                <i class="fa fa-arrow-left"></i>
                            </x-jet-nav-link>
                            เอกสารรับเข้าภายนอก : {{$document_detail->doc_origin}}
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
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <x-jet-button type="button" data-toggle="modal"
                                            data-target="#modal-update-general{{$document_detail->doc_id}}"
                                        ><i class="fa fa-edit"></i> แก้ไขข้อมูลทั่วไป</x-jet-button>
                                         
                                        <x-jet-button type="button" data-toggle="modal"
                                            data-target="#modal-update-file{{$document_detail->doc_id}}"
                                            ><i class="fa fa-edit"></i> เปลี่ยนไฟล์เอกสาร</x-jet-button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        @error('doc_filedirec')
                                        <div class="my-2">
                                            <p class="mt-2 text-sm text-red-600">
                                                {{$message}}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                         <x-jet-label class="text-md" for="doc_filedirec"
                                            value="{{ __('ไฟล์เอกสาร') }}" />
                                        @if($document_detail->doc_status == 'waiting')
                                            {!!functionController::display_pdf($document_detail->doc_filedirec)!!}
                                        @elseif($document_detail->doc_status == 'success')
                                            {!!functionController::display_pdf($document_detail->doc_filedirec_1)!!}
                                        @endif
                                            
                                    </div>
                                </div>
                                <div class="col-md-3">
                                      <div class="form-group">
                                         ไฟล์เอกสารแนบ : 
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
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="callout callout-danger"> 
                                            @if($document_detail->doc_status == 'waiting')
                                                <x-jet-label class="text-lg"
                                                    value="{{ __('รอพิจารณา') }}" />
                                            @elseif($document_detail->doc_status == 'success')
                                            <x-jet-label class="text-lg" value="{{ __('สถานะการลงรับหนังสือ') }}" />
                                            <table>
                                                @foreach($sub_docsS as $row_sub_docs)
                                                <tr>
                                                    <td>{{ functionController::funtion_groupmem_name($row_sub_docs->sub_recid) }}</td>
                                                    <td>{!! functionController::funtion_sub_status_detail($row_sub_docs->sub_status) !!}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                            @endif
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <x-jet-button type="button"  data-toggle="modal" onclick="window.print();" class="btn btn-primary" > print</x-jet-button>
                                    
                                </div>
                            </div>
                            <hr>
                          
                            <div class="flex items-center justify-center mt-20">
                                @if($document_detail->doc_status == 'success' && $check_s == '0')
                                <x-jet-button type="button"  data-toggle="modal" data-target="#modal-update-groupmems{{$document_detail->doc_id}}"><i class="fa fa-edit"></i> แก้ไขกองงานที่เกี่ยวข้อง</x-jet-button>
                                @elseif($document_detail->doc_status == 'waiting')
                                <x-jet-button type="button" data-toggle="modal" data-target="#modal-delete{{$document_detail->doc_id}}">
                                            <i class="fa fa-trash"></i> ลบเอกสาร</x-jet-button>
                                @else
                                
                                @endif
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-update-general{{$document_detail->doc_id}}">
        <div class="modal-dialog modal-l">
            <div class="modal-content">
                <div class="modal-header">
                    <label class="modal-title">แก้ไขข้อมูลทั่วไป
                    </label>
                </div>
                <div class="modal-body">
                    <form action="{{route('updateGeneral')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <x-jet-label for="doc_docnum" value="{{ __('เลขที่หนังสือ') }}" />
                                    <input type="text" name="doc_docnum" value="{{$document_detail->doc_docnum}}"
                                        class="form-control @error('doc_docnum') is-invalid @enderror" required>
                                    @error('doc_docnum')
                                    <div class="my-2">
                                        <p class="mt-2 text-sm text-red-600">
                                            {{$message}}</p>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <x-jet-label for="doc_date" value="{{ __('วันที่') }}" />
                                    <input type="date" name="doc_date" value="{{$document_detail->doc_date}}"
                                        class="form-control @error('doc_date') is-invalid @enderror" required>
                                    @error('doc_date')
                                    <div class="my-2">
                                        <p class="mt-2 text-sm text-red-600">
                                            {{$message}}</p>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <x-jet-label for="doc_date_2" value="{{ __('ลงวันที่') }}" />
                                    <input type="date" name="doc_date_2" value="{{$document_detail->doc_date_2}}"
                                        class="form-control @error('doc_date_2') is-invalid @enderror" required>
                                    @error('doc_date_2')
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
                                        required>{{$document_detail->doc_title}}</textarea>
                                    @error('doc_title')
                                    <div class="my-2">
                                        <p class="mt-2 text-sm text-red-600">
                                            {{$message}}</p>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="doc_id" class="form-control" value="{{$document_detail->doc_id}}">
                        <x-jet-button onclick="submitForm(this);">
                            {{ __('save') }}
                        </x-jet-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-update-file{{$document_detail->doc_id}}">
        <div class="modal-dialog modal-l">
            <div class="modal-content">
                <div class="modal-header">
                    <label class="modal-title">แก้ไขข้อมูลเอกสาร
                    </label>
                </div>
                <div class="modal-body">
                    <form action="{{route('updateFile')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <x-jet-label for="doc_filedirec" value="{{ __('อัพโหลดไฟล์เอกสารใหม่') }}" />
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
                        </div>
                        <input type="hidden" name="doc_id" class="form-control" value="{{$document_detail->doc_id}}">
                        <input type="hidden" name="old_doc_filedirec" class="form-control"
                            value="{{$document_detail->doc_filedirec}}">
                        <x-jet-button onclick="submitForm(this);">
                            {{ __('save') }}
                        </x-jet-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-delete{{$document_detail->doc_id}}">
        <div class="modal-dialog modal-l">
            <div class="modal-content">
                <div class="modal-header">
                    <label class="modal-title">คุณต้องการลบเอกสารนี้ใช่ไหม
                    </label>
                </div>
                <div class="modal-body">
                    <form action="{{route('delete')}}" method="post" enctype="multipart/form-data">
                    @csrf
                        <input type="hidden" name="doc_recnum" class="form-control" value="{{$document_detail->doc_recnum}}">
                        <input type="hidden" name="doc_id" class="form-control" value="{{$document_detail->doc_id}}">
                        <input type="hidden" name="doc_filedirec" class="form-control"
                            value="{{$document_detail->doc_filedirec}}">
                        <input type="hidden" name="doc_attached_file" class="form-control"
                            value="{{$document_detail->doc_attached_file}}">
                        <x-jet-button onclick="submitForm(this);">
                            {{ __('ยืนยัน') }}
                        </x-jet-button>
                    </form>
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
                    <form action="{{route('documents_admission_updateGroupmem')}}" method="post" enctype="multipart/form-data">
                    @csrf
                        <div class="card card-body">
                            <x-jet-label class="text-lg" value="{{ __('พิจารณาเลือกกองที่เกี่ยวข้อง') }}" />
                            <div class="form-group">
                                <button id='documents_admission_group_allController_selected_multiple_sub2_recid_cottons-select-all-select-all' class="h-10 px-5 m-2 text-sm text-purple-100 transition-colors duration-150 bg-purple-600 rounded-lg focus:shadow-outline hover:bg-purple-700">
                                    เลือกทั้งหมด
                                </button>
                                <select name="sub_recid[]" id="documents_admission_allController_update-groupmems_selected_multiple" multiple="multiple"
                                    required class=" @error('sub_recid') is-invalid @enderror">
                                    @foreach($sub_docsS as $row_sub_docs)
                                        <option selected value="{{$row_sub_docs->sub_recid}}">
                                        {{ functionController::funtion_groupmem_name($row_sub_docs->sub_recid) }}</option>
                                    @endforeach
                                    @foreach($GroupmemS as $row_Groupmem)
                                    <option value="{{$row_Groupmem->group_id}}">
                                        {{ $row_Groupmem->group_name }}</option>
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