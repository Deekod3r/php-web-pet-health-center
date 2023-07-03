<!doctype html>
<html lang="en">
<?php $title = "Tin tức" ?>
<?php include "view/admin/layout/asset-header.php" ?>

<body>
    <?php include "view/admin/layout/header.php" ?>
    <div class="container-fluid main-admin mb-5">
        <form class="" id="form-edit-news" method="post" enctype="multipart/form-data">
            <h3 class="mb-3 text-primary">Sửa tin tức</h3>
            <div class="row g-3">
                <input type="hidden" id="news-id">
                <div class="col-6">
                    <label for="" class="form-label mb-0">Tiêu đề</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa-sharp fa-solid fa-shield-dog text-secondary fa-xl" style="color: #ed6436; font-size:25px;"></i>
                        </span>
                        <textarea type="text" class="form-control" id="news-title" name="newsTitle" placeholder="" value=""></textarea>
                    </div>
                </div>
                <div class="col-6">
                    <label for="" class="form-label mb-0">Mô tả</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa-sharp fa-solid fa-shield-dog text-secondary fa-xl" style="color: #ed6436; font-size:25px;"></i>
                        </span>
                        <textarea type="text" class="form-control" id="news-desc" name="newsDesc" placeholder="" value=""></textarea>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <label for="" class="form-label mb-0">Nội dung</label>
                    <textarea type="text" class="form-control" id="news-content" name="newsContent" placeholder="" value=""></textarea>
                    <script>
                        CKEDITOR.replace('newsContent');
                    </script>
                </div>
                <div class="col-5 mt-3">
                    <label for="" class="form-label mr-2">Danh mục</label>
                    <select name="categorynews" id="category-news" class="custom-select" style="width:250px;">
                        <option value="">Chọn</option>
                    </select>
                </div>
                <div class="col-5 mt-3">
                    <label for="" class="form-label mr-2">Trạng thái</label>
                    <select name="newsStatus" id="news-status" class="custom-select" style="width:250px;">
                        <option value="">Chọn</option>
                        <option value="1">Công khai</option>
                        <option value="0">Ẩn</option>
                    </select>
                </div>
                <div class="col-7 mt-3">
                    <label for="" class="form-label">Hình ảnh</label>
                    <input class="form-control border-0" type="file" id="news-img" name="newsImg" style="width:350px; display:inline" onchange="preview()">
                </div>
                <div class="col-7 mt-1 mb-1">
                    <button onclick="clearImage()" class="btn btn-primary" type="button" id="clear-img" style="display:none">Xoá ảnh</button>
                    <div class="mt-1">
                        <img id="frame" src="" class="img-thumbnail" width="30%" height="30%" style="display: none" />
                    </div>
                </div>
            </div>
            <!-- <hr class="my-4">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="same-address">
                <label class="form-check-label" for="same-address">Shipping address is the same as my billing address</label>
            </div> -->
            <hr class="my-4">
            <div class="row mr-1 ml-1">
                <button class="col-5 btn btn-primary" type="submit" id="submit">Lưu</button>
                <p class="col-lg-2"></p>
                <button class="col-5 btn btn-primary" type="reset" onclick="clearImage()">Làm mới</button>
            </div>
            <div class="alert alert-danger mt-3 mr-1 ml-1" role="alert" style="display: none" id="msg-news"></div>
        </form>
    </div>
    <?php include("view/admin/layout/asset-footer.php") ?>
    <script>
        function preview() {
            frame.src = URL.createObjectURL(event.target.files[0]);
            $('#frame').show();
            $('#clear-img').show();
        }

        function clearImage() {
            document.getElementById('news-img').value = null;
            frame.src = "";
            $('#frame').hide();
            $('#clear-img').hide();
        }
    </script>
    <script src="asset/admin/js/news/news-edit.js?v=<?php echo time() ?>" async></script>
</body>

</html>