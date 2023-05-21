<!DOCTYPE html>
<html lang="en">
<?php $title = "Lịch đang hẹn"; ?>
<?php include("layout/asset-header.php") ?>

<body>
    <?php include("layout/header.php") ?>

    <div class="container py-5 main" style="margin-bottom:0">
        <h3 class="text-primary mb-3">Lịch đang hẹn</h3>
        <div class="alert" role="alert" style="display: none" id="msg-cancel-appointment">
        </div>
        <div class="table-responsive current">
            <table class="table table-striped table-hover table-borderless table-success align-middle">
                <thead class="">
                    <tr class="color-text">
                        <th scope="col">Mã lịch hẹn</th>
                        <th scope="col">Thời gian đặt</th>
                        <th scope="col">Ngày hẹn</th>
                        <th scope="col">Giờ hẹn</th>
                        <th scope="col">Dịch vụ</th>
                        <th scope="col">Ghi chú</th>
                        <th scope="col">Trạng thái</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="color-text" id="body-table">
                </tbody>
            </table>
        </div>

        <!-- modal -->
        <div class="modal fade" id="myModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="ml-3 mt-2 mb-0">Xác nhận huỷ lịch hẹn</h3>
                    </div>
                    <div class="modal-body">
                        <p class="ml-3 mt-2 mb-0" style="color:black">Bạn chắc chắn muốn huỷ lịch hẹn?</p>
                        <p style="display:none" id="id-appointment"></p>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-info" data-dismiss="modal">Đóng</a>
                        <a class="btn btn-danger" id="confirm-cancel" data-dismiss="modal">Xác nhận</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal -->
    </div>

    <?php include("layout/footer.php") ?>


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <?php include("layout/asset-footer.php") ?>
    <script src="asset/js/customer/customer-current-apm.js?v=<?php echo time() ?>"></script>
</body>

</html>