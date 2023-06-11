function loadData(){
    $.ajax({
        type: "GET",
        url: "?controller=service&action=data_detail_service",
        data : {
            idService: new URLSearchParams(document.location.href).get("id")
        },
        dataType: "json",
        success: function (response) {
            //console.log(response);
            if (response.responseCode == responseCode.success) {
                sv = response.data.service;
                // sv_price = sv.sv_price == 0 ? "Liên hệ" : new Intl.NumberFormat("vi-VN", {style: "currency",currency: "VND",}).format(sv.sv_price);
                $('#service-id').val(sv.sv_id);
                $('#service-name').val(sv.sv_name);
                $('#service-description').val(sv.sv_description);
                $('#service-price').val(parseInt(sv.sv_price));
                $('#type-pet').val(sv.sv_pet);
                $('#category-service').val(sv.cs_id);
                $('#service-status').val(sv.sv_status);
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
}

function preview() {
    frame.src = URL.createObjectURL(event.target.files[0]);
    $('#frame').show();
    $('#clear-img').show();
}
function clearImage() {
    document.getElementById('service-img').value = null;
    frame.src = "";
    $('#frame').hide();
    $('#clear-img').hide();
}

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

    loadData();

    $("#reset").click(function () {
        loadData();
    })

    $("#form-edit-service").submit(function (e) {
        svId = $('#service-id').val().trim();
        svName = $("#service-name").val().trim();
        svDescription = $("#service-description").val().trim();
        categoryService = $("#category-service").val().trim();
        typPet = $("#type-pet").val().trim();
        servicePrice = $("#service-price").val().trim() != '' && $("#service-price").val() >= 0 ? parseInt($("#service-price").val()) : parseInt(0);
        svStatus = $("#service-status").val().trim();
        svImg = $("#service-img")[0].files[0];
        //svImg = $("#service-img")[0].files[0];
        // console.log(sessionStorage.getItem('token')); return false;
        if (svId == '' || svName == '' || svDescription == '' || categoryService == '' || typPet == '' || svStatus == '') {
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
        let formData = new FormData();
        if (svImg != null) {
            type = svImg.type.substring(6);
            if (type != 'jpg' && type != 'jpeg' && type != 'png' && type != 'gif') {
                $('#msg-service').html("CLI: Định dạng file không phù hợp. Vui lòng tải các file có đinh dạng: jpg, jpeg, png, gif");
                $('#msg-service').show()
                window.setTimeout(function () {
                    $('#msg-service').hide()
                }, 3000);
                return false;
            }
            formData.append('svImg',svImg,Date.now()+svImg.name);
        }
        //console.log(svName, svDescription, categoryService, servicePrice, svStatus, typPet,svImg.name, sessionStorage.getItem('token'));
        formData.append('svName', svName);
        formData.append('svId', svId);
        formData.append('categoryService', categoryService);
        formData.append('typePet', typPet);
        formData.append('svDescription', svDescription);
        formData.append('svPrice', servicePrice);
        formData.append('svStatus', svStatus);
        formData.append('token', sessionStorage.getItem('token'));
        //return false;
        $.ajax({
            type: "POST",
            url: "?controller=service&action=edit_service",
            data: formData,
            dataType: "json",
            processData: false,
            contentType: false,
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
