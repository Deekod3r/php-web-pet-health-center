<!DOCTYPE html>
<html lang="en">
<?php $title = "Tin tức";?>
<?php include("layout/asset_header.php")?>
<body>
    <?php include("layout/header.php")?>
    <!-- Blog Start -->
    <div class="container pt-3 main">
        <div class="d-flex flex-column text-center mb-5 pt-5">
            <h4 class="text-secondary mb-3">Pet Blog</h4>
            <h1 class="display-4 m-0">Tin tức<span class="text-primary"> mới nhất</span></h1>
        </div>
        <form action="" style="margin-bottom: 40px" id="form-search-news">
            <div class="form-group">
                <input type="text" class="form-control border-1" placeholder="Nhập nội dung tin tức" name="newsKey" id="news-key">
            </div>
            <div>
                <p style="font-weight:bold; margin-bottom:0">&nbspDanh mục tin tức: </p>
                <select name="categoryNews" id="category-news" class="custom-select" style="width:250px;">
                    <option value="">Chọn danh mục tin tức</option>
                    <option value="">Tất cả</option>                   
                </select>
            </div>
            <div style="margin-top:10px">
                <button class="btn btn-lg btn-primary btn-block border-0" type="submit">Tìm kiếm</button>
            </div>
        </form>
        <div class="row pb-3" id="dataNews">
            <!-- <div class="col-lg-4 mb-4">
                <div class="card border-0 mb-2">
                    <img class="card-img-top" src="asset/img/blog-1.jpg" alt="">
                    <div class="card-body bg-light p-4">
                        <h4 class="card-title text-truncate text-wrap"><?php //echo $n['news_title']?></h4>
                        <div class="d-flex mb-3">
                            <small class="mr-2"><i class="fa fa-user text-muted"></i> Admin</small>
                            <small class="mr-2"><i class="fa fa-folder text-muted"></i> Danh mục</small>
                            <small class="mr-2"><i class="fa fa-calendar text-muted"></i> <?php //echo $n['news_date_release']?></small>
                        </div>
                        <p style="height:80px" class="text-nowrap"><?php //echo $n['news_description']?></p>
                        <a class="font-weight-bold" href="?controller=news&action=detail_news&id=<?php //echo $n['news_id']?>">Xem chi tiết</a>
                    </div>
                </div>
            </div> -->
            <!-- <div class="col-lg-12">
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
            </div> -->
        </div>
        <div class="row" id="page">
        </div>
    </div>
    <!-- Blog End -->


    <?php include("layout/footer.php")?>


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <?php include("layout/asset_footer.php") ?>
    <script src="asset/js/news/news.js?v=<?php echo time() ?>" async></script>

</body>
</html>