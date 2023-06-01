<!doctype html>
<html lang="en">
<?php $title = "Dịch vụ" ?>
<?php include "view/admin/layout/asset-header.php" ?>

<body>
    <?php include "view/admin/layout/header.php" ?>
    <div class="container-fluid main-admin">
        <div class="container-fluid">
            <form action="" style="margin-bottom: 40px" id="form-search-service" method="get">
                <div class="row" style="margin-top: 10px">
                    <div class="col-1"></div>
                    <div class="form-group col-lg-2">
                        <p style="font-weight:bold; margin-bottom:0; color:black">&nbspTên dịch vụ:</p>
                        <input type="text" class="form-control border-1" placeholder="VD: Tiêm phòng" name="svName" id="service-name" />
                    </div>
                    <div class="col-lg-2">
                        <p style="font-weight:bold; margin-bottom:0; color:black">&nbspDanh mục:</p>
                        <select name="categoryService" id="category-service" class="custom-select">
                        </select>
                    </div>
                    <div class="col-lg-1">
                        <p style="font-weight:bold; margin-bottom:0;color:black">&nbspThú cưng:</p>
                        <select name="typePet" id="type-pet" class="custom-select">
                            <option value="">Tất cả</option>
                            <option value="0">Mèo</option>
                            <option value="1">Chó</option>
                            <option value="2">Chó và mèo</option>
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <label for="" style="font-weight:bold; color:black; display: block" class="mb-0">&nbspGiá tiền:</label>
                        <input type="number" class="form-control border-1" placeholder="" name="priceStart" id="price-start" min=0 style="width:40%; display: inline"/>
                        <span>&nbspđến&nbsp</span>
                        <input type="number" class="form-control border-1" placeholder="" name="priceEnd" id="price-end" min=0 style="width:40%; display: inline"/>
                    </div>
                    <div class="col-lg-1">
                        <p style="font-weight:bold;color:black" class="mb-0">&nbspTrạng thái:</p>
                        <select name="svStatus" id="sv-status" class="custom-select">
                            <option value="">Tất cả</option>
                            <option value="1">Hoạt động</option>
                            <option value="0">Tạm dừng</option>
                        </select>
                    </div>
                    <div class="col-1"></div>
                </div>
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-4">
                        <input class="btn btn-primary mr-1" type="reset">
                        <button class="btn btn-primary" type="submit " id="submit">Tìm kiếm</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="container-fluid">
            <a href="?controller=service&action=service_add_page" class='btn btn-primary mb-3' style='color:white'>Thêm dịch vụ</a>
            <button class='btn btn-secondary mb-3' style='color:white' data-toggle='modal' data-target='#myModal2'>Danh sách nhóm dịch vụ</button>
            <div class="alert" role="alert" style="display: none" id="msg-service"></div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="col-lg-0" scope="col">#</th>
                        <th class="col-lg-1" scope="col">Hình ảnh</th>
                        <th class="col-lg-2" scope="col">Tên dịch vụ</th>
                        <th class="col-lg-4" scope="col">Mô tả</th>
                        <th class="col-lg-1" scope="col">Giá</th>
                        <th class="col-lg-1" scope="col">Phân loại</th>
                        <th class="col-lg-1" scope="col">Danh mục</th>
                        <th class="col-lg-1" scope="col">Trạng thái</th>
                        <th class="col-lg-1"></th>
                    </tr>
                </thead>
                <tbody id="data-service">
                </tbody>
            </table>
        </div>

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


        <!-- modal2 -->
        <div class="modal fade" id="myModal2" tabindex="-1" aria-hidden="true" style="margin-left: -15%">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="ml-3 mt-2 mb-0">Danh sách nhóm dịch vụ</h3>
                    </div>
                    <div class="modal-body">
                        <button class='btn btn-info mb-3' style='color:white' data-toggle='modal' data-target='#myModal1'>Thêm nhóm dịch vụ</button>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tên nhóm dịch vụ</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="data-cs">
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-danger" data-dismiss="modal">Đóng</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal2 -->

        <!-- modal1 -->
        <div class="modal fade" id="myModal1" tabindex="-1" aria-hidden="true" style="margin-left: 15%">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="form-add-cs" method="post">
                        <div class="modal-header">
                            <h3 class="ml-3 mt-2 mb-0">Thêm nhóm dịch vụ</h3>
                        </div>
                        <div class="modal-body">
                            <div class="alert" role="alert" style="display: none" id="msg-cs"></div>
                            <div class="mb-3">
                                <label for="" class="form-label">Tên nhóm dịch vụ</label>
                                <input type="text" class="form-control" id="cs-name">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-danger" data-dismiss="modal" onclick="$('#form-add-cs')[0].reset()">Đóng</a>
                            <button class="btn btn-primary">Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- modal1 -->

        <!-- modal3 -->
        <div class="modal fade" id="myModal3" tabindex="-1" aria-hidden="true" style="margin-left: 15%">
            <div class="modal-dialog">
                <form id="form-edit-cs">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="ml-3 mt-2 mb-0">Sửa nhóm dịch vụ</h3>
                        </div>
                        <div class="modal-body">
                            <div class="alert" role="alert" style="display: none" id="msg-cs-edit"></div>
                            <div class="mb-3">
                                <label for="" class="form-label">Tên nhóm dịch vụ</label>
                                <input type="hidden" id="cs-id-edit">
                                <input type="text" class="form-control" id="cs-name-edit">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-danger" data-dismiss="modal">Đóng</a>
                            <button class="btn btn-primary">Lưu</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- modal3 -->

    </div>
    <?php include "view/admin/layout/asset-footer.php" ?>
    <script src="asset/admin/js/service/service.js?v=<?php echo time() ?>" async></script>
</body>

</html>