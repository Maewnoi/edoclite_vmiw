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
                        <div class="card-header">จัดการ tokens</div>
                        <div class="card-body table-responsive">
                            <table id="example1" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">ลำดับ</th>
                                        <th scope="col">ชื่อ site</th>
                                        <th scope="col">สิทธิ์</th>
                                        <th scope="col">tokens</th>
                                        <th scope="col">รูปประทับตรา</th>
                                        <th scope="col">จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tokenS as $row)
                                    <tr>
                                        <th>{{$loop->index+1}}</th>
                                        <td>{{$row->site_name}}</td>
                                        <td>{{functionController::funtion_user_level($row->token_level)}}</td>
                                        <td>
                                            <p class="text-sm text-muted">
                                                {{$row->token_token}}
                                            </p>
                                        </td>
                                        <td>
                                            @if($row->token_seal != '')
                                                <img src="{{ asset($row->token_seal) }}" class="img-thumbnail visible-xs" alt="">
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" data-toggle="modal"
                                                data-target="#modal-update{{$row->token_id}}"
                                                class="btn btn-outline-warning btn-sm"><i
                                                    class="fa fa-edit"></i></button>
                                            <hr>
                                            <button type="button" data-toggle="modal"
                                                data-target="#modal-delete{{$row->token_id}}"
                                                class="btn btn-outline-danger btn-sm"><i
                                                    class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="modal-delete{{$row->token_id}}">
                                        <div class="modal-dialog modal-l">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">คุณต้องการลบหรือไม่ ?
                                                    </h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('deleteControltokens')}}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="token_id" class="form-control"
                                                            value="{{$row->token_id}}">
                                                        <input type="hidden" name="token_seal" class="form-control"
                                                            value="{{$row->token_seal}}">
                                                        <x-jet-button onclick="submitForm(this);">
                                                            {{ __('delete') }}
                                                        </x-jet-button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="modal-update{{$row->token_id}}">
                                        <div class="modal-dialog modal-l">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">แก้ไข
                                                    </h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('updateControltokens')}}" method="post"  enctype="multipart/form-data">
                                                    @csrf
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <x-jet-label for="token_token" value="{{ __('token') }}" />
                                                                    <input type="text" name="token_token" required value="{{ $row->token_token }}"
                                                                        class="form-control @error('token_token') is-invalid @enderror">
                                                                    @error('token_token')
                                                                    <div class="my-2">
                                                                        <p class="mt-2 text-sm text-red-600">
                                                                            {{$message}}</p>
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            @if($row->token_seal != '')
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <x-jet-label for="token_seal" value="{{ __('รูปประทับตรา') }}" />
                                                                    <input type="file" name="token_seal"
                                                                        class="form-control @error('token_seal') is-invalid @enderror"
                                                                        accept="image/*">
                                                                    @error('token_seal')
                                                                    <div class="my-2">
                                                                        <p class="mt-2 text-sm text-red-600">
                                                                            {{$message}}</p>
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="token_seal_old" class="form-control"
                                                            value="{{$row->token_seal}}">
                                                            @endif
                                                        </div>
                                                        <input type="hidden" name="token_id" class="form-control"
                                                            value="{{$row->token_id}}">
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
                        <div class="card-header">เพิ่ม</div>
                        <div class="card-body">
                            <form action="{{route('addControltokens')}}" method="post"  enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <x-jet-label for="token_token" value="{{ __('token') }}" />
                                            <input type="text" name="token_token" required
                                                class="form-control @error('token_token') is-invalid @enderror">
                                            @error('token_token')
                                            <div class="my-2">
                                                <p class="mt-2 text-sm text-red-600">
                                                    {{$message}}</p>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <x-jet-label for="token_site_id" value="{{ __('site') }}" />
                                            <select class="form-control @error('token_site_id') is-invalid @enderror"
                                                name="token_site_id" required>
                                                <option value="">
                                                    เลือก site
                                                </option>
                                                @foreach($sitesS as $rowsites)
                                                <option value="{{$rowsites->site_id}}">
                                                    {{$rowsites->site_name}}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('token_site_id')
                                            <div class="my-2">
                                                <p class="mt-2 text-sm text-red-600">
                                                    {{$message}}</p>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <x-jet-label for="token_level" value="{{ __('สิทธิ์') }}" />
                                            <select class="form-control @error('token_level') is-invalid @enderror"
                                                name="token_level" required id="controltokensController_token_level">
                                                <option value="">
                                                    เลือก สิทธิ์
                                                </option>
                                                <option value="3">
                                                    สรรบรรณกลาง
                                                </option>
                                                <option value="8">
                                                    หน้าห้อง
                                                </option>
                                                <option value="2">
                                                    รองปลัด|ปลัด
                                                </option>
                                                <option value="1">
                                                    รองนายก|นายก
                                                </option>
                                            </select>
                                            @error('token_level')
                                            <div class="my-2">
                                                <p class="mt-2 text-sm text-red-600">
                                                    {{$message}}</p>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group hide" id="controltokensController_token_seal_form-group">
                                            <x-jet-label for="token_seal" value="{{ __('รูปประทับตรา (บังคับ)') }}" />
                                            <input type="file" name="token_seal" id="controltokensController_token_seal"
                                                class="form-control @error('token_seal') is-invalid @enderror"
                                                accept="image/*">
                                            @error('token_seal')
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