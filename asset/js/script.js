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
        dataType: 'json',
        success: function(response) {
            //console.log(response);
            if (response.responseCode == responseCode.success) {
                $('.shop-name').html(response.data.shop.shop_name);
                $('.shop-address').append(response.data.shop.shop_address);
                $('.shop-mail').append(response.data.shop.shop_mail);
                $('.shop-phone').append(response.data.shop.shop_phone);
                $('.shop-fb').attr('href',response.data.shop.shop_facebook);
                $('.shop-desc').append(response.data.shop.shop_description);
            } else alert(response.responseCode + ": " + response.message + "Vui lòng thử lại sau ít phút.");
        },
        error: function(xhr) {
            alert("Hệ thống gặp sự cố, vui lòng thử lại sau ít phút. Chi  tiết lỗi: " + xhr.responseText + ", " + xhr.status + ", " + xhr.error);
        }
    })
}

function logout() {
    $.ajax({
        type: 'GET',
        url: '?controller=home&action=logout',
        dataType: 'json',
        success: function(response) {
            //console.log(response);
            if(response.responseCode == responseCode.success){
                sessionStorage.removeItem('token');
                window.location.replace('?controller=home&action=index');
            } else alert(response.responseCode + ": " + response.message + "Vui lòng thử lại sau ít phút.");
        },
        error: function(xhr) {
            alert("Hệ thống gặp sự cố, vui lòng thử lại sau ít phút. Chi  tiết lỗi: " + xhr.responseText + ", " + xhr.status + ", " + xhr.error);
        }
    })
}

const responseCode = {
    fail : "00",
    success: "01",
    inputEmpty: "02",
    inputInvalidType: "03",
    dataEmpty: "04",
    objectExists: "05",
    objectDoesNotExist: "06",
    dataDoesNotMatch: "07",
    requestInvalid: "98",
    unknownError: "99"
}