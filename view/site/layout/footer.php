    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white mt-5 py-5 px-sm-3 px-md-5">
        <div class="row pt-5">
            <div class="col-lg-4 col-md-12 mb-5">
                <h1 class="mb-3 display-5 text-capitalize text-white"><span class="text-primary">Care</span>PET</h1>
                <p class="m-0">Hệ thống chăm sóc thú cưng số 1 HUCE, đem đến cho bạn sự yên tâm, tin tưởng, mang niềm vui tới cho thú cưng của bạn. Hệ thống chuyên cung cấp các dịch vụ thẩm mỹ, sức khoẻ, y tế, tinh thần cho thú cưng (chó, mèo). Với chất lượng dịch vụ tốt nhất luôn được khách hàng tin tưởng sẽ là điểm đến lý tưởng và tuyệt vời dành cho vật nuôi.</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-3 mb-5">
                        <h5 class="text-primary mb-4">Liên hệ</h5>
                        <p style="width: 210px"><i class="fa fa-map-marker-alt mr-2"></i><?php echo $shop['shop_address']?></p>
                        <p><i class="fa fa-phone-alt mr-2"></i><?php echo $shop['shop_phone']?></p>
                        <p><i class="fa fa-envelope mr-2"></i><?php echo $shop['shop_mail']?></p>
                        <div class="d-flex justify-content-start mt-4">
                            <a class="btn btn-outline-light rounded-circle text-center mr-2 px-0" style="width: 36px; height: 36px;" href="https://twitter.com/?lang=vi" target="_blank"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light rounded-circle text-center mr-2 px-0" style="width: 36px; height: 36px;" href="<?php echo $shop['shop_facebook']?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light rounded-circle text-center mr-2 px-0" style="width: 36px; height: 36px;" href="https://www.linkedin.com/in/dung-trinh-tien-a76939272/" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-outline-light rounded-circle text-center mr-2 px-0" style="width: 36px; height: 36px;" href="https://www.instagram.com/trtieensdungx/" target="_blank"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="col-md-3 mb-5">
                        <h5 class="text-primary mb-4">Website</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Trang chủ</a>
                            <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Thông tin shop</a>
                            <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Dịch vụ</a>
                            <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Đặt lịch</a>
                            <a class="text-white" href="#"><i class="fa fa-angle-right mr-2"></i>Liên hệ</a>
                        </div>
                    </div>
                    <div class="col-md-6 mb-5">
                        <h5 class="text-primary mb-4">Đăng ký nhận thông báo <br/> để có các thông tin khuyến mại sớm nhất</h5>
                        <form action="">
                            <div class="form-group">
                                <input type="text" class="form-control border-0" placeholder="Họ và tên" required="required" />
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control border-0" placeholder="Địa chỉ email" required="required" />
                            </div>
                            <div>
                                <button class="btn btn-lg btn-primary btn-block border-0" type="submit">Đăng ký</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid text-white py-4 px-sm-3 px-md-5" style="background: #111111;">
        <div class="row">
            <div class="col-md-6 text-center text-md-left mb-3 mb-md-0">
                <p class="m-0 text-white">
                    &copy; <a class="text-white font-weight-bold" href="#">CarePET</a>. Copyright <?php echo date("Y");?> by Team2 - 65PM2 (Web advenced).
                </p>
            </div>
            <div class="col-md-6 text-center text-md-right">
                <ul class="nav d-inline-flex">
                    <li class="nav-item">
                        <a class="nav-link text-white py-0" href="#">Quyền riêng tư</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white py-0" href="#">Điều khoản</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white py-0" href="#">Câu hỏi thường gặp</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white py-0" href="#">Trợ giúp</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Footer End -->