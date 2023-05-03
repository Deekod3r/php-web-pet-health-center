<!DOCTYPE html>
<html lang="en">
<?php $title = "Thông tin tài khoản";?>
<?php include("layout/asset_header.php")?>
<style>
    .tablink {
        background-color: #555;
        color: white;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        font-size: 17px;
        width: 25%;
    }

    .tablink:hover {
        background-color: #777;
    }

    /* Style the tab content (and add height:100% for full page content) */
    .tabcontent {
        color: white;
        display: none;
        padding: 100px 20px;
        height: 100%;
    }

</style>
<body>
    <?php include("layout/header.php")?>

    <div class="container py-5" style="margin-bottom:0">

        <button class="tablink" onclick="openPage('Account', this)" id="defaultOpen">Thông tin tài khoản</button>
        <button class="tablink" onclick="openPage('Pet', this)">Thông tin thú cưng</button>
        <button class="tablink" onclick="openPage('History', this)">Lịch sử dịch vụ</button>
        <button class="tablink" onclick="openPage('Current', this)">Lịch đang hẹn</button>

        <div id="Account" class="tabcontent">
            <h3 class="text-primary mb-3">Thông tin tài khoản</h3>
            <div class="col-lg-7 pb-5 pb-lg-0 px-3 px-lg-5">
                <h5 class="text-muted mb-3"><b>Họ và tên:</b> <?php echo $customer['ctm_name']?></h5>
                <h5 class="text-muted mb-3"><b>Số điện thoại:</b> <?php echo $customer['ctm_phone']?></h5>
                <h5 class="text-muted mb-3"><b>Email:</b> <?php echo $customer['ctm_email']?></h5>
                <h5 class="text-muted mb-3"><b>Địa chỉ:</b> <?php echo $customer['ctm_address']?></h5>
            </div>
            <a href="?controller=appointment&action=appointment_page" class="btn btn-lg btn-primary px-4">Cập nhật thông tin</a>
        </div>

        <div id="Pet" class="tabcontent">
            <h3 class="text-primary mb-3">Thông tin thú cưng</h3>
            <div class="col-lg-7 pb-5 pb-lg-0 px-3 px-lg-5">
                <?php if (count($pet) > 0) { ?>
                    <?php foreach($pet as $p): ?>
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
        </div>

        <div id="History" class="tabcontent">
        <h3 class="text-primary mb-3">Thông tin thú cưng</h3>
            <div class="col-lg-7 pb-5 pb-lg-0 px-3 px-lg-5">
                <?php if (count($pet) > 0) { ?>
                    <?php foreach($pet as $p): ?>
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
        </div>

        <div id="Current" class="tabcontent">
            <h3>Current</h3>
            <p>Who we are and what we do.</p>
        </div>

    </div>

    <?php include("layout/footer.php")?>


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>
    <script>
        function openPage(pageName,elmnt) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablink");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].style.backgroundColor = "";
            }
            document.getElementById(pageName).style.display = "block";
            elmnt.style.backgroundColor = '#65C178';
        }

        // Get the element with id="defaultOpen" and click on it
        document.getElementById("defaultOpen").click();
    </script>
    <?php include("layout/asset_footer.php") ?>
</body>

</html>