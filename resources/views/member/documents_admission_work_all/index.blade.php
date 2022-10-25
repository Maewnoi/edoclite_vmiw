@php
use App\Http\Controllers\functionController;
@endphp
<x-app-layout>
    <!-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            สวัสดี , {{Auth::user()->name}}
        </h2>
    </x-slot> -->
    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @if(session("success"))
                    <div class="alert shadow alert-success">{{session('success')}}</div>
                    @endif
                    @if ($errors->any())
                    @foreach ($errors->all() as $error)
                    <div class="alert shadow alert-danger">{{ $error }}</div>
                    @endforeach
                    @endif
                    <div class="card shadow">
                        <div class="card-header bg-primary">เอกสารรับเข้าภายนอก </div>
                        <div class="card-body table-responsive">
                            <table id="example1" class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">ลำดับ</th>
                                        <th scope="col">หน่วยงานต้นเรื่อง</th>
                                        <th scope="col">เลขที่รับส่วนงาน</th>
                                        <th scope="col">เลขที่หนังสือ</th>
                                        <th scope="col">วันที่</th>
                                        <th scope="col">วันที่ลง</th>
                                        <th scope="col">เรื่อง</th>
                                        <th scope="col">ชั้นความเร็ว/สถานะ</th>
                                        <th scope="col">รายละเอียด</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($document_admission_all_work as $row)
                                    <tr>
                                        <th>{{$loop->index+1}}</th>
                                        <td>{{$row->doc_origin}}</td>
                                        <td>{{$row->doc_recnum}}</td>
                                        <td>{{$row->doc_docnum}}</td>
                                        <td>
                                            @if($row->doc_date != NULL)
                                            <span class="badge bg-secondary">{{$row->doc_date}}</span>
                                            <p class="text-sm text-muted">
                                                <i class="far fa-clock mr-1"></i>
                                                {{Carbon\Carbon::parse($row->doc_date)->diffForHumans()}}
                                            </p>
                                            @endif
                                        </td>
                                        <td>
                                            @if($row->doc_date_2 != NULL)
                                            <span class="badge bg-secondary">{{$row->doc_date_2}}</span>
                                            <p class="text-sm text-muted">
                                                <i class="far fa-clock mr-1"></i>
                                                {{Carbon\Carbon::parse($row->doc_date_2)->diffForHumans()}}
                                            </p>
                                            @endif
                                        </td>
                                        <td>{{$row->doc_title}}</td>
                                        <td>
                                            {!! functionController::funtion_doc_speed($row->doc_speed) !!}
                                            {!! functionController::funtion_sub2_status($row->sub2_status) !!}
                                        </td>
                                        <td>
                                            <x-jet-nav-link href="{{url('/documents_admission_work_all/detail/'.$row->doc_id)}}">
                                                <i class="far fa-file-alt"></i>
                                            </x-jet-nav-link>
                                            <!-- <x-jet-button>
                                                <i class="fas fa-trash-alt"></i>
                                            </x-jet-button> -->
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>