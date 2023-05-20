<!DOCTYPE html>
<html lang="en">
<?php $title = "Thông tin shop";?>
<?php include("layout/asset-header.php")?>
<body>
    <?php include("layout/header.php")?>
    <!-- About Start -->
    <div class="container py-5 main" style="margin-bottom:0">
        <div class="row py-5">
            <div class="col-lg-7 pb-5 pb-lg-0 px-3 px-lg-5">
                <h4 class="text-secondary mb-3">Thông tin</h4>
                <h1 class="display-4 mb-4"><span class="text-primary shop-name"></span> & <span class="text-secondary">Your pet</span></h1>
                <h5 class="text-muted mb-3 shop-address"><b>Địa chỉ: </b></h5>
                <h5 class="text-muted mb-3 shop-phone"><b>Số điện thoại: </b></h5>
                <h5 class="text-muted mb-3 shop-mail"><b>Email: </b></h5>
                <p class="mb-4 shop-desc" style="font-size:18px"></p>
                <ul class="list-inline">
                    <li><h5><i class="fa fa-check-double text-secondary mr-3"></i>Uy tín</h5></li>
                    <li><h5><i class="fa fa-check-double text-secondary mr-3"></i>Chất lượng</h5></li>
                    <li><h5><i class="fa fa-check-double text-secondary mr-3"></i>Hỗ trợ 24/7</h5></li>
                </ul>
                <a href="?controller=appointment&action=appointment_page" class="btn btn-lg btn-primary mt-3 px-4">Đặt lịch ngay</a>
            </div>
            <div class="col-lg-5">
                <div class="row px-3">
                    <div class="col-12 p-0">
                        <img class="img-fluid w-100" src="asset/img/about-1.jpg" alt="">
                    </div>
                    <div class="col-6 p-0">
                        <img class="img-fluid w-100" src="asset/img/about-2.jpg" alt="">
                    </div>
                    <div class="col-6 p-0">
                        <img class="img-fluid w-100" src="asset/img/about-3.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Team Start -->
    <div class="container mt-5 pt-5 pb-3" style="margin-top:0">
        <div class="d-flex flex-column text-center mb-5">
            <h4 class="text-secondary mb-3">Đội ngũ quản trị</h4>
            <h1 class="display-4 m-0">Cán bộ <span class="text-primary">hàng đầu trong lĩnh vực</span></h1>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="team card position-relative overflow-hidden border-0 mb-4">
                    <img class="card-img-top" src="asset/img/dung.jpg" alt="" height=550px>
                    <div class="card-body text-center p-0">
                        <div class="team-text d-flex flex-column justify-content-center bg-light">
                            <h5>Vũ Thị Thuỳ Dung</h5>
                            <i>Founder & CEO</i>
                        </div>
                        <div class="team-social d-flex align-items-center justify-content-center bg-dark">
                            <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0" style="width: 36px; height: 36px;" href="#"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0" style="width: 36px; height: 36px;" href="https://www.facebook.com/vtt.dung.1911" target="_blank"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0" style="width: 36px; height: 36px;" href="#" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-outline-primary rounded-circle text-center px-0" style="width: 36px; height: 36px;" href="https://www.instagram.com/vtt.dung/" target="_blank"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="team card position-relative overflow-hidden border-0 mb-4">
                    <img class="card-img-top" src="asset/img/dungx.jpg" alt="" height=550px>
                    <div class="card-body text-center p-0">
                        <div class="team-text d-flex flex-column justify-content-center bg-light">
                            <h5>Trịnh Tiến Dũng</h5>
                            <i>Chef Executive</i>
                        </div>
                        <div class="team-social d-flex align-items-center justify-content-center bg-dark">
                            <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0" style="width: 36px; height: 36px;" href="#"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0" style="width: 36px; height: 36px;" href="https://www.facebook.com/Uop.Tsu/" target="_blank"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0" style="width: 36px; height: 36px;" href="https://www.linkedin.com/in/dung-trinh-tien-a76939272/"><i class="fab fa-linkedin-in" target="_blank"></i></a>
                            <a class="btn btn-outline-primary rounded-circle text-center px-0" style="width: 36px; height: 36px;" href="https://www.instagram.com/trtieensdungx/" target="_blank"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="team card position-relative overflow-hidden border-0 mb-4">
                    <img class="card-img-top" src="asset/img/thuan.jpg" alt="" height=550px>
                    <div class="card-body text-center p-0">
                        <div class="team-text d-flex flex-column justify-content-center bg-light">
                            <h5>Ngô Văn Thuận</h5>
                            <i>Doctor</i>
                        </div>
                        <div class="team-social d-flex align-items-center justify-content-center bg-dark">
                            <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0" style="width: 36px; height: 36px;" href="#"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0" style="width: 36px; height: 36px;" href="https://www.facebook.com/ngovan.thuan.127" target="_blank"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0" style="width: 36px; height: 36px;" href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-outline-primary rounded-circle text-center px-0" style="width: 36px; height: 36px;" href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->


    <?php include("layout/footer.php")?>


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <?php include("layout/asset-footer.php") ?>
    <script src="asset/js/about-contact.js?v=<?php echo time() ?>" async></script>

</body>

</html>