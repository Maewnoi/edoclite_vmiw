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
                                            <button type="button" data-toggle="modal"
                                             data-target="#modal-update-general{{$document_detail->doc_id}}"
                                            class="btn btn-outline-warning "><i class="fa fa-edit"></i> แก้ไขข้อมูลทั่วไป</button>
                                            
                                            <button type="button" data-toggle="modal"
                                                data-target="#modal-update-file{{$document_detail->doc_id}}"
                                                class="btn btn-outline-warning "><i class="fa fa-edit"></i> เปลี่ยนไฟล์เอกสาร</button>
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
                            ผู้บันทึกตอบกลับ : {{functionController::funtion_users($document_detail->sub2_recid)}}
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>