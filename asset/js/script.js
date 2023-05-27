const number = /[0-9]/;
const lowerChars = /[a-z]/;
const upperChars = /[A-Z]/;
const specialChars = /[\.!\'^£$%&*()}{@#~?><,|=_+¬-]/;
const regNumber = /^\d+$/;


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
            } else alert("RES: " + response.responseCode + ": " + response.message + "Vui lòng thử lại sau ít phút.");
        },
        error: function (xhr) {
            alert("ER: Hệ thống gặp sự cố, vui lòng thử lại sau ít phút. Chi tiết lỗi: " + xhr.responseText + ", " + xhr.status + ", " + xhr.error);
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
                sessionStorage.clear();
                window.location.replace('?controller=home&action=index');
            } else alert("RES: " + response.responseCode + ": " + response.message + "Vui lòng thử lại sau ít phút.");
        },
        error: function (xhr) {
            alert("ER: Hệ thống gặp sự cố, vui lòng thử lại sau ít phút. Chi tiết lỗi: " + xhr.responseText + ", " + xhr.status + ", " + xhr.error);
        }
    })
}

function setService(idCS){
    sessionStorage.setItem('csId',idCS);
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

const typePet = {
    cat : 0,
    dog : 1,
    both : 2
}

const gender = {
    male : 1,
    female : 0
}

const statusAppointment = {
    confirmNo : 3,
    confirmYes : 2,
    cancel : 0,
    done : 1
}

const statusObject = {
    active: 1,
    inActive: 0
}