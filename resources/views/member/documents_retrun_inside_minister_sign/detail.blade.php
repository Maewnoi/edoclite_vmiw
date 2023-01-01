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
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <x-jet-label class="text-md" for="docrtdt_file"
                                            value="{{ __('ไฟล์เอกสาร') }}" />
                                        {!!functionController::display_pdf($document_retrun_inside_detail->docrtdt_file)!!}
                                    </div>
                                </div>
                            </div>
                            <hr>
                            @if($document_retrun_inside_detail->docrt_sealid_4 == Auth::user()->id && $document_retrun_inside_detail->docrt_sealdate_4 == null || $document_retrun_inside_detail->docrt_sealid_5 == Auth::user()->id && $document_retrun_inside_detail->docrt_sealdate_5 == null)
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{route('documents_retrun_inside_minister_sign_understand')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                        <div class="card card-body">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <x-jet-label for="docrt_sealid" value="{{ __('ดำเนินการต่อ') }}" />
                                                        <select class="form-control select2bs4 @error('docrt_sealid') is-invalid @enderror"
                                                            required name="docrt_sealid" id="documents_retrun_inside_minister_signController_docrt_sealid">
                                                            <option value="">เลือก</option>
                                                            <option value="ไม่มีผู้ลงนามต่อ">ไม่มีผู้ลงนามต่อ</option>
                                                            @foreach($userS as $row_user)
                                                            <option value="{{$row_user->id}}">{{$row_user->name}} [{{$row_user->pos}}]</option>
                                                            @endforeach
                                                        </select>
                                                        @error('docrt_sealid')
                                                        <div class="my-2">
                                                            <p class="mt-2 text-sm text-red-600">
                                                                {{$message}}</p>
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <x-jet-label for="docrt_sealpos" value="{{ __('ตำแหน่ง') }}" />
                                                        <input type="text" name="docrt_sealpos"
                                                            value="{{Auth::user()->pos}}"
                                                            class="form-control @error('docrt_sealpos') is-invalid @enderror"
                                                            >
                                                        @error('docrt_sealpos')
                                                        <div class="my-2">
                                                            <p class="mt-2 text-sm text-red-600">
                                                                {{$message}}</p>
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex items-center justify-center">
                                                <input type="hidden" name="docrtdt_file"
                                                                    value="{{$document_retrun_inside_detail->docrtdt_file}}">
                                                <input type="hidden" name="docrt_sealid_4"
                                                                    value="{{$document_retrun_inside_detail->docrt_sealid_4}}">
                                                <input type="hidden" name="docrt_sealid_5"
                                                                    value="{{$document_retrun_inside_detail->docrt_sealid_5}}">
          
                                                <input type="hidden" name="docrt_sealpos_4"
                                                                    value="{{$document_retrun_inside_detail->docrt_sealpos_4}}">
                                                <input type="hidden" name="docrt_sealpos_5"
                                                                    value="{{$document_retrun_inside_detail->docrt_sealpos_5}}">
                                                <input type="hidden" name="docrt_groupmems_id"
                                                                    value="{{$document_retrun_inside_detail->docrt_groupmems_id}}">

                                                <input type="hidden" name="docrt_id" value="{{$document_retrun_inside_detail->docrt_id}}">
                                                <input type="hidden" name="docrtdt_topic" value="{{$document_retrun_inside_detail->docrtdt_topic}}">
                                                <input type="hidden" name="docrtdt_draft"
                                                                value="{{$document_retrun_inside_detail->docrtdt_draft}}">
                                                <input type="hidden" name="docrtdt_date"
                                                                value="{{$document_retrun_inside_detail->docrtdt_date}}">
                                                <input type="hidden" name="docrtdt_id"
                                                                    value="{{$document_retrun_inside_detail->docrtdt_id}}">
                                                <x-jet-button onclick="submitForm(this);">
                                                    {{ __('ลงนาม') }}
                                                </x-jet-button>
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
</x-app-layout>