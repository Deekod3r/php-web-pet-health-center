<!DOCTYPE html>
<html lang="en">
<?php $title = "Thông tin thú cưng"; ?>
<?php include("layout/asset_header.php") ?>

<body>
    <?php include("layout/header.php") ?>

    <div class="container py-5 main" style="margin-bottom:0">
        <h3 class="text-primary mb-3">Thông tin thú cưng</h3>
            <div class="table-responsive">
                <table class="table table-striped table-hover table-borderless table-success align-middle">
                    <thead class="">
                        <tr class="color-text">
                            <th scope="col" class="col-lg-2">Mã thú cưng</th>
                            <th scope="col" class="col-lg-2">Tên</th>
                            <th scope="col" class="col-lg-1">Loại</th>
                            <th scope="col" class="col-lg-2">Giống</th>
                            <th scope="col" class="col-lg-1">Giới tính</th>
                            <th scope="col" class="col-lg-4">Ghi chú</th>
                        </tr>
                    </thead>
                    <tbody class="" id="body-table">
                    </tbody>
                </table>
            </div>
    </div>

    <?php include("layout/footer.php") ?>

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>
    <?php include("layout/asset_footer.php") ?>
    <script src="asset/js/customer/customer-pet.js?v=<?php echo time() ?>"></script>
</body>

</html>