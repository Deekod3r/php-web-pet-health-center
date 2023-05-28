<!doctype html>
<html lang="en">
<?php $title = "Tin tức" ?>
<?php include "view/admin/layout/asset-header.php" ?>

<body>
    <?php include "view/admin/layout/header.php" ?>
    <div class="container-fluid main-admin">
        <div class="container-fluid">
            <form action="" style="margin-bottom: 40px" id="form-search-news" method="get">
                <div class="row" style="margin-top: 10px">
                    <div class="col-2"></div>
                    <div class="form-group col-lg-2">
                        <p style="font-weight:bold; margin-bottom:0; color:black">&nbspNội dung tin tức:</p>
                        <input type="text" class="form-control border-1" placeholder="VD: Tiêm phòng" name="newsKey" id="news-key" />
                    </div>
                    <div class="col-lg-2">
                        <p style="font-weight:bold; margin-bottom:0; color:black">&nbspDanh mục:</p>
                        <select name="categoryNews" id="category-news" class="custom-select">
                        </select>
                    </div>
                    <div class="col-lg-1">
                        <p style="font-weight:bold; margin-bottom:0; color:black">&nbspTin tức tháng:</p>
                        <input type="number" class="form-control border-1" name="newsMonth" id="month-news" min=1 max=12 />
                    </div>
                    <div class="col-lg-1">
                        <p style="font-weight:bold; margin-bottom:0; color:black">&nbspTin tức năm:</p>
                        <input type="number" class="form-control border-1" name="newsYear" id="year-news" min=0 max=2300 />
                    </div>
                    <div class="col-lg-2">
                        <p style="font-weight:bold;color:black" class="mb-0">&nbspTrạng thái:</p>
                        <select name="newsStatus" id="news-status" class="custom-select">
                            <option value="">Tất cả</option>
                            <option value="1">Công khai</option>
                            <option value="0">Ẩn</option>
                        </select>
                    </div>
                    <div class="col-2"></div>
                </div>
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-4">
                        <input class="btn btn-primary mr-1" type="reset">
                        <button class="btn btn-primary" type="submit " id="submit">Tìm kiếm</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="container-fluid">
            <a href="?controller=news&action=news_add_page" class='btn btn-primary mb-3' style='color:white'>Thêm tin tức</a>
            <button class='btn btn-secondary mb-3' style='color:white' data-toggle='modal' data-target='#myModal2'>Danh sách nhóm tin tức</button>
            <div class="alert" role="alert" style="display: none" id="msg-news"></div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="col-lg-1" scope="col">#</th>
                        <th class="col-lg-1" scope="col">Hình ảnh</th>
                        <th class="col-lg-4" scope="col">Tiêu đề</th>
                        <th class="col-lg-2" scope="col">Ngày đăng</th>
                        <th class="col-lg-1" scope="col">Danh mục</th>
                        <th class="col-lg-1" scope="col">Admin</th>
                        <th class="col-lg-1" scope="col">Trạng thái</th>
                        <th class="col-lg-1"></th>
                    </tr>
                </thead>
                <tbody id="data-news">
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
                        <h3 class="ml-3 mt-2 mb-0">Xác nhận xoá Tin tức</h3>
                    </div>
                    <div class="modal-body">
                        <p class="ml-3 mt-2 mb-0" style="color:black">Bạn chắc chắn muốn xoá Tin tức?</p>
                        <p style="display:none" id="id-news"></p>
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
                        <h3 class="ml-3 mt-2 mb-0">Danh sách nhóm Tin tức</h3>
                    </div>
                    <div class="modal-body">
                        <button class='btn btn-info mb-3' style='color:white' data-toggle='modal' data-target='#myModal1'>Thêm nhóm tin tức</button>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tên nhóm tin tức</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="data-cn">
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
                    <form id="form-add-cn" method="post">
                        <div class="modal-header">
                            <h3 class="ml-3 mt-2 mb-0">Thêm nhóm Tin tức</h3>
                        </div>
                        <div class="modal-body">
                            <div class="alert" role="alert" style="display: none" id="msg-cn"></div>
                            <div class="mb-3">
                                <label for="" class="form-label">Tên nhóm Tin tức</label>
                                <input type="text" class="form-control" id="cn-name">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-danger" data-dismiss="modal">Đóng</a>
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
                <form id="form-edit-cn">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="ml-3 mt-2 mb-0">Sửa nhóm Tin tức</h3>
                        </div>
                        <div class="modal-body">
                            <div class="alert" role="alert" style="display: none" id="msg-cn-edit"></div>
                            <div class="mb-3">
                                <label for="" class="form-label">Tên nhóm Tin tức</label>
                                <input type="hidden" id="cn-id-edit">
                                <input type="text" class="form-control" id="cn-name-edit">
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
    <script src="asset/admin/js/news/news.js?v=<?php echo time() ?>" async></script>
</body>

</html>