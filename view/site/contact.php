<!DOCTYPE html>
<html lang="en">
<?php $title = "Liên hệ";?>
<?php include("layout/asset-header.php")?>
<body>
    <?php include("layout/header.php")?>
    <!-- Contact Start -->
    <div class="container-fluid pt-3 main" style="margin-bottom:0">
        <div class="d-flex flex-column text-center mb-5 pt-5">
            <h4 class="text-secondary mb-3">Liên hệ</h4>
            <h1 class="display-4 m-0">Hòm thư<span class="text-primary"> góp ý</span></h1>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-sm-8 mb-5">
                <div class="contact-form">
                    <div id="success"></div>
                    <form name="sentMessage" id="contactForm" novalidate="novalidate">
                        <div class="control-group">
                            <p style="margin-bottom:0; font-weight:bold; font-size: 18px">Họ và tên</p>
                            <input type="text" class="form-control p-4" id="name" placeholder="" required="required" data-validation-required-message="* Họ và tên trống."/>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <p style="margin-bottom:0; font-weight:bold; font-size: 18px">Số điện thoại</p>
                            <input type="text" class="form-control p-4" id="phone" placeholder="" required="required" data-validation-required-message="* Số điện thoại trống."/>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <p style="margin-bottom:0; font-weight:bold; font-size: 18px">Địa chỉ</p>
                            <input type="text" class="form-control p-4" id="address" placeholder="" required="required" data-validation-required-message="* Địa chỉ trống." />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <p style="margin-bottom:0; font-weight:bold; font-size: 18px">Nội dung</p>
                            <textarea class="form-control p-4" rows="6" id="message" placeholder="" required="required" data-validation-required-message="* Nội dung trống."></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div>
                            <button class="btn btn-primary py-3 px-5" type="submit" id="sendMessageButton">Gửi</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-12 mb-n2 p-0">
                <iframe style="width: 100%; height: 500px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.717704117159!2d105.83723038559408!3d21.00395013872537!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ad6a577c253d%3A0xa16adece9b90cf0!2zNTUgR2nhuqNpIFBow7NuZywgxJDhu5NuZyBUw6JtLCBIYWkgQsOgIFRyxrBuZywgSMOgIE7hu5lpIDEwMDAwMCwgVmlldG5hbQ!5e0!3m2!1sen!2sbd!4v1682064404962!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
        </div>
    </div>
    <!-- Contact End -->


    <?php include("layout/footer.php")?>


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <?php include("layout/asset-footer.php") ?>
    <script src="asset/js/about-contact.js?v=<?php echo time() ?>" async></script>

</body>

</html>