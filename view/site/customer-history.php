<!DOCTYPE html>
<html lang="en">
<?php $title = "Lịch sử dịch vụ"; ?>
<?php include("layout/asset-header.php"); ?>

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

        <!-- modal -->
        <div class="modal fade" id="myModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="ml-3 mt-2 mb-0 ">Chi tiết hoá đơn: <span class="bill-id"></span></h3>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="table-responsive">
                                <table class="table table-primary table-striped table-hover table-borderless align-middle">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="color:black">Mã thú cưng</th>
                                            <th scope="col" style="color:black">Tên thú cưng</th>
                                            <th scope="col" style="color:black">Mã dịch vụ</th>
                                            <th scope="col" style="color:black">Tên dịch vụ</th>
                                            <th scope="col" style="color:black">Đơn giá</th>
                                            <th scope="col" style="color:black">Số lượng</th>
                                            <th scope="col" style="color:black">Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody id="detail-body">                                      
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td style="color:black"><b>Tạm tính:</b></td>
                                            <td style="color:black" id='sub-total'></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-primary" data-dismiss="modal">Đóng</a>
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
    <script src="asset/js/customer/customer-history.js?v=<?php echo time() ?>"></script>
</body>

</html>