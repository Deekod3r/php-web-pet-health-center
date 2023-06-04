<!doctype html>
<html lang="en">
<?php $title = "Hoá đơn" ?>
<?php include("view/admin/layout/asset-header.php") ?>
<style>
    .scrollbox {
        max-height: 200px;
        overflow-y: scroll;
        background-color: #f6f6f6;

        &::-webkit-scrollbar {
            background-color: transparent;
            width: 8px;
        }
    }

    .scrollbox:hover {
        &::-webkit-scrollbar {
            width: 8px;
        }

        &::-webkit-scrollbar-thumb {
            background-color: rgba(0, 0, 0, .2)
        }
    }

    @media (hover: none) {
        .scrollbox {
            &::-webkit-scrollbar {
                width: 8px;
            }

            &::-webkit-scrollbar-thumb {
                background-color: rgba(0, 0, 0, .2)
            }
        }
    }

    .menu {
        list-type: none;
        margin: 0;
        padding: 0;


    }

    body {
        font-family: sans-serif;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    table td,
    th {
        height: 15px;
        padding: 5px;
        border: 1px solid #ccc;
    }

    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    ::selection {
        color: #fff;
        background: #664AFF;
    }

    .wrapper {
        max-width: 450px;
        margin: 150px auto;
    }

    .wrapper .search-input {
        background: #fff;
        width: 100%;
        border-radius: 5px;
        position: relative;
        box-shadow: 0px 1px 5px 3px rgba(0, 0, 0, 0.12);
    }

    .search-input input {
        height: 55px;
        width: 100%;
        outline: none;
        border: none;
        border-radius: 5px;
        padding: 0 60px 0 20px;
        font-size: 18px;
        box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.1);
    }

    .search-input.active input {
        border-radius: 5px 5px 0 0;
    }

    .search-input .autocom-box {
        padding: 0;
        opacity: 0;
        pointer-events: none;
        max-height: 280px;
        overflow-y: auto;
    }

    .search-input.active .autocom-box {
        padding: 10px 8px;
        opacity: 1;
        pointer-events: auto;
    }

    .autocom-box li {
        list-style: none;
        padding: 8px 12px;
        /* display: none; */
        width: 100%;
        cursor: pointer;
        border-radius: 3px;
    }

    .search-input.active .autocom-box li {
        display: block;
    }

    .autocom-box li:hover {
        background: #efefef;
    }

    .search-input .icon {
        position: absolute;
        right: 0px;
        top: 0px;
        height: 55px;
        width: 55px;
        text-align: center;
        line-height: 55px;
        font-size: 20px;
        color: #644bff;
        cursor: pointer;
    }

    .wrapper {
        /* height: 120px; */
        /* min-width: 380px; */
        display: flex;
        /* align-items: center; */
        /* justify-content: center; */
        background: #FFF;
        border-radius: 5px;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        cursor: pointer;
    }

    .wrapper span {
        width: 100%;
        text-align: center;
        font-size: 18;
        font-weight: 600;
    }

    .wrapper span.num {
        font-size: 18px;
        border-right: 2px solid rgba(0, 0, 0, .2);
        border-left: 2px solid rgba(0, 0, 0, .2);
        pointer-events: none;
    }


    .wrapper span.minus {
        user-select: none;
    }

    .wrapper span.minus:active {
        color: darkblue;
    }


    .wrapper span.plus {
        user-select: none;
    }

    .wrapper span.plus:active {
        color: darkblue;
    }
</style>

<body>
    <?php include("view/admin/layout/header.php") ?>
    <div class="container-fluid main-admin">
        <main>
            <div class="text-center">
                <h2>Hoá đơn dịch vụ</h2>
                <p class="lead">Power by CarePET</p>
            </div>

            <div class="row g-5">
                <div class="col-md-5 col-lg-4 order-md-last">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-primary">Giá trị</span>
                    </h4>
                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h5 class="my-0">Tạm tính</h5>
                            </div>
                            <strong id="sub-total"></strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between bg-light">
                            <div class="text-success">
                                <h6 class="my-0">Giảm giá</h6>
                                <small id="dc-code"></small>
                            </div>
                            <span class="text-success" id="value-discount"></span>                        
                       </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <h5>Tổng tiền</h5>
                            <strong id="total-value"></strong>
                        </li>
                    </ul>

                    <form class="card p-2" id="execute-discount">
                        <div class="input-group">
                            <input type="text" class="form-control hidden" placeholder="Mã giảm giá" id="discount-code">
                            <button type="submit" class="btn btn-secondary hidden" style="color:white">Áp dụng</button>
                        </div>
                        <div class="alert mt-3 mb-0" id="alert-bill" style="display:none">
                        </div>
                    </form>
                </div>
                <div class="col-md-7 col-lg-8 mb-3">
                    <h4 class="mb-3">Thông tin</h4>
                    <div>
                        <div class="row g-3">
                            <input type="hidden" id="ctm-id">

                            <div class="col-lg-2">
                                <label for="ctm-phone" class="form-label">Mã hoá đơn</label>
                                <input type="text" class="form-control" id="bill-id" readonly>
                            </div>

                            <div class="col-lg-2">
                                <label for="ctm-name" class="form-label">Họ và tên</label>
                                <input type="text" class="form-control" id="ctm-name" readonly>
                            </div>

                            <div class="col-lg-2">
                                <label for="ctm-phone" class="form-label">Số điện thoại</label>
                                <input type="text" class="form-control" id="ctm-phone" readonly>
                            </div>

                            <div class="col-lg-3">
                                <label for="ctm-phone" class="form-label">Ngày tạo</label>
                                <input type="text" class="form-control" id="bill-date" readonly>
                            </div>

                            <div class="col-lg-3">
                                <label for="ctm-phone" class="form-label">Trạng thái</label>
                                <input type="text" class="form-control" id="bill-status" readonly>
                            </div>
                        </div>
                        <hr class="my-4">
                        <form action="" class="hidden">
                            <h4 class="mb-3">Dịch vụ</h4>
                            <div class="col-sm-12">
                                <label for="ctm-phone" class="form-label hidden">Tìm kiếm</label>
                                <input type="text" class="form-control hidden" id="service-name">
                            </div>
                            <div class="autocom-box scrollbox pl-3 pr-3 pt-1" style="background-color: white;">
                            </div>
                        </form>
                        <hr class="my-4">
                        <h4 class="mb-3">Chi tiết hoá đơn</h4>
                        <div>
                            <table>
                                <thead>
                                    <tr>
                                        <th style="width:8%">Mã dịch vụ</th>
                                        <th style="width:30%">Tên dịch vụ</th>
                                        <th style="width:8%">Thú cưng</th>
                                        <th style="width:12.5%">Đơn giá</th>
                                        <th style="width:24.85%">Số lượng</th>
                                        <th style="width:11.8%">Thành tiền</th>
                                        <th></th>
                                    </tr>
                                </thead>
                            </table>
                            <div class="scrollbox w-100 ">
                                <table id="list-service">
                                
                                </table>
                            </div>
                        </div>
                        <hr class="my-4">

                        <button class="w-25 btn btn-primary hidden" type="button" id="save">Lưu</button>
                        <button class="w-25 btn btn-primary hidden" type="button" id="pay">Thanh toán</button>
                    </div>
                </div>
        </main>
    </div>
    <?php include("view/admin/layout/asset-footer.php") ?>
    <script src="asset/admin/js/bill/bill-edit.js?v=<?php echo time() ?>"></script>
</body>

</html>