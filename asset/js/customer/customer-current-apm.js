function loadDataCurrentApm() {
    $.ajax({
        type: "GET",
        url: "?controller=appointment&action=data_customer_current_apm",
        data: {
            token: sessionStorage.getItem("token"),
        },
        dataType: "json",
        success: function (response) {
            console.log(response);
            if (response.responseCode == responseCode.success) {
                var appointmentData = "";
                response.data.appointment.forEach((element) => {
                    let statusApm = element.apm_status;
                    switch (element.apm_status) {
                        case statusAppointment.cancel:
                            statusApm = "Đã huỷ";
                            break;
                        case statusAppointment.confirmNo:
                            statusApm = "Chờ xác nhận";
                            break;
                        case statusAppointment.confirmYes:
                            statusApm = "Đã xác nhận";
                            break;
                        case statusAppointment.done:
                            statusApm = "Hoàn thành";
                            break;
                    }
                    appointmentData += "<tr class=''>";
                    appointmentData +=
                        "<td scope='row' class=''>" + element.apm_id + "</td>";
                    appointmentData += "<td>" + element.apm_date + "</td>";
                    appointmentData += "<td>" + element.apm_time + "</td>";
                    appointmentData += "<td>" + element.cs_name + "</td>";
                    appointmentData += "<td>" + element.apm_note + "</td>";
                    appointmentData += "<td>" + statusApm + "</td>";
                    appointmentData += "<td>";
                    if (element.apm_status == 0) {
                        appointmentData +=
                            "<a class='btn btn-danger' id='cancel-appointment' onclick='cancelAppointment(" +
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
            alert(
                "Hệ thống gặp sự cố, vui lòng thử lại sau ít phút. Chi  tiết lỗi: " +
                xhr.responseText +
                ", " +
                xhr.status +
                ", " +
                xhr.error
            );
        },
    });
}

function cancelAppointment(id) {
    if (confirm("Are you sure you want to cancel?")) {
        //console.log(sessionStorage.getItem("token"));
        $.ajax({
            type: "POST",
            url: "?controller=appointment&action=cancel_appointment",
            data: {
                token: sessionStorage.getItem("token"),
                idApm: id,
            },
            dataType: "json",
            success: function (response) {
                //console.log(response);
                if (response.responseCode == responseCode.success) {
                    $("#msg-cancel-appointment").html(response.message);
                    $("#msg-cancel-appointment").addClass(" alert-success");
                    $("#msg-cancel-appointment").show();
                    window.setTimeout(function () {
                        $("#msg-cancel-appointment").hide();
                    }, 3000);
                    loadDataCurrentApm();
                } else if (response.statusCode == "00") {
                    $("#msg-cancel-appointment").html(response.message);
                    $("#msg-cancel-appointment").addClass(" alert-danger");
                    $("#msg-cancel-appointment").show();
                    window.setTimeout(function () {
                        $("#msg-cancel-appointment").hide();
                    }, 3000);
                    loadDataCurrentApm();
                } else
                    alert(
                        response.responseCode +
                        ": " +
                        response.message +
                        "Vui lòng thử lại sau ít phút."
                    );
            },
            error: function (xhr) {
                alert(
                    "Hệ thống gặp sự cố, vui lòng thử lại sau ít phút. Chi  tiết lỗi: " +
                    xhr.responseText +
                    ", " +
                    xhr.status +
                    ", " +
                    xhr.error
                );
            },
        });
    }
}

$(document).ready(function () {
    loadDataCurrentApm();
    loadDataShop();
});
