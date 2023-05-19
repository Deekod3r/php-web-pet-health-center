<!DOCTYPE html>
<html lang="en">
<?php $title = "Đặt lịch"; ?>
<?php include("layout/asset_header.php") ?>

<body>
    <?php include("layout/header.php") ?>
    </br>
    </br>
    <!-- Booking Start -->
    <div class="container-fluid main pt-3 mb-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <div class="bg-primary py-1 px-4 px-sm-5">
                        <?php if (isset($_SESSION['login']) && $_SESSION['login']) { ?>
                            <form class="py-5" method="post" id="form-booking" action="?controller=appointment&action=booking">
                                <div class="form-group">
                                    <p style="margin-bottom:0; color:black; margin-top:0; font-size:18px; font-weight:bold">Ngày</p>
                                    <div class="date" id="date" data-target-input="nearest">
                                        <input type="text" class="form-control border-0 p-4 datetimepicker-input" name="apmDate" id="apm-date" placeholder="" data-target="#date" data-toggle="datetimepicker" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <p style="margin-bottom:0; color:black; margin-top:0; font-size:18px; font-weight:bold">Giờ</p>
                                    <div class="time" id="time" data-target-input="nearest">
                                        <input type="text" class="form-control border-0 p-4 datetimepicker-input" name="apmTime" id="apm-time" placeholder="" data-target="#time" data-toggle="datetimepicker" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <select class="custom-select border-0 px-4" style="height: 47px;" name="categoryService" id="category-service">
                                        <option value="">Chọn dịch vụ</option>                                       
                                    </select>
                                </div>
                                <div class="form-group">
                                    <p style="margin-bottom:0; color:black; margin-top:0; font-size:18px; font-weight:bold">Ghi chú</p>
                                    <input type="text" class="form-control border-0 p-4" placeholder="" name="apmNote" id="apm-note"/>
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-dark btn-block border-0 py-3" type="submit">Đặt lịch</button>
                                </div>
                                <div class="alert mb-0 " id="msg-booking" role="alertdialog" style="display:none">
                                </div>
                            </form>
                        <?php } else { ?>
                            <h4 style="margin-bottom:0">Vui lòng đăng nhập để đặt lịch</h4>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-lg-7 py-5 py-lg-0 px-3 px-lg-5">
                    <h4 class="text-secondary mb-3">Đặt lịch ngay</h4>
                    <h1 class="display-4 mb-4">Trải nghiệm dịch vụ tuyệt vời cùng <span class="text-primary">CarePET</span></h1>
                    <p></p>
                    <div class="row py-2">
                        <div class="col-sm-6">
                            <div class="d-flex flex-column">
                                <div class="d-flex align-items-center mb-2">
                                    <h1 class="flaticon-vaccine font-weight-normal text-secondary m-0 mr-3"></h1>
                                    <h5 class="text-truncate m-0">Tiêm phòng</h5>
                                </div>
                                <p></p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex flex-column">
                                <div class="d-flex align-items-center mb-2">
                                    <h1 class="flaticon-food font-weight-normal text-secondary m-0 mr-3"></h1>
                                    <h5 class="text-truncate m-0">Tư vấn dinh dưỡng</h5>
                                </div>
                                <p></p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex flex-column">
                                <div class="d-flex align-items-center mb-2">
                                    <h1 class="flaticon-grooming font-weight-normal text-secondary m-0 mr-3"></h1>
                                    <h5 class="text-truncate m-0">Thẩm mỹ</h5>
                                </div>
                                <p class="m-0"></p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex flex-column">
                                <div class="d-flex align-items-center mb-2">
                                    <h1 class="flaticon-toy font-weight-normal text-secondary m-0 mr-3"></h1>
                                    <h5 class="text-truncate m-0">Huấn luyện</h5>
                                </div>
                                <p class="m-0"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Booking Start -->

    <?php include("layout/footer.php") ?>


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <?php include("layout/asset_footer.php") ?>
    <script src="asset/js/appointment.js?v=<?php echo time() ?>" async></script>
</body>

</html>