<!DOCTYPE html>
<html lang="en">
<?php $title = "Đánh giá";?>
<?php include("layout/asset-header.php")?>
<body>
    <?php include("layout/header.php")?>
    <div class="container py-5 main">
        <h3 class="mb-4" id="countFeedback"></h3>
        <div class="mb-5" id="data-feedback">
        </div>
        <div class="col-lg-12" id="page">
        </div>
        <div class='alert ' role='alert' id='msg-send-feedback' style='display:none'></div>
        <div id="form">
        </div>
    </div>

    <?php include("layout/footer.php")?>

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <?php include("layout/asset-footer.php") ?>
    <script src="asset/js/feedback.js?v=<?php echo time() ?>" async></script>

</body>

</html>