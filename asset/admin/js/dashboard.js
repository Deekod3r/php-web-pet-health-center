var month = [];
var dataRevenue = [];
var dataRevenueGrowth = [];
var dataAppointments = [];
var now = new Date().getMonth() + 1;
for (var i = 1; i <= now; i++) {
    month.push(i);
}
var totalRevenueCurrentYear = 0;

function loadRevenue() {
    new Chart("myChart", {
        type: "line",
        data: {
            labels: month,
            datasets: [{
                fill: false,
                lineTension: 0,
                backgroundColor: "rgba(0,0,255,1.0)",
                borderColor: "rgba(0,0,255,0.1)",
                data: dataRevenue
            }]
        },
        options: {
            title: {
                display: true,
                text: "Doanh thu tháng",
                fontSize: 16
            },
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    ticks: {
                        min: Math.min(...dataRevenue),
                        max: Math.max(...dataRevenue) + Math.pow(10,Math.max(...dataRevenue).toString().length - 1)
                    }
                }],
            }
        }
    });
    dataRevenueGrowth[0] = 0;
    for (var i = 1; i < dataRevenue.length; i++) {
        if (dataRevenue[i-1] == 0 ) {
            if (dataRevenue[i] != 0) growth = 100; else growth = 0;
        } else {
            growth = (dataRevenue[i]-dataRevenue[i-1])/dataRevenue[i-1] * 100;
            console.log(dataRevenue[i],dataRevenue[i-1],growth,(dataRevenue[i]-dataRevenue[i-1])/dataRevenue[i-1]);
        }
        dataRevenueGrowth[i] = growth;
    }
    new Chart("myChart2", {
        type: "line",
        data: {
            labels: month,
            datasets: [{
                fill: false,
                lineTension: 0,
                backgroundColor: "rgba(0,0,255,1.0)",
                borderColor: "rgba(0,0,255,0.1)",
                data: dataRevenueGrowth
            }]
        },
        options: {
            title: {
                display: true,
                text: "Tăng trưởng doanh thu",
                fontSize: 16
            },
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    ticks: {
                        min: Math.min(...dataRevenueGrowth) - Math.pow(10,Math.max(...dataRevenueGrowth).toString().length - 1),
                        max: Math.max(...dataRevenueGrowth) + Math.pow(10,Math.max(...dataRevenueGrowth).toString().length - 1)
                    }
                }],
            }
        }
    });
    $('#revenue-current-month').html(new Intl.NumberFormat("vi-VN", {
        style: "currency",
        currency: "VND",
    }).format(dataRevenue[now-1]));
    $('#revenue-current-year').html(new Intl.NumberFormat("vi-VN", {
        style: "currency",
        currency: "VND",
    }).format(totalRevenueCurrentYear));
}


function loadAppointment() {
    new Chart("myChart1", {
        type: "line",
        data: {
            labels: month,
            datasets: [{
                fill: false,
                lineTension: 0,
                backgroundColor: "rgba(0,0,255,1.0)",
                borderColor: "rgba(0,0,255,0.1)",
                data: dataAppointments
            }]
        },
        options: {
            title: {
                display: true,
                text: "Lịch hẹn tháng",
                fontSize: 16
            },
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    ticks: {
                        min: Math.min(...dataAppointments),
                        max: Math.max(...dataAppointments) + Math.pow(10,Math.max(...dataAppointments).toString().length - 1)
                    }
                }],
            }
        }
    });
}

$(document).ready(function () {

    $.ajax({
        type: "POST",
            url: "?controller=bill&action=data_statistic_revenue_bill",
            data: {
                token: sessionStorage.getItem("token")
            },
            dataType: "json",
            success: function (response) {
                //console.log(response);
                if (response.responseCode == responseCode.success) {
                    //console.log(response.data.bills);
                    let total = 0;
                    for (var i = 0; i < month.length; i++) {
                        for (var j = 0; j < response.data.bills.length ; j++) {
                            if (response.data.bills[j].month1 == i+1) {
                                dataRevenue[i] = response.data.bills[j].revenue;
                                total += dataRevenue[i]; 
                                break;    
                            } else {
                                dataRevenue[i] = 0;
                            }
                        }
                    }
                    totalRevenueCurrentYear = total;
                    loadRevenue();
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
    })

    $.ajax({
        type: "POST",
        url: "?controller=appointment&action=data_statistic_appointment",
        data: {
            token: sessionStorage.getItem("token")
        },
        dataType: "json",
        success: function (response) {
            //console.log(response);
            if (response.responseCode == responseCode.success) {
                //console.log(response.data.appointments);
                for (var i = 0; i < month.length; i++) {
                    for (var j = 0; j < response.data.appointments.length ; j++) {
                        if (response.data.appointments[j].month == i+1) {
                            dataAppointments[i] = response.data.appointments[j].appointments; 
                            break;    
                        } else {
                            dataAppointments[i] = 0;
                        }
                    }
                }
                loadAppointment();
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
    })

    $.ajax({
        type: "POST",
        url: "?controller=appointment&action=new_appointment",
        data: {
            token: sessionStorage.getItem("token")
        },
        dataType: "json",
        success: function (response) {
            //console.log(response);
            if (response.responseCode == responseCode.success) {
                //console.log(response)
                $('#new-appointment').html(response.data.newAppointment);                
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
    })

    $.ajax({
        type: "POST",
        url: "?controller=feedback&action=new_feedback",
        data: {
            token: sessionStorage.getItem("token")
        },
        dataType: "json",
        success: function (response) {
            //console.log(response);
            if (response.responseCode == responseCode.success) {
                //console.log(response)
                $('#new-feedback').html(response.data.newFeedback);                
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
    })
})