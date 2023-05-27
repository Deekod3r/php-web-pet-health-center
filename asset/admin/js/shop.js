function dataShop(){
    $.ajax({
        type: 'GET',
        url: '?controller=shop&action=data_shop',
        dataType: 'json',
        success: function(response) {
            //console.log(response);
            if (response.responseCode == responseCode.success) {
                $('#shop-name').val(response.data.shop.shop_name);
                $('#shop-address').val(response.data.shop.shop_address);
                $('#shop-mail').val(response.data.shop.shop_mail);
                $('#shop-phone').val(response.data.shop.shop_phone);
                $('#shop-facebook').val(response.data.shop.shop_facebook);
                $('#shop-desc').val(response.data.shop.shop_description);
            } else alert("RES: " + response.responseCode + ": " + response.message + "Vui lòng thử lại sau ít phút.");
        },
        error: function (xhr) {
            alert("ER: Hệ thống gặp sự cố, vui lòng thử lại sau ít phút. Chi tiết lỗi: " + xhr.responseText + ", " + xhr.status + ", " + xhr.error);
        }
    })
}

$(document).ready(function () {
    dataShop();

    $('#form-data-shop').submit(function(e){
        shopName = $('#shop-name').val();
        shopAddress = $('#shop-address').val();
        shopMail = $('#shop-mail').val();
        shopPhone = $('#shop-phone').val();
        shopFacebook = $('#shop-facebook').val();
        shopDesc = $('#shop-desc').val();
        console.log(shopName);
        console.log(shopAddress);
        console.log(shopMail, );
        console.log(shopPhone);
        console.log(shopFacebook);
        console.log(shopDesc);
        if (shopFacebook == '' || shopName == '' || shopAddress == '' || shopPhone == '' || shopDesc == '' || shopMail == ''){
            $("#msg-shop").html("Thông tin không được bỏ trống.");
            $("#msg-shop").addClass(" alert-danger");
            $("#msg-shop").show();
            window.setTimeout(function () {
                $("#msg-shop").hide();
                $("#msg-shop").removeClass(" alert-danger");
            }, 3000);
            return false;
        }
        token = sessionStorage.getItem('token');
        $.ajax({
            type: "POST",
            url: "?controller=shop&action=edit_shop",
            data: {
                token: token,
                shopName : shopName,
                shopAddress : shopAddress,
                shopMail : shopMail,
                shopPhone : shopPhone,
                shopFacebook : shopFacebook,
                shopDesc : shopDesc
            },
            dataType: "json",
            success: function (response) {
                console.log(response);
                if (response.responseCode == responseCode.success) {
                    $("#msg-shop").html("Sửa dữ liệu thành công.");
                    $("#msg-shop").addClass(" alert-success");
                    $("#msg-shop").show();
                    dataShop();
                    window.setTimeout(function () {
                        $("#msg-shop").hide();
                        $("#msg-shop").removeClass(" alert-success");
                    }, 3000);
                } else {
                    $("#msg-shop").html(response.message);
                    $("#msg-shop").addClass(" alert-danger");
                    $("#msg-shop").show();
                    window.setTimeout(function () {
                        $("#msg-shop").hide();
                        $("#msg-shop").removeClass(" alert-danger");
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
    })
});