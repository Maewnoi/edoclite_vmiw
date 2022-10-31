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
                   
                    <div class="shadow card">
                        <div class="text-lg card-header bg-primary">
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
                                        {!! functionController::funtion_doc_speed($document_detail->sub3d_speed) !!}
                                        {!! functionController::funtion_sub3_status($document_detail->sub3_status) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="card card-body">
                                <x-jet-label class="text-lg" value="{{ __('ข้อมูลเอกสาร') }}" />
                                @error('doc_filedirec')
                                <div class="my-2">
                                    <p class="mt-2 text-sm text-red-600">
                                        {{$message}}</p>
                                </div>
                                @enderror
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
                            
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>