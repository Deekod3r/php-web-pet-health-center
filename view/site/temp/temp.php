// pet infor - customer
<div class="col-lg-7 pb-5 pb-lg-0 px-3 px-lg-5">
<?php  if (count($pet) > 0) { ?>
    <?php  foreach($pet as $p): ?>
    <h5 class="text-muted mb-3"><b>Mã thú cưng:</b> <?php echo $p['pet_id']?></h5>
    <h5 class="text-muted mb-3"><b>Tên:</b> <?php echo $p['pet_name']?></h5>
    <h5 class="text-muted mb-3"><b>Loại:</b> <?php if($p['pet_type'] == Enum::TYPE_CAT) echo "Mèo"; else echo "Chó" ?></h5>
    <h5 class="text-muted mb-3"><b>Giống:</b> <?php echo $p['pet_species']?></h5>
    <h5 class="text-muted mb-3"><b>Giới tính:</b> <?php if($p['pet_gender'] == Enum::GENDER_MALE) echo "Đực"; else echo "Cái" ?></h5>
    <h5 class="text-muted mb-3"><b>Ghi chú:</b> <?php echo $p['pet_note']?></h5>
    <?php endforeach;?>
    <!-- <a href="?controller=appointment&action=appointment_page" class="btn btn-lg btn-primary px-4">Cập nhật thông tin</a> -->
    <hr/>
<?php } else echo "<p style='color:black; font-size: 20px'>Thông tin trống.</p>";?>
</div>

// bill infor - customer
<?php if (count($bill) > 0) { ?>
    <?php foreach($bill as $b): ?>
    <h5 class="text-muted mb-3"><b>Mã hoá đơn:</b> <?php echo $b['bill_id']?></h5>
    <h5 class="text-muted mb-3"><b>Ngày tạo:</b> <?php echo $b['bill_date_release']?></h5>
    <h5 class="text-muted mb-3"><b>Mã khách hàng:</b> <?php echo $b['ctm_id'] ?></h5>
    <h5 class="text-muted mb-3"><b>Mã giảm giá:</b> <?php if ($b['dc_code'] != null) echo $b['dc_code']; else echo "Không"?></h5>
    <h5 class="text-muted mb-3"><b>Giá trị:</b> <?php echo number_format($b['value_temp'], 0, ',', '.')?> VND</h5>
    <h5 class="text-muted mb-3"><b>Giảm giá:</b> <?php echo number_format($b['value_reduced'], 0, ',', '.')?> VND</h5>
    <h5 class="text-muted mb-3"><b>Tổng tiền:</b> <?php echo number_format($b['total_value'], 0, ',', '.')?> VND</h5>
    <?php endforeach;?>
    <!-- <a href="?controller=appointment&action=appointment_page" class="btn btn-lg btn-primary px-4">Cập nhật thông tin</a> -->
    <hr/>
<?php } else echo "<p style='color:black; font-size: 20px'>Lịch sử trống.</p>";?>

// lich hen - customer 
<div class="col-lg-7 pb-5 pb-lg-0 px-3 px-lg-5">
    <?php if (count($appointment) > 0) { ?>
        <?php foreach($appointment as $a): ?>
        <h5 class="text-muted mb-3"><b>Mã lịch hẹn:</b> <?php echo $a['apm_id']?></h5>
        <h5 class="text-muted mb-3"><b>Ngày hẹn:</b> <?php echo $a['apm_date']?></h5>
        <h5 class="text-muted mb-3"><b>Giờ hẹn:</b> <?php echo $a['apm_time'] ?></h5>
        <h5 class="text-muted mb-3"><b>Trạng thái:</b> <?php if ($a['apm_status'] == Enum::STATUS_APPOINTMENT_CONFIRMED_NO) echo "Chờ xác nhận"; else if ($a['apm_status'] == Enum::STATUS_APPOINTMENT_CONFIRMED_YES) echo "Đã xác nhận"; else if ($a['apm_status'] == Enum::STATUS_APPOINTMENT_CANCEL) echo "Đã huỷ"; else echo "Hoàn thành";?></h5>
        <h5 class="text-muted mb-3"><b>Người hẹn:</b> <?php echo $a['ctm_id']?></h5>
        <h5 class="text-muted mb-3"><b>Dịch vụ:</b> <?php echo $a['cs_id']?></h5>
        <?php endforeach;?>
        <!-- <a href="?controller=appointment&action=appointment_page" class="btn btn-lg btn-primary px-4">Cập nhật thông tin</a> -->
        <hr/>
    <?php } else echo "<p style='color:black; font-size: 20px'>Lịch hẹn trống.</p>";?>
</div>