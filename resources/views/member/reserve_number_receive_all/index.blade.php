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
                        <div class="card-body table-responsive">
                            <ul class="flex-row nav nav-pills">
                                <li class="nav-item active">
                                    <a href="#" class="nav-link active">
                                        <i class="fas fa-inbox"></i> เลขรับภายนอก
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('reserve_number_receive_inside_all') }}" class="nav-link">
                                        <i class="far fa-envelope"></i> เลขรับภายใน
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                 
                    <div class="shadow card">
                        <div class="card-header bg-primary">รายการจองเลขรับภายนอกทั้งหมด</div>
                        <div class="card-body table-responsive">
                            <table id="example1" class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">ลำดับ</th>
                                        <th scope="col">เลขที่ถูกจอง</th>
                                        <th scope="col">ผู้จอง</th>
                                        <th scope="col">วันที่จอง</th>
                                        <th scope="col">สถานะ</th>
                                        <th scope="col">จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reserve_numberS as $row)
                                    <tr>
                                        <th>{{$loop->index+1}}</th>
                                        <td>{{$row->reserve_number}}</td>
                                        <td>{{ functionController::funtion_users($row->reserve_owner) }}</td>
                                        <td>
                                            @if($row->reserve_date != NULL)
                                            <span class="badge bg-secondary">{{$row->reserve_date}}</span>
                                            <p class="text-sm text-muted">
                                                <i class="mr-1 far fa-clock"></i>
                                                {{Carbon\Carbon::parse($row->reserve_date)->diffForHumans()}}
                                            </p>
                                            @endif
                                        </td>
                                        <td>
                                            {!! functionController::funtion_reserve_status($row->reserve_status) !!}
                                        </td>
                                        <td>
                                            @if($row->reserve_status == '0' && $row->reserve_owner != Auth::user()->id)

                                            @elseif($row->reserve_status == '0' && $row->reserve_owner ==
                                            Auth::user()->id)
                                            <x-jet-button data-toggle="modal"
                                                data-target="#modal-cancel{{$row->reserve_id}}">
                                                {{ __('ยกเลิก') }}
                                            </x-jet-button>
                                            @elseif($row->reserve_status == '2')
                                            @elseif($row->reserve_status == '1')
                                            @if($row->reserve_used != NULL)
                                            <x-jet-label
                                                value="ผู้ใช้งาน :{{ functionController::funtion_users($row->reserve_used) }}" />
                                            @endif
                                            @endif
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="modal-cancel{{$row->reserve_id}}">
                                        <div class="modal-dialog modal-l">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">คุณต้องการยกเลิกเลขที่จองนี้หรือไม่ ?
                                                    </h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('cancel_reserve_number_receive_all')}}"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="reserve_id" class="form-control"
                                                            value="{{$row->reserve_id}}">
                                                        <input type="hidden" name="reserve_number" class="form-control"
                                                            value="{{$row->reserve_number}}">
                                                        <x-jet-button onclick="submitForm(this);">
                                                            {{ __('ยืนยัน') }}
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
               
                @if(Auth::user()->level == 3)
                <div class="col-md-3">
                    <div class="shadow card">
                        <div class="card-header bg-primary">จองเลข</div>
                        <div class="card-body">
                            <form action="{{route('add_reserve_number_receive_all')}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <x-jet-label for="reserve_number" value="{{ __('เลขที่ต้องการ') }}" />
                                            <input type="number" name="reserve_number"
                                                min="{{functionController::funtion_documents_doc_recnum_plus(Auth::user()->site_id)}}"
                                                value="{{functionController::funtion_documents_doc_recnum_plus(Auth::user()->site_id)}}"
                                                class="form-control @error('reserve_number') is-invalid @enderror"
                                                required>
                                            @error('reserve_number')
                                            <div class="my-2">
                                                <p class="mt-2 text-sm text-red-600">{{$message}}</p>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <x-jet-button onclick="submitForm(this);">
                                    {{ __('จอง') }}
                                </x-jet-button>
                            </form>
                        </div>
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>