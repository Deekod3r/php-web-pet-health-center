//console.log("token="+sessionStorage.getItem('token')); 

$(document).ready(function() {
    $.ajax({
        type: 'GET',
        url: '?controller=customer&action=data_customer_info',
        data: {
            token: sessionStorage.getItem('token')
        },
        dataType: 'json',
        success: function(response) {
            console.log(response);
            //console.log(response);
            if(response.responseCode == "01"){
                $('#ctm-name').append(response.data.customer.ctm_name);
                $('#ctm-phone').append(response.data.customer.ctm_phone);
                $('#ctm-address').append(response.data.customer.ctm_address);
                $('#ctm-email').append(response.data.customer.ctm_email);
                loadDataShop();
            } else alert(response.responseCode + ": " + response.message + "Vui lòng thử lại sau ít phút.");
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
        }
    })
})