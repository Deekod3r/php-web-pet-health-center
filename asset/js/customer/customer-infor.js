//console.log("token="+sessionStorage.getItem('token')); 

$(document).ready(function() {
    $.ajax({
        type: 'GET',
        url: '?controller=customer&action=data_customer_info',
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
            //console.log(response);
            if(response.statusCode == "1"){
                $('#ctm-name').append(response.data.customer.ctm_name);
                $('#ctm-phone').append(response.data.customer.ctm_phone);
                $('#ctm-address').append(response.data.customer.ctm_address);
                $('#ctm-email').append(response.data.customer.ctm_email);

                loadDataShop();
            } else alert("Lỗi tải dữ liệu, vui lòng thử lại sau ít phút.");
        },
        error: function(xhr, status, error) {
            alert("Hệ thống gặp sự cố, vui lòng thử lại sau ít phút.");
        }
    })
})