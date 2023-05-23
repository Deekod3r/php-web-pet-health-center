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
                    <!-- <a href="" class="navbar-brand d-none d-lg-block">
                        <h5 class="m-0 display-5 text-capitalize">
                            <span class="text-primary">CarePET</span>
                        </h5>
                    </a> -->
                    <a href="?controller=home&action=index_admin" class="nav-item nav-top nav-link <?php if ($title == "Trang chủ") echo "active"; ?>">Trang chủ</a>
                    <a href="?controller=service&action=service_page_ad" class="nav-item nav-top nav-link <?php if ($title == "Dịch vụ") echo "active"; ?>">Dịch vụ</a>
                    <a href="?controller=discount&action=discount_page_ad" class="nav-item nav-top nav-link <?php if ($title == "Giảm giá") echo "active"; ?>">Giảm giá</a>
                    <a href="?controller=appointment&action=appointment_page_ad" class="nav-item nav-top nav-link <?php if ($title == "Lịch hẹn") echo "active"; ?>">Lịch hẹn</a>
                    <a href="?controller=bill&action=bill_page_ad" class="nav-item nav-top nav-link <?php if ($title == "Hoá đơn") echo "active"; ?>">Hoán đơn</a>
                    <a href="?controller=news&action=news_page_ad" class="nav-item nav-top nav-link <?php if ($title == "Tin tức") echo "active"; ?>">Tin tức</a>
                    <a href="?controller=feedback&action=feedback_page_ad" class="nav-item nav-top nav-link <?php if ($title == "Đánh giá") echo "active"; ?>">Đánh giá</a>
                    <a href="?controller=customer&action=customer_page_ad" class="nav-item nav-top nav-link <?php if ($title == "Khách hàng") echo "active"; ?>">Khách hàng</a>
                    <a href="?controller=pet&action=pet_page_ad" class="nav-item nav-top nav-link <?php if ($title == "PET") echo "active"; ?>">PET</a>
                    <a href="?controller=shop&action=shop_page_ad" class="nav-item nav-top nav-link <?php if ($title == "Thông tin shop") echo "active"; ?>">Thông tin shop</a>
                    <a href="?controller=admin&action=admin_page" class="nav-item nav-top nav-link <?php if ($title == "Admin") echo "active"; ?>">Admin</a>
                </div>
                <?php if (isset($_SESSION['login']) && $_SESSION['login'] == Enum::ADMIN) { ?>
                    <div class="dropdown" id="" style="margin-right:20px">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Thông tin tài khoản</a>
                        <!-- <ul class="dropdown-menu">
                            <li><a href="?controller=customer&action=customer_info" class="dropdown-item">Trang cá nhân</a></li>
                            <li><a href="?controller=pet&action=customer_pet" class="dropdown-item">Thú cưng của bạn</a></li>
                            <li><a href="?controller=bill&action=customer_history" class="dropdown-item">Lịch sử dịch vụ</a></li>
                            <li><a href="?controller=appointment&action=customer_current_apm" class="dropdown-item">Lịch đang hẹn</a></li>
                        </ul> -->
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