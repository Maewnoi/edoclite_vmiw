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
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="callout callout-danger"> 
                                            <x-jet-label class="text-lg" value="{{ __('สถานะ') }}" />
                                            @if($document_detail->sub2_status == '0')
                                            <x-jet-label class="text-red-500 text-md"
                                                            value="{{ __('--ยังไม่อ่าน--') }}" />
                                            @elseif($document_detail->sub2_status == '1')
                                            <x-jet-label class="text-green-500 text-md"
                                                            value="{{ __('--อ่านแล้ว--') }}" />
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="callout callout-danger"> 
                                            <x-jet-label class="text-lg" value="{{ __('สถานะตอบกลับ') }}" />
                                            @if($sub3_doc_detail)
                                            {!!functionController::funtion_sub3_status($sub3_doc_detail->sub3_status)!!}
                                            @else
                                            <x-jet-label class="text-green-500 text-md"
                                                            value="{{ __('--ไม่ตอบกลับ--') }}" />
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if(!$sub3_doc_detail)
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{route('documents_admission_work_inside_detail_respond')}}" method="post"
                                        enctype="multipart/form-data">
                                       @csrf
                                       <input type="hidden" id="documents_admission_work_inside_allController_check_respond" name="bt_respond" value="">
                                        <div class="card card-body">
                                            <x-jet-label class="text-lg" value="{{ __('ตอบกลับ v45.65') }}" />
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <select name="sub3_type"
                                                            id="documents_admission_work_inside_allController_sub3_type"
                                                            required
                                                            class="form-control select2bs4 @error('sub3_type') is-invalid @enderror">
                                                            <option value="">
                                                                เลือกประเภท
                                                            </option>
                                                            <option value="2">
                                                                แนบไฟล์
                                                            </option>
                                                            <option value="0">
                                                                บันทึกข้อความ (ทดสอบ)
                                                            </option>
                                                            <option value="1">
                                                                ตราครุฑ (ทดสอบ)
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
                                                            id="documents_admission_work_inside_allController_sub3d_speed">
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
                                                        id="documents_admission_work_inside_allController_form-group_tb-sub3_details-normal">
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <x-jet-label class="text-md" for="sub3d_government_normal"
                                                                    value="{{ __('ส่วนราชการ') }}" />
                                                                    <input class="form-control"
                                                                        name="sub3d_government_normal" type="text" value="">
                                                            </div>
                                                            <div class="col-3">
                                                                <x-jet-label class="text-md" for="sub3d_draft_normal"
                                                                    value="{{ __('ที่ร่าง') }}" />
                                                                    <input class="form-control"
                                                                        name="sub3d_draft_normal" type="text" value="">
                                                            </div>
                                                            <div class="col-3">
                                                                <x-jet-label class="text-md" for="sub3d_date_normal"
                                                                    value="{{ __('วันที่') }}" />
                                                                    <input class="form-control"
                                                                        name="sub3d_date_normal" type="text" value="21 ธันวาคม 1988">
                                                            </div>
                                                            <div class="col-3">
                                                                <x-jet-label class="text-md" for="sub3d_topic_normal"
                                                                    value="{{ __('เรื่อง') }}" />
                                                                    <input class="form-control"
                                                                        name="sub3d_topic_normal" type="text" value="">
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="doc_id_normal" value="{{$document_detail->doc_id}}">
                                                        <input type="hidden" name="sub_id_normal" value="{{$document_detail->sub_id}}">
                                                        <input type="hidden" name="sub2_id_normal" value="{{$document_detail->sub2_id}}">
                                                        <input type="hidden" name="doc_docnum_normal" value="{{$document_detail->doc_docnum}}">
                                                        <input type="hidden" name="doc_origin_normal" value="{{$document_detail->doc_origin}}">
                                                        <input type="hidden" name="doc_title_normal" value="{{$document_detail->doc_title}}">
                                                        
                                                        <div class="items-center justify-center mt-10">
                                                            <x-jet-label class="text-md" for="sub3d_file"
                                                                    value="{{ __('เอกสาร') }}" />
                                                            <input type="file" name="sub3d_file" accept="application/pdf"
                                                                id="documents_admission_work_inside_allController_sub3d_file_normal"
                                                                class="form-control @error('sub3d_file') is-invalid @enderror">
                                                        </div>
                                                        
                                                        <div class="flex items-center justify-center mt-20">
                                                    
                                                            <x-jet-button onclick="submitForm(this);"
                                                                id="documents_admission_work_inside_allController_bt_respond-normal"
                                                                disabled>
                                                                {{ __('ตอบกลับ') }}
                                                            </x-jet-button>
                                                        </div>
                                                        
                                                        <label class="mt-2">หมายเหตุ : การตอบกลับนี้เอกสารจะเข้าหัวหน้าฝ่าย</label>
                                                    </div>
                                                    <div class="form-group hide"
                                                        id="documents_admission_work_inside_allController_form-group_tb-sub3_details-garuda">
                                                        <page id="documents_admission_work_inside_allController_page"
                                                            class="items-center block p-24 mx-auto bg-white shadow-2xl">
                                                            <div class="row">
                                                                <div class="col-3 pt-14">
                                                                    <input class="form-control form-control-border"
                                                                        id="documents_admission_work_inside_allController_sub3d_draft-garuda"
                                                                        name="sub3d_draft_garuda" type="text" value="ที่ร่าง">
                                                                </div>
                                                                <div class="col-5">
                                                                    <img class="w-24 h-24 ml-20"
                                                                        src="{{ asset('/image/Garuda.jpeg') }}" alt="">
                                                                </div>
                                                                <div class="col-4 pt-14">
                                                                    <input class="form-control form-control-border"
                                                                        id="documents_admission_work_inside_allController_sub3d_government-garuda"
                                                                        name="sub3d_government_garuda" type="text" value="องค์การบริหาร">
                                                                </div>
                                                                <div class="col-5">
                                                                </div>
                                                                <div class="col-3">
                                                                    <input class="mt-3 form-control form-control-border"
                                                                        id="documents_admission_work_inside_allController_sub3d_date-garuda"
                                                                        name="sub3d_date_garuda" type="text" value="21 ธันวาคม 1988">
                                                                </div>
                                                                <div class="col-4">
                                                                </div>
                                                                <div class="col-2">
                                                                    <p class="mt-3">เรื่อง</p>
                                                                </div>
                                                                <div class="col-10">
                                                                    <input class="form-control form-control-border"
                                                                        id="documents_admission_work_inside_allController_sub3d_topic-garuda"
                                                                        name="sub3d_topic_garuda" type="text" value="">
                                                                </div>   
                                                                <div class="col-12">
                                                                    <div class="mt-3 mb-14">
                                                                        <textarea id="documents_admission_work_inside_allController_sub3d_podium-garuda" class="form-control" rows="25" cols="75" name="sub3d_podium_garuda">เรียน ...</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </page>
                                                        <input type="hidden" name="doc_id_garuda" value="{{$document_detail->doc_id}}">
                                                        <input type="hidden" name="sub_id_garuda" value="{{$document_detail->sub_id}}">
                                                        <input type="hidden" name="sub2_id_garuda" value="{{$document_detail->sub2_id}}">
                                                        <input type="hidden" name="doc_docnum_garuda" value="{{$document_detail->doc_docnum}}">
                                                        <input type="hidden" name="doc_origin_garuda" value="{{$document_detail->doc_origin}}">
                                                        <input type="hidden" name="doc_title_garuda" value="{{$document_detail->doc_title}}">

                                                        <div class="flex items-center justify-center mt-20">
                                                            <button type="button"
                                                                id="documents_admission_work_inside_allController_bt_preview-garuda"
                                                                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-900 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:shadow-outline-blue disabled:opacity-25">
                                                                {{ __('แสดงตัวอย่าง') }}
                                                            </button>
                                                            <x-jet-button onclick="submitForm(this);"
                                                                id="documents_admission_work_inside_allController_bt_respond-garuda"
                                                                disabled>
                                                                {{ __('ตอบกลับ') }}
                                                            </x-jet-button>
                                                        </div>
                                                        
                                                        <label class="mt-2">หมายเหตุ : การตอบกลับนี้เอกสารจะเข้าหัวหน้าฝ่าย</label>
                                                    </div>
                                                    <div class="form-group hide"
                                                        id="documents_admission_work_inside_allController_form-group_tb-sub3_details-message-memo">
                                                        <page id="documents_admission_work_inside_allController_page"
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
                                                                        id="documents_admission_work_inside_allController_sub3d_government"
                                                                        name="sub3d_government" type="text" value="">
                                                                </div>
                                                                <!-- // -->
                                                                <div class="col-2">
                                                                    <p class="mt-3">ที่ร่าง</p>
                                                                </div>
                                                                <div class="col-4">
                                                                    <input class="form-control form-control-border"
                                                                        id="documents_admission_work_inside_allController_sub3d_draft"
                                                                        name="sub3d_draft" type="text" value="">
                                                                </div>
                                                                <div class="col-2">
                                                                    <p class="mt-3">วันที่</p>
                                                                </div>
                                                                <div class="col-4">
                                                                    <input class="form-control form-control-border"
                                                                        id="documents_admission_work_inside_allController_sub3d_date"
                                                                        name="sub3d_date" type="text" value="">
                                                                </div>
                                                                <!-- // -->
                                                                <div class="col-2">
                                                                    <p class="mt-3">เรื่อง</p>
                                                                </div>
                                                                <div class="col-10">
                                                                    <input class="form-control form-control-border"
                                                                        id="documents_admission_work_inside_allController_sub3d_topic"
                                                                        name="sub3d_topic" type="text" value="">
                                                                </div>
                                                                <!-- // -->
                                                                <div class="col-12">
                                                                    <div class="mt-3 mb-14">
                                                                        <textarea id="documents_admission_work_inside_allController_sub3d_podium" class="form-control" rows="25" cols="75"name="sub3d_podium">เรียน ...</textarea>
                                                                    </div>
                                                                </div>
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
                                                                id="documents_admission_work_inside_allController_bt_preview"
                                                                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-900 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:shadow-outline-blue disabled:opacity-25">
                                                                {{ __('แสดงตัวอย่าง') }}
                                                            </button>
                                                            <x-jet-button onclick="submitForm(this);"
                                                                id="documents_admission_work_inside_allController_bt_respond"
                                                                disabled>
                                                                {{ __('ตอบกลับ') }}
                                                            </x-jet-button>
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
                        id="documents_admission_work_inside_allController_close-modal-preview">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <iframe id="documents_admission_work_inside_allController_pdf_preview" frameborder="0" height="800px"
                            width="100%">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>