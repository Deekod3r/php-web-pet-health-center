<!doctype html>
<html lang="en">
<?php $title = "Dịch vụ" ?>
<?php include("view/admin/layout/asset-header.php") ?>

<body>
    <?php include("view/admin/layout/header.php") ?>
    <div class="container-fluid main-admin pr-5 pl-5">
        <div class="container">
            <form action="" style="margin-bottom: 40px" id="form-search-service" method="get">
                <div class="row" style="margin-top: 10px">
                    <div class="form-group col-lg-4">
                        <p style="font-weight:bold; margin-bottom:0; color:black">&nbspNhập tên dịch vụ:</p>
                        <input type="text" class="form-control border-1" placeholder="VD: Tiêm phòng" name="svName" id="service-name" />
                    </div>
                    <div class="col-lg-3">
                        <p style="font-weight:bold; margin-bottom:0; color:black" class="w-100">&nbspDanh mục dịch vụ:</p>
                        <select name="categoryService" id="category-service" class="custom-select" style="width:250px;">
                            <option value="">Tất cả</option>
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <p style="font-weight:bold; margin-bottom:0;color:black">&nbspDanh mục thú cưng:</p>
                        <select name="typePet" id="type-pet" class="custom-select" style="width:250px;">
                            <option value="">Tất cả</option>
                            <option value="0">Mèo</option>
                            <option value="1">Chó</option>
                        </select>
                    </div>
                </div>
                <div style="margin-top:10px; width: 250px;">
                    <button class="btn btn-lg btn-primary btn-block border-0" type="submit">Tìm kiếm</button>
                </div>
            </form>
        </div>
        <a href="#" class="btn btn-primary mb-3 mt-3">Thêm dịch vụ</a>
        <div class="alert" role="alert" style="display: none" id="msg-delete-service">
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="col-lg-1" scope="col">#</th>
                    <th class="col-lg-1" scope="col">Hình ảnh</th>
                    <th class="col-lg-4" scope="col">Tên dịch vụ</th>
                    <th class="col-lg-2" scope="col">Giá</th>
                    <th class="col-lg-1" scope="col">Phân loại</th>
                    <th class="col-lg-1" scope="col">Danh mục</th>
                    <th class="col-lg-1" scope="col">Trạng thái</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="data-service">
            </tbody>
        </table>
        <div class="row" id="page">
        </div>

        <!-- modal -->
        <div class="modal fade" id="myModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="ml-3 mt-2 mb-0">Xác nhận xoá dịch vụ</h3>
                    </div>
                    <div class="modal-body">
                        <p class="ml-3 mt-2 mb-0" style="color:black">Bạn chắc chắn muốn xoá dịch vụ?</p>
                        <p style="display:none" id="id-service"></p>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-info" data-dismiss="modal">Đóng</a>
                        <a class="btn btn-danger" id="confirm-delete" data-dismiss="modal">Xác nhận</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal -->
    </div>
    <?php include("view/admin/layout/asset-footer.php") ?>
    <script src="asset/admin/js/service.js?v=<?php echo time() ?>" async></script>
</body>

</html>