<!doctype html>
<html lang="en">
<?php $title = "Khách hàng" ?>
<?php include("view/admin/layout/asset-header.php") ?>

<body>
    <?php include("view/admin/layout/header.php") ?>
    <div class="container-fluid main">
        <div class="container">
            <form action="" style="margin-bottom: 40px" id="form-search-customer" method="get">
                <div class="row" style="margin-top: 10px">
                    <div class="form-group col-lg-4">
                        <p style="font-weight:bold; margin-bottom:0; color:black">&nbspNhập tên khách hàng:</p>
                        <input type="text" class="form-control border-1" name="ctmName" id="customer-name" />
                    </div>
                    <div class="form-group col-lg-4">
                        <p style="font-weight:bold; margin-bottom:0; color:black">&nbspNhập địa chỉ:</p>
                        <input type="text" class="form-control border-1" name="ctmAddress" id="customer-address" />
                    </div>
                    <div class="form-group col-lg-4">
                        <p style="font-weight:bold; margin-bottom:0; color:black">&nbspNhập số điện thoại:</p>
                        <input type="text" class="form-control border-1" name="ctmPhone" id="customer-phone" />
                    </div>
                </div>
                <div>
                    <input class="btn btn-primary" type="reset">
                    <button class="btn btn-primary" type="submit " id="submit">Tìm kiếm</button>
                </div>
            </form>
        </div>
        <div class="container-fluid">
            <a class='btn btn-primary mb-3' style='color:white' data-toggle='modal' data-target='#myModal'>Thêm khách hàng</a>
            <div class="alert" role="alert" style="display: none" id="msg-service"></div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="col-lg-0" scope="col">#</th>
                        <th class="col-lg-3" scope="col">Tên KH</th>
                        <th class="col-lg-4" scope="col">Địa chỉ</th>
                        <th class="col-lg-2" scope="col">Số điện thoại</th>
                        <th class="col-lg-1" scope="col">Giới tính</th>
                        <th class="col-lg-1" scope="col">Phản hồi</th>
                        <th class="col-lg-1" scope="col">Trạng thái</th>
                        <!-- <th class="col-lg-1"></th> -->
                    </tr>
                </thead>
                <tbody id="data-customer">
                </tbody>
            </table>
        </div>

        <!-- modal -->
        <div class="modal fade" id="myModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="form-add-customer" method="post" action="">
                        <div class="modal-header">
                            <h3 class="ml-3 mt-2 mb-0">Thêm khách hàng</h3>
                        </div>
                        <div class="modal-body">
                            <div class="alert" role="alert" style="display: none" id="msg-ctm"></div>
                            <div class="mb-3">
                                <label for="" class="form-label">Họ và tên</label>
                                <input type="text" class="form-control" id="ctm-name">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Số điện thoại</label>
                                <input type="text" class="form-control" id="ctm-phone">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Địa chỉ</label>
                                <input type="text" class="form-control" id="ctm-address">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-danger" data-dismiss="modal" onclick="resetAddForm()">Đóng</a>
                            <button class="btn btn-primary" >Lưu</button>
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
    <script src="asset/admin/js/customer.js?v=<?php echo time() ?>" async></script>

</body>

</html>