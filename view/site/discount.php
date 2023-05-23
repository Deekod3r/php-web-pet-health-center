<!DOCTYPE html>
<html lang="en">
<?php $title = "Khuyến mại"; ?>
<?php include("layout/asset-header.php") ?>

<body>
    <?php include("layout/header.php") ?>

    <div class="container pt-3 main">
        <div class="d-flex flex-column text-center mb-5 pt-5">
            <h4 class="text-secondary mb-3">Pet Deals</h4>
            <h1 class="display-4 m-0">Khuyến mại<span class="text-primary"> hot nhất</span></h1>
        </div>
        <div class="row pb-3" id="data-discount">
        </div>
        <div class="row" id="page">
        </div>
    </div>

    <?php include("layout/footer.php") ?>
    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>
    <?php include("layout/asset-footer.php") ?>
    <script src="asset/js/discount.js?v=<?php echo time() ?>" async></script>

</body>

</html>