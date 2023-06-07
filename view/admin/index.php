<!doctype html>
<html lang="en">
<?php $title = "Trang chủ" ?>
<?php include "view/admin/layout/asset-header.php" ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

<body>
    <?php include "view/admin/layout/header.php" ?>
    <div class="container-fluid main-admin">
        <!-- Content Row -->
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Doanh thu tháng hiện tại</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="revenue-current-month"></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Doanh thu năm hiện tại</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="revenue-current-year"></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Lịch hẹn cần duyệt</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="new-appointment"></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Đánh giá mới</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="new-feedback"></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->
        <div class="row mb-5">
            <div class="col-6">
                <canvas id="myChart" style="width:100%;max-width:1000px"></canvas>
            </div>
            <div class="col-6">
                <canvas id="myChart1" style="width:100%;max-width:1000px"></canvas>
            </div>
            <div class="col-12">
                <canvas id="myChart2" style="width:100%; height:500px"></canvas>
            </div>
        </div>
    </div>
    <script src="asset/admin/js/dashboard.js?v=<?php echo time() ?>" async></script>
    <?php include "view/admin/layout/asset-footer.php" ?>
</body>

</html>