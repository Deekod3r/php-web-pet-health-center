<!doctype html>
<html lang="en">
<?php $title = "Đánh giá" ?>
<?php include("view/admin/layout/asset-header.php") ?>
<style type="text/css">
    .heading {
        font-size: 25px;
        margin-right: 25px;
    }

    .fa {
        font-size: 25px;
    }

    .checked {
        color: orange;
    }

    /* Three column layout */
    .side {
        float: left;
        width: 15%;
        margin-top: 10px;
    }

    .middle {
        margin-top: 10px;
        float: left;
        width: 70%;
    }

    /* Place text to the right */
    .right {
        text-align: right;
    }

    /* Clear floats after the columns */
    .row:after {
        content: "";
        display: table;
        clear: both;
    }

    /* The bar container */
    .bar-container {
        width: 100%;
        background-color: #f1f1f1;
        text-align: center;
        color: white;
    }

    /* Individual bars */
    .bar-r5 {
        width: 60%;
        height: 18px;
        background-color: #04AA6D;
    }

    .bar-r4 {
        width: 30%;
        height: 18px;
        background-color: #2196F3;
    }

    .bar-r3 {
        width: 10%;
        height: 18px;
        background-color: #00bcd4;
    }

    .bar-r2 {
        width: 4%;
        height: 18px;
        background-color: #ff9800;
    }

    .bar-r1 {
        width: 15%;
        height: 18px;
        background-color: #f44336;
    }
</style>
<body>
    <?php include("view/admin/layout/header.php") ?>
    <div class="container-fluid main-admin">
        <div class="container m-auto">
        <h3 class="mb-3" id="countFeedback"></h3>
        <h5 class="mb-3" onclick="searchFeedback(0)" style="cursor:pointer">Tất cả</h5>
        <div class="row m-3 mb-5">
            <a class="side" onclick="searchFeedback(5)" style="cursor:pointer">
                <div>5 <i class="fa-solid fa-star"></i></div>
            </a>
            <div class="middle">
                <div class="bar-container">
                    <div class="bar-r5"></div>
                </div>
            </div>
            <div class="side right">
                <div id="c-r5"></div>
            </div>
            <a class="side" onclick="searchFeedback(4)" style="cursor:pointer">
                <div>4 <i class="fa-solid fa-star"></i></div>
            </a>
            <div class="middle">
                <div class="bar-container">
                    <div class="bar-r4"></div>
                </div>
            </div>
            <div class="side right">
                <div id="c-r4"></div>
            </div>
            <a class="side" onclick="searchFeedback(3)" style="cursor:pointer">
                <div>3 <i class="fa-solid fa-star"></i></div>
            </a>
            <div class="middle">
                <div class="bar-container">
                    <div class="bar-r3"></div>
                </div>
            </div>
            <div class="side right">
                <div id="c-r3"></div>
            </div>
            <a class="side" onclick="searchFeedback(2)" style="cursor:pointer">
                <div>2 <i class="fa-solid fa-star"></i></div>
            </a>
            <div class="middle">
                <div class="bar-container">
                    <div class="bar-r2"></div>
                </div>
            </div>
            <div class="side right">
                <div id="c-r2"></div>
            </div>
            <a class="side" onclick="searchFeedback(1)" style="cursor:pointer">
                <div>1 <i class="fa-solid fa-star"></i></div>
            </a>
            <div class="middle">
                <div class="bar-container">
                    <div class="bar-r1"></div>
                </div>
            </div>
            <div class="side right">
                <div id="c-r1"></div>
            </div>
        </div>
        </div>
        <div class="container-fluid">
            <div class="search" role="search" style="display: none" id="msg-feedback"></div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="col-0" scope="col">#</th>
                        <th class="col-lg-4" scope="col">Nội dung</th>
                        <th class="col-lg-1" scope="col">Đánh giá</th>
                        <th class="col-lg-2" scope="col">Thời gian</th>
                        <th class="col-lg-2" scope="col">Khách hàng</th>
                        <th class="col-lg-2" scope="col">Trạng thái</th>
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
                            <div class="search col-12 " role="search" style="display: none" id="msg-feedback-edit"></div>
                            <input type="hidden" id="feedback-id-edit">
                            <div class="col-lg-4 mb-3">
                                <p style="font-weight:bold; margin-bottom:0;color:black">Loại</p>
                                <select name="feedbackActive" id="feedback-active" class="custom-select">
                                    <option value="0">Ẩn</option>
                                    <option value="1">Hiển thị</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-danger" data-dismiss="modal" onclick="resetEditForm()">Đóng</a>
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