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
                                        <b> เลขที่รับส่วนงาน : </b><label class="text-primary"><p>{{$document_detail->doc_recnum}}<p></label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                            <b> เลขที่หนังสือ : </b><label class="text-primary">{{$document_detail->doc_docnum}}</label>
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <b> ชั้นความเร็ว/สถานะ : </b>
                                        {!! functionController::funtion_doc_speed($document_detail->doc_speed) !!}
                                        {!! functionController::funtion_sub2_status($document_detail->sub2_status) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <b> วันที่ : </b><label class="text-primary">{{$document_detail->doc_date}}</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <b> ลงวันที่ : </b><label class="text-primary">{{$document_detail->doc_date}}</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <b> เวลา : </b><label class="text-primary">{{$document_detail->doc_time}}</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <b> เรื่อง : </b><label class="text-primary">{{$document_detail->doc_title}}</label>
                                    @error('doc_filedirec')
                                    <div class="my-2">
                                        <p class="mt-2 text-sm text-red-600">
                                            {{$message}}</p>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <hr/>
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
                          
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>