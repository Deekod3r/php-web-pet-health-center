<!DOCTYPE html>
<html lang="en">
<?php $title = "Trang chủ"; ?>
<?php include("layout/asset_header.php") ?>
<!-- <script src="asset/js/index.js?v=<?php echo time() ?>" async></script> -->

<body>
    <?php include("layout/header.php") ?>

    <div class="main container-fluid p-0 main main1">
        <div id="header-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="asset/img/carousel-6.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h3 class="text-white mb-3 d-none d-sm-block">Cung cấp các dịch vụ tốt nhất cho thú cưng của bạn</h3>
                            <h1 class="display-3 text-white mb-3">Keep Your Pet Happy</h1>
                            <h5 class="text-white mb-3 d-none d-sm-block"> - CarePET - </h5>
                            <a href="?controller=appointment&action=appointment_page" class="btn btn-lg btn-primary mt-3 mt-md-4 px-4">Đặt lịch ngay</a>
                            <a href="?controller=service&action=service_page" class="btn btn-lg btn-secondary mt-3 mt-md-4 px-4" style="color:white">Xem thêm</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="asset/img/carousel-5.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h3 class="text-white mb-3 d-none d-sm-block">Cung cấp các dịch vụ tốt nhất cho thú cưng của bạn</h3>
                            <h1 class="display-3 text-white mb-3">Keep Your Pet Happy</h1>
                            <h5 class="text-white mb-3 d-none d-sm-block"> - CarePET - </h5>
                            <a href="?controller=appointment&action=appointment_page" class="btn btn-lg btn-primary mt-3 mt-md-4 px-4">Đặt lịch ngay</a>
                            <a href="?controller=service&action=service_page" class="btn btn-lg btn-secondary mt-3 mt-md-4 px-4" style="color:white">Xem thêm</a>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                <div class="btn btn-primary rounded" style="width: 45px; height: 45px;">
                    <span class="carousel-control-prev-icon mb-n2"></span>
                </div>
            </a>
            <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                <div class="btn btn-primary rounded" style="width: 45px; height: 45px;">
                    <span class="carousel-control-next-icon mb-n2"></span>
                </div>
            </a>
        </div>
    </div>

    <div class="container-fluid bg-light pt-5">
        <div class="container py-5">
            <div class="d-flex flex-column text-center mb-5">
                <h4 class="text-secondary mb-3" style="font-size:30px">Phổ biến</h4>
                <h1 class="display-4 m-0">Dịch vụ thú cưng <span class="text-primary">cao cấp</span></h1>
            </div>
            <div class="row pb-3">
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="d-flex flex-column text-center bg-white mb-2 p-3 p-sm-5" style="height:400px">
                        <h3 class="flaticon-grooming display-3 font-weight-normal text-secondary mb-3"></h3>
                        <h3 class="mb-3">Cắt tỉa, vệ sinh</h3>
                        <p>Tỉa lông theo yêu cầu, tắm rửa, vệ sinh thú cưng siêu thơm tho và sạch sẽ.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="d-flex flex-column text-center bg-white mb-2 p-3 p-sm-5" style="height:400px">
                        <h3 class="flaticon-cat display-3 font-weight-normal text-secondary mb-3"></h3>
                        <h3 class="mb-3">Huấn luyện</h3>
                        <p>Huấn luyện, đào tạo giúp thú cưng có những kỹ năng cơ bản để phù hợp với lối sống của bạn và gia đình bạn.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="d-flex flex-column text-center bg-white mb-2 p-3 p-sm-5" style="height:400px">
                        <h3 class="flaticon-vaccine display-3 font-weight-normal text-secondary mb-3"></h3>
                        <h3 class="mb-3">Tiêm phòng</h3>
                        <p>Bảo vệ thú cưng của bạn phòng chống lại các bệnh truyền nhiễm. Bảo vệ con người khỏi sự lây nhiễm của các bệnh truyền lây giữa động vật và người</p>
                    </div>
                </div>
            </div>
            <p style="text-align:center; font-size:25px"><a class="text-uppercase font-weight-bold" href="?controller=service&action=service_page">Xem thêm</a></p>
        </div>
    </div>

    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5">
                <img class="img-fluid w-100" src="asset/img/feature-2.jpg" alt="">
            </div>
            <div class="col-lg-7 py-5 py-lg-0 px-3 px-lg-5">
                <h4 class="text-secondary mb-3" style="font-size:30px">Vì sao nên sử dụng dịch vụ của <b>CarePET</b>?</h4>
                <h1 class="display-4 mb-4"><span class="text-primary">Chăm sóc đặc biệt</span> với thú cưng của bạn</h1>
                <div class="row py-2">
                    <div class="col-6">
                        <div class="d-flex align-items-center mb-4">
                            <h1 class="flaticon-cat font-weight-normal text-secondary m-0 mr-3"></h1>
                            <h5 class="text-truncate m-0">Công nghệ tiên tiến</h5>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center mb-4">
                            <h1 class="flaticon-doctor font-weight-normal text-secondary m-0 mr-3"></h1>
                            <h5 class="text-truncate m-0">Hỗ trợ nhanh chóng</h5>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                            <h1 class="flaticon-care font-weight-normal text-secondary m-0 mr-3"></h1>
                            <h5 class="text-truncate m-0">Nâng niu</h5>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                            <h1 class="flaticon-dog font-weight-normal text-secondary m-0 mr-3"></h1>
                            <h5 class="text-truncate m-0">Nhiệt tình</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5 pt-5 pb-3">
        <div class="d-flex flex-column text-center mb-5">
            <h4 class="text-secondary mb-3" style="font-size:30px">Đối tác</h4>
            <h1 class="display-4 m-0">Doanh nghiệp <span class="text-primary">uy tín</span></h1>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="team card position-relative overflow-hidden border-0 mb-4">
                    <img class="card-img-top" src="asset/img/brand-1.jpg" alt="">
                    <div class="card-body text-center p-0">
                        <div class="team-text d-flex flex-column justify-content-center bg-light">
                            <h5>DogCat</h5>
                            <i></i>
                        </div>
                        <div class="team-social d-flex align-items-center justify-content-center bg-dark">
                            <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0" style="width: 36px; height: 36px;" href="#"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0" style="width: 36px; height: 36px;" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0" style="width: 36px; height: 36px;" href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-outline-primary rounded-circle text-center px-0" style="width: 36px; height: 36px;" href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="team card position-relative overflow-hidden border-0 mb-4">
                    <img class="card-img-top" src="asset/img/brand-2.jpg" alt="">
                    <div class="card-body text-center p-0">
                        <div class="team-text d-flex flex-column justify-content-center bg-light">
                            <h5>Husky</h5>
                            <i></i>
                        </div>
                        <div class="team-social d-flex align-items-center justify-content-center bg-dark">
                            <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0" style="width: 36px; height: 36px;" href="#"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0" style="width: 36px; height: 36px;" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0" style="width: 36px; height: 36px;" href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-outline-primary rounded-circle text-center px-0" style="width: 36px; height: 36px;" href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="team card position-relative overflow-hidden border-0 mb-4">
                    <img class="card-img-top" src="asset/img/brand-3.jpg" alt="">
                    <div class="card-body text-center p-0">
                        <div class="team-text d-flex flex-column justify-content-center bg-light">
                            <h5>Catis</h5>
                            <i></i>
                        </div>
                        <div class="team-social d-flex align-items-center justify-content-center bg-dark">
                            <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0" style="width: 36px; height: 36px;" href="#"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0" style="width: 36px; height: 36px;" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0" style="width: 36px; height: 36px;" href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-outline-primary rounded-circle text-center px-0" style="width: 36px; height: 36px;" href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="team card position-relative overflow-hidden border-0 mb-4">
                    <img class="card-img-top" src="asset/img/brand-4.jpg" alt="">
                    <div class="card-body text-center p-0">
                        <div class="team-text d-flex flex-column justify-content-center bg-light">
                            <h5>Flying Corgi</h5>
                            <i></i>
                        </div>
                        <div class="team-social d-flex align-items-center justify-content-center bg-dark">
                            <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0" style="width: 36px; height: 36px;" href="#"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0" style="width: 36px; height: 36px;" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0" style="width: 36px; height: 36px;" href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-outline-primary rounded-circle text-center px-0" style="width: 36px; height: 36px;" href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid bg-light p-0 py-5">
        <div class="container p-0 py-5" id="feedback">
            <div class="d-flex flex-column text-center mb-5">
                <h4 class="text-secondary mb-3">Feedback</h4>
                <h1 class="display-4 m-0">Đánh giá của <span class="text-primary">khách hàng</span></h1>
            </div>
            <div class='owl-carousel testimonial-carousel' id="feedback1"></div>
        </div>
    </div>
    
    <?php include("layout/footer.php") ?>

    <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <?php include("layout/asset_footer.php") ?>
    <script src="asset/js/index.js?v=<?php echo time() ?>"></script>

</body>

</html>