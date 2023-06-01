<!doctype html>
<html lang="en">
<?php $title = "Giảm giá" ?>
<?php include("view/admin/layout/asset-header.php") ?>

<body>
    <?php include("view/admin/layout/header.php") ?>
    <div class="container-fluid main-admin">
        <div class="container-fluid">
            <form action="" style="margin-bottom: 40px" id="form-search-discount" method="get">
                <div class="row" style="margin-top: 10px">
                    <div class="form-group col-lg-1"></div>
                    <div class="form-group col-lg-2">
                        <p style="font-weight:bold; margin-bottom:0; color:black">&nbspNhập mã giảm giá:</p>
                        <input type="text" class="form-control border-1" name="discountCode" id="discount-code" placeholder="VD: HAPPY99"/>
                    </div>
                    <div class="form-group col-lg-2">
                        <p style="font-weight:bold; margin-bottom:0; color:black">&nbspĐiều kiện áp dụng:</p>
                        <input type="number" class="form-control border-1" name="discountCondition" id="discount-condition" min=0/>
                    </div>
                    <div class="col-lg-1">
                        <p style="font-weight:bold; margin-bottom:0; color:black">&nbspTrạng thái:</p>
                        <select name="discountStatus" id="discount-status" class="custom-select">
                            <option value="">Tất cả</option>
                            <option value="1">Hoạt động</option>
                            <option value="0">Ngừng</option>
                        </select>
                    </div>
                    <div class="col-lg-1">
                        <p style="font-weight:bold; margin-bottom:0; color:black">&nbspSố lượng:</p>
                        <select name="discountQuantity" id="discount-quantity" class="custom-select">
                            <option value="">Tất cả</option>
                            <option value="desc">Tăng dần</option>
                            <option value="asc">Giảm dần</option>
                        </select>
                    </div>
                    <div class="form-group col-lg-2">
                        <p style="font-weight:bold; margin-bottom:0;color:black">&nbspGiá trị giảm giá:</p>
                        <select name="discountValue" id="discount-value" class="custom-select mt-0 mb-0">
                            <option value="">Tất cả</option>
                            <option value="dc_value">Giá trực tiếp</option>
                            <option value="dc_value_percent">%</option>
                        </select>
                    </div>
                    <div class="col-lg-1">
                        <p style="font-weight:bold; margin-bottom:0; color:black">&nbspGiảm giá tháng:</p>
                        <input type="number" class="form-control border-1" name="dcMonth" id="discount-month" min=1 max=12 />
                    </div>
                    <div class="col-lg-1">
                        <p style="font-weight:bold; margin-bottom:0; color:black">&nbspGiảm giá năm:</p>
                        <input type="number" class="form-control border-1" name="dcYear" id="discount-year" min=0 max=2300 />
                    </div>
                    <div class="form-group col-lg-1"></div>
                    <div class="form-group col-lg-1"></div>
                    <div class="col-lg-3">
                        <input class="btn btn-primary" type="reset">
                        <button class="btn btn-primary" type="submit " id="submit">Tìm kiếm</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="container-fluid">
            <a class='btn btn-primary mb-3' style='color:white' data-toggle='modal' data-target='#myModal'>Thêm mã giảm giá</a>
            <div class="alert" role="alert" style="display: none" id="msg-service"></div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="col-lg-0" scope="col">#</th>
                        <th class="col-lg-1" scope="col">Mã giảm giá</th>
                        <th class="col-lg-3" scope="col">Mô tả</th>
                        <th class="col-lg-2" scope="col">Điều kiện</th>
                        <th class="col-lg-1" scope="col">Giá trị giảm</th>
                        <th class="col-lg-1" scope="col">Bắt đầu</th>
                        <th class="col-lg-1" scope="col">Kết thúc</th>
                        <th class="col-lg-1" scope="col">Số lượng</th>
                        <th class="col-lg-1" scope="col">Trạng thái</th>
                        <th class="col-lg-1"></th>
                    </tr>
                </thead>
                <tbody id="data-discount">
                </tbody>
            </table>
        </div>

        <!-- modal -->
        <div class="modal fade" id="myModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form id="form-add-discount" method="post" action="">
                        <div class="modal-header">
                            <h3 class="ml-3 mt-2 mb-0">Thêm mã giảm giá</h3>
                        </div>
                        <div class="modal-body row">
                            <div class="alert col-12 " role="alert" style="display: none" id="msg-discount"></div>
                            <div class="mb-3 col-4">
                                <label for="" class="form-label" style="font-weight:bold; margin-bottom:0;color:black">Mã giảm giá</label>
                                <input type="text" class="form-control" name="discountCodeAdd" id="discount-code-add">
                            </div>
                            <div class="mb-3 col-4">
                                <label for="" class="form-label" style="font-weight:bold; margin-bottom:0;color:black">Điều kiện</label>
                                <input type="number" class="form-control" name="discountConditionAdd"  id="discount-condition-add" min=0>
                            </div>
                            <div class="mb-3 col-4">
                                <label for="" class="form-label" style="font-weight:bold; margin-bottom:0;color:black">Số lượng</label>
                                <input type="number" class="form-control" name="discountQuantityAdd"  id="discount-quantity-add">
                            </div>
                            <div class="form-group col-4">
                                <label for="" class="form-label" style="font-weight:bold; margin-bottom:0;color:black">Ngày bắt đầu</label>
                                <div class="date" id="date1" data-target-input="nearest"> 
                                    <input type="date" class="form-control " name="discountStartTimeAdd" id="discount-start-time-add" placeholder="" />
                                </div>
                            </div>
                            <div class="form-group col-4">
                                <label for="" class="form-label" style="font-weight:bold; margin-bottom:0;color:black">Ngày kết thúc</label>
                                <div class="date" id="date1" data-target-input="nearest">
                                    <input type="date" class="form-control " name="discountEndTimeAdd" id="discount-end-time-add" placeholder="" />
                                </div>
                            </div>
                            <div class="form-group col-lg-5">
                                <p style="font-weight:bold; margin-bottom:0;color:black">Giá trị</p>
                                <div class="input-group">
                                    <span class="input-group-text">
                                    <select name="discountTypeAdd" id="discount-type-add" class="custom-select">
                                        <option value="">Chọn</option>
                                        <option value="dc_value">Trực tiếp</option>
                                        <option value="dc_value_percent">%</option>
                                    </select>
                                    </span>
                                    <input type="number" class="form-control " name="discountValueAdd" id="discount-value-add" style="height:52px" />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <p style="font-weight:bold; margin-bottom:0;color:black">Mô tả</p>
                                <textarea type="text" class="form-control"  name="discountDescAdd" id="discount-desc-add"></textarea>
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
                    <form id="form-edit-discount" method="post" action="">
                        <div class="modal-header">
                            <h3 class="ml-3 mt-2 mb-0">Sửa giảm giá</h3>
                        </div>
                        <div class="modal-body">
                            <div class="alert col-12 " role="alert" style="display: none" id="msg-discount-edit"></div>
                            <input type="hidden" id="discount-id-edit" name="discountIdEdit">
                            <div class="mb-3">
                                <p style="font-weight:bold; margin-bottom:0;color:black">Trạng thái</p>
                                <select name="discountStatusEdit" id="discount-status-edit" class="custom-select">
                                    <option value="0">Không hiệu lực</option>
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
    <script src="asset/admin/js/discount/discount.js?v=<?php echo time() ?>" async></script>

</body>

</html>