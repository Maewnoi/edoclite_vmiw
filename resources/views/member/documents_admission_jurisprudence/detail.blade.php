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
                                        <x-jet-label class="text-md" for="doc_filedirec_1"
                                            value="{{ __('ไฟล์เอกสาร') }}" />
                                        {!!functionController::display_pdf($document_detail->sub3d_file)!!}
                                    </div>
                                </div>
                            </div>
                            <hr>
                            @if($document_detail->sub3_status == '2')
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{route('documents_admission_jurisprudence_understand')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                        <div class="card card-body">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <x-jet-label for="sub3_sealid" value="{{ __('เลือกผู้ลงนาม') }}" />
                                                    <select class="form-control select2bs4 @error('sub3_sealid') is-invalid @enderror"
                                                        required name="sub3_sealid">
                                                        <option value="">เลือกผู้ลงนาม</option>
                                                        <option value="not">ไม่เลือก</option>
                                                        @foreach($userS as $row_user)
                                                        <option value="{{$row_user->id}}">{{$row_user->name}} [{{$row_user->pos}}]</option>
                                                        @endforeach
                                                    </select>
                                                    @error('sub3_sealid')
                                                    <div class="my-2">
                                                        <p class="mt-2 text-sm text-red-600">
                                                            {{$message}}</p>
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="flex items-center justify-center">
                                                <input type="hidden" name="doc_id" value="{{$document_detail->doc_id}}">
                                                <input type="hidden" name="sub_id" value="{{$document_detail->sub_id}}">
                                                <input type="hidden" name="sub2_id"
                                                                    value="{{$document_detail->sub2_id}}">
                                                <input type="hidden" name="sub3_id"
                                                                    value="{{$document_detail->sub3_id}}">
                                                <input type="hidden" name="sub3d_id"
                                                                    value="{{$document_detail->sub3d_id}}">
                                                <input type="hidden" name="doc_docnum"
                                                                    value="{{$document_detail->doc_docnum}}">
                                                <input type="hidden" name="doc_origin"
                                                                    value="{{$document_detail->doc_origin}}">
                                                <input type="hidden" name="doc_title"
                                                                    value="{{$document_detail->doc_title}}">
                                                            
                                                <x-jet-button onclick="submitForm(this);">
                                                    {{ __('อนุมัติ') }}
                                                </x-jet-button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <form action="{{route('documents_admission_jurisprudence_do_not_understand')}}" method="post" enctype="multipart/form-data">
                            @csrf
                                <div class="flex items-center justify-center">
                                    <x-jet-button onclick="submitForm(this);">
                                        {{ __('ไม่อนุมัติ') }}
                                    </x-jet-button>
                                </div>
                            </form>
                            @endif
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>