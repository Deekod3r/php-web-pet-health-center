<!doctype html>
<html lang="en">
<?php $title = "Thông tin shop" ?>
<?php include("view/admin/layout/asset-header.php") ?>

<body>
    <?php include("view/admin/layout/header.php") ?>
    <div class="container main-admin">
        <form class="" id="form-data-shop" method="post">
            <h3 class="mb-3 text-primary">Thông tin shop</h3>
            <div class="row g-3">
                <div class="col-4 mt-3">
                    <label for="" class="form-label mb-0">Tên shop</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa-sharp fa-solid fa-shield-dog text-secondary fa-xl" style="color: #ed6436; font-size:25px;"></i>
                        </span>
                        <input type="text" class="form-control" id="shop-name" name="shopName" placeholder="" style="width:250px; display:inline">
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <label for="" class="form-label mb-0">Mô tả</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa-sharp fa-solid fa-shield-dog text-secondary fa-xl" style="color: #ed6436; font-size:25px;"></i>
                        </span>
                        <textarea rows=5 type="text" class="form-control" id="shop-desc" name="shopDesc" placeholder="" value=""></textarea>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <label for="" class="form-label mb-0">Địa chỉ</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa-sharp fa-solid fa-shield-dog text-secondary fa-xl" style="color: #ed6436; font-size:25px;"></i>
                        </span>
                        <textarea rows=3 type="text" class="form-control" id="shop-address" name="shopAddress" placeholder="" value=""></textarea>
                    </div>
                </div>
                <div class="col-4 mt-3">
                    <label for="" class="form-label mr-2  mb-0">Số điện thoại</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa-sharp fa-solid fa-shield-dog text-secondary fa-xl" style="color: #ed6436; font-size:25px;"></i>
                        </span>
                        <input type="text" class="form-control" id="shop-phone" name="shopPhone" placeholder="" style="width:250px; display:inline">
                    </div>
                </div>
                <div class="col-4 mt-3">
                    <label for="" class="form-label mr-2  mb-0">Email</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa-sharp fa-solid fa-shield-dog text-secondary fa-xl" style="color: #ed6436; font-size:25px;"></i>
                        </span>
                        <input type="text" class="form-control" id="shop-mail" name="shopMail" placeholder="" style="width:250px; display:inline">
                    </div>
                </div>
                <div class="col-6 mt-3">
                    <label for="" class="form-label mr-2  mb-0">Facebook</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa-sharp fa-solid fa-shield-dog text-secondary fa-xl" style="color: #ed6436; font-size:25px;"></i>
                        </span>
                        <input type="text" class="form-control" id="shop-facebook" name="shopFacebook" placeholder="" style="width:250px; display:inline">
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
                <button class="col-12 btn btn-primary" type="submit" id="submit">Lưu</button>
            </div>
            <div class="alert mt-3 mr-1 ml-1" role="alert" style="display: none" id="msg-shop"></div>
        </form>
    </div>
    <?php include("view/admin/layout/asset-footer.php") ?>
    <script src="asset/admin/js/shop.js?v=<?php echo time() ?>" async></script>
</body>

</html>