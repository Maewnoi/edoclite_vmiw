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
                            เอกสารรับเข้าภายนอกรายละเอียด 
                        </div>
                        <div class="card-body table-responsive">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        ส่วนราชการ : <font class="text-primary">{{$document_retrun_inside_detail->docrtdt_government}}</font>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        ที่ร่าง : <font class="text-primary">{{$document_retrun_inside_detail->docrtdt_draft}}</font>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        วันที่ : <font class="text-primary">{{$document_retrun_inside_detail->docrtdt_date}}</font>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        เรื่อง : <font class="text-primary">{{$document_retrun_inside_detail->docrtdt_topic}}</font>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        ชั้นความเร็ว/สถานะ : 
                                        {!! functionController::funtion_docrtdt_speed($document_retrun_inside_detail->docrtdt_speed) !!}
                                        {!! functionController::funtion_docrt_status($document_retrun_inside_detail->docrt_status) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        ประเภทเอกสาร : 
                                        {!! functionController::funtion_docrt_type($document_retrun_inside_detail->docrt_type) !!}
                                        
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{route('documents_retrun_inside_work_retrun_respond')}}" method="post"
                                        enctype="multipart/form-data">
                                       @csrf
                                        <div class="card card-body">
                                            <x-jet-label class="text-lg" value="{{ __('แก้ไขการตอบกลับ v45.65') }}" />
                                            <div class="row">
                                                <div class="col-md-12 table-responsive">
                                                @if($document_retrun_inside_detail->docrt_type == '0')
                                                <!-- //บันทึกข้อความ -->
                                                <div class="form-group"
                                                    id="documents_retrun_inside_work_retrunController_form-group_tb-docrt_details-message-memo">
                                                    <page id="documents_retrun_inside_work_retrunController_page"
                                                        class="items-center block p-24 mx-auto bg-white shadow-2xl">
                                                        <div class="row">
                                                            <div class="col-5">
                                                                <img class="w-16 h-16"
                                                                    src="{{ asset('/image/Garuda.jpeg') }}" alt="">
                                                            </div>
                                                            <div class="col-7">
                                                                <label class="mt-6">บันทึกข้อความ</label>
                                                            </div>
                                                            <!-- // -->
                                                            <div class="col-3">
                                                                <p class="mt-6">ส่วนราชการ</p>
                                                            </div>
                                                            <div class="col-9">
                                                                <input class="mt-2 form-control form-control-border"
                                                                    id="documents_retrun_inside_work_retrunController_docrtdt_government"
                                                                    name="docrtdt_government" type="text" value="{{$document_retrun_inside_detail->docrtdt_government}}">
                                                            </div>
                                                            <!-- // -->
                                                            <div class="col-2">
                                                                <p class="mt-3">ที่ร่าง</p>
                                                            </div>
                                                            <div class="col-4">
                                                                <input class="form-control form-control-border"
                                                                    id="documents_retrun_inside_work_retrunController_docrtdt_draft"
                                                                    name="docrtdt_draft" type="text" value="{{$document_retrun_inside_detail->docrtdt_draft}}">
                                                            </div>
                                                            <div class="col-2">
                                                                <p class="mt-3">วันที่</p>
                                                            </div>
                                                            <div class="col-4">
                                                                <input class="form-control form-control-border"
                                                                    id="documents_retrun_inside_work_retrunController_docrtdt_date"
                                                                    name="docrtdt_date" type="text" value="{{$document_retrun_inside_detail->docrtdt_date}}">
                                                            </div>
                                                            <!-- // -->
                                                            <div class="col-2">
                                                                <p class="mt-3">เรื่อง</p>
                                                            </div>
                                                            <div class="col-10">
                                                                <input class="form-control form-control-border"
                                                                    id="documents_retrun_inside_work_retrunController_docrtdt_topic"
                                                                    name="docrtdt_topic" type="text" value="{{$document_retrun_inside_detail->docrtdt_topic}}">
                                                            </div>
                                                            <!-- // -->
                                                            <div class="col-12">
                                                                <div class="mt-3 mb-14">
                                                                    <textarea id="documents_retrun_inside_work_retrunController_docrtdt_podium" class="form-control" rows="25" cols="75"name="docrtdt_podium">{{$document_retrun_inside_detail->docrtdt_podium}}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </page>
                                                    <input type="hidden" name="docrt_id" value="{{$document_retrun_inside_detail->docrt_id}}">
                                                    <input type="hidden" name="docrtdt_id"
                                                                        value="{{$document_retrun_inside_detail->docrtdt_id}}">
                                                    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />

                                                    <input type="hidden" name="bt_respond" value="respond">
                                                    <div class="flex items-center justify-center mt-20">
                                                        <button type="button"
                                                            id="documents_retrun_inside_work_retrunController_bt_preview"
                                                            class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-900 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:shadow-outline-blue disabled:opacity-25">
                                                            {{ __('แสดงตัวอย่าง') }}
                                                        </button>
                                                        <x-jet-button onclick="submitForm(this);"
                                                            id="documents_retrun_inside_work_retrunController_bt_respond"
                                                            disabled>
                                                            {{ __('ตอบกลับอีกครั้ง') }}
                                                        </x-jet-button>
                                                    </div>
                                                    <label class="mt-2">หมายเหตุ : การตอบกลับนี้เอกสารจะเข้าหัวหน้าฝ่าย</label>
                                                </div>
                                                @elseif($document_retrun_inside_detail->docrt_type == '1')
                                                <!-- ตราครุฑ -->
                                                <div class="form-group"
                                                    id="documents_retrun_inside_work_retrunController_form-group_tb-docrt_details-garuda">
                                                    <page id="documents_retrun_inside_work_retrunController_page"
                                                        class="items-center block p-24 mx-auto bg-white shadow-2xl">
                                                        <div class="row">
                                                            <div class="col-3 pt-14">
                                                                <input class="form-control form-control-border"
                                                                    id="documents_retrun_inside_work_retrunController_docrtdt_draft-garuda"
                                                                    name="docrtdt_draft_garuda" type="text" value="ที่ร่าง">
                                                            </div>
                                                            <div class="col-5">
                                                                <img class="w-24 h-24 ml-20"
                                                                    src="{{ asset('/image/Garuda.jpeg') }}" alt="">
                                                            </div>
                                                            <div class="col-4 pt-14">
                                                                   <input class="form-control form-control-border"
                                                                    id="documents_retrun_inside_work_retrunController_docrtdt_government-garuda"
                                                                    name="docrtdt_government_garuda" type="text" value="{{$document_retrun_inside_detail->docrtdt_government}}">
                                                            </div>
                                                            <div class="col-5">
                                                            </div>
                                                            <div class="col-3">
                                                                <input class="mt-3 form-control form-control-border"
                                                                    id="documents_retrun_inside_work_retrunController_docrtdt_date-garuda"
                                                                    name="docrtdt_date_garuda" type="text" value="{{$document_retrun_inside_detail->docrtdt_date}}">
                                                            </div>
                                                            <div class="col-4">
                                                            </div>
                                                            <div class="col-2">
                                                                <p class="mt-3">เรื่อง</p>
                                                            </div>
                                                            <div class="col-10">
                                                                <input class="form-control form-control-border"
                                                                    id="documents_retrun_inside_work_retrunController_docrtdt_topic-garuda"
                                                                    name="docrtdt_topic_garuda" type="text" value="{{$document_retrun_inside_detail->docrtdt_topic}}">
                                                            </div>   
                                                            <div class="col-12">
                                                                <div class="mt-3 mb-14">
                                                                    <textarea id="documents_retrun_inside_work_retrunController_docrtdt_podium-garuda" class="form-control" rows="25" cols="75" name="docrtdt_podium_garuda">{{$document_retrun_inside_detail->docrtdt_podium}}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </page>
                                                    <input type="hidden" name="docrt_id_garuda" value="{{$document_retrun_inside_detail->docrt_id}}">
                                                    <input type="hidden" name="docrtdt_id_garuda"
                                                                        value="{{$document_retrun_inside_detail->docrtdt_id}}">
                                                    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />

                                                    <input type="hidden" name="bt_respond" value="respond_garuda">
                                                    <div class="flex items-center justify-center mt-20">
                                                        <button type="button"
                                                            id="documents_retrun_inside_work_retrunController_bt_preview-garuda"
                                                            class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-900 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:shadow-outline-blue disabled:opacity-25">
                                                            {{ __('แสดงตัวอย่าง') }}
                                                        </button>
                                                        <x-jet-button onclick="submitForm(this);"
                                                            id="documents_retrun_inside_work_retrunController_bt_respond-garuda"
                                                            disabled>
                                                            {{ __('ตอบกลับอีกครั้ง') }}
                                                        </x-jet-button>
                                                    </div>
                                                    <label class="mt-2">หมายเหตุ : การตอบกลับนี้เอกสารจะเข้าหัวหน้าฝ่าย</label>
                                                </div>
                                                @endif
                                                </div>
                                            </div>
                                        </div>  
                                    </form>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   <!-- Modal preview -->
   <div class="modal fade" id="modal-preview">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="bg-indigo-300 modal-header">
                    <label class="modal-title">ตัวอย่างเอกสาร
                    </label>
                    <button type="button"
                        id="documents_retrun_inside_work_retrunController_close-modal-preview">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <iframe id="documents_retrun_inside_work_retrunController_pdf_preview" frameborder="0" height="800px"
                            width="100%">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
