<!doctype html>
<html lang="en">
<?php $title = "Lịch hẹn" ?>
<?php include("view/admin/layout/asset-header.php") ?>

<body>
    <?php include("view/admin/layout/header.php") ?>
    <div class="container-fluid main-admin">
        <div class="container-fluid">
            <form action="" style="margin-bottom: 40px" id="form-search-appointment" method="get">
                <div class="row" style="margin-top: 10px">
                    <div class="form-group col-lg-2"></div>
                    <div class="form-group col-lg-2">
                        <p style="font-weight:bold; margin-bottom:0; color:black">&nbspSố điện thoại khách:</p>
                        <input type="text" class="form-control border-1" name="ctmPhone" id="phone-ctm" />
                    </div>
                    <div class="form-group col-lg-2">
                        <p style="font-weight:bold; margin-bottom:0; color:black">&nbspNgày hẹn:</p>
                        <input type="date" class="form-control border-1" name="apmDate" id="date-apm"/>
                    </div>
                    <div class="col-lg-1">
                        <p style="font-weight:bold; margin-bottom:0; color:black">&nbspLịch hẹn tháng:</p>
                        <input type="number" class="form-control border-1" name="apmMonth" id="month-apm" min=1 max=12 />
                    </div>
                    <div class="col-lg-1">
                        <p style="font-weight:bold; margin-bottom:0; color:black">&nbspLịch hẹn năm:</p>
                        <input type="number" class="form-control border-1" name="apmYear" id="year-apm" min=0 max=2300 />
                    </div>
                    <div class="form-group col-lg-2">
                        <p style="font-weight:bold; margin-bottom:0;color:black">&nbspTrạng thái:</p>
                        <select name="apmStatus" id="apm-status" class="custom-select mt-0 mb-0">
                            <option value="">...</option>
                            <option value="0">Huỷ</option>
                            <option value="1">Hoàn thành</option>
                            <option value="2">Đã xác nhận</option>
                            <option value="3">Chưa xác nhận</option>
                        </select>
                    </div>
                    <div class="form-group col-lg-2"></div>
                    <div class="form-group col-lg-2"></div>
                    <div class="col-lg-3">
                        <input class="btn btn-primary" type="reset">
                        <button class="btn btn-primary" type="submit " id="submit">Tìm kiếm</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="container-fluid">
            <a class='btn btn-primary mb-3' style='color:white' data-toggle='modal' data-target='#myModal'>Thêm lịch hẹn</a>
            <div class="alert" role="alert" style="display: none" id="msg-service"></div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="col-lg-0" scope="col">#</th>
                        <th class="col-lg-2" scope="col">Thời gian đặt</th>
                        <th class="col-lg-1" scope="col">Ngày hẹn</th>
                        <th class="col-lg-0" scope="col">Giờ hẹn</th>
                        <th class="col-lg-1" scope="col">Dịch vụ</th>
                        <th class="col-lg-2" scope="col">Khách hàng</th>
                        <th class="col-lg-2" scope="col">Ghi chú</th>
                        <th class="col-lg-1" scope="col">Trạng thái</th>
                        <th class="col-lg-1" scope="col">Huỷ</th>
                        <th class="col-lg-0"></th>
                    </tr>
                </thead>
                <tbody id="data-appointment">
                </tbody>
            </table>
        </div>

        <!-- modal -->
        <div class="modal fade" id="myModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form id="form-add-appointment" method="post" action="">
                        <div class="modal-header">
                            <h3 class="ml-3 mt-2 mb-0">Thêm lịch hẹn</h3>
                        </div>
                        <div class="modal-body row">
                            <div class="alert col-12 " role="alert" style="display: none" id="msg-appointment"></div>
                            <div class="form-group col-6">
                                <p style="margin-bottom:0; color:black; margin-top:0; font-size:18px; font-weight:bold">Ngày</p>
                                <div class="date" id="date" data-target-input="nearest">
                                    <input type="date" class="form-control p-4 " name="apmDate" id="apm-date" placeholder="" />
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <p style="margin-bottom:0; color:black; margin-top:0; font-size:18px; font-weight:bold">Giờ</p>
                                <div class="time" id="time" data-target-input="nearest">
                                    <input type="time" class="form-control p-4 " name="apmTime" id="apm-time" placeholder="" />
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <p style="margin-bottom:0; color:black; margin-top:0; font-size:18px; font-weight:bold">Số điện thoại</p>
                                <div class="time" id="time" data-target-input="nearest">
                                    <input type="text" class="form-control p-4 " name="ctmPhone" id="ctm-phone" placeholder="" />
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <p style="margin-bottom:0; color:black; margin-top:0; font-size:18px; font-weight:bold">Dịch vụ</p>
                                <select class="custom-select px-4" style="height: 47px;" name="categoryService" id="category-service">
                                    <option value="">...</option>
                                </select>
                            </div>
                            <div class="form-group col-12">
                                <p style="margin-bottom:0; color:black; margin-top:0; font-size:18px; font-weight:bold">Ghi chú</p>
                                <input type="text" class="form-control p-4" placeholder="" name="apmNote" id="apm-note" />
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
                    <form id="form-edit-appointment" method="post" action="">
                        <div class="modal-header">
                            <h3 class="ml-3 mt-2 mb-0">Sửa giảm giá</h3>
                        </div>
                        <div class="modal-body">
                            <div class="alert col-12 " role="alert" style="display: none" id="msg-appointment-edit"></div>
                            <input type="hidden" id="appointment-id-edit" name="appointmentIdEdit">
                            <div class="mb-3">
                                <p style="font-weight:bold; margin-bottom:0;color:black">Trạng thái</p>
                                <select name="appointmentStatusEdit" id="appointment-status-edit" class="custom-select" style="width:250px;">
                                    <option value="0">Huỷ</option>
                                    <option value="1">Hoàn thành</option>
                                    <option value="2">Đã xác nhận</option>
                                    <option value="3">Chưa xác nhận</option>
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
    <script src="asset/admin/js/appointment/appointment.js?v=<?php echo time() ?>" async></script>

</body>

</html>