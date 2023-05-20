<!DOCTYPE html>
<html lang="en">
<?php $title = "Dịch vụ"; ?>
<?php include("layout/asset-header.php") ?>

<body>
    <?php include("layout/header.php") ?>
    <!-- Services Start -->
    <div class="container-fluid bg-light pt-3 main">
        <div class="container py-5">
            <div class="d-flex flex-column text-center mb-5">
                <h4 class="text-secondary mb-3"></h4>
                <h1 class="display-4 m-0">Dịch vụ <span class="text-primary">cao cấp</span></h1>
            </div>
            <div class="row pb-3">
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="d-flex flex-column text-center bg-white mb-2 p-3 p-sm-5">
                        <h3 class="flaticon-vaccine display-3 font-weight-normal text-secondary mb-3"></h3>
                        <h3 class="mb-3">Tiêm phòng</h3>
                        <p>Vacxin chuẩn nhập khẩu, có giấy chứng nhận của bộ y tế. Tiêm phòng giúp thú cưng của bạn phòng ngừa được bệnh tật.</p>
                        <a href="?controller=appointment&action=appointment_page" class="text-uppercase font-weight-bold" href="?controller=appointment&action=appointment_page">Đặt lịch ngay</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="d-flex flex-column text-center bg-white mb-2 p-3 p-sm-5">
                        <h3 class="flaticon-food display-3 font-weight-normal text-secondary mb-3"></h3>
                        <h3 class="mb-3">Tư vấn dinh dưỡng</h3>
                        <p>Lời tư vấn dinh dưỡng từ các chuyên gia hàng đầu, giúp thú cưng của bạn có chế độ ăn tốt nhất để phát triển.</p>
                        <a href="?controller=appointment&action=appointment_page" class="text-uppercase font-weight-bold" href="?controller=appointment&action=appointment_page">Đặt lịch ngay</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="d-flex flex-column text-center bg-white mb-2 p-3 p-sm-5">
                        <h3 class="flaticon-grooming display-3 font-weight-normal text-secondary mb-3"></h3>
                        <h3 class="mb-3">Thẩm mỹ</h3>
                        <p>Đôi bàn tay khéo léo từ các "nghệ nhân" sẽ mang tới cho pet của bạn một "bộ cánh" độc nhất và vô cùng ấn tượng.</p>
                        <a href="?controller=appointment&action=appointment_page" class="text-uppercase font-weight-bold" href="?controller=appointment&action=appointment_page">Đặt lịch ngay</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 mb-6">
                    <div class="d-flex flex-column text-center bg-white mb-2 p-3 p-sm-5">
                        <h3 class="flaticon-cat display-3 font-weight-normal text-secondary mb-3"></h3>
                        <h3 class="mb-3">Huấn luyện</h3>
                        <p style="height: 80px">Huyến luyện chó mèo sinh hoạt (đi vệ sinh, ăn ngủ nghỉ,...) bằng các kỹ thuật chuyên nghiệp nhất.</p>
                        <a href="?controller=appointment&action=appointment_page" class="text-uppercase font-weight-bold" href="?controller=appointment&action=appointment_page">Đặt lịch ngay</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 mb-6">
                    <div class="d-flex flex-column text-center bg-white mb-2 p-3 p-sm-5">
                        <h3 class="flaticon-dog display-3 font-weight-normal text-secondary mb-3"></h3>
                        <h3 class="mb-3">Khám bệnh, điều trị</h3>
                        <p style="height: 80px">Dịch vụ thăm khám, chữa bệnh, điều trị bằng các công nghệ tiên tiến nhất, đem đến trải nghiệm tuyệt vời dành cho thú cưng của bạn.</p>
                        <a href="?controller=appointment&action=appointment_page" class="text-uppercase font-weight-bold" href="?controller=appointment&action=appointment_page">Đặt lịch ngay</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Services End -->

    <div class="container py-5">
        <div class="d-flex flex-column text-center mb-5">
            <h4 class="text-secondary mb-3"></h4>
            <h1 class="display-4 m-0">Trải nghiệm với <span class="text-primary">chi phí tốt nhất</span></h1>
        </div>
        <form action="?controller=service&action=data_service" style="margin-bottom: 40px" id="form-search-service" method="get">
            <div class="form-group">
                <input type="text" class="form-control border-1" placeholder="Nhập tên dịch vụ" name="svName" id="service-name" />
            </div>
            <div class="row" style="margin-top: 10px">
                <div class="col-lg-4">
                    <p style="font-weight:bold; margin-bottom:0">&nbspDanh mục dịch vụ: </p>
                    <select name="categoryService" id="category-service" class="custom-select" style="width:250px;">
                        <option value="">Chọn danh mục dịch vụ</option>
                        <option value="">Tất cả</option>
                    </select>
                </div>
                <div class="col-lg-8">
                    <p style="font-weight:bold; margin-bottom:0">&nbspDanh mục thú cưng: </p>
                    <select name="typePet" id="type-pet" class="custom-select" style="width:250px;">
                        <option value="">Chọn loại thú cưng</option>
                        <option value="0">Mèo</option>
                        <option value="1">Chó</option>
                    </select>
                </div>
            </div>
            <div style="margin-top:10px; width: 250px;">
                <button class="btn btn-lg btn-primary btn-block border-0" type="submit">Tìm kiếm</button>
            </div>
        </form>

        <!-- modal -->
        <div class="modal fade" id="myModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="ml-3 mt-2 mb-0">Thông tin sản phẩm</h3>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-3 col-lg-3" id="sv-id" style="font-size:17px; color:black"></div>
                                <div class="col-md-8 col-lg-8 ms-auto" id="sv-name" style="font-size:17px; color:black"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-lg-4 ms-auto" id="typ-pet" style="font-size:17px; color:black"></div>
                                <div class="col-md-6 col-lg-6 ms-auto" id="cs-name" style="font-size:17px; color:black"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 col-lg-7 ms-auto" id="sv-price" style="font-size:17px; color:black"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-lg-12 ms-auto" id="sv-desc" style="font-size:17px; color:black"></div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-3 col-lg-3"></div>
                                <img  class="col-md-6 col-lg-6 ms-auto" src="asset/img/feature-2.jpg" alt="">
                                <div class="col-md-3 col-lg-3"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-primary" data-dismiss="modal">Đóng</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal -->

        <div class="row" id="data-service">
        </div>

        <div class="row" id="page">
        </div>
    </div>

    <div id="pop-up-service">
    </div>

    <?php include("layout/footer.php") ?>


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <?php include("layout/asset-footer.php") ?>
    <script src="asset/js/service.js?v=<?php echo time() ?>" async></script>
</body>

</html>