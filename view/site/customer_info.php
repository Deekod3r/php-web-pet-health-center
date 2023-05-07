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
                <p class="card-text"><b>Họ và tên:</b> <?php echo $customer['ctm_name'] ?></p>
                <p class="card-text"><b>Số điện thoại:</b> <?php echo $customer['ctm_phone'] ?></p>
                <p class="card-text"><b>Email:</b> <?php echo $customer['ctm_email'] ?></p>
                <p class="card-text"><b>Địa chỉ:</b> <?php echo $customer['ctm_address'] ?></p>
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
</body>

</html>