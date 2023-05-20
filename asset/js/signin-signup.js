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


function checkCharacter(input,num,lowChars,upChars,speChars,length,size) {
    let check = true;
    let number = /[0-9]/;
    let lowerChars = /[a-z]/;
    let upperChars = /[A-Z]/;
    let specialChars = /[\.!\'^£$%&*()}{@#~?><,|=_+¬-]/;
    if (num) {
       check = number.test(input);
       if (!check) return false;
    }
    if (lowChars) {
       check = lowerChars.test(input);
       if (!check) return false;
    }
    if (upChars) {
       check = upperChars.test(input);
       if (!check) return false;
    }
    if (speChars) {
       check = specialChars.test(input);
       if (!check) return false;
    }
    if (length && Number.isInteger(size)) {
       if (input.length < size) check = false;
       if (!check) return false;
    }
    return check;
 }


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
                        $('#msg-login').html(response.message);
                        $('#alert-login').show();
                        window.setTimeout(function () {
                            $('#alert-login').hide()
                        }, 3000);
                    }
                },
                error: function (error) {
                    $('#msg-login').html("Lỗi đăng nhập, vui lòng thử lại sau ít phút. " + error);
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
        let password = $('#register').find('input[name="rgPassword"]').val();
        let confirmPassword = $('#rg-confirm-password').val();
        let name = $('#register').find('input[name="rgName"]').val();
        let phone = $('#register').find('input[name="rgPhone"]').val();
        //let email = $('#register').find('input[name="rgEmail"]').val();
        let address = $('#register').find('input[name="rgAddress"]').val();
        let gender = $('#register').find('input[name="rgGender"]:checked').val();
        if (password != "" && confirmPassword != "" && name != "" && address != "" && phone != "" && gender != "") {
            if (name.length >= 2) {
                if (phone.length >= 10 && phone.length <= 13 && checkCharacter(phone,true,false,false,false,false,false,0)) {
                    if (password == confirmPassword) {
                        if (checkCharacter(password,true,true,true,true,true,8)) {
                            $.ajax({
                                type: $(this).attr('method'),
                                url: $(this).attr('action'),
                                data: $(this).serialize(),
                                dataType: 'json',
                                success: function (response) {
                                    console.log(response);
                                    if (response.responseCode == responseCode.success) {
                                        $('#msg-register').html("Tạo tài khoản thành công.");
                                        $('#msg-register').show();
                                        $('#register')[0].reset();
                                    } else {
                                        $('#msg-register').html(response.message);
                                        $('#msg-register').show();
                                    }
                                },
                                error: function (error) {
                                    $('#msg-login').html("Lỗi đăng ký, vui lòng thử lại sau ít phút. " + error);
                                    $('#msg-register').show(); 
                                }
                            })
                        } else $('#msg-register').html("Mật khẩu phải bao gồm chữ cái hoa, chữ cái thường, số, ít nhất 1 ký tự đặc biệt và có độ dài tối thiểu 8 ký tự.");
                    } else {
                        $('#msg-register').html("Mật khẩu chưa trùng khớp.");
                    }
                } else {
                    $('#msg-register').html("Số điện thoại không hợp lệ.");
                }
            } else {
                $('#msg-register').html("Họ và tên có độ dài tối thiểu 2 ký tự.");
            }
        } else $('#msg-register').html("Vui lòng nhập đầy đủ thông tin đăng nhập.");
        $('#msg-register').show();
        window.setTimeout(function () {
            $('#msg-register').hide()
        }, 5000);
        e.preventDefault();
    })

})
