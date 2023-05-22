<!doctype html>
<html lang="en">
<?php $title = "Trang chủ" ?>
<?php include("view/admin/layout/asset-header.php") ?>

<body>
    <?php include("view/admin/layout/header.php") ?>
    <div class="container main">
        <h1>trang chủ</h1>        
        <?php $role = enum::ROLE_MANAGER;?>
        <h1><?php echo $_SESSION['ad'.$role]?></h1>
    </div>
    <?php include("view/admin/layout/asset-footer.php") ?>
</body>

</html>