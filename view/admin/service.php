<!doctype html>
<html lang="en">
<?php $title = "Dịch vụ" ?>
<?php include("view/admin/layout/asset-header.php") ?>

<body>
    <?php include("view/admin/layout/header.php") ?>
    <div class="container-fluid main pr-5 pl-5">
        <form action="">
            <div>
                <input type="text">
            </div>
        </form>
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