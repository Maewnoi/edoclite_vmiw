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
                    <div class="border shadow card border-info">
                        <div class="card-body table-responsive">
                            <ul class="flex-row nav nav-pills">
                                <li class="nav-item active">
                                    <a href="#" class="nav-link active">
                                        <i class="fas fa-inbox"></i> เลขส่งภายนอก
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('reserve_number_delivery_inside_all') }}" class="nav-link">
                                        <i class="far fa-envelope"></i> เลขส่งภายใน
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="border shadow card border-info">
                        <div class="card-header bg-primary">รายการจองเลขส่งภายนอกทั้งหมด</div>
                        <div class="card-body table-responsive">
                            <table id="example1" class="table table-striped">
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
                                    @foreach($reserve_delivery_numberS as $row)
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
                                                    <form action="{{route('cancel_reserve_number_delivery_all')}}" method="post">
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
                <div class="col-md-3">
                    <div class="row">
                        @if(Auth::user()->level == 3 || Auth::user()->level == 6)
                        <div class="col-md-12">
                            <div class="border shadow card border-info">
                                <div class="card-header bg-primary">จองเลข</div>
                                    <div class="card-body">
                                        <form action="{{route('add_reserve_number_delivery_all')}}" method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <x-jet-label for="reserve_number" value="{{ __('เลขที่ต้องการ') }}" />
                                                        <input type="number" name="reserve_number"
                                                            min="{{functionController::funtion_documents_doc_recnum_delivery_plus(Auth::user()->site_id)}}"
                                                            value="{{functionController::funtion_documents_doc_recnum_delivery_plus(Auth::user()->site_id)}}"
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
                        </div>
                        @endif

                        <!-- จองเลขอัตโนมัติ -->
                        @if(Auth::user()->level == 3)
                        <div class="col-md-12">
                            <div class="border shadow card border-info">
                                <div id="auto_reserve_number_header_card" class="card-header @if($check_auto_reserve_number) {{ 'bg-success'}} @else {{ 'bg-danger' }}  @endif ">ตั้งค่าการจองเลขอัตโนมัติ</div>
                                    <div class="card-body">
                                        <div class="row">
                                            <!-- เปิด ปิด -->
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <input type="radio" class="btn-check" name="auto_reserve_number_options-radio" value="0"
                                                    id="auto_reserve_number_danger-radio" autocomplete="off" @if(!$check_auto_reserve_number) checked @endif >
                                                    <label class="btn btn-outline-danger" for="auto_reserve_number_danger-radio">ปิด</label>

                                                    <input type="radio" class="btn-check" name="auto_reserve_number_options-radio" value="1"
                                                    id="auto_reserve_number_success-radio" autocomplete="on" @if($check_auto_reserve_number) checked @endif>
                                                    <label class="btn btn-outline-success" for="auto_reserve_number_success-radio">เปิด</label>
                                                </div>
                                                <hr>
                                            </div>
                                         
                                            <div class="@if($check_auto_reserve_number) @else {{ 'hide' }} @endif " id="auto_reserve_number_form_card">
                                                <!-- จำนวนเลข -->
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <x-jet-label for="" value="{{ __('จำนวนเลขที่ต้องการจอง') }}" />
                                                        <select class="form-control select2bs4"
                                                            name="arn_quantity" id="auto_reserve_number_arn_quantity" required>
                                                            @if($check_auto_reserve_number)
                                                            <option selected value="{{$check_auto_reserve_number->arn_quantity}}">{{$check_auto_reserve_number->arn_quantity}}</option>
                                                            <option value="1">1</option>
                                                            @else
                                                            <option selected value="1">1</option>
                                                            @endif
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                            <option value="7">7</option>
                                                            <option value="8">8</option>
                                                            <option value="9">9</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <input type="hidden" id="auto_reserve_number_arn_template" value="delivery">
                                                <input type="hidden" id="auto_reserve_number_arn_user_id" value="{{Auth::user()->id}}">
                                                <input type="hidden" id="auto_reserve_number_csrf_token" value="{{ csrf_token() }}">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="mt-2 text-danger">หมายเหตุ : ระบบจะจองเลขอัตโนมัติเวลา 00.01 ของทุกวันเมื่อมีการเปิดใช้งาน</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div> 
            </div>
        </div>
    </div>
</x-app-layout>