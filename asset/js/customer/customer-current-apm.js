function loadDataCurrentApm() {
    $.ajax({
        type: "GET",
        url: "?controller=appointment&action=data_customer_current_apm",
        data: {
            token: sessionStorage.getItem("token"),
        },
        dataType: "json",
        success: function (response) {
            //console.log(response);
            if (response.responseCode == responseCode.success) {
                var appointmentData = "";
                response.data.appointment.forEach((element) => {
                    let statusApm = element.apm_status;
                    let colorStatus = 'black';
                    switch (element.apm_status) {
                        case statusAppointment.cancel:
                            colorStatus = "red";
                            statusApm = "Đã huỷ";
                            break;
                        case statusAppointment.confirmNo:
                            statusApm = "Chờ xác nhận";
                            break;
                        case statusAppointment.confirmYes:
                            colorStatus = "#ED6436";
                            statusApm = "Đã xác nhận";
                            break;
                        case statusAppointment.done:
                            colorStatus = "green";
                            statusApm = "Hoàn thành";
                            break;
                    }
                    appointmentData += "<tr class=''>";
                    appointmentData +=
                        "<td scope='row'>" + element.apm_id + "</td>";
                    appointmentData += "<td>" + element.apm_booking_at + "</td>";
                    appointmentData += "<td>" + element.apm_date + "</td>";
                    appointmentData += "<td>" + element.apm_time + "</td>";
                    appointmentData += "<td>" + element.cs_name + "</td>";
                    appointmentData += "<td>" + element.apm_note + "</td>";
                    appointmentData += "<td style='color: "+ colorStatus + ";font-weight:bold'>" + statusApm + "</td>";
                    appointmentData += "<td>";
                    if (element.apm_status == 0) {
                        appointmentData +=
                            "<a style='font-weight:600; cursor:pointer;' class='badge badge-danger' data-toggle='modal' data-target='#myModal' id='cancel-appointment' onclick='cancelConfirm(" +
                            element.apm_id +
                            ")'>Huỷ</a>";
                    }
                    appointmentData += "</td>";
                    appointmentData += "</tr>";
                });
                $("#body-table").html(appointmentData);
            } else if (response.responseCode == responseCode.dataEmpty) {
                $(".current").html(
                    "<p style='margin:auto; margin-bottom:20px; color:black; font-size:20px; color:red; font-weight:bold'>Thông tin trống.</p>"
                );
            } else
                alert(
                    response.responseCode +
                    ": " +
                    response.message +
                    "Vui lòng thử lại sau ít phút."
                );
        },
        error: function (xhr) {
            alert("ER: Hệ thống gặp sự cố, vui lòng thử lại sau ít phút. Chi tiết lỗi: " + xhr.responseText + ", " + xhr.status + ", " + xhr.error);
        }
    });
}

function cancelConfirm(id) {
    $('#id-appointment').html(id);
}

$('#confirm-cancel').click(function(){
    $.ajax({
        type: "POST",
        url: "?controller=appointment&action=cancel_appointment",
        data: {
            token: sessionStorage.getItem("token"),
            idApm: $('#id-appointment').html(),
        },
        dataType: "json",
        success: function (response) {
            //console.log(response);
            if (response.responseCode == responseCode.success) {
                $("#msg-cancel-appointment").html("Huỷ lịch hẹn thành công.");
                $("#msg-cancel-appointment").addClass(" alert-success");
                $("#msg-cancel-appointment").show();
                window.setTimeout(function () {
                    $("#msg-cancel-appointment").hide();
                }, 3000);
                loadDataCurrentApm();
            } else if (response.responseCode == responseCode.fail) {
                $("#msg-cancel-appointment").html(response.message);
                $("#msg-cancel-appointment").addClass(" alert-danger");
                $("#msg-cancel-appointment").show();
                window.setTimeout(function () {
                    $("#msg-cancel-appointment").hide();
                }, 3000);
                loadDataCurrentApm();
            } else alert("RES: " + response.responseCode + ": " + response.message + "Vui lòng thử lại sau ít phút.");
        },
        error: function (xhr) {
            alert("ER: Hệ thống gặp sự cố, vui lòng thử lại sau ít phút. Chi tiết lỗi: " + xhr.responseText + ", " + xhr.status + ", " + xhr.error);
        }
    });
})


$(document).ready(function () {
    loadDataCurrentApm();
    loadDataShop();
});
