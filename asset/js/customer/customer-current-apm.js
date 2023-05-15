function loadDataCurrentApm() {
    $.ajax({
        type: "GET",
        url: "?controller=appointment&action=data_customer_current_apm",
        data: {
            token: sessionStorage.getItem("token")
        },
        //cache: false,
        //contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function (response) {
            //console.log(response);
            // response = JSON.stringify(response);
            // response = JSON.parse(response);
            if (response.statusCode == "1") {
                var appointmentData = "";
                response.data.appointment.forEach((element) => {
                    appointmentData += "<tr class=''>";
                    appointmentData +=
                        "<td scope='row' class=''>" + element.apm_id + "</td>";
                    appointmentData += "<td>" + element.apm_date + "</td>";
                    appointmentData += "<td>" + element.apm_time + "</td>";
                    appointmentData += "<td>" + element.cs_id + "</td>";
                    appointmentData += "<td>" + element.apm_note + "</td>";
                    appointmentData += "<td>" + element.apm_status + "</td>";
                    appointmentData += "<td>";
                    if (element.apm_status == 0) {
                        appointmentData += "<a class='btn btn-danger' id='cancel-appointment' onclick='cancelAppointment(" + element.apm_id + ")'>Huỷ</a>";
                    }
                    appointmentData += "</td>";
                    appointmentData += "</tr>";
                });
                $("#body-table").html(appointmentData);
            } else alert("Lỗi tải dữ liệu, vui lòng thử lại sau ít phút.");
        },
        error: function (xhr, status, error) {
            alert("Hệ thống gặp sự cố, vui lòng thử lại sau ít phút.");
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
                idApm: id
            },
            //cache: false,
            //contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: function (response) {
                //console.log(response);
                // response = JSON.stringify(response);
                // response = JSON.parse(response);
                if (response.statusCode == "1") {
                    $('#msg-cancel-appointment').html(response.message);
                    $('#msg-cancel-appointment').addClass(" alert-success");
                    $('#msg-cancel-appointment').show();
                        window.setTimeout(function () {
                            $('#msg-cancel-appointment').hide()
                    }, 3000);
                    loadDataCurrentApm();
                } else if (response.statusCode == "0") {
                    $('#msg-cancel-appointment').html(response.message);
                    $('#msg-cancel-appointment').addClass(" alert-danger");
                    $('#msg-cancel-appointment').show();
                        window.setTimeout(function () {
                            $('#msg-cancel-appointment').hide()
                    }, 3000);
                    loadDataCurrentApm();
                } else alert("Lỗi tải dữ liệu, vui lòng thử lại sau ít phút.");
            },
            error: function (xhr, status, error) {
                alert("Vui lòng thử lại sau ít phút.");
            },
        });
    }
};

$(document).ready(function () {
    loadDataCurrentApm();
    loadDataShop();
});
