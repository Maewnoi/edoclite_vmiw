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
                        <div class="card-header">ตารางข้อมูล Sites</div>
                        <div class="card-body table-responsive">
                            <table id="example1" class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">ลำดับ</th>
                                        <th scope="col">ชื่อ</th>
                                        <th scope="col">วันที่สร้าง</th>
                                        <th scope="col">วันที่อัพเดต</th>
                                        <th scope="col">จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sitesrS as $row)
                                    <tr>
                                        <th>{{$loop->index+1}}</th>
                                        <td>{{$row->site_name}}</td>
                                        <td>
                                            @if($row->site_created_at != NULL)
                                            <span
                                                class="badge bg-secondary">{{$row->site_created_at}}</span>
                                            <p class="text-sm text-muted">
                                                <i class="far fa-clock mr-1"></i>
                                                {{Carbon\Carbon::parse($row->site_created_at)->diffForHumans()}}
                                            </p>
                                            @endif
                                        </td>
                                        <td>
                                            @if($row->site_updated_at != NULL)
                                            <span
                                                class="badge bg-secondary">$row->site_updated_at</span>
                                            <p class="text-sm text-muted">
                                                <i class="far fa-clock mr-1"></i>
                                                {{Carbon\Carbon::parse($row->site_updated_at)->diffForHumans()}}
                                            </p>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" data-toggle="modal"
                                                data-target="#modal-update{{$row->site_id}}"
                                                class="btn btn-outline-warning btn-sm"><i
                                                    class="fa fa-edit"></i></button>
                                            <hr>
                                            <button type="button" data-toggle="modal"
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
                                                        <x-jet-button>
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
                                                    <form action="{{route('updateSites')}}" method="post">
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
                                                                        <p class="text-sm text-red-600 mt-2">
                                                                            {{$message}}</p>
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <input type="hidden" name="site_id" value="{{$row->site_id}}"
                                                            class="form-control">
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
                        <div class="card-header">เพิ่ม Sites</div>
                        <div class="card-body">
                            <form action="{{route('addSites')}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <x-jet-label for="site_name" value="{{ __('ชื่อ') }}" />
                                            <input type="text" name="site_name" value="{{ old('site_name') }}"
                                            required class="form-control @error('site_name') is-invalid @enderror">
                                            @error('site_name')
                                            <div class="my-2">
                                                <p class="text-sm text-red-600 mt-2">{{$message}}</p>
                                            </div>
                                            @enderror
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