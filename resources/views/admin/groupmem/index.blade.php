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
                <div class="col-md-9">

                    @if(session("success"))
                    <div class="alert shadow alert-success">{{session('success')}}</div>
                    @endif
                    @if ($errors->any())
                    @foreach ($errors->all() as $error)
                    <div class="alert shadow alert-danger">{{ $error }}</div>
                    @endforeach
                    @endif
                    <div class="card shadow">
                        <div class="card-header">ตารางข้อมูลกองงาน</div>
                        <div class="card-body table-responsive">
                            <table id="example1" class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">ลำดับ</th>
                                        <th scope="col">ชื่อกอง</th>
                                        <th scope="col">LineToken</th>
                                        <th scope="col">ชื่อ Sites</th>
                                        <th scope="col">วันที่สร้าง</th>
                                        <th scope="col">วันที่อัพเดต</th>
                                        <th scope="col">จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($GroupmemS as $row)
                                    <tr>
                                        <th>{{$loop->index+1}}</th>
                                        <td>{{$row->group_name}}</td>
                                        <td>
                                            <p class="text-sm text-muted">
                                                @if($row->group_token == NULL)
                                                {{'ไม่ถูกนิยาม'}}
                                                @else
                                                {{$row->group_token}}
                                                @endif
                                            </p>
                                        </td>
                                        <td>{{ functionController::funtion_sites($row->group_site_id) }}</td>
                                        <td>
                                            @if($row->group_created_at != NULL)
                                            <span class="badge bg-secondary">{{$row->group_created_at}}</span>
                                            <p class="text-sm text-muted">
                                                <i class="far fa-clock mr-1"></i>
                                                {{Carbon\Carbon::parse($row->group_created_at)->diffForHumans()}}
                                            </p>
                                            @endif
                                        </td>
                                        <td>
                                            @if($row->group_updated_at != NULL)
                                            <span class="badge bg-secondary">{{$row->group_updated_at}}</span>
                                            <p class="text-sm text-muted">
                                                <i class="far fa-clock mr-1"></i>
                                                {{Carbon\Carbon::parse($row->group_updated_at)->diffForHumans()}}
                                            </p>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" data-toggle="modal"
                                                data-target="#modal-update{{$row->group_id}}"
                                                class="btn btn-outline-warning btn-sm"><i
                                                    class="fa fa-edit"></i></button>
                                            <hr>
                                            <button type="button" data-toggle="modal"
                                                data-target="#modal-delete{{$row->group_id}}"
                                                class="btn btn-outline-danger btn-sm"><i
                                                    class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="modal-delete{{$row->group_id}}">
                                        <div class="modal-dialog modal-l">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">คุณต้องการลบกองนี้หรือไม่ ?
                                                    </h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('deleteGroupmem')}}" method="post">
                                                        @csrf
                                                        <input type="hidden" required name="group_id"
                                                            class="form-control" value="{{$row->group_id}}">
                                                        <x-jet-button>
                                                            {{ __('delete') }}
                                                        </x-jet-button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="modal-update{{$row->group_id}}">
                                        <div class="modal-dialog modal-l">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">แก้ไขกองงาน
                                                    </h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('updateGroupmem')}}" method="post">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <x-jet-label for="group_name"
                                                                        value="{{ __('ชื่อกองงาน') }}" />
                                                                    <select
                                                                        class="form-control @error('group_name') is-invalid @enderror"
                                                                        name="group_name" required>
                                                                        <option value="{{$row->group_id}}">
                                                                            {{$row->group_name}}
                                                                        </option>
                                                                        <option value="สำนักปลัด">
                                                                            สำนักปลัด
                                                                        </option>
                                                                        <option value="สำนักงานเลขานูการ">
                                                                            สำนักงานเลขานูการ
                                                                        </option>
                                                                        <option value="กองคลัง">
                                                                            กองคลัง
                                                                        </option>
                                                                        <option value="กองช่าง">
                                                                            กองช่าง
                                                                        </option>
                                                                        <option value="กองสาธารณสุข">
                                                                            กองสาธารณสุข
                                                                        </option>
                                                                        <option value="กองยุทธศาสตร์และงบประมาณ">
                                                                            กองยุทธศาสตร์และงบประมาณ
                                                                        </option>
                                                                        <option value="กองการศึกษาศาสนาและวัฒนธรรม">
                                                                            กองการศึกษาศาสนาและวัฒนธรรม
                                                                        </option>
                                                                        <option
                                                                            value="กองทรัพยากรธรรมชาติและสิ่งแวดล้อม">
                                                                            กองทรัพยากรธรรมชาติและสิ่งแวดล้อม
                                                                        </option>
                                                                        <option value="กองพัสดุและทรัพย์สิน">
                                                                            กองพัสดุและทรัพย์สิน
                                                                        </option>
                                                                        <option value="กองการเจ้าหน้าที่">
                                                                            กองการเจ้าหน้าที่
                                                                        </option>
                                                                    </select>
                                                                    @error('group_name')
                                                                    <div class="my-2">
                                                                        <p class="text-sm text-red-600 mt-2">
                                                                            {{$message}}</p>
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <x-jet-label for="group_site_id"
                                                                        value="{{ __('ชื่อ Sites') }}" />
                                                                    <select
                                                                        class="form-control @error('group_site_id') is-invalid @enderror"
                                                                        name="group_site_id" required>
                                                                        <option value="{{$row->group_site_id}}">
                                                                            {{ functionController::funtion_sites($row->group_site_id) }}
                                                                        </option>
                                                                        @foreach($sitesS as $row_sitesS)
                                                                        <option value="{{$row_sitesS->site_id}}">
                                                                            {{$row_sitesS->site_name}}
                                                                        </option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('group_site_id')
                                                                    <div class="my-2">
                                                                        <p class="text-sm text-red-600 mt-2">
                                                                            {{$message}}</p>
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <x-jet-label for="group_token"
                                                                        value="{{ __('LineToken') }}" />
                                                                    <input type="text" name="group_token"
                                                                        value="{{$row->group_token}}"
                                                                        class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <input type="hidden" required name="group_id"
                                                            value="{{$row->group_id}}" class="form-control">
                                                        <x-jet-button>
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
                    <div class="card shadow">
                        <div class="card-header">เพิ่มกองงาน</div>
                        <div class="card-body">
                            <form action="{{route('addGroupmem')}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <x-jet-label for="group_name" value="{{ __('ชื่อกองงาน') }}" />
                                            <select class="form-control @error('group_name') is-invalid @enderror"
                                                name="group_name" required>
                                                <option value="">
                                                    เลือกกองงาน
                                                </option>
                                                <option value="สำนักปลัด">
                                                    สำนักปลัด
                                                </option>
                                                <option value="สำนักงานเลขานูการ">
                                                    สำนักงานเลขานูการ
                                                </option>
                                                <option value="กองคลัง">
                                                    กองคลัง
                                                </option>
                                                <option value="กองช่าง">
                                                    กองช่าง
                                                </option>
                                                <option value="กองสาธารณสุข">
                                                    กองสาธารณสุข
                                                </option>
                                                <option value="กองยุทธศาสตร์และงบประมาณ">
                                                    กองยุทธศาสตร์และงบประมาณ
                                                </option>
                                                <option value="กองการศึกษาศาสนาและวัฒนธรรม">
                                                    กองการศึกษาศาสนาและวัฒนธรรม
                                                </option>
                                                <option value="กองทรัพยากรธรรมชาติและสิ่งแวดล้อม">
                                                    กองทรัพยากรธรรมชาติและสิ่งแวดล้อม
                                                </option>
                                                <option value="กองพัสดุและทรัพย์สิน">
                                                    กองพัสดุและทรัพย์สิน
                                                </option>
                                                <option value="กองการเจ้าหน้าที่">
                                                    กองการเจ้าหน้าที่
                                                </option>
                                            </select>
                                            @error('group_name')
                                            <div class="my-2">
                                                <p class="text-sm text-red-600 mt-2">{{$message}}</p>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <x-jet-label for="group_site_id" value="{{ __('ชื่อ Sites') }}" />
                                            <select class="form-control @error('group_site_id') is-invalid @enderror"
                                                name="group_site_id" required>
                                                <option value="">เลือก Sites
                                                </option>
                                                @foreach($sitesS as $row_sitesS)
                                                <option value="{{$row_sitesS->site_id}}">
                                                    {{$row_sitesS->site_name}}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('group_site_id')
                                            <div class="my-2">
                                                <p class="text-sm text-red-600 mt-2">{{$message}}</p>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <x-jet-label for="group_token" value="{{ __('LineToken') }}" />
                                            <input type="text" name="group_token" value="{{ old('group_token') }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <x-jet-button>
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