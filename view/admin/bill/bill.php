<!doctype html>
<html lang="en">
<?php $title = "Hoá đơn" ?>
<?php include("view/admin/layout/asset-header.php") ?>

<body>
    <?php include("view/admin/layout/header.php") ?>
    <div class="container-fluid main-admin">
        <div class="container">
            <form action="" style="margin-bottom: 40px" id="form-search-bill" method="get">
                <div class="row" style="margin-top: 10px">
                    <div class="form-group col-lg-2">
                        <p style="font-weight:bold; margin-bottom:0; color:black">&nbspNhập mã hoá đơn:</p>
                        <input type="text" class="form-control border-1" name="billId" id="bill-id" />
                    </div>
                    <div class="form-group col-lg-2">
                        <p style="font-weight:bold; margin-bottom:0; color:black">&nbspSố điện thoại khách:</p>
                        <input type="text" class="form-control border-1" name="ctmPhone" id="ctm-phone" />
                    </div>
                    <div class="form-group col-lg-2">
                        <p style="font-weight:bold; margin-bottom:0; color:black">&nbspNgày:</p>
                        <input type="date" class="form-control border-1" name="billDate" id="date-bill"/>
                    </div>
                    <div class="col-lg-2">
                        <p style="font-weight:bold; margin-bottom:0; color:black">&nbspTháng:</p>
                        <input type="number" class="form-control border-1" name="billMonth" id="month-bill" min=1 max=12 />
                    </div>
                    <div class="col-lg-2">
                        <p style="font-weight:bold; margin-bottom:0; color:black">&nbspNăm:</p>
                        <input type="number" class="form-control border-1" name="billYear" id="year-bill" min=0 max=2300 />
                    </div>
                    <div class="col-lg-2">
                        <p style="font-weight:bold; margin-bottom:0;color:black">&nbspTrạng thái:</p>
                        <select name="billStatus" id="bill-status" class="custom-select">
                            <option value="">Tất cả</option>
                            <option value="0">Chưa thanh toán</option>
                            <option value="1">Đã thanh toán</option>
                        </select>
                    </div>
                </div>
                <div class="mt-2">
                    <input class="btn btn-primary" type="reset">
                    <button class="btn btn-primary" type="submit " id="submit">Tìm kiếm</button>
                </div>
            </form>
        </div>
        <div class="container-fluid">
            <a class='btn btn-primary mb-3' style='color:white' data-toggle='modal' data-target='#myModal1'>Thêm hoá đơn</a>
            <div class="alert" role="alert" style="display: none" id="msg-bill"></div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="col-0" scope="col">#</th>
                        <th class="col-lg-2" scope="col">Ngày tạo</th>
                        <th class="col-lg-1" scope="col">Người tạo</th>
                        <th class="col-lg-2" scope="col">Khách hàng</th>
                        <th class="col-lg-1" scope="col">Mã giảm giá</th>
                        <th class="col-lg-2" scope="col">Tạm tính</th>
                        <th class="col-lg-1" scope="col">Giảm giá</th>
                        <th class="col-lg-2" scope="col">Tổng tiền</th>
                        <th class="col-lg-1" scope="col">Trạng thái</th>
                        <th class="col-lg-0"></th>
                    </tr>
                </thead>
                <tbody id="data-bill">
                </tbody>
            </table>
        </div>

        <!-- modal -->
        <div class="modal fade" id="myModal1" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="form-add-bill" method="post" action="">
                        <div class="modal-header">
                            <h3 class="ml-3 mt-2 mb-0">Thêm hoá đơn</h3>
                        </div>
                        <div class="modal-body row">
                            <div class="alert col-12 " role="alert" style="display: none" id="msg-bill-add"></div>
                            <div class="mb-3 col-12">
                                <label for="" class="form-label" style="font-weight:bold; margin-bottom:0;color:black">Số điện thoại khách hàng</label>
                                <input type="text" class="form-control" id="ctm-phone-add">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-danger" data-dismiss="modal" onclick="reseteditForm()">Đóng</a>
                            <button class="btn btn-primary">Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- modal -->

        <div class="row" id="page">
        </div>
    </div>
    <?php include("view/admin/layout/asset-footer.php") ?>
    <script src="asset/admin/js/bill/bill.js?v=<?php echo time() ?>" async></script>

</body>

</html>