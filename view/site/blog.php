<!DOCTYPE html>
<html lang="en">
<?php $title = "Tin tức";?>
<?php include("layout/asset-header.php")?>
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
                <p style="font-weight:bold; margin-bottom:0; color:black">&nbspNhập nội dung tin tức: </p>
                <input type="text" class="form-control border-1" placeholder="VD: Cách nuôi mèo anh lông ngắn..." name="newsKey" id="news-key">
            </div>
            <div>
                <p style="font-weight:bold; margin-bottom:0; color:black">&nbspDanh mục tin tức: </p>
                <select name="categoryNews" id="category-news" class="custom-select" style="width:250px;">
                    <option value="">Tất cả</option>                   
                </select>
            </div>
            <div style="margin-top:10px">
                <button class="btn btn-lg btn-primary btn-block border-0" type="submit">Tìm kiếm</button>
            </div>
        </form>
        <div class="row pb-3" id="data-news">
        </div>
        <div class="row" id="page">
        </div>
    </div>
    <!-- Blog End -->


    <?php include("layout/footer.php")?>


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <?php include("layout/asset-footer.php") ?>
    <script src="asset/js/news/news.js?v=<?php echo time() ?>" async></script>

</body>
</html>