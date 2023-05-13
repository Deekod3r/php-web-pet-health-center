$(document).ready(function () {

    function checkSpecialCharacter(character) {
        var minLength = 8;
        var number = /[0-9]/;
        var lowCharacter = /[a-z]/;
        var upCharacter = /[A-Z]/;
        var specialChar = /[ `!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
        return number.test(character) && specialChar.test(character) && lowCharacter.test(character) && upCharacter.test(character) && character.length >= minLength;
    }

    $('#login').submit(function (e) {
        $('#msg-login').html("");
        if ($('#lg-password').val() != "" && $('#lg-phone').val() != "") {
            $.ajax({
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    response = JSON.stringify(response);
                    response = JSON.parse(response);
                    console.log(response);
                    console.log(response.checkLogin);
                    if(response.checkLogin == true){
                        window.location.replace("https://carepet65.com/routes.php?controller=home&action=index");
                    } else  $('#msg-login').html("Lỗi đăng nhập.");
                },
                error: function(response) {
                    if(response){
                        //window.location.replace("https://carepet65.com/routes.php?controller=home&action=index");
                    } else  $('#msg-login').html("Thông tin đăng nhập không chính xác.");
                }
            })
        } else {
            $('#msg-login').html("Vui lòng nhập đầy đủ thông tin đăng nhập 1.");
        }
        e.preventDefault();
    });

    $('#register').submit(function (e) {
        e.preventDefault();
        let password = $('#register').find('input[name="rg-password"]').val();
        let confirmPassword = $('#rg-confirm-password').val();
        let name = $('#register').find('input[name="rg-password"]').val();
        let phone = $('#register').find('input[name="rg-phone"]').val();
        let email = $('#register').find('input[name="rg-email"]').val();
        let address = $('#register').find('input[name="rg-address"]').val();
        if (password != "" && email != "" && confirmPassword != "" && email != "" && name != "" && address != "" && phone != "") {
            if (password == confirmPassword) {
                if (checkSpecialCharacter(password)) {
                    this.submit();
                } else $('#msg-login').html("Mật khẩu phải bao gồm chữ cái hoa, chữ cái thường, số, ít nhất 1 ký tự đặc biệt và có độ dài tối thiểu 8 ký tự.");
            } else {
                $('#msg-login').html("Mật khẩu chưa trùng khớp.");
            }
        } else $('#msg-login').html("Vui lòng nhập đầy đủ thông tin đăng nhập.");
    })

})
