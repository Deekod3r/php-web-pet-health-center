<!doctype html>
<html lang="en">
<?php $title = "Admin" ?>
<?php include("view/admin/layout/asset-header.php") ?>

<body>
    <?php include("view/admin/layout/header.php") ?>
    <div class="container-fluid main-admin">
        <div class="container">
            <form action="" style="margin-bottom: 40px" id="form-search-admin" method="get">
                <div class="row" style="margin-top: 10px">
                    <div class="form-group col-lg-2">
                        <p style="font-weight:bold; margin-bottom:0; color:black">&nbspTài khoản:</p>
                        <input type="text" class="form-control border-1" name="adminUsername" id="admin-username" />
                    </div>
                    <div class="col-lg-2">
                        <p style="font-weight:bold; margin-bottom:0;color:black">&nbspQuyền:</p>
                        <select name="adminRole" id="admin-role" class="custom-select" >
                            <option value="">Tất cả</option>
                            <option value="1">Quản lý</option>
                            <option value="2">NV Tin tức</option>
                            <option value="3">NV Bán hàng</option>
                        </select>
                    </div>
                    <div class="col-lg-2">
                        <p style="font-weight:bold; margin-bottom:0;color:black">&nbspTrạng thái:</p>
                        <select name="adminStatus" id="admin-status" class="custom-select" >
                            <option value="">Tất cả</option>
                            <option value="0">Khoá</option>
                            <option value="1">Hoạt động</option>
                        </select>
                    </div>
                    <div class="col-lg-4 mt-4">
                        <input class="btn btn-primary" type="reset">
                        <button class="btn btn-primary" type="submit " id="submit">Tìm kiếm</button>
                    </div>
                </div>
                
            </form>
        </div>
        <div class="container">
            <a class='btn btn-primary mb-3' style='color:white' data-toggle='modal' data-target='#myModal'>Thêm admin</a>
            <div class="alert" role="alert" style="display: none" id="msg-admin"></div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="col-lg-1" scope="col">#</th>
                        <th class="col-lg-1" scope="col">Tài khoản</th>
                        <!-- <th class="col-lg-1" scope="col">Mật khẩu</th> -->
                        <th class="col-lg-1" scope="col">Quyền</th>
                        <th class="col-lg-1" scope="col">Trạng thái</th>
                        <th class="col-lg-1"></th>
                    </tr>
                </thead>
                <tbody id="data-admin">
                </tbody>
            </table>
        </div>

        <!-- modal -->
        <div class="modal fade" id="myModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form id="form-add-admin" method="post" action="">
                        <div class="modal-header">
                            <h3 class="ml-3 mt-2 mb-0">Thêm admin</h3>
                        </div>
                        <div class="modal-body row">
                            <div class="alert col-12 " role="alert" style="display: none" id="msg-admin-add"></div>
                            <div class="mb-3 col-4">
                                <label for="" class="form-label" style="font-weight:bold; margin-bottom:0;color:black">Tài khoản</label>
                                <input type="text" class="form-control" id="admin-username-add" name="adminUsernameAdd" >
                            </div>
                            <div class="mb-3 col-4">
                                <label for="" class="form-label" style="font-weight:bold; margin-bottom:0;color:black">Mật khẩu</label>
                                <input type="text" class="form-control" id="admin-password-add" name="adminPasswordAdd" >
                            </div>
                            <div class="col-lg-4 mb-3">
                                <p style="font-weight:bold; margin-bottom:0;color:black">Quyền</p>
                                <select name="adminRoleAdd" id="admin-role-add" class="custom-select" style="width:250px;">
                                    <option value="">Chọn</option>
                                    <option value="1">Quản lý</option>
                                    <option value="2">Nhân viên tin tức</option>
                                    <option value="3">Nhân viên bán hàng</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-danger" data-dismiss="modal" onclick="resetAddForm()">Đóng</a>
                            <button class="btn btn-primary">Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- modal -->

        <!-- modal -->
        <div class="modal fade" id="myModal1" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="form-edit-admin" method="post" action="">
                        <div class="modal-header">
                            <h3 class="ml-3 mt-2 mb-0">Sửa admin</h3>
                        </div>
                        <div class="modal-body row">
                            <div class="alert col-12 " role="alert" style="display: none" id="msg-admin-edit"></div>
                            <input type="hidden" id="admin-id-edit">
                            <div class="col-12">
                                <p style="font-weight:bold; margin-bottom:0;color:black">Trạng thái</p>
                                <select name="adminStatusEdit" id="admin-status-edit" class="custom-select">
                                    <option value="0">Khoá</option>
                                    <option value="1">Hoạt động</option>
                                </select>
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
    <script src="asset/admin/js/admin/admin.js?v=<?php echo time() ?>" async></script>

</body>

</html>