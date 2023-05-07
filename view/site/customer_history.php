<!DOCTYPE html>
<html lang="en">
<?php $title = "Lịch sử dịch vụ"; ?>
<?php include("layout/asset_header.php") ?>

<body>
    <?php include("layout/header.php") ?>

    <div class="container py-5 main" style="margin-bottom:0">
        <h3 class="text-primary mb-3">Lịch sử sử dụng dịch vụ</h3>
        <?php if (count($bill) > 0) { ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover table-borderless table-success align-middle">
                    <thead class="">
                        <tr class="color-text">
                            <th scope="col">Mã hoá đơn</th>
                            <th scope="col">Thời gian</th>
                            <th scope="col">Mã giảm giá</th>
                            <th scope="col">Tạm tính</th>
                            <th scope="col">Giảm giá</th>
                            <th scope="col">Tổng tiền</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody class="color-text">
                        <?php foreach ($bill as $b) : ?>
                            <tr class="">
                                <td scope="row" class=""><?php echo $b['bill_id'] ?></td>
                                <td><?php echo $b['bill_date_release'] ?></td>
                                <td><?php if ($b['dc_code'] != null) echo $b['dc_code'];
                                    else echo "Không" ?></td>
                                <td><?php echo number_format($b['value_temp'], 0, ',', '.') ?> VND</td>
                                <td><?php echo number_format($b['value_reduced'], 0, ',', '.') ?> VND</td>
                                <td><?php echo number_format($b['total_value'], 0, ',', '.') ?> VND</td>
                                <td><a style="font-weight:600" href="<?php echo $b['bill_id'] ?>">Xem chi tiết</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php } else echo "<p style='color:black; font-size: 20px'>Lịch sử trống.</p>"; ?>
    </div>


    <?php include("layout/footer.php") ?>

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <?php include("layout/asset_footer.php") ?>
</body>

</html>