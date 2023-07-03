<!DOCTYPE html>
<html lang="en">
<?php include("layout/asset-header.php")?>
<body>
    <?php include("layout/header.php")?>
    <!-- Detail Start -->
    <!-- Detail Start -->
    <div class="container py-5 main">
        <div class="row pt-5">
            <div class="col-lg-8" id="detail-news">
                <div class="d-flex flex-column text-left mb-4">
                    <h4 class="text-secondary mb-3">Tin tức</h4>
                    <h1 class="mb-3 news-title"></h1>
                    <div class="d-index-flex mb-2">
                        <span class="mr-3"><i class="fa fa-user text-muted"></i> Admin</span>
                        <span class="mr-3 category-news"><i class="fa fa-folder text-muted"></i> </span>
                        <span class="mr-3 news-date-release"><i class="fa fa-calendar text-muted"></i> </span>
                    </div>
                </div>
                <div class="mb-5">
                    <img class="img-fluid w-100 mb-4 news-img" src="" alt="Image">
                    <p class="news-content"></p>
                </div>
            </div>

            <div class="col-lg-4 mt-5 mt-lg-0">
                <div class="mb-5">
                    <form action="" onsubmit="return false">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-lg" placeholder="Tìm kiếm">
                            <div class="input-group-append">
                                <span class="input-group-text bg-transparent text-primary">
                                    <i class="fa fa-search"></i>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="mb-5">
                    <h3 class="mb-4">Danh mục tin tức</h3>
                    <ul class="list-group list-category-news">
                    </ul>
                </div>
                <div class="mb-5">
                    <img src="img/blog-1.jpg" alt="" class="img-fluid">
                </div>
                <div class="mb-5 recent-news">
                    <h3 class="mb-4">Bài viết gần đây</h3>
                </div>
            </div>
        </div>
    </div>
    <!-- Detail End -->


    <?php include("layout/footer.php")?>


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <?php include("layout/asset-footer.php") ?>
    <script src="asset/js/news/news-detail.js?v=<?php echo time() ?>" async></script>

</body>

</html>