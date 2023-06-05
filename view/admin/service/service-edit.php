<!doctype html>
<html lang="en">
<?php $title = "Dịch vụ" ?>
<?php include("view/admin/layout/asset-header.php") ?>

<body>
    <?php include("view/admin/layout/header.php") ?>
    <div class="container main-admin mb-5">
        <form class="" id="form-edit-service" enctype="multipart/form-data" method="post" action="?controller=service&action=add_service">
            <h3 class="mb-3 text-primary">Sửa dịch vụ</h3>
            <div class="row g-3">
                <input type="hidden" id="service-id">
                <div class="col-12">
                    <label for="" class="form-label mb-0">Tên dịch vụ</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa-sharp fa-solid fa-shield-dog text-secondary fa-xl" style="color: #ed6436; font-size:25px;"></i>
                        </span>
                        <textarea type="text" class="form-control" id="service-name" name="svName" placeholder="" value=""></textarea>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <label for="" class="form-label mb-0">Mô tả</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa-sharp fa-solid fa-shield-cat text-secondary fa-xl" style="color: #ed6436; font-size:25px;"></i>
                        </span>
                        <textarea type="text" class="form-control" id="service-description" name="svDescription"  placeholder="" value=""></textarea>
                    </div>
                </div>
                <div class="col-5 mt-3">
                    <label for="" class="form-label mr-2">Phân loại</label>
                    <select name="typePet" id="type-pet" class="custom-select" style="width:250px;">
                        <option value="">Chọn</option>
                        <option value="0">Mèo</option>
                        <option value="1">Chó</option>
                        <option value="2">Chó và mèo</option>
                    </select>
                </div>
                <div class="col-5 mt-3">
                    <label for="" class="form-label mr-2">Danh mục</label>
                    <select name="categoryService" id="category-service" class="custom-select" style="width:250px;">
                        <option value="">Chọn</option>
                    </select>
                </div>
                <div class="col-5 mt-3">
                    <label for="" class="form-label mr-2">Trạng thái</label>
                    <select name="svStatus" id="service-status" class="custom-select" style="width:250px;">
                        <option value="">Chọn</option>
                        <option value="1">Hoạt động</option>
                        <option value="0">Tạm dừng</option>
                    </select>
                </div>
                <div class="col-4 mt-3">
                    <label for="" class="form-label mr-2">Giá tiền</label>
                    <input type="number" class="form-control" id="service-price" name="svPrice"  placeholder="" style="width:250px; display:inline">
                </div>
                <div class="col-7 mt-3">
                    <label for="" class="form-label">Hình ảnh</label>
                    <input class="form-control border-0" type="file" id="service-img" name="svImg" style="width:350px; display:inline" onchange="preview()">
                </div>
                <div class="col-7 mt-1 mb-1">
                    <button onclick="clearImage()" class="btn btn-primary" type="button" id="clear-img" style="display:none">Xoá ảnh</button>
                    <div class="mt-1">
                        <img id="frame" src="" class="img-thumbnail" width="30%" height="30%" style="display: none"/>
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
                <button class="col-5 btn btn-primary" type="button" id="reset">Làm mới</button>
            </div>
            <div class="alert alert-danger mt-3 mr-1 ml-1" role="alert" style="display: none" id="msg-service"></div>
        </form>
    </div>
    <?php include("view/admin/layout/asset-footer.php") ?>
    <script src="asset/admin/js/service/service-edit.js?v=<?php echo time() ?>" async></script>
</body>

</html>