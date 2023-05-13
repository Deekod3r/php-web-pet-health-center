//console.log("token="+sessionStorage.getItem('token')); 

$(document).ready(function() {
    $.ajax({
        type: 'GET',
        url: 'https://carepet65.com/routes.php?controller=customer&action=data_customer_info',
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
                $('#ctm_name').append(response.data.customer.ctm_name);
                $('#ctm_phone').append(response.data.customer.ctm_phone);
                $('#ctm_address').append(response.data.customer.ctm_address);
                $('#ctm_email').append(response.data.customer.ctm_email);

                loadDataShop();
            } else alert("Lỗi tải dữ liệu, vui lòng thử lại sau ít phút.");
        },
        error: function(xhr, status, error) {
            alert("Hệ thống gặp sự cố, vui lòng thử lại sau ít phút.");
        }
    })
})