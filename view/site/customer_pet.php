<!DOCTYPE html>
<html lang="en">
<?php $title = "Thông tin thú cưng"; ?>
<?php include("layout/asset_header.php") ?>

<body>
    <?php include("layout/header.php") ?>

    <div class="container py-5 main" style="margin-bottom:0">
        <h3 class="text-primary mb-3">Thông tin thú cưng</h3>
        <?php if (count($pet) > 0) { ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover table-borderless table-success align-middle">
                    <thead class="">
                        <tr class="color-text">
                            <th scope="col" class="col-lg-2">Mã thú cưng</th>
                            <th scope="col" class="col-lg-2">Tên</th>
                            <th scope="col" class="col-lg-1">Loại</th>
                            <th scope="col" class="col-lg-2">Giống</th>
                            <th scope="col" class="col-lg-1">Giới tính</th>
                            <th scope="col" class="col-lg-4">Ghi chú</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        <?php foreach ($pet as $p) : ?>
                            <tr class="color-text">
                                <td scope="row" class=""><?php echo $p['pet_id'] ?></td>
                                <td><?php echo $p['pet_name'] ?></td>
                                <td><?php if ($p['pet_type'] == Enum::TYPE_CAT) echo "Mèo";
                                    else echo "Chó" ?></td>
                                <td><?php echo $p['pet_species'] ?></td>
                                <td><?php if ($p['pet_gender'] == Enum::GENDER_MALE) echo "Đực";
                                    else echo "Cái" ?></td>
                                <td><?php echo $p['pet_note'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php } else echo "<p style='color:black; font-size: 20px'>Thông tin trống.</p>"; ?>
    </div>

    <?php include("layout/footer.php") ?>

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>
    <?php include("layout/asset_footer.php") ?>
</body>

</html>