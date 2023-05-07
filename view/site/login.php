<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link rel="shortcut icon" type="image/png" href="asset/img/icon_web.png" />
  <title>Đăng nhập | CarePET</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
  <link rel="stylesheet" href="asset/css/signin-signup.css?v=<?php echo time();?>">
  <script src="https://kit.fontawesome.com/ddac631aed.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="asset/js/signin-up-jquery.js">
  </script>
</head>

<body>
  <div class="container <?php if (isset($_SESSION['msg_register']) && isset($_SESSION['check_register'])) echo 'active'?>">
    <div class="forms">
      <div class="form login">
        <span class="title">Đăng nhập</span>
        <i class="fa-solid fa-paw" style="color: #ed6436; font-size:30px; margin-left:5px"></i>        
        <form action="?controller=home&action=login_action" method="post" name="login" id="login">
          <div class="input-field">
            <input type="text" placeholder=" " class="form-input" name="lg-phone" id="lg-phone">
            <label for="" class="form-active" style="font-size:15px; color: #ED6436;">&nbspTên tài khoản hoặc số điện thoại</label>
            <i class="uil uil-user icon"></i>
          </div>
          <div class="input-field">
            <input type="password" class="form-input password" placeholder=" " name="lg-password" id="lg-password">
            <label for="" class="form-active" style="font-size:15px; color: #ED6436;">&nbspMật khẩu</label>
            <i class="uil uil-lock icon"></i>
            <i class="uil uil-eye-slash showHidePw"></i>
          </div>
          <div class="checkbox-text">
            <div class="checkbox-content">
              <input style="color: #ED6436;" type="checkbox" id="logCheck">
              <p for="logCheck" class="text">Ghi nhớ đăng nhập</p>
            </div>
            <a href="#" class="text">Quên mật khẩu?</a>
          </div>
          <div class="input-field button">
            <input type="submit" value="Đăng nhập">
          </div>
        </form>
        <div class="login-signup">
          <span class="text" style="font-size:15px">Bạn chưa có tài khoản?
            <a href="#" class="text signup-link">Đăng ký ngay</a>
          </span>
        </div>
        <?php if (isset($_SESSION['msg_login']) && isset($_SESSION['check_login']) && !$_SESSION['check_login']): ?>
        <div class="login-signup">
          <span class="text" id="msg-login" style="font-size:15px; color: red; font-weight:600"><?php echo $_SESSION['msg_login']?></span>
        </div>
        <?php endif;
          $_SESSION['msg_login'] = null;
          $_SESSION['check_login'] = null;
        ?>
      </div>

      <div class="form signup">
        <span class="title">Đăng ký</span>
        <i class="fa-solid fa-paw" style="color: #ed6436; font-size:30px; margin-left:5px"></i>        
        <form action="?controller=customer&action=register" name="register" id="register" method="POST">
          <div class="input-field">
            <input type="text" placeholder=" " class="form-input" name="rg-name" id="rg-name">
            <label class="form-active" for="" style="font-size:15px; color: #ED6436;">&nbspHọ và tên</label>
            <i class="uil uil-user"></i>
          </div>
          <div class="input-field">
            <input type="text" placeholder=" " class="form-input " name="rg-email" id="rg-email">
            <label class="form-active" for="" style="font-size:15px; color: #ED6436;">&nbspEmail</label>
            <i class="uil uil-envelope icon"></i>
          </div>
          <div class="input-field">
            <input type="text" placeholder=" " class="form-input " name="rg-phone" id="rg-phone">
            <label class="form-active" for="" style="font-size:15px; color: #ED6436;">&nbspSố điện thoại</label>
            <i class="uil uil-phone"></i>
          </div>
          <div class="input-field">
            <input type="text" placeholder=" " class="form-input " name="rg-address" id="rg-address">
            <label class="form-active" for="" style="font-size:15px; color: #ED6436;">&nbspĐịa chỉ</label>
            <i class="uil uil-location-pin-alt"></i>
          </div>
          <div class="input-field">
            <input type="text" placeholder=" " class="form-input password" name="rg-password" id="rg-password">
            <label class="form-active" for="" style="font-size:15px; color: #ED6436;">&nbspMật khẩu</label>
            <i class="uil uil-lock icon"></i>
            <i class="uil uil-eye-slash showHidePw"></i>
          </div>
          <div class="input-field">
            <input type="text" placeholder=" " class="form-input password"  id="rg-confirm-password">
            <label class="form-active" for="" style="font-size:15px; color: #ED6436;">&nbspXác nhận mật khẩu</label>
            <i class="uil uil-lock icon"></i>
            <i class="uil uil-eye-slash showHidePw"></i>
          </div>
          <div class="Gender">
            <h4 class="mb-2 pb-1">Giới tính: </h4>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="rg-gender" id="rg-gender-male" value="1" />
              <label class="form-check-label" for="maleGender">Nam</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="rg-gender" id="rg-gender-female" value="0" />
              <label class="form-check-label" for="femaleGender">Nữ</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="rg-gender" id="rg-gender-other" value="2" />
              <label class="form-check-label" for="otherGender">Khác</label>
            </div>
          </div>
          <div class="input-field button">
            <input type="submit" value="Đăng ký">
          </div>
        </form>
        <div class="login-signup">
          <span class="text" style="font-size:15px">Bạn đã có tài khoản?
            <a href="#" class="text login-link">Đăng nhập ngay</a>
          </span>
        </div>
        <?php if (isset($_SESSION['msg_register']) && isset($_SESSION['check_register'])): ?>
        <div class="login-signup">
          <span class="text" id="msg-register" style="font-size:15px; <?php if (!$_SESSION['check_register']) echo ' color: red; '; else echo ' color: green; ' ?> font-weight:600"><?php echo $_SESSION['msg_register']?></span>
        </div>
        <?php endif;
          $_SESSION['msg_register'] = null;
          $_SESSION['check_register'] = null;
        ?>
      </div>
    </div>
  </div>

  <script src="asset/js/signin-up.js"></script>
  <script src="asset/js/script.js"></script>

</body>

</html>