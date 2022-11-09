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
                <div class="col-md-9">
                    
                    <div class="shadow card">
                        <div class="card-header">ตารางข้อมูลชื่อผู้ใช้</div>
                        <div class="card-body table-responsive">
                            <table id="example1" class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">ลำดับ</th>
                                        <th scope="col">ชื่อผู้ใช้/อีเมล</th>
                                        <th scope="col">ชื่อ-นามสกุล</th>
                                        <th scope="col">ตำแหน่ง</th>
                                        <th scope="col">กองงาน</th>
                                        <th scope="col">สิทธิ์การเข้าถึง</th>
                                        <th scope="col">วันที่สร้าง</th>
                                        <th scope="col">จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($memberS as $row)
                                    <tr>
                                        <th>{{$loop->index+1}}</th>
                                        <td>{{$row->email}}</td>
                                        <td>{{$row->name}}</td>
                                        <td>{{$row->pos}}</td>
                                        <td>
                                            @if($row->group_name != NULL)
                                            {{$row->group_name}}
                                            @else
                                            <p class="text-sm text-muted">
                                                ไม่ถูกนิยาม
                                            </p>
                                            @endif
                                        </td>
                                        <td>
                                            @if($row->level == '1')
                                            นายก
                                            @elseif($row->level == '2')
                                            รองนายก|ปลัด|รองปลัด
                                            @elseif($row->level == '3')
                                            สารบรรณกลาง
                                            @elseif($row->level == '4')
                                            หัวหน้ากอง
                                            @elseif($row->level == '5')
                                            หัวหน้าฝ่าย
                                            @elseif($row->level == '6')
                                            สารบรรณกอง
                                            @elseif($row->level == '7')
                                            งาน
                                            @endif
                                        </td>
                                        <td>
                                            @if($row->created_at != NULL)
                                            <span class="badge bg-secondary">{{$row->created_at}}</span>
                                            <p class="text-sm text-muted">
                                                <i class="mr-1 far fa-clock"></i>
                                                {{Carbon\Carbon::parse($row->created_at)->diffForHumans()}}
                                            </p>
                                            @endif
                                        </td>

                                        <td>
                                            <button type="button" data-toggle="modal"
                                                data-target="#modal-update{{$row->id}}"
                                                class="btn btn-outline-warning btn-sm"><i
                                                    class="fa fa-edit"></i></button>
                                            <hr>
                                            <button type="button" data-toggle="modal"
                                                data-target="#modal-delete{{$row->id}}"
                                                class="btn btn-outline-danger btn-sm"><i
                                                    class="fa fa-trash"></i></button>
                                        </td>
                                    </tr> 
                                    <div class="modal fade" id="modal-delete{{$row->id}}">
                                        <div class="modal-dialog modal-l">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">คุณต้องการลบชื่อผู้ใช้นี้หรือไม่ ?
                                                    </h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('deleteMember')}}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="id" class="form-control"
                                                            value="{{$row->id}}">
                                                        <x-jet-button onclick="submitForm(this);">
                                                            {{ __('delete') }}
                                                        </x-jet-button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                           
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