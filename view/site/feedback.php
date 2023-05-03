<!DOCTYPE html>
<html lang="en">
<?php $title = "Đánh giá";?>
<?php include("layout/asset_header.php")?>
<body>
    <?php include("layout/header.php")?>
    <div class="container py-5">
        <div class="mb-5">
            <h3 class="mb-4"><?php echo count($feedback)?> Đánh giá</h3>
            <?php foreach($feedback as $fb): ?>
            <div class="media mb-4">
                <img src="asset/img/customer.png" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                <div class="media-body">
                    <h6 style="margin-bottom:0">Ẩn danh | <small><?php echo $fb['fb_time']?></small></h6>
                    <?php for ($i = 0; $i < $fb['fb_rating']; $i++):?>
                        <span style="font-size: 20px;"><img class="img-fluid" src="asset/img/star.png" style="width: 15px; height: 15px; display: inline" alt=""></span>
                        <?php endfor;?>
                        <?php for ($i = $fb['fb_rating']; $i < 5; $i++):?>
                        <span style="font-size: 20px;"><img class="img-fluid" src="asset/img/non-star.png" style="width: 13px; height: 13px; display: inline" alt=""></span>
                    <?php endfor;?>
                    <p><?php echo $fb['fb_content']?></p>
                    <!-- <button class="btn btn-sm btn-light"></button> -->
                </div>
            </div>
            <?php endforeach;?>
        </div>
        <div class="col-lg-12">
                <nav aria-label="Page navigation">
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
                </nav>
            </div>
        <form action="" method="post">
            <div class="form-group">
                <input type="text" class="form-control border-1" placeholder="Hãy chia sẻ trải nghiệm sử dụng dịch vụ của bạn" required/>
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
                <input class="form-check-input" type="radio" name="rating" id="rating-4" value=5>
                <label class="form-check-label" for="rating-5">
                    5<img class="img-fluid" src="asset/img/star.png" style="width: 18px; height: 18px; margin-right:5px; margin-left:5px " alt=""> 
                </label>
            </div>
            <div style="margin-top: 10px">
                <input class="btn btn-lg btn-primary btn-block border-0" type="submit" <?php if (isset($_SESSION['login']) && $_SESSION['login'] && $_SESSION['can_feedback']) {echo "value='Gửi'";} else echo "disabled value='Hãy sử dụng dịch vụ của CarePET và quay lại đánh giá sau nhé!'";?>>
            </div>
        </form>
    </div>


    <?php include("layout/footer.php")?>


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <?php include("layout/asset_footer.php") ?>
</body>

</html>