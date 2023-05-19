<!DOCTYPE html>
<html lang="en">
<?php $title = "Lịch sử dịch vụ"; ?>
<?php include("layout/asset_header.php"); ?>

<body>
    <?php include("layout/header.php"); ?>

    <div class="container py-5 main" style="margin-bottom:0">
        <h3 class="text-primary mb-3">Lịch sử sử dụng dịch vụ</h3>
        <div class="table-responsive history">
            <table class="table table-striped table-hover table-borderless table-success align-middle">
                <thead class="">
                    <tr class="color-text">
                        <th scope="col">Mã hoá đơn</th>
                        <th scope="col">Thời gian</th>
                        <th scope="col">Mã giảm giá</th>
                        <th scope="col">Tạm tính</th>
                        <th scope="col">Giảm giá</th>
                        <th scope="col">Tổng tiền</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody class="color-text" id="body-table">                   
                </tbody>
            </table>
        </div>
        <div class="col-lg-12" id="page">
        </div>

        <div id="pop-up-history">
        </div>
    </div>

    <?php include("layout/footer.php") ?>

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <?php include("layout/asset_footer.php") ?>
    <script src="asset/js/customer/customer-history.js?v=<?php echo time() ?>"></script>
</body>

</html>