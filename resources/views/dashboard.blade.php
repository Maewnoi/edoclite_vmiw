<x-app-layout>
    <!-- <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
       
        </h2>
    </x-slot> -->
    <div class="py-12">
        <div class="container">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="mb-3 shadow info-box">
                            <span class="info-box-icon bg-info elevation-2"><i class="fa fa-university"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">จำนวน Sites</span>
                                <span class="info-box-number">
                                    <lable id="funtion_query_dashboard_count_sites_level_0"></lable>
                                    <small>Sites</small>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="mb-3 shadow info-box">
                            <span class="info-box-icon bg-danger elevation-2"><i class="fas fa-users"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">จำนวนกลุ่มงาน</span>
                                <span class="info-box-number">
                                    <lable id="funtion_query_dashboard_count_groupmem_level_0"></lable>
                                    <small>กลุ่ม</small>
                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="clearfix hidden-md-up"></div> -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="mb-3 shadow info-box">
                            <span class="info-box-icon bg-success elevation-2"><i
                                    class="fa fa-address-book"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">จำนวนฝ่าย</span>
                                <span class="info-box-number">
                                    <lable id="funtion_query_dashboard_count_cottons_level_0"></lable>
                                    <small>ฝ่าย</small>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="mb-3 shadow info-box">
                            <span class="info-box-icon bg-warning elevation-2"><i class="fa fa-address-card"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">จำนวนผู้ใช้</span>
                                <span class="info-box-number">
                                    <lable id="funtion_query_dashboard_count_member_level_0"></lable>
                                    <small>คน</small>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="border border shadow card border-info border-info">
                            <div class="card-header">
                                <h5 class="card-title">เอกสารทั้งหมด</h5>
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
                                <div id="chart_level_0" style="height: 250px; width: 100%;"></div>
                            </div>
                            <div class="card-footer">
                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>