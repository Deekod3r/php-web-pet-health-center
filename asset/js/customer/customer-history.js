$(document).ready(function() {
    $.ajax({
        type: 'GET',
        url: 'https://carepet65.com/routes.php?controller=bill&action=data_customer_history',
        data: {
            token: sessionStorage.getItem('token')
        },
        //cache: false,
        //contentType: "application/json; charset=utf-8",
        dataType: 'json',
        success: function(response) {
            console.log(response);
            // response = JSON.stringify(response);
            // response = JSON.parse(response);
            if(response.statusCode == "1"){
                var billData = "";
                response.data.bill.forEach(element => {
                    discount = element.dc_id == null ? 'Không' : element.dc_id;
                    billData += "<tr class=''>"
                    billData += "<td scope='row' class=''>"+ element.bill_id +"</td>"
                    billData += "<td>"+ element.bill_date_release +"</td>"
                    billData += "<td>"+ discount +"</td>"
                    billData += "<td>"+ element.value_temp +" VND</td>"
                    billData += "<td>"+ element.value_reduced +" VND</td>"
                    billData += "<td>"+ element.total_value +" VND</td>"
                    billData += "<td><a style='font-weight:600' href='"+ element.bill_id +"'>Xem chi tiết</a></td>"
                    billData += "</tr>"
                });
                $('#body-table').html(billData);
                loadDataShop();
            } else alert("Lỗi tải dữ liệu, vui lòng thử lại sau ít phút.");
        },
        error: function(xhr, status, error) {
            alert("Hệ thống gặp sự cố, vui lòng thử lại sau ít phút.");
        }
    })
})