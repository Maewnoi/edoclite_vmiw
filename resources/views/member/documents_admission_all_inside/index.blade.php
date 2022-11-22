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
                            เอกสารภายในทั้งหมด
                                <div class="float-right mt-1 ml-3 spinner-grow spinner-grow-sm text-warning" role="status" id="processingIndicator"> 
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">ลำดับ</th>
                                        <th scope="col">ประเภทเอกสาร</th>
                                        <th scope="col">เลขที่</th>
                                        <th scope="col">เลขที่หนังสือ</th>
                                        <th scope="col">วันที่</th>
                                        <th scope="col">วันที่ลง</th>
                                        <th scope="col">เรื่อง</th>
                                        <th scope="col">ชั้นความเร็ว</th>
                                        <th scope="col">สถานะ</th>
                                        <th scope="col">รายละเอียด</th>
                                    </tr>
                                </thead>
                               
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>