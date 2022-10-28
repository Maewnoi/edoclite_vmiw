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
                                <div class="col-md-6">
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
                                        {!! functionController::funtion_sub2_status($document_detail->sub2_status) !!}
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
                                @if(functionController::display_pdf_sub3_doc($document_detail->sub_id) != '')
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <x-jet-label class="text-md" for="doc_filedirec_1"
                                            value="{{ __('บันทึกข้อความตอบกลับ') }}" />
                                        {!!functionController::display_pdf(functionController::display_pdf_sub3_doc($document_detail->sub_id))!!}

                                    </div>
                                </div>
                                @endif
                            </div>
                            <hr>
                           @if($document_detail->sub2_status == '0')
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{route('documents_admission_work_detail_respond')}}" method="post"
                                        enctype="multipart/form-data">
                                       @csrf
                                        <div class="card card-body">
                                            <x-jet-label class="text-lg" value="{{ __('ตอบกลับ') }}" />
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <select name="sub3_type"
                                                            id="documents_admission_work_allController_sub3_type"
                                                            required
                                                            class="form-control select2bs4 @error('sub3_type') is-invalid @enderror">
                                                            <option value="">
                                                                เลือกประเภท
                                                            </option>
                                                            <option value="0">
                                                                บันทึกข้อความ
                                                            </option>
                                                            <option value="1">
                                                                ตราครุฑ
                                                            </option>
                                                        </select>
                                                        @error('sub3_type')
                                                        <div class="my-2">
                                                            <p class="mt-2 text-sm text-red-600">
                                                                {{$message}}</p>
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <select name="sub3d_speed" required
                                                            class="form-control select2bs4 @error('sub3d_speed') is-invalid @enderror"
                                                            id="documents_admission_work_allController_sub3d_speed">
                                                            <option value="">
                                                                เลือกชั้นความเร็ว
                                                            </option>
                                                            <option value="0">ปกติ</option>
                                                            <option value="1">ด่วน</option>
                                                            <option value="2">ด่วนมาก</option>
                                                            <option value="3">ด่วนที่สุด</option>
                                                        </select>
                                                        @error('sub3d_speed')
                                                        <div class="my-2">
                                                            <p class="mt-2 text-sm text-red-600">
                                                                {{$message}}</p>
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-12 table-responsive">
                                                    <div class="form-group hide"
                                                        id="documents_admission_work_allController_form-group_tb-sub3_details-garuda">
                                                        <page id="ocuments_admission_work_allController_page"
                                                            class="items-center block p-24 mx-auto bg-white shadow-2xl">
                                                            <div class="row">
                                                                <div class="col-3 pt-14">
                                                                    <input class="form-control form-control-border"
                                                                        id="documents_admission_work_allController_sub3d_draft-garuda"
                                                                        name="sub3d_draft-garuda" type="text" value="ที่ร่าง">
                                                                </div>
                                                                <div class="col-5">
                                                                    <img class="w-24 h-24 ml-20"
                                                                        src="{{ asset('/image/Garuda.jpeg') }}" alt="">
                                                                </div>
                                                                <div class="col-4 pt-14">
                                                                    <input class="form-control form-control-border"
                                                                        id="documents_admission_work_allController_sub3d_government-garuda"
                                                                        name="sub3d_government-garuda" type="text" value="องค์การบริหาร">
                                                                </div>
                                                                <div class="col-5">
                                                                </div>
                                                                <div class="col-3">
                                                                    <input class="mt-3 form-control form-control-border"
                                                                        id="documents_admission_work_allController_sub3d_date-garuda"
                                                                        name="sub3d_date-garuda" type="text" value="21 oct 1988">
                                                                </div>
                                                                <div class="col-4">
                                                                </div>
                                                                <div class="col-2">
                                                                    <p class="mt-3">เรื่อง</p>
                                                                </div>
                                                                <div class="col-10">
                                                                    <input class="form-control form-control-border"
                                                                        id="documents_admission_work_allController_sub3d_topic-garuda"
                                                                        name="sub3d_topic-garuda" type="text" value="">
                                                                </div>   
                                                                <div class="col-12">
                                                                    <div class="mt-3 mb-14">
                                                                        <textarea id="documents_admission_work_allController_sub3d_podium-garuda" class="form-control" rows="25" cols="75" name="sub3d_podium-garuda">เรียน ...</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </page>
                                                    </div>
                                                    <div class="form-group hide"
                                                        id="documents_admission_work_allController_form-group_tb-sub3_details-message-memo">
                                                        <page id="ocuments_admission_work_allController_page"
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
                                                                        id="documents_admission_work_allController_sub3d_government"
                                                                        name="sub3d_government" type="text" value="">
                                                                </div>
                                                                <!-- // -->
                                                                <div class="col-2">
                                                                    <p class="mt-3">ที่ร่าง</p>
                                                                </div>
                                                                <div class="col-4">
                                                                    <input class="form-control form-control-border"
                                                                        id="documents_admission_work_allController_sub3d_draft"
                                                                        name="sub3d_draft" type="text" value="">
                                                                </div>
                                                                <div class="col-2">
                                                                    <p class="mt-3">วันที่</p>
                                                                </div>
                                                                <div class="col-4">
                                                                    <input class="form-control form-control-border"
                                                                        id="documents_admission_work_allController_sub3d_date"
                                                                        name="sub3d_date" type="text" value="">
                                                                </div>
                                                                <!-- // -->
                                                                <div class="col-2">
                                                                    <p class="mt-3">เรื่อง</p>
                                                                </div>
                                                                <div class="col-10">
                                                                    <input class="form-control form-control-border"
                                                                        id="documents_admission_work_allController_sub3d_topic"
                                                                        name="sub3d_topic" type="text" value="">
                                                                </div>
                                                                <!-- // -->
                                                                <div class="col-12">
                                                                    <div class="mt-3 mb-14">
                                                                        <textarea id="documents_admission_work_allController_sub3d_podium" class="form-control" rows="25" cols="75"name="sub3d_podium">เรียน ...</textarea>
                                                                    </div>
                                                                </div>
                                                                <!-- // -->
                                                                <!-- <div class="col-12">
                                                                    <div class="col-3">
                                                                        <select
                                                                            class="ml-32 form-control form-control-border"
                                                                            id="documents_admission_work_allController_sub3d_therefore"
                                                                            name="sub3d_therefore">
                                                                            <option value="test">
                                                                                test
                                                                            </option>
                                                                            <option value="test2">
                                                                                test2
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="col-3">
                                                                        <select
                                                                            class="ml-64 form-control form-control-border"
                                                                            id="documents_admission_work_allController_sub3d_pos"
                                                                            name="sub3d_pos">

                                                                            <option value="test">
                                                                                test
                                                                            </option>
                                                                            <option value="test2">
                                                                                test2
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                </div> -->
                                                            </div>
                                                        </page>
                                                        <input type="hidden" name="doc_id" value="{{$document_detail->doc_id}}">
                                                        <input type="hidden" name="sub_id" value="{{$document_detail->sub_id}}">
                                                        <input type="hidden" name="sub2_id" value="{{$document_detail->sub2_id}}">
                                                        <input type="hidden" name="doc_docnum" value="{{$document_detail->doc_docnum}}">
                                                        <input type="hidden" name="doc_origin" value="{{$document_detail->doc_origin}}">
                                                        <input type="hidden" name="doc_title" value="{{$document_detail->doc_title}}">
                                                        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />
                                                       
                                                   
                                                        <div class="flex items-center justify-center mt-20">
                                                            <button type="button"
                                                                id="documents_admission_work_allController_bt_preview"
                                                                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-900 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:shadow-outline-blue disabled:opacity-25">
                                                                {{ __('แสดงตัวอย่าง') }}
                                                            </button>
                                                            <x-jet-button
                                                                id="documents_admission_work_allController_bt_respond"
                                                                disabled>
                                                                {{ __('ตอบกลับ') }}
                                                            </x-jet-button>
                                                        </div>
                                                        <div class="mt-2 shadow alert alert-danger hide"
                                                            id="documents_admission_work_allController_alert_error">
                                                            <p id="documents_admission_work_allController_tag_p_error">
                                                            </p>
                                                        </div>
                                                        <label class="mt-2">หมายเหตุ : การตอบกลับนี้เอกสารจะเข้าหัวหน้าฝ่าย</label>
                                                    </div>
                                                </div>
                                            </div>
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
    <!-- Modal preview -->
    <div class="modal fade" id="modal-preview">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="bg-indigo-300 modal-header">
                    <label class="modal-title">ตัวอย่างเอกสาร
                    </label>
                    <button type="button"
                        id="documents_admission_work_allController_close-modal-preview">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <iframe id="documents_admission_work_allController_pdf_preview" frameborder="0" height="800px"
                            width="100%">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
