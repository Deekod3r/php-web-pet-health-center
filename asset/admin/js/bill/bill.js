const limitBillPage = 5;

var billId = new URLSearchParams(document.location.href).get("bill-id") || '';
var ctmPhone = new URLSearchParams(document.location.href).get("ctm-phone") || "";
var billDate = new URLSearchParams(document.location.href).get("bill-date") || "";
var billMonth = new URLSearchParams(document.location.href).get("bill-month") || "";
var billYear = new URLSearchParams(document.location.href).get("bill-year") || "";
var billStatus = new URLSearchParams(document.location.href).get("bill-status") || "";

url = "?controller=bill&action=bill_page_ad";

function loadPaging(index, endPage) {
    index = parseInt(index);
    endPage = parseInt(endPage);
    page = "";
    page += "   <div class='col-lg-12'>";
    page += "   <nav aria-label='Page navigation'>";
    page += "   <ul class='pagination justify-content-center mb-4'>";
    page += "   <li class='page-item head'>";
    page +=
        "       <a class='page-link'  style='cursor:pointer' onclick='loadDataPage(" +
        1 +
        ")'>";
    page += "       <span aria-hidden='true'>&laquo; Trang đầu</span>";
    page += "       </a>";
    page += "   </li>";

    page += "   <li class='page-item head' id='previous'>";
    page +=
        "       <a class='page-link'  style='cursor:pointer' aria-label='Previous' onclick='loadDataPage(" +
        (index - 1) +
        ")'>";
    page += "       <span aria-hidden='true'>&laquo; Trước</span>";
    page += "       </a>";
    page += "   </li>";

    if (index > 2) {
        page +=
            "   <li class='page-item'><a class='page-link' style='cursor:pointer'  onclick='loadDataPage(" +
            (index - 2) +
            ")'>" +
            (index - 2) +
            "</a></li>";
        page +=
            "   <li class='page-item'><a class='page-link' style='cursor:pointer' onclick='loadDataPage(" +
            (index - 1) +
            ")'>" +
            (index - 1) +
            "</a></li>";
    } else if (index > 1) {
        page +=
            "   <li class='page-item'><a class='page-link' style='cursor:pointer' onclick='loadDataPage(" +
            (index - 1) +
            ")'>" +
            (index - 1) +
            "</a></li>";
    }
    page +=
        "   <li class='page-item active'><a class='page-link' style='cursor:pointer' onclick='loadDataPage(" +
        index +
        ")'>" +
        index +
        "</a></li>";
    for (let i = index + 1; i <= endPage; i++) {
        page +=
            "    <li class='page-item'><a class='page-link' style='cursor:pointer'  onclick='loadDataPage(" +
            i +
            ")'>" +
            i +
            "</a></li>";
        if (i == index + 3) break;
    }

    page += "    <li class='page-item foot' id='next'>";
    page +=
        "        <a class='page-link'  aria-label='Next' style='cursor:pointer' onclick='loadDataPage(" +
        (index + 1) +
        ")'>";
    page += "         <span aria-hidden='true'>Sau &raquo;</span>";
    page += "        </a>";
    page += "     </li>";

    page += "   <li class='page-item foot'>";
    page +=
        "       <a class='page-link'  style='cursor:pointer' onclick='loadDataPage(" +
        endPage +
        ")'>";
    page += "       <span aria-hidden='true'>Trang cuối &raquo;</span>";
    page += "       </a>";
    page += "   </li>";
    page += "     </ul>";
    page += " </nav>";
    page += " </div> ";
    $("#page").html(page);
    // if (index <= 1) $("#previous").addClass("disabled");
    // if (index >= endPage) $("#next").addClass("disabled");
    if (index <= 1) $(".head").addClass("disabled");
    if (index >= endPage) $(".foot").addClass("disabled");
}

function loadDataPage(page){
    $.ajax({
        type: "GET",
        url: "?controller=bill&action=data_bill",
        data: {
            billId: billId,
            billDate: billDate,
            ctmPhone: ctmPhone,
            billMonth: billMonth,
            billYear: billYear,
            billStatus: billStatus,
            index: page,
            limit: limitBillPage,
            token: sessionStorage.getItem("token")
        },
        dataType: "json",
        success: function (response) {
            console.log(response);
            if (response.responseCode == responseCode.success) {
                param = "";
                if (billId != null && billId != "") param += "&bill-id=" + billId;
                if (ctmPhone != null && ctmPhone != "")
                    param += "&ctm-phone=" + ctmPhone;
                if (billDate != null && billDate != "") param += "&bill-date=" + billDate;
                if (billMonth != null && billMonth != "") param += "&bill-month=" + billMonth;
                if (billYear != null && billYear != "") param += "&bill-year=" + billYear;
                if (billStatus != null && billStatus != "") param += "&bill-status=" + billStatus;
                if (page > 1) {
                    window.history.pushState(null, "", url + param + "&page=" + page);
                } else window.history.pushState(null, "", url + param);
                loadDatabill(response.data.bills);
                loadPaging(page, Math.ceil(response.data.count / limitBillPage));
            } else if (response.responseCode == responseCode.dataEmpty) {
                window.history.pushState(null, "", url);
                $("#page").html("");
                $("#data-bill").html(
                    "<p style='font-size:20px; color:red; font-weight:bold; text-align:center'>Thông tin trống.</p>"
                );
            } else
                alert(
                    "RES: " +
                    response.responseCode +
                    ": " +
                    response.message +
                    "Vui lòng thử lại sau ít phút."
                );
        },
        error: function (xhr) {
            alert(
                "ER: Hệ thống gặp sự cố, vui lòng thử lại sau ít phút. Chi tiết lỗi: " +
                xhr.responseText +
                ", " +
                xhr.status +
                ", " +
                xhr.error
            );
        },
    });
}

function loadDatabill(data){
    var billData = "";
    data.forEach((element) => {
        statusBill = element.bill_status == statusObject.active ? "Đã thanh toán" : "Chưa thanh toán";
        discountCode = element.dc_code != null ? element.dc_code : "";
        billData += "<tr>";
        billData += "<th scope='row'>" + element.bill_id + "</th>";
        billData += "<td>" + element.bill_date_release + "</td>";
        billData += "<td>" + element.ad_username + "</td>";
        billData += "<td>" + element.ctm_id + " - " + element.ctm_name + "</td>";
        billData += "<td>" + discountCode + "</td>";
        billData += "<td>" + new Intl.NumberFormat("vi-VN", {style: "currency",currency: "VND",}).format(element.sub_total) + "</td>";
        billData += "<td>" + new Intl.NumberFormat("vi-VN", {style: "currency",currency: "VND",}).format(element.value_reduced) + "</td>";
        billData += "<td>" + new Intl.NumberFormat("vi-VN", {style: "currency",currency: "VND",}).format(element.total_value) + "</td>";
        billData += "<td>" + statusBill + "</td>";
        billData += "<td><a class='btn btn-primary' onclick='loadDataDetailBill("+ element.bill_id  +")' >Sửa</a></td>";
        billData += "</tr>";
    });
    $("#data-bill").html(billData);
}

function resetAddForm() {
    $("#form-add-bill")[0].reset();
}

function loadDataDetailBill(id) {
    return false;
    $.ajax({
        type: "GET",
        url: "?controller=bill&action=data_detail_bill",
        data: {
            billId: id,
            token: sessionStorage.getItem("token")
        },
        dataType: "json",
        success: function (response) {
            console.log(response);
            if (response.responseCode == responseCode.success) {
                $("#bill-id-edit").val(id)
                $("#bill-active").val(response.data.bill.fb_active)
            } else
                alert(
                    "RES: " +
                    response.responseCode +
                    ": " +
                    response.message +
                    "Vui lòng thử lại sau ít phút."
                );
        },
        error: function (xhr) {
            alert(
                "ER: Hệ thống gặp sự cố, vui lòng thử lại sau ít phút. Chi tiết lỗi: " +
                xhr.responseText +
                ", " +
                xhr.status +
                ", " +
                xhr.error
            );
        },
    });
}

$(document).ready(function(){

    indexPage = new URLSearchParams(document.location.href).get("page");

    indexPage = indexPage != null && indexPage != 1 ? indexPage : 1;

    loadDataPage(indexPage);

    $("#form-add-bill").submit(function (e) {
        ctmPhoneAdd = $("#ctm-phone-add").val().trim();
        if (ctmPhoneAdd == "" ) {
            $("#msg-bill").html("CLI: Thông tin không được bỏ trống.");
            $("#msg-bill").addClass(" alert-danger");
            $("#msg-bill").show();
            window.setTimeout(function () {
                $("#msg-bill").hide();
                $("#msg-bill").removeClass(" alert-danger");
            }, 3000);
            return false;
        } 
        if (!regNumber.test(ctmPhoneAdd)) {
            $("#msg-bill").html("CLI: Số điện thoại không hợp lệ.");
            $("#msg-bill").addClass(" alert-danger");
            $("#msg-bill").show();
            window.setTimeout(function () {
                $("#msg-bill").hide();
                $("#msg-bill").removeClass(" alert-danger");
            }, 3000);
            return false;
        }
        $.ajax({
            type: "POST",
            url: "?controller=bill&action=add_bill",
            data: {
                ctmPhone: ctmPhoneAdd,
                token: sessionStorage.getItem("token")
            },
            dataType: "json",
            success: function (response) {
                //console.log(response);
                if (response.responseCode == responseCode.success) {
                    $("#msg-bill").html("CLI: Thêm hoá đơn thành công.");
                    $("#msg-bill").addClass(" alert-success");
                    $("#msg-bill").show();
                    $("#form-add-bill")[0].reset();
                    window.setTimeout(function () {
                        $("#msg-bill").hide();
                        $("#msg-bill").removeClass(" alert-success");
                    }, 3000);
                    loadDataPage(1);
                } else {
                    $("#msg-bill").html(response.message);
                    $("#msg-bill").addClass(" alert-danger");
                    $("#msg-bill").show();
                    window.setTimeout(function () {
                        $("#msg-bill").hide();
                        $("#msg-bill").removeClass(" alert-danger");
                    }, 3000);
                }
            },
            error: function (xhr) {
                alert(
                    "ER: Hệ thống gặp sự cố, vui lòng thử lại sau ít phút. Chi tiết lỗi: " +
                    xhr.responseText +
                    ", " +
                    xhr.status +
                    ", " +
                    xhr.error
                );
            },
        });
        e.preventDefault();
    });

    $("#form-search-bill").submit(function (e) {
        billId = $("#bill-id").val().trim();
        ctmPhone = $("#ctm-phone").val().trim();
        billDate = $("#date-bill").val().trim();
        billMonth = $("#month-bill").val().trim();
        billYear = $("#year-bill").val().trim();
        billStatus = $("#bill-status").val().trim();
        loadDataPage(1);
        e.preventDefault();
    });

    $("#form-edit-bill").submit(function (e) {
        billIdEdit = $("#bill-id-edit").val().trim();
        billActiveEdit = $("#bill-active").val().trim();
        if (billIdEdit == "" || billActiveEdit == "") {
            $("#msg-bill-edit").html("CLI: Thông tin không được bỏ trống.");
            $("#msg-bill-edit").addClass(" alert-danger");
            $("#msg-bill-edit").show();
            window.setTimeout(function () {
                $("#msg-bill-edit").hide();
                $("#msg-bill-edit").removeClass(" alert-danger");
            }, 3000);
            return false;
        } 
        return false;
        $.ajax({
            type: "POST",
            url: "?controller=bill&action=edit_bill",
            data: {
                billId: billIdEdit,
                billActiveEdit: billActiveEdit,
                token: sessionStorage.getItem("token")
            },
            dataType: "json",
            success: function (response) {
                //console.log(response);
                if (response.responseCode == responseCode.success) {
                    $("#msg-bill-edit").html("CLI: Sửa hoá đơn thành công.");
                    $("#msg-bill-edit").addClass(" alert-success");
                    $("#msg-bill-edit").show();
                    $("#form-add-bill")[0].reset();
                    window.setTimeout(function () {
                        $("#msg-bill-edit").hide();
                        $("#msg-bill-edit").removeClass(" alert-success");
                    }, 3000);
                    loadDataPage(new URLSearchParams(document.location.href).get("page") || 1);
                } else {
                    $("#msg-bill-edit").html(response.message);
                    $("#msg-bill-edit").addClass(" alert-danger");
                    $("#msg-bill-edit").show();
                    window.setTimeout(function () {
                        $("#msg-bill-edit").hide();
                        $("#msg-bill-edit").removeClass(" alert-danger");
                    }, 3000);
                }
            },
            error: function (xhr) {
                alert(
                    "ER: Hệ thống gặp sự cố, vui lòng thử lại sau ít phút. Chi tiết lỗi: " +
                    xhr.responseText +
                    ", " +
                    xhr.status +
                    ", " +
                    xhr.error
                );
            },
        });
        e.preventDefault();
    });
})