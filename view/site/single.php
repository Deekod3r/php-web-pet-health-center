<!DOCTYPE html>
<html lang="en">
<?php $title = $news['news_title']; $ctr = null;?>
<?php include("layout/asset_header.php")?>
<body>
    <?php include("layout/header.php")?>
    <!-- Detail Start -->
    <div class="container py-5">
        <div class="row pt-5">
            <div class="col-lg-8">
                <div class="d-flex flex-column text-left mb-4">
                    <h4 class="text-secondary mb-3">Tin tức</h4>
                    <h1 class="mb-3"><?php echo $news['news_title'];?></h1>
                    <div class="d-index-flex mb-2">
                        <span class="mr-3"><i class="fa fa-user text-muted"></i> Admin</span>
                        <span class="mr-3"><i class="fa fa-folder text-muted"></i> <?php echo "Danh mục";?></span>
                        <span class="mr-3"><i class="fa fa-calendar text-muted"></i> <?php echo $news['news_date_release'];?></span>
                    </div>
                </div>

                <div class="mb-5">
                    <img class="asset/img-fluid w-100 mb-4" src="asset/img/carousel-1.jpg" alt="Image">
                    <p><?php echo $news['news_content'];?></p>    
                </div>
            </div>

            <div class="col-lg-4 mt-5 mt-lg-0">
                <div class="mb-5">
                    <form action="">
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
                    <ul class="list-group">
                        <?php foreach ($categoryNews as $cn): ?>
                        <?php if ($cn['cn_id'] == $news['cn_id']) $ctr = $cn['cn_name'];?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a class="text-dark mb-2" href=""><?php echo $cn['cn_name']?></a>
                            <span class="badge badge-primary badge-pill">HOT</span>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="mb-5">
                    <h3 class="mb-4">Bài viết gần đây</h3>
                    <?php foreach ($recentNews as $rn): ?>
                    <div class="d-flex align-items-center border-bottom mb-3 pb-3">
                        <!-- <img class="asset/img-fluid" src="asset/img/blog-1.jpg" style="width: 80px; height: 80px;" alt=""> -->
                        <div class="d-flex flex-column pl-3">
                            <a class="text-dark mb-2" href="?controller=news&action=detail_news&id=<?php echo $rn['news_id']?>"><?php echo $rn['news_title'];?></a>
                            <div class="d-flex">
                                <small class="mr-3"><i class="fa fa-user text-muted"></i> Admin</small>
                                <small class="mr-3"><i class="fa fa-folder text-muted"></i> Danh mục</small>
                                <small class="mr-3"><i class="fa fa-comments text-muted"></i> <?php echo $rn['news_date_release'];?></small>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Detail End -->


    <?php include("layout/footer.php")?>


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <?php include("layout/asset_footer.php") ?>
</body>

</html>