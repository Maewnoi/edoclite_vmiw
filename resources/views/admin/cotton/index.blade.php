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
                        <div class="card-header">ตารางข้อมูลฝ่าย</div>
                        <div class="card-body table-responsive">
                            <table id="example1" class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">ลำดับ</th>
                                        <th scope="col">ชื่อ</th>
                                        <th scope="col">กองาน</th>
                                        <th scope="col">site</th>
                                        <th scope="col">วันที่สร้าง</th>
                                        <th scope="col">วันที่อัพเดต</th>
                                        <th scope="col">จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cottonS as $row)
                                    <tr>
                                        <th>{{$loop->index+1}}</th>
                                        <td>{{$row->cottons_name}}</td>
                                        <td>{{$row->group_name}}</td>
                                        <td>{{$row->site_name}}</td>
                                        <td>
                                            @if($row->cottons_created_at != NULL)
                                            <span class="badge bg-secondary">{{$row->cottons_created_at}}</span>
                                            <p class="text-sm text-muted">
                                                <i class="mr-1 far fa-clock"></i>
                                                {{Carbon\Carbon::parse($row->cottons_created_at)->diffForHumans()}}
                                            </p>
                                            @endif
                                        </td>
                                        <td>
                                            @if($row->cottons_updated_at != NULL)
                                            <span class="badge bg-secondary">$row->cottons_updated_at</span>
                                            <p class="text-sm text-muted">
                                                <i class="mr-1 far fa-clock"></i>
                                                {{Carbon\Carbon::parse($row->cottons_updated_at)->diffForHumans()}}
                                            </p>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" data-toggle="modal"
                                                data-target="#modal-update{{$row->cottons_id}}"
                                                class="btn btn-outline-warning btn-sm"><i
                                                    class="fa fa-edit"></i></button>
                                            <hr>
                                            <button type="button" data-toggle="modal"
                                                data-target="#modal-delete{{$row->cottons_id}}"
                                                class="btn btn-outline-danger btn-sm"><i
                                                    class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="modal-delete{{$row->cottons_id}}">
                                        <div class="modal-dialog modal-l">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">คุณต้องการลบฝ่ายนี้หรือไม่ ?
                                                    </h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('deletecottons')}}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="cottons_id" class="form-control"
                                                            value="{{$row->cottons_id}}">
                                                        <x-jet-button onclick="submitForm(this);">
                                                            {{ __('delete') }}
                                                        </x-jet-button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="modal-update{{$row->cottons_id}}">
                                        <div class="modal-dialog modal-l">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">แก้ไขฝ่าย
                                                    </h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('updatecottons')}}" method="post">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <x-jet-label for="cottons_name"
                                                                        value="{{ __('ชื่อ') }}" />
                                                                    <input type="text" name="cottons_name" required
                                                                        value="{{$row->cottons_name}}"
                                                                        class="form-control @error('cottons_name') is-invalid @enderror">
                                                                    @error('cottons_name')
                                                                    <div class="my-2">
                                                                        <p class="mt-2 text-sm text-red-600">
                                                                            {{$message}}</p>
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <input type="hidden" name="cottons_id"
                                                            value="{{$row->cottons_id}}" class="form-control">
                                                        <x-jet-button onclick="submitForm(this);">
                                                            {{ __('save') }}
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
                <div class="col-md-3">
                    <div class="shadow card">
                        <div class="card-header">เพิ่มฝ่าย</div>
                        <div class="card-body">
                            <form action="{{route('addcottons')}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <x-jet-label for="cottons_name" value="{{ __('ชื่อ') }}" />
                                            <input type="text" name="cottons_name" value="{{ old('cottons_name') }}"
                                                required
                                                class="form-control @error('cottons_name') is-invalid @enderror">
                                            @error('cottons_name')
                                            <div class="my-2">
                                                <p class="mt-2 text-sm text-red-600">{{$message}}</p>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <x-jet-label for="cottons_group" value="{{ __('กองงาน') }}" />
                                            <select class="form-control @error('cottons_group') is-invalid @enderror"
                                                name="cottons_group">
                                                <option value="">
                                                    เลือกกองงาน
                                                </option>
                                                @foreach($select_groupmemsS as $row_groupmemsS)
                                                <option value="{{$row_groupmemsS->group_id}}">
                                                    {{$row_groupmemsS->group_name}} : {{$row_groupmemsS->site_name}}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('cottons_group')
                                            <div class="my-2">
                                                <p class="mt-2 text-sm text-red-600">
                                                    {{$message}}</p>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <x-jet-button onclick="submitForm(this);">
                                    {{ __('save') }}
                                </x-jet-button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>