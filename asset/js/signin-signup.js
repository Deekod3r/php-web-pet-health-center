const container = document.querySelector(".container"),
    pwShowHide = document.querySelectorAll(".showHidePw"),
    pwFields = document.querySelectorAll(".password"),
    signUp = document.querySelector(".signup-link"),
    login = document.querySelector(".login-link");

pwShowHide.forEach(eyeIcon => {
    eyeIcon.addEventListener("click", () => {
        pwFields.forEach(pwField => {
            if (pwField.type === "password") {
                pwField.type = "text";

                pwShowHide.forEach(icon => {
                    icon.classList.replace("uil-eye-slash", "uil-eye");
                })
            } else {
                pwField.type = "password";

                pwShowHide.forEach(icon => {
                    icon.classList.replace("uil-eye", "uil-eye-slash");
                })
            }
        })
    })
})


signUp.addEventListener("click", () => {
    container.classList.add("active");
});
login.addEventListener("click", () => {
    container.classList.remove("active");
});

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
                success: function (response) {
                    // response = JSON.stringify(response);
                    // response = JSON.parse(response);
                    //console.log(response);
                    if (response.statusCode == "1") {
                        sessionStorage.setItem("token", response.data.token);
                        if (response.data.typeAccount == "admin") {
                            window.location.href = '?controller=home&action=index_admin'
                        } else window.location.href = '?controller=home&action=index';
                    } else {
                        $('#msg-login').html(response.message);
                        $('#alert-login').show();
                        window.setTimeout(function () {
                            $('#alert-login').hide()
                        }, 3000);
                    }
                },
                error: function (xhr, status, error) {
                    $('#msg-login').html("Lỗi đăng nhập, vui lòng thử lại sau ít phút." + error);
                }
            })
        } else {
            $('#msg-login').html("Vui lòng điền đầy đủ thông tin đăng nhập.");
            $('#alert-login').show();
            window.setTimeout(function () {
                $('#alert-login').hide()
            }, 3000);
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
