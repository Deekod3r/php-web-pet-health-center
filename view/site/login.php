<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
  <title>Đăng nhập | CarePET</title>
  <link rel="stylesheet" href="asset/login/style.css">
  <link rel="shortcut icon" type="image/png" href="asset/img/icon_web.png"/>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;800&display=swap" rel="stylesheet">
</head>
  <body>
    <div class="main">
      <div class="container b-container" id="b-container">
        <form class="form" id="b-form" method="" action="">
          <h2 class="form_title title">Tạo tài khoản</h2>
          <input class="form__input" type="text" placeholder="Name">
          <input class="form__input" type="text" placeholder="Email">
          <input class="form__input" type="password" placeholder="Password">
          <button class="form__button button submit">ĐĂNG KÝ</button>
        </form>
      </div>
      <div class="container a-container" id="a-container">
        <form class="form" id="a-form" method="post" action="?controller=home&action=login_action">
          <h2 class="form_title title">Chào mừng đến với Care<span style="color:#ED6436">PET</span></h2>
          <input class="form__input" type="text" placeholder="Số điện thoại">
          <input class="form__input" type="password" placeholder="Mật khẩu"><a class="form__link">Quên mật khẩu?</a>
          <button class="form__button button submit">ĐĂNG NHẬP</button>
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
  </body>
</html>

