const limitDiscountPage = 6;

var discountCode = new URLSearchParams(document.location.href).get("discount-code") || "";
var discountCondition = new URLSearchParams(document.location.href).get("discount-conditon") || "";
var discountStatus = new URLSearchParams(document.location.href).get("discount-status") || "";
var discountQuantity = new URLSearchParams(document.location.href).get("discount-value") || "";
var discountValue = new URLSearchParams(document.location.href).get("discount-value") || "";

// discountName = discountName != undefined && discountName != null ? discountName : "";
// discountType = discountType != undefined && discountType != null ? discountType : "";
// ctmPhone = ctmPhone != undefined && ctmPhone != null ? ctmPhone : "";
// genderdiscount = genderdiscount != undefined && genderdiscount != null ? genderdiscount : "";

url = "?controller=discount&action=discount_page_ad";

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
        url: "?controller=discount&action=data_discount",
        data: {
            discountCode: discountCode,
            discountCondition: discountCondition,
            discountStatus: discountStatus,
            discountQuantity: discountQuantity,
            discountValue: discountValue,
            index: page,
            limit: limitDiscountPage,
            token: sessionStorage.getItem("token")
        },
        dataType: "json",
        success: function (response) {
            //console.log(response);
            if (response.responseCode == responseCode.success) {
                // param = "";
                // if (discountName != null && discountName != "") param += "&discount-name=" + discountName;
                // if (ctmPhone != null && ctmPhone != "")
                //     param += "&discount-status=" + ctmPhone;
                // if (discountType != null && discountType != "") param += "&discount-conditon=" + discountType;
                // if (genderdiscount != null && genderdiscount != "") param += "&discount-value=" + genderdiscount;
                // if (page > 1) {
                //     window.history.pushState(null, "", url + param + "&page=" + page);
                // } else window.history.pushState(null, "", url + param);
                loadDataDiscount(response.data.discounts);
                loadPaging(page, Math.ceil(response.data.count / limitDiscountPage));
            } else if (response.responseCode == responseCode.dataEmpty) {
                window.history.pushState(null, "", url);
                $("#page").html("");
                $("#data-discount").html(
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

function loadDataDiscount(data){
    var discountData = "";
    data.forEach((element) => {
        if (element.dc_value == 0) value = element.dc_value_percent + "%";
        else value = new Intl.NumberFormat("vi-VN", {style: "currency",currency: "VND",}).format(element.dc_value);
        quantity = element.dc_quantity != null ? element.dc_quantity : "Không giới hạn";
        isActive = element.dc_active == statusObject.active ? "Hoạt động" : "Không hiệu lực";
        now = Date.now();
        check = new Date(element.dc_end_time + " " + "00:00:00");
        edit = "";
        if (check.getTime() - now > 0) {
            edit = "<a class='btn btn-primary' onclick='loadDataDetailDiscount("+ element.dc_id  +")'  data-toggle='modal' data-target='#myModal1'>Sửa</a>";
        }
        discountData += "<tr>";
        discountData += "<th scope='row'>" + element.dc_id + "</th>";
        discountData += "<td>" + element.dc_code + "</td>";
        discountData += "<td>" + element.dc_description + "</td>";
        discountData += "<td>Đơn tối thiểu: " + new Intl.NumberFormat("vi-VN", {style: "currency",currency: "VND",}).format(element.dc_condition) + "</td>";
        discountData += "<td>" + value + "</td>";
        discountData += "<td>" + element.dc_start_time + "</td>";
        discountData += "<td>" + element.dc_end_time + "</td>";
        discountData += "<td>" + quantity + "</td>";
        discountData += "<td>" + isActive + "</td>";
        discountData += "<td>" + edit +"</td>";
        discountData += "</tr>";
    });
    $("#data-discount").html(discountData);
}

function resetAddForm() {
    $("#form-add-discount")[0].reset();
}

function loadDataDetailDiscount(id) {
    $.ajax({
        type: "GET",
        url: "?controller=discount&action=data_detail_discount",
        data: {
            discountId: id,
            token: sessionStorage.getItem("token")
        },
        dataType: "json",
        success: function (response) {
            console.log(response);
            if (response.responseCode == responseCode.success) {
                $("#discount-id-edit").val(id)
                $("#discount-status-edit").val(response.data.discount.dc_active)
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

    $("#form-add-discount").submit(function (e) {
        discountCodeAdd = $("#discount-code-add").val().trim();
        discountConditionAdd = $("#discount-condition-add").val();
        discountQuantityAdd = $("#discount-quantity-add").val();
        discountStartTimeAdd = $("#discount-start-time-add").val();
        discountEndTimeAdd = $("#discount-end-time-add").val();
        discountTypeAdd = $("#discount-type-add").val().trim();
        discountValueAdd = $("#discount-value-add").val();
        discountDescAdd = $("#discount-desc-add").val().trim();
        
        if (discountCodeAdd == "" || discountConditionAdd == "" ||  discountStartTimeAdd == "" || discountEndTimeAdd == "" || discountTypeAdd == "" || discountValueAdd == "" || discountDescAdd == "" ) {
            $("#msg-discount").html("CLI: Thông tin không được bỏ trống.");
            $("#msg-discount").addClass(" alert-danger");
            $("#msg-discount").show();
            window.setTimeout(function () {
                $("#msg-discount").hide();
                $("#msg-discount").removeClass(" alert-danger");
            }, 3000);
            return false;
        } 
        if (!regNumber.test(discountConditionAdd) || !regNumber.test(discountValueAdd)) {
            $("#msg-discount").html("CLI: Giá trị tiền phải là số.");
            $("#msg-discount").addClass(" alert-danger");
            $("#msg-discount").show();
            window.setTimeout(function () {
                $("#msg-discount").hide();
                $("#msg-discount").removeClass(" alert-danger");
            }, 3000);
            return false;
        }
        if (discountQuantityAdd != '') {
            if (!regNumber.test(discountQuantityAdd) || discountQuantityAdd < 0) {
                $("#msg-discount").html("CLI: Số lượng phải là số lớn hơn hoặc bằng 0.");
                $("#msg-discount").addClass(" alert-danger");
                $("#msg-discount").show();
                window.setTimeout(function () {
                    $("#msg-discount").hide();
                    $("#msg-discount").removeClass(" alert-danger");
                }, 3000);
                return false;
            }
        }
        let timeStart = $('#discount-start-time-add').val()
        let timeEnd = $('#discount-end-time-add').val()
        if (timeStart >= timeEnd) {
            $("#msg-discount").html("CLI: Thời gian kết thúc phải sau thời gian bắt đầu.");
            $("#msg-discount").addClass(" alert-danger");
            $("#msg-discount").show();
            window.setTimeout(function () {
                $("#msg-discount").hide();
                $("#msg-discount").removeClass(" alert-danger");
            }, 3000);
            return false;
        }
        now = Date.now();
        check = new Date($("#discount-start-time-add").val() + " " + "00:00:00");
        diff = check.getTime() - now;
        if (diff < 86400000) {
            $("#msg-discount").html("CLI: Mã giảm giá phải tạo tối thiểu trước 24 tiếng ngày bắt đầu.");
            $("#msg-discount").addClass(" alert-danger");
            $("#msg-discount").show();
            window.setTimeout(function () {
                $("#msg-discount").hide();
                $("#msg-discount").removeClass(" alert-danger");
            }, 3000);
            return false;
        }
        //return false;
        formData= new FormData($("#form-add-discount")[0]);
        formData.append('token',sessionStorage.getItem("token"))
        //return false;
        $.ajax({
            type: "POST",
            url: "?controller=discount&action=add_discount",
            processData: false,
            contentType: false,
            data: formData,
            dataType: "json",
            success: function (response) {
                console.log(response);
                if (response.responseCode == responseCode.success) {
                    $("#msg-discount").html("CLI: Thêm mã giảm giá thành công.");
                    $("#msg-discount").addClass(" alert-success");
                    $("#msg-discount").show();
                    $("#form-add-discount")[0].reset();
                    window.setTimeout(function () {
                        $("#msg-discount").hide();
                        $("#msg-discount").removeClass(" alert-success");
                    }, 3000);
                    loadDataPage(1);
                } else {
                    $("#msg-discount").html(response.message);
                    $("#msg-discount").addClass(" alert-danger");
                    $("#msg-discount").show();
                    window.setTimeout(function () {
                        $("#msg-discount").hide();
                        $("#msg-discount").removeClass(" alert-danger");
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

    $("#form-search-discount").submit(function (e) {
        discountCode = $("#discount-code").val().trim();
        discountCondition = $("#discount-condition").val();
        discountStatus = $("#discount-status").val().trim();
        discountQuantity = $("#discount-quantity").val().trim();
        discountValue = $("#discount-value").val().trim();
        loadDataPage(1);
        e.preventDefault();
    });

    $("#form-edit-discount").submit(function (e) {
        discountIdEdit = $("#discount-id-edit").val().trim();
        discountStatusEdit = $("#discount-status-edit").val().trim();
        if (discountIdEdit == "" || discountStatusEdit == "") {
            $("#msg-discount-edit").html("CLI: Thông tin không được bỏ trống.");
            $("#msg-discount-edit").addClass(" alert-danger");
            $("#msg-discount-edit").show();
            window.setTimeout(function () {
                $("#msg-discount-edit").hide();
                $("#msg-discount-edit").removeClass(" alert-danger");
            }, 3000);
            return false;
        }
        //return false;
        formData= new FormData($("#form-edit-discount")[0]);
        formData.append('token',sessionStorage.getItem("token"))
        $.ajax({
            type: "POST",
            url: "?controller=discount&action=edit_discount",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function (response) {
                //console.log(response);
                if (response.responseCode == responseCode.success) {
                    $("#msg-discount-edit").html("CLI: Sửa giảm giá thành công.");
                    $("#msg-discount-edit").addClass(" alert-success");
                    $("#msg-discount-edit").show();
                    $("#form-add-discount")[0].reset();
                    window.setTimeout(function () {
                        $("#msg-discount-edit").hide();
                        $("#msg-discount-edit").removeClass(" alert-success");
                    }, 3000);
                    loadDataPage(new URLSearchParams(document.location.href).get("page") || 1);
                } else {
                    $("#msg-discount-edit").html(response.message);
                    $("#msg-discount-edit").addClass(" alert-danger");
                    $("#msg-discount-edit").show();
                    window.setTimeout(function () {
                        $("#msg-discount-edit").hide();
                        $("#msg-discount-edit").removeClass(" alert-danger");
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