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
                        <div class="card-header bg-primary">บันทึกข้อความ</div>
                        <div class="card-body table-responsive">
                            <table id="example1" class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">ลำดับ</th>
                                        <th scope="col">ส่วนราชการ</th>
                                        <th scope="col">ที่ร่าง</th>
                                        <th scope="col">วันที่</th>
                                        <th scope="col">เรื่อง</th>
                                        <th scope="col">ชั้นความเร็ว/สถานะ</th>
                                        <th scope="col">รายละเอียด</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($document_admission_division_retrun as $row)
                                    <tr>
                                        <th>{{$loop->index+1}}</th>
                                        <td>{{$row->sub3d_government}}</td>
                                        <td>{{$row->sub3d_draft}}</td>
                                        <td>{{$row->sub3d_date}}</td>
                                        <td>{{$row->sub3d_topic}}</td>
                                        <td>
                                            {!! functionController::funtion_doc_speed($row->sub3d_speed) !!}
                                            {!! functionController::funtion_sub3_status($row->sub3_status) !!}
                                        </td>
                                        <td>
                                            <x-jet-nav-link href="{{url('/documents_admission_division_retrun/detail/'.$row->doc_id)}}">
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