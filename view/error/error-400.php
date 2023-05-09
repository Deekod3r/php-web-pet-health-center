<title>Yêu cầu gặp vấn đề | CarePET</title>
<link rel="shortcut icon" type="image/png" href="asset/img/icon_web.png"/>
<style>
    body {
  background-color: #f1fdfd;
  /*background-image: url(https://www.justcolor.net/wp-content/uploads/sites/1/nggallery/doodle-art-doodling/coloring-page-adults-doodle-art-rachel.jpg);*/
  background-size: cover;
}
.err-status {
  text-align: center;
  color: #00c3cf;
}
.err-status__num {
  text-align: center;
  font-size: 20rem;
  color: rgba(197, 244, 250, 1);
  position: relative;
  margin: 0;
}
.err-status__num:after{
  content: attr(data-num);
  position: absolute;
  color: #00c7d7;
  font-size: 15rem;
  transform: translate(-420px, 40px);
}

.err-status__title {
  color: #41535d;
  font-size: 2rem;
  text-transform: uppercase;
  margin: 0
}
.err-status__desc {
  color: #c4d4d7;
  font-size: 1.1rem;
  margin-bottom: 40px;
}
.err-status__link {
  display: inline-block;
  background-color: #00c3cf;
  color: #fff;
  padding: 10px 20px;
  border-radius: 6px;
  text-decoration: none;
}
</style>
<div class="err-status">
  <h1 data-num="400" class="err-status__num">400</h1>
  <h2 class="err-status__title">BAD REQUEST</h2>
  <p class="err-status__desc">YÊU CẦU CỦA BẠN ĐANG GẶP VẤN ĐỀ</p>
  <a href="?controller=home&action=index" class="err-status__link">BACK TO HOME</a>
</div>