function checkSpecialCharacter(character) {
    var format = /[ `!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
    var formatPassword = /[ `!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
    format.test("");
}

function confirmAction(action, object) {
    return confirm("Bạn có muốn " + action + " " + object + " " + "không?");
}

function loadDataShop(){
    $.ajax({
        type: 'GET',
        url: '?controller=shop&action=data_shop',
        // data: {
        //     token: sessionStorage.getItem('token')
        // },
        //cache: false,
        //contentType: "application/json; charset=utf-8",
        dataType: 'json',
        success: function(response) {
            //console.log(response);
            // response = JSON.stringify(response);
            // response = JSON.parse(response);
            if(response.statusCode == "1"){
                $('.shop-name').html(response.data.shop.shop_name);
                $('.shop-address').append(response.data.shop.shop_address);
                $('.shop-mail').append(response.data.shop.shop_mail);
                $('.shop-phone').append(response.data.shop.shop_phone);
                $('.shop-fb').attr('href',response.data.shop.shop_facebook);
                $('.shop-desc').append(response.data.shop.shop_description);
            } else alert("Lỗi tải dữ liệu, vui lòng thử lại sau ít phút.");
        },
        error: function(xhr, status, error) {
            alert("Hệ thống gặp sự cố, vui lòng thử lại sau ít phút.");
        }
    })
}

function logout() {
    $.ajax({
        type: 'GET',
        url: '?controller=home&action=logout',
        // data: {
        //     token: sessionStorage.getItem('token')
        // },
        //cache: false,
        //contentType: "application/json; charset=utf-8",
        dataType: 'json',
        success: function(response) {
            //console.log(response);
            // response = JSON.stringify(response);
            // response = JSON.parse(response);
            if(response.statusCode == "1"){
                sessionStorage.removeItem('token');
                window.location.replace('?controller=home&action=index');
            } else alert("Lỗi tải dữ liệu, vui lòng thử lại sau ít phút.");
        },
        error: function(xhr, status, error) {
            alert("Hệ thống gặp sự cố, vui lòng thử lại sau ít phút.");
        }
    })
}