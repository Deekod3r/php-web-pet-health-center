<!doctype html>
<html lang="en">
<?php $title = "Đánh giá" ?>
<?php include("view/admin/layout/asset-header.php") ?>

<body>
    <?php include("view/admin/layout/header.php") ?>
    <div class="container-fluid main-admin">
        <div class="container">
            <!-- <form action="" style="margin-bottom: 40px" id="form-search-feedback" method="get">
                <div class="row" style="margin-top: 10px">
                    <div class="form-group col-lg-2">
                        <p style="font-weight:bold; margin-bottom:0; color:black">&nbspNhập tên thú cưng:</p>
                        <input type="text" class="form-control border-1" name="feedbackName" id="feedback-name" />
                    </div>
                    <div class="form-group col-lg-2">
                        <p style="font-weight:bold; margin-bottom:0; color:black">&nbspSố điện thoại chủ:</p>
                        <input type="text" class="form-control border-1" name="ctmPhone" id="ctm-phone" />
                    </div>
                    <div class="col-lg-3">
                        <p style="font-weight:bold; margin-bottom:0;color:black">&nbspDanh mục thú cưng:</p>
                        <select name="typefeedback" id="type-feedback" class="custom-select" style="width:250px;">
                            <option value="">Tất cả</option>
                            <option value="0">Mèo</option>
                            <option value="1">Chó</option>
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <p style="font-weight:bold; margin-bottom:0;color:black">&nbspGiới tính:</p>
                        <select name="genderfeedback" id="gender-feedback" class="custom-select" style="width:250px;">
                            <option value="">Tất cả</option>
                            <option value="0">Cái</option>
                            <option value="1">Đực</option>
                        </select>
                    </div>
                </div>
                <div class="mt-2">
                    <input class="btn btn-primary" type="reset">
                    <button class="btn btn-primary" type="submit " id="submit">Tìm kiếm</button>
                </div>
            </form> -->
        </div>
        <div class="container-fluid">
            <div class="alert" role="alert" style="display: none" id="msg-feedback"></div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="col-1" scope="col">#</th>
                        <th class="col-lg-5" scope="col">Nội dung</th>
                        <th class="col-lg-1" scope="col">Đánh giá</th>
                        <th class="col-lg-2" scope="col">Thời gian</th>
                        <th class="col-lg-2" scope="col">Khách hàng</th>
                        <th class="col-lg-1"></th>
                    </tr>
                </thead>
                <tbody id="data-feedback">
                </tbody>
            </table>
        </div>

        <!-- modal -->
        <div class="modal fade" id="myModal1" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="form-edit-feedback" method="post" action="">
                        <div class="modal-header">
                            <h3 class="ml-3 mt-2 mb-0">Sửa feedback</h3>
                        </div>
                        <div class="modal-body row">
                            <div class="alert col-12 " role="alert" style="display: none" id="msg-feedback-edit"></div>
                            <input type="hidden" id="feedback-id-edit">
                            <div class="col-lg-4 mb-3">
                                <p style="font-weight:bold; margin-bottom:0;color:black">Loại</p>
                                <select name="typefeedbackEdit" id="feedback-active" class="custom-select">
                                    <option value="0">Ẩn</option>
                                    <option value="1">Hiển thị</option>
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
    <script src="asset/admin/js/feedback/feedback.js?v=<?php echo time() ?>" async></script>

</body>

</html>