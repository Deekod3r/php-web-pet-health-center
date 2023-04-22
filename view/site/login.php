<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
  <title>Đăng nhập | CarePET</title>
  <link rel="stylesheet" href="asset/login/style.css">
  <link rel="shortcut icon" type="image/png" href="asset/img/icon_web.png"/>
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;800&display=swap" rel="stylesheet">
</head>
  <body>
    <div class="main">
      <div class="container a-container" id="a-container">
        <form class="form" id="a-form" method="post" action="?controller=home&action=login_action">
          <h2 class="form_title title">Chào mừng đến với Care<span style="color:#ED6436">PET</span></h2>
          <input class="form__input" type="text" placeholder="Số điện thoại" name="phone">
          <input class="form__input" type="password" placeholder="Mật khẩu" name="password">
          <a class="form__link">Quên mật khẩu?</a>
          <button class="form__button button submit" id="login" type="submit">ĐĂNG NHẬP</button>
        </form>
        <div class="">
            <p id="msg"></p>
        </div>
      </div>
      <div class="container b-container" id="b-container">
        <form class="form" id="b-form" method="" action="">
          <h2 class="form_title title">Tạo tài khoản</h2>
          <input class="form__input" type="text" placeholder="Name">
          <input class="form__input" type="text" placeholder="Email">
          <input class="form__input" type="password" placeholder="Password">
          <button class="form__button button submit" id="register">ĐĂNG KÝ</button>
        </form>
      </div>
      <div class="switch" id="switch-cnt">
        <div class="switch__circle"></div>
        <div class="switch__circle switch__circle--t"></div>
        <div class="switch__container" id="switch-c1">
          <h2 class="switch__title title">Hello Friend !</h2>
          <p class="switch__description description" style="color:black">Nhập thông tin và tạo tài khoản.</p>
          <button class="switch__button button switch-btn">ĐĂNG KÝ</button>
        </div>
        <div class="switch__container is-hidden" id="switch-c2">
          <h2 class="switch__title title">Welcome Back !</h2>
          <p class="switch__description description" style="color:black">Đăng nhập vào hệ thống bằng tài khoản đã đăng ký.</p>
          <button class="switch__button button switch-btn">ĐĂNG NHẬP</button>
        </div>
      </div>
    </div>
    <script src="asset/login/script.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script> -->
  </body>
</html>

