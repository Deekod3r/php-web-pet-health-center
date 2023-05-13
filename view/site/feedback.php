<!DOCTYPE html>
<html lang="en">
<?php $title = "Đánh giá";?>
<?php include("layout/asset_header.php")?>
<body>
    <?php include("layout/header.php")?>
    <div class="container py-5 main">
        <div class="mb-5" id="dataFeedback">
            <h3 class="mb-4" id="countFeedback"></h3>
        </div>
        <div class="col-lg-12" id="page">
            <!-- <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center mb-4">
                <li class="page-item disabled">
                    <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo; Previous</span>
                    </a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">Next &raquo;</span>
                    </a>
                </li>
                </ul>
            </nav> -->
        </div>
        <form action="?controller=feedback&action=sendFeedback" method="post">
            <div class="form-group">
                <input type="text" class="form-control border-1" placeholder="Hãy chia sẻ trải nghiệm sử dụng dịch vụ của bạn" name="fbContent"/>
            </div>
            <!-- <img class="img-fluid" src="asset/img/star.png" style="width: 25px; height: 25px; margin-right:5px; margin-left:5px " alt=""> -->
            <div class="form-check" style="display: inline;">
                <input class="form-check-input" type="radio" name="rating" id="rating-1" value=1 required>
                <label class="form-check-label" for="rating-1">
                    1<img class="img-fluid" src="asset/img/star.png" style="width: 18px; height: 18px; margin-right:5px; margin-left:5px;" alt=""> |
                </label>
            </div>
            <div class="form-check" style="display: inline;">
                <input class="form-check-input" type="radio" name="rating" id="rating-2" value=2>
                <label class="form-check-label" for="rating-2">
                    2<img class="img-fluid" src="asset/img/star.png" style="width: 18px; height: 18px; margin-right:5px; margin-left:5px " alt=""> |
                </label>
            </div>
            <div class="form-check" style="display: inline;">
                <input class="form-check-input" type="radio" name="rating" id="rating-3" value=3>
                <label class="form-check-label" for="rating-3">
                    3<img class="img-fluid" src="asset/img/star.png" style="width: 18px; height: 18px; margin-right:5px; margin-left:5px " alt=""> |
                </label>
            </div>
            <div class="form-check" style="display: inline;">
                <input class="form-check-input" type="radio" name="rating" id="rating-4" value=4>
                <label class="form-check-label" for="rating-4">
                    4<img class="img-fluid" src="asset/img/star.png" style="width: 18px; height: 18px; margin-right:5px; margin-left:5px " alt=""> |
                </label>
            </div>
            <div class="form-check" style="display: inline;">
                <input class="form-check-input" type="radio" name="rating" id="rating-5" value=5>
                <label class="form-check-label" for="rating-5">
                    5<img class="img-fluid" src="asset/img/star.png" style="width: 18px; height: 18px; margin-right:5px; margin-left:5px " alt=""> 
                </label>
            </div>
            <div style="margin-top: 10px; margin-bottom: 10px">
                <input class="btn btn-lg btn-primary btn-block border-0" type="submit">
            </div>
            <div class="alert" role="alert" id="mgsSendFeedback">
            </div>
        </form>
    </div>


    <?php include("layout/footer.php")?>


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <?php include("layout/asset_footer.php") ?>
    <script src="asset/js/feedback.js?v=<?php echo time() ?>" async></script>

</body>

</html>