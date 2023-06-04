const limitCustomerPage = 8;

var ctmName = new URLSearchParams(document.location.href).get("ctm-name");
var ctmAddress = new URLSearchParams(document.location.href).get("ctm-address");
var ctmPhone = new URLSearchParams(document.location.href).get("ctm-phone");

ctmName = ctmName != undefined && ctmName != null ? ctmName : "";
ctmAddress = ctmAddress != undefined && ctmAddress != null ? ctmAddress : "";
ctmPhone = ctmPhone != undefined && ctmPhone != null ? ctmPhone : "";

url = "?controller=customer&action=customer_page_ad";

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
        url: "?controller=customer&action=data_customer",
        data: {
            ctmName: ctmName,
            ctmAddress: ctmAddress,
            ctmPhone: ctmPhone,
            index: page,
            limit: limitCustomerPage
        },
        dataType: "json",
        success: function (response) {
            console.log(response);
            if (response.responseCode == responseCode.success) {
                param = "";
                if (ctmName != null && ctmName != "") param += "&ctm-name=" + ctmName;
                if (ctmPhone != null && ctmPhone != "")
                    param += "&ctm-phone=" + ctmPhone;
                if (ctmAddress != null && ctmAddress != "") param += "&ctm-address=" + ctmAddress;
                if (page > 1) {
                    window.history.pushState(null, "", url + param + "&page=" + page);
                } else window.history.pushState(null, "", url + param);
                loadDataCustomer(response.data.customers);
                loadPaging(page, Math.ceil(response.data.count / limitCustomerPage));
            } else if (response.responseCode == responseCode.dataEmpty) {
                window.history.pushState(null, "", url);
                $("#page").html("");
                $("#data-customer").html(
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

function loadDataCustomer(data){
    var customerData = "";
    data.forEach((element) => {
        if (element.ctm_active == statusObject.active) ctm_active = "Hoạt động";
        else ctm_active = "Chưa kích hoạt";
        address = element.ctm_address != null ? element.ctm_address : '';
        ctmGender = element.ctm_gender == gender.male ? "Nam" : "Nữ";
        canFeedback = element.ctm_can_feedback == statusObject.active ? "Có thể" : "Không thể"
        customerData += "<tr>";
        customerData += "<th scope='row'>" + element.ctm_id + "</th>";
        customerData += "<td>" + element.ctm_name + "</td>";
        customerData += "<td>" + address + "</td>";
        customerData += "<td>" + element.ctm_phone + "</td>";
        customerData += "<td>" + ctmGender + "</td>";
        customerData += "<td>" + canFeedback + "</td>";
        customerData += "<td>" + ctm_active + "</td>";
        customerData += "</tr>";
    });
    $("#data-customer").html(customerData);
}

function resetAddForm() {
    $("#form-add-customer")[0].reset();
}

$(document).ready(function(){

    indexPage = new URLSearchParams(document.location.href).get("page");

    indexPage = indexPage != null && indexPage != 1 ? indexPage : 1;

    loadDataPage(indexPage);

    $("#form-add-customer").submit(function (e) {
        ctmNameAdd = $("#ctm-name").val();
        ctmPhoneAdd = $("#ctm-phone").val();
        ctmAddressAdd = $("#ctm-address").val();
        if (ctmNameAdd == "" || ctmPhoneAdd == "" || ctmAddressAdd == "") {
            $("#msg-ctm").html("CLI: Thông tin không được bỏ trống.");
            $("#msg-ctm").addClass(" alert-danger");
            $("#msg-ctm").show();
            window.setTimeout(function () {
                $("#msg-ctm").hide();
                $("#msg-ctm").removeClass(" alert-danger");
            }, 3000);
            return false;
        } 
        if (!regNumber.test(ctmPhoneAdd)) {
            $("#msg-ctm").html("CLI: Số điện thoại không hợp lệ.");
            $("#msg-ctm").addClass(" alert-danger");
            $("#msg-ctm").show();
            window.setTimeout(function () {
                $("#msg-ctm").hide();
                $("#msg-ctm").removeClass(" alert-danger");
            }, 3000);
            return false;
        }
        $.ajax({
            type: "POST",
            url: "?controller=customer&action=add_customer",
            data: {
                ctmName: ctmNameAdd,
                ctmAddress: ctmAddressAdd,
                ctmPhone: ctmPhoneAdd,
                token: sessionStorage.getItem("token")
            },
            dataType: "json",
            success: function (response) {
                //console.log(response);
                if (response.responseCode == responseCode.success) {
                    $("#msg-ctm").html("CLI: Thêm khách hàng thành công.");
                    $("#msg-ctm").addClass(" alert-success");
                    $("#msg-ctm").show();
                    $("#form-add-customer")[0].reset();
                    window.setTimeout(function () {
                        $("#msg-ctm").hide();
                        $("#msg-ctm").removeClass(" alert-success");
                    }, 3000);
                    loadDataPage(1);
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
        e.preventDefault();
    });

    $("#form-search-customer").submit(function (e) {
        ctmName = $("#customer-name").val();
        ctmPhone = $("#customer-phone").val();
        ctmAddress = $("#customer-address").val();
        loadDataPage(1);
        e.preventDefault();
    });
})