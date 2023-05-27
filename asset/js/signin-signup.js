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

    $('#login').submit(function (e) {
        $('#msg-login').html("");
        if ($('#lg-password').val() != "" && $('#lg-phone').val() != "") {
            $.ajax({
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    if (response.responseCode == responseCode.success) {
                        sessionStorage.setItem("token", response.data.token);
                        if (response.data.typeAccount == "admin") {
                            window.location.href = '?controller=home&action=index_admin'
                        } else window.location.href = '?controller=home&action=index';
                    } else {
                        $('#msg-login').html("RES: " + response.message);
                        $('#msg-login').show();
                        window.setTimeout(function () {
                            $('#msg-login').hide()
                        }, 3000);
                    }
                },
                error: function (xhr) {
                    $('#msg-login').html("ER: Lỗi đăng nhập, vui lòng thử lại sau ít phút. " + xhr);
                }
            })
        } else {
            $('#msg-login').html("CLI: Vui lòng điền đầy đủ thông tin đăng nhập.");
            $('#msg-login').show();
            window.setTimeout(function () {
                $('#msg-login').hide()
            }, 3000);
        }
        e.preventDefault();
    });

    $('#register').submit(function (e) {
        let password = $('#register').find('input[name="rgPassword"]').val();
        let confirmPassword = $('#rg-confirm-password').val();
        let name = $('#register').find('input[name="rgName"]').val().trim();
        let phone = $('#register').find('input[name="rgPhone"]').val().trim();
        //let email = $('#register').find('input[name="rgEmail"]').val();
        let address = $('#register').find('input[name="rgAddress"]').val().trim();
        let gender = $('#register').find('input[name="rgGender"]:checked').val();
        if (password != "" && confirmPassword != "" && name != "" && address != "" && phone != "" && gender != "") {
            if (name.length >= 2 && !number.test(name) && !specialChars.test(name)) {
                if (phone.length >= 10 && phone.length <= 13 && regNumber.test(phone)) {
                    if (password == confirmPassword) {
                        if (password.length >= 8 && number.test(password) && specialChars.test(password) && upperChars.test(password) && lowerChars.test(password)) {
                            $.ajax({
                                type: $(this).attr('method'),
                                url: $(this).attr('action'),
                                data: $(this).serialize(),
                                dataType: 'json',
                                success: function (response) {
                                    //console.log(response);
                                    if (response.responseCode == responseCode.success) {
                                        $('#msg-register').html("RES: Tạo tài khoản thành công.");
                                        $('#msg-register').css('color','green');
                                        $('#msg-register').show();
                                        $('#register')[0].reset();
                                    } else {
                                        $('#msg-register').html("RES: " + response.message);
                                        $('#msg-register').show();
                                    }
                                },
                                error: function (xhr) {
                                    $('#msg-register').html("ER: Lỗi đăng ký, vui lòng thử lại sau ít phút. Chi tiết lỗi: " + xhr.responseText + ", " + xhr.status + ", " + xhr.error);
                                    $('#msg-register').show(); 
                                }
                            })
                        } else $('#msg-register').html("CLI: Mật khẩu phải bao gồm chữ cái hoa-thường-số, ít nhất 1 ký tự đặc biệt và độ dài tối thiểu 8 ký tự.");
                    } else {
                        $('#msg-register').html("CLI: Mật khẩu chưa trùng khớp.");
                    }
                } else {
                    $('#msg-register').html("CLI: Số điện thoại chỉ được bao gồm số, độ dài từ 10-13.");
                }
            } else {
                $('#msg-register').html("CLI: Họ và tên có độ dài tối thiểu 2 ký tự, và không được chứa ký tự đặc biệt.");
            }
        } else $('#msg-register').html("CLI: Vui lòng nhập đầy đủ thông tin đăng ký.");
        $('#msg-register').show();
        window.setTimeout(function () {
            $('#msg-register').hide()
            $('#msg-register').css('color','red');
        }, 5000);
        e.preventDefault();
    })
})
