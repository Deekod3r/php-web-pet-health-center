<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link rel="shortcut icon" type="image/png" href="asset/img/icon_web.png" />
  <title>Đăng nhập | CarePET</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
  <link rel="stylesheet" href="asset/css/signin-signup.css?v=<?php echo time();?>">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
  
  <div class="container">
    <div class="forms">
      <div class="form login">
        <div class="login-signup" style="margin-top:0px; margin-bottom:10px">
          <i class="fa-sharp fa-solid fa-shield-dog text-secondary mr-2 fa-xl"  style="color: #ed6436; font-size:30px; margin-left:5px"></i>
          <a class="title" href="?controller=home&action=index" style="font-size:18px;">CarePET</a>
          <i class="fa-sharp fa-solid fa-shield-cat text-secondary mr-2 fa-xl"  style="color: #ed6436; font-size:30px; margin-left:5px"></i>
          <!-- <i class="fa-solid fa-paw" style="color: #ed6436; font-size:30px; margin-left:5px"></i>         -->
        </div>
        <span class="title">Đăng nhập</span>
        <form action="?controller=home&action=login_action" method="post" name="login" id="login">
          <div class="input-field">
            <input type="text" placeholder=" " class="form-input" name="lgUsername" id="lg-username">
            <label for="" class="form-active" style="font-size:15px; color: #ED6436;">&nbspTên tài khoản hoặc số điện thoại</label>
            <i class="uil uil-user icon"></i>
          </div>
          <div class="input-field">
            <input type="password" class="form-input password" placeholder=" " name="lgPassword" id="lg-password">
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
            <input id="btn-login" type="submit" value="Đăng nhập">
          </div>
        </form>
        <div class="login-signup">
          <span class="text" style="font-size:15px">Bạn chưa có tài khoản?
            <a href="#" class="text signup-link">Đăng ký ngay</a>
          </span>
        </div>
        <div class="login-signup">
          <span class="text" id="msg-login" style="font-size:15px; color: red; font-weight:600"></span>
        </div>
      </div>

      <div class="form signup">
        <div class="login-signup" style="margin-top:0px; margin-bottom:10px">
          <i class="fa-sharp fa-solid fa-shield-dog text-secondary mr-2 fa-xl"  style="color: #ed6436; font-size:30px; margin-left:5px"></i>
          <a class="title" href="?controller=home&action=index" style="font-size:18px;">CarePET</a>
          <i class="fa-sharp fa-solid fa-shield-cat text-secondary mr-2 fa-xl"  style="color: #ed6436; font-size:30px; margin-left:5px"></i>
          <!-- <i class="fa-solid fa-paw" style="color: #ed6436; font-size:30px; margin-left:5px"></i>         -->
        </div>
        <span class="title">Đăng ký</span>
        <form action="?controller=customer&action=register" name="register" id="register" method="POST">
          <div class="input-field">
            <input type="text" placeholder=" " class="form-input" name="rgName" id="rg-name">
            <label class="form-active" for="" style="font-size:15px; color: #ED6436;">&nbspHọ và tên</label>
            <i class="uil uil-user"></i>
          </div>
          <!-- <div class="input-field">
            <input type="email" placeholder=" " class="form-input " name="rgEmail" id="rg-email">
            <label class="form-active" for="" style="font-size:15px; color: #ED6436;">&nbspEmail</label>
            <i class="uil uil-envelope icon"></i>
          </div> -->
          <div class="input-field">
            <input type="text" placeholder=" " class="form-input " name="rgPhone" id="rg-phone">
            <label class="form-active" for="" style="font-size:15px; color: #ED6436;">&nbspSố điện thoại</label>
            <i class="uil uil-phone"></i>
          </div>
          <div class="input-field">
            <input type="text" placeholder=" " class="form-input " name="rgAddress" id="rg-address">
            <label class="form-active" for="" style="font-size:15px; color: #ED6436;">&nbspĐịa chỉ</label>
            <i class="uil uil-location-pin-alt"></i>
          </div>
          <div class="input-field">
            <input type="text" placeholder=" " class="form-input password" name="rgPassword" id="rg-password">
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
            <h4 class="mb-2 pb-1" style="font-size:15px; color: #ED6436;">Giới tính: </h4>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="rgGender" id="rg-gender-male" value="1" />
              <label class="form-check-label" for="maleGender" style="font-size:15px; color: #ED6436;">Nam</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="rgGender" id="rg-gender-female" value="0" />
              <label class="form-check-label" for="femaleGender" style="font-size:15px; color: #ED6436;">Nữ</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="rgGender" id="rg-gender-other" value="2" />
              <label class="form-check-label" for="otherGender" style="font-size:15px; color: #ED6436;">Khác</label>
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
        <div class="login-signup">
          <span class="text" id="msg-register" style="font-size:15px; color: red; font-weight:600"></span>
        </div>
      </div>
    </div>
  </div>
  <script src="https://kit.fontawesome.com/ddac631aed.js" crossorigin="anonymous"></script>
  <script src="asset/js/script.js?v=<?php echo time()?>"></script>
  <script src="asset/js/signin-signup.js?v=<?php echo time()?>"></script>


</body>

</html>