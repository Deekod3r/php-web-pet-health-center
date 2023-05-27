const limitaAppointmentPage = 6;

var appointmentCode = new URLSearchParams(document.location.href).get("appointment-code") || "";
var appointmentCondition = new URLSearchParams(document.location.href).get("appointment-conditon") || "";
var appointmentStatus = new URLSearchParams(document.location.href).get("appointment-status") || "";
var appointmentQuantity = new URLSearchParams(document.location.href).get("appointment-value") || "";
var appointmentValue = new URLSearchParams(document.location.href).get("appointment-value") || "";

// appointmentName = appointmentName != undefined && appointmentName != null ? appointmentName : "";
// appointmentType = appointmentType != undefined && appointmentType != null ? appointmentType : "";
// ctmPhone = ctmPhone != undefined && ctmPhone != null ? ctmPhone : "";
// genderappointment = genderappointment != undefined && genderappointment != null ? genderappointment : "";

url = "?controller=appointment&action=appointment_page_ad";

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
        url: "?controller=appointment&action=data_appointment",
        data: {
            appointmentCode: appointmentCode,
            appointmentCondition: appointmentCondition,
            appointmentStatus: appointmentStatus,
            appointmentQuantity: appointmentQuantity,
            appointmentValue: appointmentValue,
            index: page,
            limit: limitaAppointmentPage,
            token: sessionStorage.getItem("token")
        },
        dataType: "json",
        success: function (response) {
            //console.log(response);
            if (response.responseCode == responseCode.success) {
                // param = "";
                // if (appointmentName != null && appointmentName != "") param += "&appointment-name=" + appointmentName;
                // if (ctmPhone != null && ctmPhone != "")
                //     param += "&appointment-status=" + ctmPhone;
                // if (appointmentType != null && appointmentType != "") param += "&appointment-conditon=" + appointmentType;
                // if (genderappointment != null && genderappointment != "") param += "&appointment-value=" + genderappointment;
                // if (page > 1) {
                //     window.history.pushState(null, "", url + param + "&page=" + page);
                // } else window.history.pushState(null, "", url + param);
                loadDataAppointment(response.data.appointments);
                loadPaging(page, Math.ceil(response.data.count / limitaAppointmentPage));
            } else if (response.responseCode == responseCode.dataEmpty) {
                window.history.pushState(null, "", url);
                $("#page").html("");
                $("#data-appointment").html(
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

function loadDataAppointment(data){
    var appointmentData = "";
    data.forEach((element) => {
        apmStatus = "";
        switch (element.apm_status) {
            case statusAppointment.confirmNo:
                apmStatus = "Chờ xác nhận"
                break;
            case statusAppointment.confirmYes:
                apmStatus = "Đã xác nhận"
                break;
            case statusAppointment.cancel:
                apmStatus = "Đã huỷ"
                break;
            case statusAppointment.done:
                apmStatus = "Hoàn thành"
                break;
            default:
                break;
        }
        if (element.apm_status == statusAppointment.confirmYes || element.apm_status == statusAppointment.confirmNo) {
            edit = "<a class='btn btn-primary' onclick='loadDataDetailAppointment("+ element.apm_id  +")'  data-toggle='modal' data-target='#myModal1'>Sửa</a>";
        } else edit = '';
        apmCancelAt = element.apm_cancel_at != null ? element.apm_cancel_at :  '';
        appointmentData += "<tr>";
        appointmentData += "<th scope='row'>" + element.apm_id + "</th>";
        appointmentData += "<td>" + element.apm_booking_at + "</td>";
        appointmentData += "<td>" + element.apm_date + "</td>";
        appointmentData += "<td>" + element.apm_time + "</td>";
        appointmentData += "<td>" + element.cs_id + " - " + element.cs_name + "</td>";
        appointmentData += "<td>" + element.ctm_id + " - " + element.ctm_name + "</td>";
        appointmentData += "<td>" + element.apm_note + "</td>";
        appointmentData += "<td>" + apmStatus + "</td>";
        appointmentData += "<td>" + apmCancelAt + "</td>";
        appointmentData += "<td>"+ edit +"</td>";
        appointmentData += "</tr>";
    });
    $("#data-appointment").html(appointmentData);
}

function resetAddForm() {
    $("#form-add-appointment")[0].reset();
}

function loadDataDetailAppointment(id) {
    $.ajax({
        type: "GET",
        url: "?controller=appointment&action=data_detail_appointment",
        data: {
            appointmentId: id,
            token: sessionStorage.getItem("token")
        },
        dataType: "json",
        success: function (response) {
            console.log(response);
            if (response.responseCode == responseCode.success) {
                $("#appointment-id-edit").val(id)
                $("#appointment-status-edit").val(response.data.appointment.apm_status)
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

    $("#form-add-appointment").submit(function (e) {
        appointmentCodeAdd = $("#appointment-code-add").val().trim();
        appointmentConditionAdd = $("#appointment-condition-add").val();
        appointmentQuantityAdd = $("#appointment-quantity-add").val();
        appointmentStartTimeAdd = $("#appointment-start-time-add").val();
        appointmentEndTimeAdd = $("#appointment-end-time-add").val();
        appointmentTypeAdd = $("#appointment-type-add").val().trim();
        appointmentValueAdd = $("#appointment-value-add").val();
        appointmentDescAdd = $("#appointment-desc-add").val().trim();
        
        if (appointmentCodeAdd == "" || appointmentConditionAdd == "" ||  appointmentStartTimeAdd == "" || appointmentEndTimeAdd == "" || appointmentTypeAdd == "" || appointmentValueAdd == "" || appointmentDescAdd == "" ) {
            $("#msg-appointment").html("CLI: Thông tin không được bỏ trống.");
            $("#msg-appointment").addClass(" alert-danger");
            $("#msg-appointment").show();
            window.setTimeout(function () {
                $("#msg-appointment").hide();
                $("#msg-appointment").removeClass(" alert-danger");
            }, 3000);
            return false;
        } 
        if (!regNumber.test(appointmentConditionAdd) || !regNumber.test(appointmentValueAdd)) {
            $("#msg-appointment").html("CLI: Giá trị tiền phải là số.");
            $("#msg-appointment").addClass(" alert-danger");
            $("#msg-appointment").show();
            window.setTimeout(function () {
                $("#msg-appointment").hide();
                $("#msg-appointment").removeClass(" alert-danger");
            }, 3000);
            return false;
        }
        if (appointmentQuantityAdd != '') {
            if (!regNumber.test(appointmentQuantityAdd) || appointmentQuantityAdd < 0) {
                $("#msg-appointment").html("CLI: Số lượng phải là số lớn hơn hoặc bằng 0.");
                $("#msg-appointment").addClass(" alert-danger");
                $("#msg-appointment").show();
                window.setTimeout(function () {
                    $("#msg-appointment").hide();
                    $("#msg-appointment").removeClass(" alert-danger");
                }, 3000);
                return false;
            }
        }
        let timeStart = $('#appointment-start-time-add').val()
        let timeEnd = $('#appointment-end-time-add').val()
        if (timeStart >= timeEnd) {
            $("#msg-appointment").html("CLI: Thời gian kết thúc phải sau thời gian bắt đầu.");
            $("#msg-appointment").addClass(" alert-danger");
            $("#msg-appointment").show();
            window.setTimeout(function () {
                $("#msg-appointment").hide();
                $("#msg-appointment").removeClass(" alert-danger");
            }, 3000);
            return false;
        }
        now = Date.now();
        check = new Date($("#appointment-start-time-add").val() + " " + "00:00:00");
        diff = check.getTime() - now;
        if (diff < 86400000) {
            $("#msg-appointment").html("CLI: Mã giảm giá phải tạo tối thiểu trước 24 tiếng ngày bắt đầu.");
            $("#msg-appointment").addClass(" alert-danger");
            $("#msg-appointment").show();
            window.setTimeout(function () {
                $("#msg-appointment").hide();
                $("#msg-appointment").removeClass(" alert-danger");
            }, 3000);
            return false;
        }
        //return false;
        formData= new FormData($("#form-add-appointment")[0]);
        formData.append('token',sessionStorage.getItem("token"))
        //return false;
        $.ajax({
            type: "POST",
            url: "?controller=appointment&action=add_appointment",
            processData: false,
            contentType: false,
            data: formData,
            dataType: "json",
            success: function (response) {
                console.log(response);
                if (response.responseCode == responseCode.success) {
                    $("#msg-appointment").html("CLI: Thêm mã giảm giá thành công.");
                    $("#msg-appointment").addClass(" alert-success");
                    $("#msg-appointment").show();
                    $("#form-add-appointment")[0].reset();
                    window.setTimeout(function () {
                        $("#msg-appointment").hide();
                        $("#msg-appointment").removeClass(" alert-success");
                    }, 3000);
                    loadDataPage(1);
                } else {
                    $("#msg-appointment").html(response.message);
                    $("#msg-appointment").addClass(" alert-danger");
                    $("#msg-appointment").show();
                    window.setTimeout(function () {
                        $("#msg-appointment").hide();
                        $("#msg-appointment").removeClass(" alert-danger");
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

    $("#form-search-appointment").submit(function (e) {
        appointmentCode = $("#appointment-code").val().trim();
        appointmentCondition = $("#appointment-condition").val();
        appointmentStatus = $("#appointment-status").val().trim();
        appointmentQuantity = $("#appointment-quantity").val().trim();
        appointmentValue = $("#appointment-value").val().trim();
        loadDataPage(1);
        e.preventDefault();
    });

    $("#form-edit-appointment").submit(function (e) {
        appointmentIdEdit = $("#appointment-id-edit").val().trim();
        appointmentStatusEdit = $("#appointment-status-edit").val().trim();
        if (appointmentIdEdit == "" || appointmentStatusEdit == "") {
            $("#msg-appointment-edit").html("CLI: Thông tin không được bỏ trống.");
            $("#msg-appointment-edit").addClass(" alert-danger");
            $("#msg-appointment-edit").show();
            window.setTimeout(function () {
                $("#msg-appointment-edit").hide();
                $("#msg-appointment-edit").removeClass(" alert-danger");
            }, 3000);
            return false;
        }
        //return false;
        formData= new FormData($("#form-edit-appointment")[0]);
        formData.append('token',sessionStorage.getItem("token"))
        $.ajax({
            type: "POST",
            url: "?controller=appointment&action=edit_appointment",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function (response) {
                //console.log(response);
                if (response.responseCode == responseCode.success) {
                    $("#msg-appointment-edit").html("CLI: Sửa lịch hẹn thành công.");
                    $("#msg-appointment-edit").addClass(" alert-success");
                    $("#msg-appointment-edit").show();
                    $("#form-add-appointment")[0].reset();
                    window.setTimeout(function () {
                        $("#msg-appointment-edit").hide();
                        $("#msg-appointment-edit").removeClass(" alert-success");
                    }, 3000);
                    loadDataPage(new URLSearchParams(document.location.href).get("page") || 1);
                } else {
                    $("#msg-appointment-edit").html(response.message);
                    $("#msg-appointment-edit").addClass(" alert-danger");
                    $("#msg-appointment-edit").show();
                    window.setTimeout(function () {
                        $("#msg-appointment-edit").hide();
                        $("#msg-appointment-edit").removeClass(" alert-danger");
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