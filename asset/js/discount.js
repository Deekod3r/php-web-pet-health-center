function loadDataPage() {
    $.ajax({
        type: "GET",
        url: "?controller=discount&action=data_discount",
        dataType: "json",
        success: function (response) {
            console.log(response);
            if (response.responseCode == responseCode.success) {
                loadDataDiscount(response.data.discounts);
            } else if (response.responseCode == responseCode.dataEmpty) {
                window.history.pushState(null, "", url);
                $('#data-news').html("<p style='margin:auto; margin-bottom:20px; color:black; font-size:20px; color:red; font-weight:bold'>Không có tin tức phù hợp.</p>");
                $('#page').html("");
            } else alert("RES: " + response.responseCode + ": " + response.message + "Vui lòng thử lại sau ít phút.");
        },
        error: function (xhr) {
            alert("ER: Hệ thống gặp sự cố, vui lòng thử lại sau ít phút. Chi tiết lỗi: " + xhr.responseText + ", " + xhr.status + ", " + xhr.error);
        }
    });
}

function loadDataDiscount(data) {
    var discountData = "";
    data.forEach((element) => {
        value = "";
        if (element.dc_value == 0) value = element.dc_value_percent + "%";
        else value = new Intl.NumberFormat("vi-VN", {style: "currency",currency: "VND",}).format(element.dc_value);
        quantity = element.dc_quantity != null ? element.dc_quantity : "Không giới hạn";
        discountData += "<div class='col-lg-6 col-md-6'>";
        discountData += "    <div class='card mb-4 rounded-3 shadow-sm'>";
        discountData += "        <div class='card-header py-3'>";
        discountData += "            <h4 class='my-0 fw-normal'>Mã giảm giá: <span class='text-primary'>"+ element.dc_code +"</span></h4>";
        discountData += "        </div>";
        discountData += "        <div class='card-body'>";
        discountData += "            <h3 class='card-title pricing-card-title'>"+ value +"<small class='text-muted fw-light'>/đơn hàng</small></h3>";
        discountData += "            <ul class='list-unstyled mt-3 mb-4'>";
        discountData += "                <li><b>Điều kiện áp dụng:</b> Hoá đơn tối thiểu "+ new Intl.NumberFormat("vi-VN", {style: "currency",currency: "VND",}).format(element.dc_condition) +"</li>";
        discountData += "                <li><b>Thời gian bắt đầu:</b> "+ element.dc_start_time +"</li>";
        discountData += "                <li><b>Thời gian kết thúc:</b> "+ element.dc_end_time +"</li>";
        discountData += "                <li><b>Số lượng còn lại:</b> "+ quantity +"</li>";
        discountData += "            </ul>";
        discountData += "            <a href='?controller=appointment&action=appointment_page' class='w-100 btn btn-lg btn-outline-primary'>Đặt lịch ngay</a>";
        discountData += "        </div>";
        discountData += "    </div>";
        discountData += "</div>";
    });
    $("#data-discount").html(discountData);
}

$(document).ready(function () {

    loadDataShop();

    loadDataPage();
});
