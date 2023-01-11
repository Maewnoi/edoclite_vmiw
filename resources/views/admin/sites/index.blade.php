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
                        <div class="card-header">ตารางข้อมูล Sites</div>
                        <div class="card-body table-responsive">
                            <table id="example1" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">ลำดับ</th>
                                        <th scope="col">ชื่อ</th>
                                        <th scope="col">เส้นทางเก็บไฟล์ (แก้ไขไม่ได้)</th>
                                        <th scope="col">ขนาดการใช้งาน</th>
                                        <th scope="col">วันที่สร้าง</th>
                                        <th scope="col">วันที่อัพเดต</th>
                                        <th scope="col">ระบบเข้ารหัสเอกสารด้วย CA</th>
                                        <th scope="col">จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sitesrS as $row)
                                    @php $site_size_ltd_explode = explode(" ", $row->site_size_ltd); @endphp
                                    <tr>
                                        <th>{{$loop->index+1}}</th>
                                        <td>{{$row->site_name}}</td>
                                        <td><p class="text-sm text-muted">{{substr($row->site_path_folder, 0, -25)}}</p></td>
                                        <td><span class="badge bg-secondary">{!! functionController::format_Size(functionController::folder_Size("image/".$row->site_path_folder))!!} / @if($row->site_size_ltd == '-') {{'ไม่จำกัด'}} @else {{$row->site_size_ltd}} @endif </span></td>
                                        <td>
                                            @if($row->site_created_at != NULL)
                                            <span
                                                class="badge bg-secondary">{{$row->site_created_at}}</span>
                                            <p class="text-sm text-muted">
                                                <i class="mr-1 far fa-clock"></i>
                                                {{Carbon\Carbon::parse($row->site_created_at)->diffForHumans()}}
                                            </p>
                                            @endif
                                        </td>
                                        <td>
                                            @if($row->site_updated_at != NULL)
                                            <span
                                                class="badge bg-secondary">{{$row->site_updated_at}}</span>
                                            <p class="text-sm text-muted">
                                                <i class="mr-1 far fa-clock"></i>
                                                {{Carbon\Carbon::parse($row->site_updated_at)->diffForHumans()}}
                                            </p>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input check_site_ca" type="checkbox" {{ $row->site_ca == '1' ? 'checked="checked"' : ''}}
                                                 name="site_ca" id="check_site_ca" data-id="{{$row->site_id}}" data-token="{{ csrf_token() }}">
                                                <label class="form-check-label" for=check_site_ca">
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <button type="button" data-toggle="modal"
                                                data-target="#modal-update{{$row->site_id}}"
                                                class="btn btn-outline-warning btn-sm"><i
                                                    class="fa fa-edit"></i></button>
                                            <hr>
                                            <button type="button" data-toggle="modal" disabled
                                                data-target="#modal-delete{{$row->site_id}}"
                                                class="btn btn-outline-danger btn-sm"><i
                                                    class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="modal-delete{{$row->site_id}}">
                                        <div class="modal-dialog modal-l">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">คุณต้องการลบกองนี้หรือไม่ ?
                                                    </h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('deleteSites')}}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="site_id" class="form-control"
                                                            value="{{$row->site_id}}">
                                                        <x-jet-button onclick="submitForm(this);">
                                                            {{ __('delete') }}
                                                        </x-jet-button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="modal-update{{$row->site_id}}">
                                        <div class="modal-dialog modal-l">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">แก้ไข Sites
                                                    </h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('updateSites')}}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <x-jet-label for="site_name"
                                                                        value="{{ __('ชื่อ') }}" />
                                                                    <input type="text" name="site_name" required
                                                                        value="{{$row->site_name}}"
                                                                        class="form-control @error('site_name') is-invalid @enderror">
                                                                    @error('site_name')
                                                                    <div class="my-2">
                                                                        <p class="mt-2 text-sm text-red-600">
                                                                            {{$message}}</p>
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <x-jet-label for="site_img" value="{{ __('โลโก้') }}" />
                                                                    <input type="file" name="site_img"
                                                                        class="form-control @error('site_img') is-invalid @enderror"
                                                                    required accept="image/*">
                                                                @error('site_img')
                                                                    <div class="my-2">
                                                                        <p class="mt-2 text-sm text-red-600">
                                                                        {{$message}}</p>
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <x-jet-label for="site_color" value="{{ __('ธีม') }}" />
                                                                    <select class="form-control select2bs4 @error('site_color') is-invalid @enderror"
                                                                        name="site_color" required>
                                                                        <option value="{{$row->site_color}}">{{$row->site_color}}
                                                                        </option>    
                                                                        <option value="blue">blue
                                                                        </option>      
                                                                        <option value="red">red
                                                                        </option>   
                                                                        <option value="green">green
                                                                        </option>   
                                                                    </select>
                                                                    @error('site_color')
                                                                    <div class="my-2">
                                                                        <p class="mt-2 text-sm text-red-600">
                                                                        {{$message}}</p>
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <x-jet-label for="site_size_ltd" value="{{ __('ขนาดพื้นที่') }}" />
                                                                    <div class="row">
                                                                        <div class="col-sm-6">
                                                                            <select class="form-control select2bs4 @error('site_size_ltd_0') is-invalid @enderror"
                                                                                name="site_size_ltd_0" required>
                                                                                <option value="@if($row->site_size_ltd == '-') {{'-'}} @else {{ $site_size_ltd_explode[0];}} @endif">@if($row->site_size_ltd == '-') {{'-'}} @else {{ $site_size_ltd_explode[0];}} @endif
                                                                                </option>
                                                                                <option value="-">เลือก ไม่จำกัด
                                                                                </option>
                                                                                @for($i = 1; $i <= 1024; $i++)
                                                                                <option value="{{ $i }}">{{ $i }}
                                                                                </option>
                                                                                @endfor
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <select class="form-control select2bs4 @error('site_size_ltd_1') is-invalid @enderror"
                                                                                name="site_size_ltd_1" required>
                                                                                
                                                                                <option value="@if($row->site_size_ltd == '-') {{'KB'}} @else {{ $site_size_ltd_explode[1];}} @endif">@if($row->site_size_ltd == '-') {{'KB'}} @else {{ $site_size_ltd_explode[1];}} @endif
                                                                                </option>
                                                                                <option value="KB">KB
                                                                                </option>
                                                                                <option value="MB">MB
                                                                                </option>
                                                                                <option value="GB">GB
                                                                                </option>
                                                                                <option value="TB">TB
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    @error('site_size_ltd_0')
                                                                    <div class="my-2">
                                                                        <p class="mt-2 text-sm text-red-600">
                                                                        {{$message}}</p>
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <input type="hidden" name="site_id" value="{{$row->site_id}}">
                                                        <input type="hidden" name="old_site_img" value="{{$row->site_img}}">
                                                      
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
                        <div class="card-header">เพิ่ม Sites</div>
                        <div class="card-body">
                            <form action="{{route('addSites')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <x-jet-label for="site_name" value="{{ __('ชื่อ') }}" />
                                            <input type="text" name="site_name"
                                            required class="form-control @error('site_name') is-invalid @enderror">
                                            @error('site_name')
                                            <div class="my-2">
                                                <p class="mt-2 text-sm text-red-600">{{$message}}</p>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <x-jet-label for="site_img" value="{{ __('โลโก้') }}" />
                                            <input type="file" name="site_img"
                                                class="form-control @error('site_img') is-invalid @enderror"
                                            required accept="image/*">
                                           @error('site_img')
                                            <div class="my-2">
                                                <p class="mt-2 text-sm text-red-600">
                                                {{$message}}</p>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <x-jet-label for="site_color" value="{{ __('ธีม') }}" />
                                            <select class="form-control select2bs4 @error('site_color') is-invalid @enderror"
                                                name="site_color" required>
                                                <option value="">บังคับเลือก
                                                </option>
                                                <option value="blue">blue
                                                </option>      
                                                <option value="red">red
                                                </option>   
                                                <option value="green">green
                                                </option>     
                                            </select>
                                            @error('site_color')
                                            <div class="my-2">
                                                <p class="mt-2 text-sm text-red-600">
                                                {{$message}}</p>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <x-jet-label for="site_size_ltd" value="{{ __('ขนาดพื้นที่') }}" />
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <select class="form-control select2bs4 @error('site_size_ltd_0') is-invalid @enderror"
                                                        name="site_size_ltd_0" required>
                                                        <option value="-">เลือก ไม่จำกัด
                                                        </option>
                                                        @for($i = 1; $i <= 1024; $i++)
                                                        <option value="{{ $i }}">{{ $i }}
                                                        </option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <select class="form-control select2bs4 @error('site_size_ltd_1') is-invalid @enderror"
                                                        name="site_size_ltd_1" required>
                                                        <option value="KB">KB
                                                        </option>
                                                        <option value="MB">MB
                                                        </option>
                                                        <option value="GB">GB
                                                        </option>
                                                        <option value="TB">TB
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            @error('site_size_ltd_0')
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