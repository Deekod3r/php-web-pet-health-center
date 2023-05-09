<!DOCTYPE html>
<html lang="en">
<?php $title = "Lịch đang hẹn"; ?>
<?php include("layout/asset_header.php") ?>

<body>
    <?php include("layout/header.php") ?>

    <div class="container py-5 main" style="margin-bottom:0">
        <h3 class="text-primary mb-3">Lịch đang hẹn</h3>
        <?php if (isset($_SESSION['check_cancel_apm'])):?>
        <div class="alert <?php if (!$_SESSION['check_cancel_apm']) echo ' alert-danger '; else echo ' alert-success' ?>" role="alert">
            <?php echo $_SESSION['msg_cancel_apm']?>
        </div>
        <?php endif;
            $_SESSION['msg_cancel_apm'] = null;
            $_SESSION['check_cancel_apm'] = null;
        ?>
        <?php if (count($appointment) > 0) { ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover table-borderless table-success align-middle">
                    <thead class="">
                        <tr class="color-text">
                            <th scope="col">Mã lịch hẹn</th>
                            <th scope="col">Ngày hẹn</th>
                            <th scope="col">Giờ hẹn</th>
                            <th scope="col">Dịch vụ</th>
                            <th scope="col">Ghi chú</th>
                            <th scope="col">Trạng thái</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="color-text">
                        <?php foreach ($appointment as $a) : ?>
                            <tr class="">
                                <td scope="row" class=""><?php echo $a['apm_id'] ?></td>
                                <td><?php echo $a['apm_date'] ?></td>
                                <td><?php echo $a['apm_time'] ?></td>
                                <td><?php echo $a['cs_id'] ?></td>
                                <td><?php echo $a['apm_note'] ?></td>
                                <td><?php if ($a['apm_status'] == Enum::STATUS_APPOINTMENT_CONFIRMED_NO) echo "Chờ xác nhận";
                                    else if ($a['apm_status'] == Enum::STATUS_APPOINTMENT_CONFIRMED_YES) echo "Đã xác nhận";
                                    else if ($a['apm_status'] == Enum::STATUS_APPOINTMENT_CANCEL) echo "Đã huỷ";
                                    else echo "Hoàn thành"; ?></td>
                                <?php if ($a['apm_status'] != Enum::STATUS_APPOINTMENT_CONFIRMED_YES) { ?>
                                    <td>
                                        <form method="post" action="?controller=appointment&action=cancel_appointment" onsubmit="return confirmAction('huỷ','lịch hẹn')">
                                            <input type="hidden" name="id_apm" value="<?php echo $a['apm_id'] ?>">
                                            <input type="hidden" name="id_ctm" value="<?php echo $_SESSION['id'] ?>">
                                            <button class="btn btn-danger">Huỷ</button>
                                        </form>
                                    </td>
                                <?php } else echo "<td></td>" ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php } else echo "<p style='color:black; font-size: 20px'>Lịch hẹn trống.</p>"; ?>
    </div>

    <?php include("layout/footer.php") ?>


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>
    
    <?php include("layout/asset_footer.php") ?>
</body>

</html>