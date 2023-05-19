<!DOCTYPE html>
<html lang="en">
<?php $title = "Thông tin tài khoản"; ?>
<?php include("layout/asset_header.php") ?>

<body>
    <?php include("layout/header.php") ?>

    <div class="container py-5 main" style="margin-bottom:0">
        <div class="card text-center">
            <div class="card-header">
                <h3 class="text-primary" style="margin-bottom:0; padding-bottom:0">Thông tin tài khoản</h3>
            </div>
            <div class="card-body">
                <h5 class="card-title">Khách hàng</h5>
                <p class="card-text" id="ctm-name"><b>Họ và tên: </b></p>
                <p class="card-text" id="ctm-phone"><b>Số điện thoại: </b></p>
                <!-- <p class="card-text" id="ctm-email"><b>Email: </b></p> -->
                <p class="card-text" id="ctm-address"><b>Địa chỉ: </b></p>
                <a href="#" class="btn btn-primary">Cập nhật thông tin</a>
            </div>
            <div class="card-footer text-muted">
                CarePET
            </div>
        </div>
    </div>

    <?php include("layout/footer.php") ?>
    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>
    <?php include("layout/asset_footer.php") ?>
    <script src="asset/js/customer/customer-infor.js?v=<?php echo time() ?>"></script>
</body>

</html>