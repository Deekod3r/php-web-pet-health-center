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
                            <form class="py-5" action="?controller=appointment&action=booking" method="post">
                                <input type="hidden" name="ctmId" value="<?php echo $_SESSION['id'];?>">
                                <div class="form-group">
                                    <p style="margin-bottom:0; color:black; margin-top:0; font-size:18px; font-weight:bold">Ngày</p>
                                    <div class="date" id="date" data-target-input="nearest">
                                        <input type="text" class="form-control border-0 p-4 datetimepicker-input" name="apmDate" placeholder="" data-target="#date" data-toggle="datetimepicker" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <p style="margin-bottom:0; color:black; margin-top:0; font-size:18px; font-weight:bold">Giờ</p>
                                    <div class="time" id="time" data-target-input="nearest">
                                        <input type="text" class="form-control border-0 p-4 datetimepicker-input" name="apmTime" placeholder="" data-target="#time" data-toggle="datetimepicker" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <select class="custom-select border-0 px-4" style="height: 47px;" name="categoryService">
                                        <option value="">Chọn dịch vụ</option>
                                        <?php foreach ($categoryService as $cs) : ?>
                                            <option value="<?php echo $cs['cs_id'] ?>"><?php echo $cs['cs_name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <p style="margin-bottom:0; color:black; margin-top:0; font-size:18px; font-weight:bold">Ghi chú</p>
                                    <input type="text" class="form-control border-0 p-4" placeholder="" name="apmNote" />
                                </div>
                                <div>
                                    <button class="btn btn-dark btn-block border-0 py-3" type="submit">Đặt lịch</button>
                                </div>
                                <?php if (isset($_SESSION['check_booking'])): ?>
                                <p style="margin-top:15px; margin-bottom:0; text-align:center; font-size: 20px; <?php if (!$_SESSION['check_booking']) echo ' color: #F6F1E9; '; else echo ' color: #F6F1E9; ' ?>"><?php echo $_SESSION['msg_booking']?></p>
                                <?php endif; 
                                    $_SESSION['msg_booking'] = null;
                                    $_SESSION['check_booking'] = null;
                                ?>
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
</body>

</html>