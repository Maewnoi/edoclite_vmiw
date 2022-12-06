@php
use App\Http\Controllers\functionController;
@endphp
<x-app-layout>
    <!-- <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
        </h2>
    </x-slot> -->
    <div class="py-12">
        <div class="container">
            <div class="container-fluid">
                <div class="row">
                    <!-- นายก รองนายก -->
                    @if(Auth::user()->level == '1')
                    <div class="col-md-6">
                        <div class="border shadow card border-info">
                            <div class="card-header bg-primary">
                                <h5 class="card-title">ลงนามอิเล็กทรอนิกส์เอกสารภายนอก</h5>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="chart_level_1" style="height: 250px; width: 100%;"></div>
                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="border shadow card border-info">
                            <div class="card-header bg-primary">
                                <h5 class="card-title">ลงนามอิเล็กทรอนิกส์เอกสารภายใน</h5>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="chart_inside_level_1" style="height: 250px; width: 100%;"></div>
                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                    @endif
                    <!-- ปลัด รองปลัด -->
                    @if(Auth::user()->level == '2')
                    <div class="col-md-6">
                        <div class="border shadow card border-info">
                            <div class="card-header bg-primary">
                                <h5 class="card-title">ลงนามอิเล็กทรอนิกส์เอกสารภายนอก</h5>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="chart_level_2" style="height: 250px; width: 100%;"></div>
                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="border shadow card border-info">
                            <div class="card-header bg-primary">
                                <h5 class="card-title">ลงนามอิเล็กทรอนิกส์เอกสารภายใน</h5>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="chart_inside_level_2" style="height: 250px; width: 100%;"></div>
                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                    @endif
                    <!-- สารบรรณกลาง -->
                    @if(Auth::user()->level == '3')
                    <div class="col-md-5">
                        <div class="border shadow card border-info">
                            <div class="card-header bg-primary">
                                <h5 class="card-title">เอกสารรับเข้าภายนอกทั้งหมด</h5>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="chart_level_3" style="height: 250px; width: 100%;"></div>
                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="border shadow card border-info">
                            <div class="card-header bg-primary">
                                <h5 class="card-title">ปฏิทินเลขที่จอง
                                    <div class="float-right mt-1 ml-3 spinner-grow spinner-grow-sm text-warning" role="status" id="calendar_isLoading"> 
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </h5>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <input type="hidden" id="member_dashboard_input_calendar_reserve_numbers"
                                    value="{{Auth::user()->id}}" class="form-control">
                                <div id="calendar"></div>
                                <div id="external-events"></div>
                            </div>
                            <div class="card-footer">
                                <span class="badge badge-info">เลขรับภายนอก</span> <span
                                    class="badge badge-secondary">เลขรับภายใน</span>
                            </div>
                        </div>
                    </div>
                    @endif
                    <!-- หัวหน้ากอง -->
                    @if(Auth::user()->level == '4')
                    <div class="col-md-6">
                        <div class="border shadow card border-info">
                            <div class="card-header bg-primary">
                                <h5 class="card-title">ทะเบียนหนังสือภายนอก</h5>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="chart_level_4" style="height: 250px; width: 100%;"></div>
                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="border shadow card border-info">
                            <div class="card-header bg-primary">
                                <h5 class="card-title">ทะเบียนหนังสือภายใน</h5>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="chart_inside_level_4" style="height: 250px; width: 100%;"></div>
                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                    @endif
                    <!-- หัวหน้าฝ่าย -->
                    @if(Auth::user()->level == '5')
                    <div class="col-md-6">
                        <div class="border shadow card border-info">
                            <div class="card-header bg-primary">
                                <h5 class="card-title">ทะเบียนหนังสือภายนอก</h5>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="chart_level_5" style="height: 250px; width: 100%;"></div>
                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="border shadow card border-info">
                            <div class="card-header bg-primary">
                                <h5 class="card-title">ทะเบียนหนังสือภายใน</h5>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="chart_inside_level_5" style="height: 250px; width: 100%;"></div>
                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- สารบรรณกอง -->
                    @if(Auth::user()->level == '6')
                    <div class="col-md-5">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="border shadow card border-info">
                                    <div class="card-header bg-primary">
                                        <h5 class="card-title">เอกสารรับเข้าภายนอกทั้งหมด</h5>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        
                                        <div id="chart_level_6" style="height: 250px; width: 100%;"></div>
                                    </div>
                                    <div class="card-footer">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="border shadow card border-info">
                                    <div class="card-header bg-primary">
                                        <h5 class="card-title">เอกสารรับเข้าภายในทั้งหมด</h5>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                       
                                        <div id="chart_inside_level_6" style="height: 250px; width: 100%;"></div>
                                    </div>
                                    <div class="card-footer">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="border shadow card border-info">
                            <div class="card-header bg-primary">
                                <h5 class="card-title">ปฏิทินเลขที่จอง 
                                    <div class="float-right mt-1 ml-3 spinner-grow spinner-grow-sm text-warning" role="status" id="calendar_isLoading"> 
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </h5>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <input type="hidden" id="member_dashboard_input_calendar_reserve_numbers"
                                    value="{{Auth::user()->id}}" class="form-control">
                                <div id="calendar"></div>
                                <div id="external-events"></div>
                            </div>
                            <div class="card-footer">
                                <span class="badge badge-info">เลขรับภายนอก</span> 
                                <span class="badge badge-secondary">เลขรับภายใน</span>
                                <span class="badge badge-primary">เลขส่งภายใน</span>
                                <span class="badge badge-success">เลขประกาศ</span>
                                <span class="badge badge-danger">เลขคำสั่ง</span>
                                <span class="badge badge-warning">เลขหนังสือรับรอง</span>
                            </div>
                        </div>
                    </div>

                    @endif

                    <!-- งาน -->
                    @if(Auth::user()->level == '7')
                    <div class="col-md-6">
                        <div class="border shadow card border-info">
                            <div class="card-header bg-primary">
                                <h5 class="card-title">ทะเบียนหนังสือภายนอก</h5>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="chart_level_7" style="height: 250px; width: 100%;"></div>
                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="border shadow card border-info">
                            <div class="card-header bg-primary">
                                <h5 class="card-title">ทะเบียนหนังสือภายใน</h5>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="chart_inside_level_7" style="height: 250px; width: 100%;"></div>
                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>