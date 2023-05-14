<!DOCTYPE html>
<html lang="en">
<?php $title = "Dịch vụ";?>
<?php include("layout/asset_header.php")?>
<body>
    <?php include("layout/header.php")?>
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
    <!-- Pricing Plan Start -->
    <div class="container py-5">
        <div class="d-flex flex-column text-center mb-5">
            <h4 class="text-secondary mb-3"></h4>
            <h1 class="display-4 m-0">Trải nghiệm với <span class="text-primary">chi phí tốt nhất</span></h1>
        </div>
        <form action="?controller=service&action=data_service" style="margin-bottom: 40px" id="form-search-service" method="get">
            <div class="form-group" >
                <input type="text" class="form-control border-1" placeholder="Nhập tên dịch vụ" name="svName" id="service-name"/>
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
                    <select name="typePet" id="type_pet" class="custom-select" style="width:250px;">
                        <option value="">Chọn loại thú cưng</option>
                        <option value="0">Mèo</option>
                        <option value="1">Chó</option>
                    </select>
                </div>
            </div>
            <div style="margin-top:10px; width: 250px;">
                <button class="btn btn-lg btn-primary btn-block border-0" type="submit" >Tìm kiếm</button>
            </div>
        </form>
        <div class="row" id="data-service">
            <!-- <div class="col-lg-4 mb-4">
                <div class="card border-1">
                    <div class="card-header position-relative border-0 p-0 mb-4">
                        <img class="card-img-top" src="asset/img/orange.jpg" alt="" height=100px>
                        <div class="position-absolute d-flex flex-column align-items-center justify-content-center w-100 h-100" style="top: 0; left: 0; z-index: 1; background: rgba(0, 0, 0, .5);">
                            <h3 class="text-primary mb-3"></h3>
                            <h1 class="display-5 text-white mb-0">
                                <small class="align-top" style="font-size: 22px; line-height: 45px;"></small>CarePET<small class="align-bottom" style="font-size: 16px; line-height: 40px;"></small>
                            </h1>
                        </div>
                    </div>
                    <div class="card-body text-center p-0">
                        <ul class="list-group list-group-flush mb-4">
                            <li class="list-group-item p-2" style="font-size: 20px; font-weight:bold; height:70px"><i class="fa fa-check text-secondary mr-2"></i></li>
                            <li class="list-group-item p-2" style="font-size: 20px; font-weight:bold; height:20px"><i class="fa fa-check text-secondary mr-2"></i>Giá:</li>
                        </ul>
                    </div>
                    <div class="card-footer border-0 p-0">
                        <a href="?controller=appointment&action=appointment_page" class="btn btn-primary btn-block p-3" style="border-radius: 0; background-color: #65C178; border-color: #65C178">Đặt lịch</a>
                    </div>
                </div>
            </div> -->
            <!-- <div class="col-lg-12">
                <nav aria-label="Page navigation">
                  <ul class="pagination justify-content-center mb-4">
                    <li class="page-item disabled">
                      <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo; Previous</span>
                      </a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                      <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">Next &raquo;</span>
                      </a>
                    </li>
                  </ul>
                </nav>
            </div> -->
        </div>
        <div class="row" id="page">
        </div>
    </div>
    <!-- Pricing Plan End -->

    <?php include("layout/footer.php")?>


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <?php include("layout/asset_footer.php") ?>
    <script src="asset/js/service.js?v=<?php echo time() ?>" async></script>
</body>

</html>