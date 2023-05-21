<div style="position: fixed; z-index:1000; top: 0; width:100%; background-color:white;">
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
                    <a href="" class="navbar-brand d-none d-lg-block">
                        <h1 class="m-0 display-5 text-capitalize">
                            <span class="text-primary">CarePET</span>
                        </h1>
                    </a>
                    <a href="?controller=home&action=index" class="nav-item nav-top nav-link <?php if ($title == "Trang chủ") echo "active"; ?>">Trang chủ</a>
                    <a href="?controller=service&action=service_page" class="nav-item nav-top nav-link <?php if ($title == "Dịch vụ") echo "active"; ?>">Dịch vụ</a>
                    <a href="?controller=appointment&action=appointment_page" class="nav-item nav-top nav-link <?php if ($title == "Đặt lịch") echo "active"; ?>">Đặt lịch</a>
                    <a href="?controller=news&action=news_page" class="nav-item nav-top nav-link <?php if ($title == "Tin tức") echo "active"; ?>">Tin tức</a>
                    <a href="?controller=feedback&action=feedback_page" class="nav-item nav-top nav-link <?php if ($title == "Đánh giá") echo "active"; ?>">Đánh giá</a>
                    <a href="?controller=shop&action=about_page" class="nav-item nav-top nav-link <?php if ($title == "Thông tin shop") echo "active"; ?>">Thông tin shop</a>
                    <a href="?controller=shop&action=contact_page" class="nav-item nav-top nav-link <?php if ($title == "Liên hệ") echo "active"; ?>">Liên hệ</a>
                </div>
                <?php if (isset($_SESSION['login']) && $_SESSION['login'] == Enum::ADMIN) { ?>
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