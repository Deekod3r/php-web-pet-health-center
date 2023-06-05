<div style="position: fixed; z-index:1000; top: 0; width:100%; background-color:white;">
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row bg-secondary py-1 px-lg-5">
            <div class="col-lg-6 text-center text-lg-left mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center">
                    <a class="text-white pr-3" href="">Câu hỏi thường gặp</a>
                    <span class="text-white">|</span>
                    <a class="text-white px-3" href="">Hỗ trợ</a>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <a class="text-white px-3 shop-fb" id="nav-shop-fb" target="_blank">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-white px-3" href="https://twitter.com/?lang=vi" target="_blank">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-white px-3" href="https://www.linkedin.com/in/dung-trinh-tien-a76939272/" target="_blank">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-white px-3" href="https://www.instagram.com/trtieensdungx/" target="_blank">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="text-white pl-3" href="https://www.youtube.com/" target="_blank">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row py-2 px-lg-5">
            <div class="col-lg-4">
                <a href="" class="navbar-brand d-none d-lg-block">
                    <h1 class="m-0 display-5 text-capitalize">
                        <span class="text-primary">Care</span>PET
                        <!-- <span style="font-size:15px">Hệ thống chăm sóc thú cưng</span> -->
                    </h1>
                </a>
            </div>
            <div class="col-lg-8 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <div class="d-inline-flex flex-column text-center pr-3 border-right">
                        <h6>Giờ mở cửa</h6>
                        <p class="m-0">8.00 AM - 9.00 PM</p>
                    </div>
                    <div class="d-inline-flex flex-column text-center px-3 border-right">
                        <h6>Địa chỉ</h6>
                        <p class="m-0 shop-address"  id="nav-shop-address" ></p>
                    </div>
                    <div class="d-inline-flex flex-column text-center px-3 border-right">
                        <h6>Email liên hệ</h6>
                        <p class="m-0 shop-mail"  id="nav-shop-mail" ></p>
                    </div>
                    <div class="d-inline-flex flex-column text-center pl-3">
                        <h6>Số điện thoại</h6>
                        <p class="m-0 shop-phone"  id="nav-shop-phone" ></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-1 py-lg-0 px-lg-5">
            <a href="" class="navbar-brand d-block d-lg-none">
                <h1 class="m-0 display-5 text-capitalize font-italic text-white"><span class="text-primary">Care</span>PET</h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between px-1" id="navbarCollapse">
                <div class="navbar-nav mr-auto py-0">
                    <a href="?controller=home&action=index" class="nav-item nav-top nav-link <?php if ($title == "Trang chủ") echo "active"; ?>">Trang chủ</a>
                    <a href="?controller=service&action=service_page" class="nav-item nav-top nav-link <?php if ($title == "Dịch vụ") echo "active"; ?>">Dịch vụ</a>
                    <a href="?controller=discount&action=discount_page" class="nav-item nav-top nav-link <?php if ($title == "Khuyến mại") echo "active"; ?>">Khuyến mại</a>
                    <a href="?controller=appointment&action=appointment_page" class="nav-item nav-top nav-link <?php if ($title == "Đặt lịch") echo "active"; ?>">Đặt lịch</a>
                    <a href="?controller=news&action=news_page" class="nav-item nav-top nav-link <?php if ($title == "Tin tức") echo "active"; ?>">Tin tức</a>
                    <a href="?controller=feedback&action=feedback_page" class="nav-item nav-top nav-link <?php if ($title == "Đánh giá") echo "active"; ?>">Đánh giá</a>
                    <a href="?controller=shop&action=about_page" class="nav-item nav-top nav-link <?php if ($title == "Thông tin shop") echo "active"; ?>">Thông tin shop</a>
                    <a href="?controller=shop&action=contact_page" class="nav-item nav-top nav-link <?php if ($title == "Liên hệ") echo "active"; ?>">Liên hệ</a>
                </div>
                <?php if (isset($_SESSION['login']) && $_SESSION['login'] == Enum::ROLE_CUSTOMER) { ?>
                    <div class="dropdown" id="" style="margin-right:20px">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Thông tin tài khoản</a>
                        <ul class="dropdown-menu">
                            <!-- rounded-0 m-0 -->
                            <li><a href="?controller=customer&action=customer_info" class="dropdown-item">Trang cá nhân</a></li>
                            <li><a href="?controller=pet&action=customer_pet" class="dropdown-item">Thú cưng của bạn</a></li>
                            <li><a href="?controller=bill&action=customer_history" class="dropdown-item">Lịch sử dịch vụ</a></li>
                            <li><a href="?controller=appointment&action=customer_current_apm" class="dropdown-item">Lịch đang hẹn</a></li>
                        </ul>
                    </div>
                    <a onclick="logout()" class="nav-link" style="cursor:pointer">Đăng xuất</a>
                <?php } else { ?>
                    <a href="?controller=home&action=login_page" class="nav-link">Đăng nhập</a>
                <?php } ?>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->
</div>