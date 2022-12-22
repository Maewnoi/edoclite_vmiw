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
                    <div class="border shadow card border-info">
                        <div class="card-header">ตารางข้อมูลชื่อผู้ใช้</div>
                        <div class="card-body table-responsive">
                            <table id="example1" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">ลำดับ</th>
                                        <th scope="col">ชื่อผู้ใช้/อีเมล</th>
                                        <th scope="col">ชื่อ-นามสกุล</th>
                                        <th scope="col">กองงาน</th>
                                        <th scope="col">สิทธิ์การเข้าถึง</th>
                                        <th scope="col">วันที่สร้าง</th>
                                        <th scope="col">นิติการ</th>
                                        <th scope="col">ผู้พิจารณา</th>
                                        <th scope="col">จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($memberS as $row)
                                    <tr>
                                        <th>{{$loop->index+1}}</th>
                                        <td>{{$row->email}}</td>
                                        <td>{{$row->name}}</td>
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
                                            นายก|รองนายก
                                            @elseif($row->level == '2')
                                            ปลัด|รองปลัด
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
                                            @if($row->level == '5' || $row->level == '7')
                                            <div class="form-check">
                                                <input class="form-check-input check_jurisprudence" type="checkbox" {{ $row->jurisprudence == '1' ? 'checked="checked"' : ''}}
                                                 name="jurisprudence" id="check_jurisprudence" data-id="{{$row->id}}" data-token="{{ csrf_token() }}">
                                                <label class="form-check-label" for=check_jurisprudence">
                                                </label>
                                            </div>
                                            @endif
                                        </td>
                                        <td>
                                            @if($row->level == '4' || $row->level == '5' || $row->level == '6' || $row->level == '7')
                                            <div class="form-check">
                                                <input class="form-check-input check_user_center" type="checkbox" {{ $row->center == '1' ? 'checked="checked"' : ''}}
                                                 name="center" id="check_user_center" data-id="{{$row->id}}" data-token="{{ csrf_token() }}">
                                                <label class="form-check-label" for=check_user_center">
                                                </label>
                                            </div>
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
                                    <div class="modal fade" id="modal-update{{$row->id}}">
                                        <div class="modal-dialog modal-l">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">แก้ไขชื่อผู้ใช้
                                                    </h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('updateMember')}}" method="post"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <x-jet-label for="email"
                                                                        value="{{ __('ชื่อผู้ใช้/อีเมล') }}" />
                                                                    <input type="text" name="email"
                                                                        value="{{ $row->email }}"
                                                                        class="form-control @error('email') is-invalid @enderror"
                                                                        required>
                                                                    @error('email')
                                                                    <div class="my-2">
                                                                        <p class="mt-2 text-sm text-red-600">
                                                                            {{$message}}</p>
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <x-jet-label for="name"
                                                                        value="{{ __('ชื่อ-นามสกุล') }}" />
                                                                    <input type="text" name="name"
                                                                        value="{{ $row->name }}"
                                                                        class="form-control @error('name') is-invalid @enderror"
                                                                        required>
                                                                    @error('name')
                                                                    <div class="my-2">
                                                                        <p class="mt-2 text-sm text-red-600">
                                                                            {{$message}}</p>
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <x-jet-label for="tel"
                                                                        value="{{ __('เบอร์โทรศัพท์') }}" />
                                                                    <input type="number" name="tel"
                                                                        value="{{ $row->tel }}"
                                                                        class="form-control @error('tel') is-invalid @enderror"
                                                                        required>
                                                                    @error('tel')
                                                                    <div class="my-2">
                                                                        <p class="mt-2 text-sm text-red-600">
                                                                            {{$message}}</p>
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <x-jet-label for="sign"
                                                                        value="{{ __('ลายเซ็น') }}" />
                                                                    <input type="file" name="sign"
                                                                        class="form-control @error('sign') is-invalid @enderror"
                                                                        accept="image/*" value="{{$row->sign}}">
                                                                    @error('sign')
                                                                    <div class="my-2">
                                                                        <p class="mt-2 text-sm text-red-600">
                                                                            {{$message}}</p>
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <input type="hidden" name="id" value="{{$row->id}}">
                                                        <input type="hidden" name="old_sign" value="{{$row->sign}}">

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
                    <div class="border shadow card border-info">
                        <div class="card-header">เพิ่มชื่อผู้ใช้</div>
                        <div class="card-body">
                            <form action="{{route('addMember')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <x-jet-label for="email" value="{{ __('ชื่อผู้ใช้/อีเมล') }}" />
                                            <input type="text" name="email" value="{{ old('email') }}"
                                                class="form-control @error('email') is-invalid @enderror" required>
                                            @error('email')
                                            <div class="my-2">
                                                <p class="mt-2 text-sm text-red-600">{{$message}}</p>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <x-jet-label for="password" value="{{ __('รหัสผ่าน') }}" />
                                            <input type="password" name="password" autocomplete="new-password"
                                                class="form-control @error('password') is-invalid @enderror" required>
                                            @error('password')
                                            <div class="my-2">
                                                <p class="mt-2 text-sm text-red-600">{{$message}}</p>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <x-jet-label for="password_confirmation"
                                                value="{{ __('รหัสผ่านยืนยัน') }}" />
                                            <input type="password" name="password_confirmation"
                                                autocomplete="new-password"
                                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                                required>
                                            @error('password_confirmation')
                                            <div class="my-2">
                                                <p class="mt-2 text-sm text-red-600">{{$message}}</p>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <x-jet-label for="name" value="{{ __('ชื่อ-นามสกุล') }}" />
                                            <input type="text" name="name" value="{{ old('name') }}"
                                                class="form-control @error('name') is-invalid @enderror" required>
                                            @error('name')
                                            <div class="my-2">
                                                <p class="mt-2 text-sm text-red-600">{{$message}}</p>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <x-jet-label for="level" value="{{ __('สิทธิ์') }}" />
                                            <select class="form-control select2bs4 @error('level') is-invalid @enderror"
                                                name="level" id="memberController_add_level" required>
                                                <option value="">บังคับเลือก
                                                </option>
                                                <option value="1">นายก
                                                </option>
                                                <option value="2">รองนายก
                                                </option>
                                                <option value="2">ปลัด
                                                </option>
                                                <option value="2">รองปลัด
                                                </option>
                                                <option value="3">สารบรรณกลาง
                                                </option>
                                                <option value="4">หัวหน้ากอง
                                                </option>
                                                <option value="5">หัวหน้าฝ่าย
                                                </option>
                                                <option value="6">สารบรรณกอง
                                                </option>
                                                <option value="7">งาน
                                                </option>
                                            </select>
                                            @error('level')
                                            <div class="my-2">
                                                <p class="mt-2 text-sm text-red-600">{{$message}}</p>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <x-jet-label for="pos" value="{{ __('ตำแหน่ง') }}" />
                                            <input type="text" name="pos" value="{{ old('pos') }}"
                                                class="form-control @error('pos') is-invalid @enderror" required>
                                            @error('pos')
                                            <div class="my-2">
                                                <p class="mt-2 text-sm text-red-600">{{$message}}</p>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group" id="memberController_add_form-group_group">
                                            <x-jet-label for="group" value="{{ __('กองงาน') }}" />
                                            <select class="form-control select2bs4 @error('group') is-invalid @enderror"
                                                name="group" id="memberController_add_group" required>
                                                <option value="">บังคับเลือก
                                                </option>
                                                @foreach($select_groupmemsS as $row_groupmemsS)
                                                <option value="{{$row_groupmemsS->group_id}}">
                                                    {{$row_groupmemsS->group_name}} : {{$row_groupmemsS->site_name}}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('group')
                                            <div class="my-2">
                                                <p class="mt-2 text-sm text-red-600">{{$message}}</p>
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group hide" id="memberController_add_form-group_sites">
                                            <x-jet-label for="sites" value="{{ __('site') }}" />
                                            <select class="form-control select2bs4 @error('sites') is-invalid @enderror"
                                                name="sites" id="memberController_add_sites" required>
                                                <option value="">บังคับเลือก
                                                </option>
                                                @foreach($select_sitesS as $row_sitesS)
                                                <option value="{{$row_sitesS->site_id}}">
                                                    {{$row_sitesS->site_name}}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('sites')
                                            <div class="my-2">
                                                <p class="mt-2 text-sm text-red-600">{{$message}}</p>
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group hide" id="memberController_add_form-group_cotton">
                                            <x-jet-label value="{{ __('ฝ่าย') }}" />
                                            <select class="form-control"
                                                name="cotton" id="memberController_add_cotton">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <x-jet-label for="tel" value="{{ __('เบอร์โทรศัพท์') }}" />
                                            <input type="number" name="tel" value="{{ old('tel') }}"
                                                class="form-control @error('tel') is-invalid @enderror" required>
                                            @error('tel')
                                            <div class="my-2">
                                                <p class="mt-2 text-sm text-red-600">{{$message}}</p>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <x-jet-label for="sign" value="{{ __('ลายเซ็น') }}" />
                                            <input type="file" name="sign"
                                                class="form-control @error('sign') is-invalid @enderror"
                                                accept="image/*">
                                            @error('sign')
                                            <div class="my-2">
                                                <p class="mt-2 text-sm text-red-600">{{$message}}</p>
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