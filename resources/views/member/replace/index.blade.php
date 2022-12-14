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
                        <div class="card-header bg-primary">
                            <div class="clearfix">
                            รักษาการแทน
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="example1" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">ลำดับ</th>
                                        <th scope="col">ชื่อ-นามสกุล</th>
                                        <th scope="col">ตำแหน่ง</th>
                                        <th scope="col">กองงาน</th>
                                        <th scope="col">ฝ่าย</th>
                                        <th scope="col">สิทธิ์การเข้าถึง</th>
                                        <th scope="col">จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <input type="hidden" name="replaceController_token" id="replaceController_token" value="{{ csrf_token() }}" />
                                    @foreach($memberS as $row)
                                    <tr>
                                        <th>{{$loop->index+1}}</th>
                                        <td>{{$row['name']}}</td>
                                        <td>{{$row['pos']}}</td>
                                        <td>{{functionController::funtion_groupmem_name($row['group'])}}</td>
                                        <td>{{functionController::funtion_cottons($row['cotton'])}}</td>
                                        <td>{{functionController::funtion_user_level($row['level'])}}</td>
                                        <td>
                                            <div class="flex items-center mr-4">
                                                <input id="replaceController-checkbox" data-id="{{$row['id']}}" type="checkbox" class="w-4 h-4 text-purple-600 bg-gray-100 border-gray-300 rounded name-replaceController-checkbox focus:ring-purple-500 dark:focus:ring-purple-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                                @if(functionController::funtion_replaces($row['id']) == '1')
                                                checked
                                                @elseif(functionController::funtion_replaces($row['id']) == '0')
                                                @endif
                                                >
                                                <label for="replaceController-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">รักษาการแทนน</label>
                                            </div>
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