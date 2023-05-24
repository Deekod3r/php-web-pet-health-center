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

    $.ajax({
        type: "GET",
        url: "?controller=service&action=data_detail_service",
        data : {
            idService: new URLSearchParams(document.location.href).get("id")
        },
        dataType: "json",
        success: function (response) {
            console.log(response);
            if (response.responseCode == responseCode.success) {
                sv = response.data.service;
                // sv_price = sv.sv_price == 0 ? "Liên hệ" : new Intl.NumberFormat("vi-VN", {style: "currency",currency: "VND",}).format(sv.sv_price);
                $('#service-id').val(sv.sv_id);
                $('#service-name').html(sv.sv_name);
                $('#service-description').html(sv.sv_description);
                $('#service-price').val(parseInt(sv.sv_price));
                $('#type-pet').val(sv.sv_pet).change();
                $('#category-service').val(sv.cs_id).change();
                $('#service-status').val(sv.sv_status).change();
                //$('#service-status').attr("src",sv.sv_img);
            } else  alert(
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

    $("#form-edit-service").submit(function (e) {
        svId = $('#service-id').val();
        svName = $("#service-name").val();
        svDescription = $("#service-description").val();
        categoryService = $("#category-service").val();
        typPet = $("#type-pet").val();
        servicePrice = $("#service-price").val() != '' && $("#service-price").val() > 0 ? parseInt($("#service-price").val()) : 0;
        svStatus = $("#service-status").val();
        //svImg = $("#service-img")[0].files[0];
        // console.log(sessionStorage.getItem('token')); return false;
        if (svId == '' || svName == '' || svDescription == '' || categoryService == '' || typPet == '' || svStatus == '' || servicePrice == '') {
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
            url: "?controller=service&action=edit_service",
            data: {
                token: token,
                svId: svId,
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
                    sessionStorage.setItem('msgService', "Sửa dịch vụ thành công");
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
