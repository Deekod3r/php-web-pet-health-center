$(document).ready(function () {

    $.ajax({
        type: "GET",
        url: "?controller=categoryservice&action=data_category_service",
        dataType: "json",
        success: function (response) {
            //console.log(response);
            if (response.responseCode == responseCode.success) {
                var categoryServiceData = "";
                response.data.categoryServices.forEach((element) => {
                    categoryServiceData +=
                        "<option value='" +
                        element.cs_id +
                        "'>" +
                        element.cs_name +
                        "</option>";
                });
                $("#category-service").append(categoryServiceData);
            } else if (response.responseCode != responseCode.dataEmpty)
                alert(
                    "RES: " +
                    response.responseCode +
                    ": " +
                    response.message +
                    "Vui lòng thử lại sau ít phút."
                );
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
        }
    });

    // $("#submit").click(function (e) {
    //     svName = $("#service-name").val();
    //     svDescription = $("#service-description").val();
    //     categoryService = $("#category-service").val();
    //     typPet = $("#type-pet").val();
    //     servicePrice = $("#service-price").val() != '' && $("#service-price").val() > 0 ? $("#service-price").val() : 0 ;
    //     svStatus = $("#service-status").val();
    //     svImg = $("#service-img")[0].files[0];
    //     console.log(svName, svDescription, categoryService, servicePrice, svStatus, typPet,svImg.name);
    // })

    $("#form-add-service").submit(function (e) {
        svName = $("#service-name").val().trim();
        svDescription = $("#service-description").val().trim();
        categoryService = $("#category-service").val().trim();
        typPet = $("#type-pet").val().trim();
        servicePrice = $("#service-price").val().trim() != '' && $("#service-price").val() > 0 ? parseInt($("#service-price").val()) : 0;
        svStatus = $("#service-status").val().trim();
        //svImg = $("#service-img")[0].files[0];
        // console.log(sessionStorage.getItem('token')); return false;
        if (svName == '' || svDescription == '' || categoryService == '' || typPet == '' || svStatus == '' || servicePrice == '') {
            $('#msg-service').html("CLI: Thông tin không được bỏ trống.");
            $('#msg-service').show()
            window.setTimeout(function () {
                $('#msg-service').hide()
            }, 3000);
            return false;
        }
        if (servicePrice < 0 || !Number.isInteger(servicePrice)) {
            $('#msg-service').html("CLI: Giá tiền không hợp lệ.");
            $('#msg-service').show()
            window.setTimeout(function () {
                $('#msg-service').hide()
            }, 3000);
            return false;
        }
        //console.log(svName, svDescription, categoryService, servicePrice, svStatus, typPet,svImg.name, sessionStorage.getItem('token'));
        let token = sessionStorage.getItem('token')
        //return false;
        $.ajax({
            type: "POST",
            url: "?controller=service&action=add_service",
            data: {
                token: token,
                svName: svName,
                categoryService: categoryService,
                typePet: typPet,
                svDescription: svDescription,
                svPrice: servicePrice,
                svStatus: svStatus,
                //svImg: svImg,
                // test: 1
            },
            dataType: "json",
            success: function (response) {
                //console.log(response);
                if (response.responseCode == responseCode.success) {
                    sessionStorage.setItem('addService', true);
                    sessionStorage.setItem('msgService', "Thêm dịch vụ thành công");
                    window.location.href = "?controller=service&action=service_page_ad";
                } else {
                    $('#msg-service').html(response.message);
                    $('#msg-service').show()
                    window.setTimeout(function () {
                        $('#msg-service').hide()
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
    });

});
