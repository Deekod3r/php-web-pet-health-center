$(document).ready(function () {
    loadDataShop();
    $.ajax({
        type: 'GET',
        url: '?controller=categoryservice&action=data_category_service',
        // data: {
        //     token: sessionStorage.getItem('token')
        // },
        //cache: false,
        //contentType: "application/json; charset=utf-8",
        dataType: 'json',
        success: function (response) {
            console.log(response);
            // response = JSON.stringify(response);
            // response = JSON.parse(response);
            if (response.statusCode == "1") {
                if (sessionStorage.getItem('token') != null && sessionStorage.getItem('token') != '') {
                    var categoryServiceData = "";
                    response.data.categoryService.forEach(element => {
                        categoryServiceData += "<option value='" + element.cs_id + "'>" + element.cs_name + "</option>"
                    });
                    $('#category-service').append(categoryServiceData);
                }
            } else alert("Lỗi tải dữ liệu, vui lòng thử lại sau ít phút.");
        },
        error: function (xhr, status, error) {
            alert("Hệ thống gặp sự cố, vui lòng thử lại sau ít phút.");
        }
    });

    $('#form-booking').submit(function (e) {
        if ($('#apm-date').val() != '' && $('#apm-time').val() != '' && $('#apm-note').val() != '' && $('#category-service').val() != '') {
            $.ajax({
                type: 'POST',
                url: '?controller=appointment&action=booking',
                data: {
                    token: sessionStorage.getItem('token'),
                    apmDate: $('#apm-date').val(),
                    apmTime: $('#apm-time').val(),
                    apmNote: $('#apm-note').val(),
                    categoryService: $('#category-service').val()
                },
                //cache: false,
                //contentType: "application/json; charset=utf-8",
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    // response = JSON.stringify(response);
                    // response = JSON.parse(response);
                    if (response.statusCode == "1") {
                        $('#apm-date').val(''),
                            $('#apm-time').val(''),
                            $('#apm-note').val(''),
                            $('#category-service').val('')
                        $('#msg-booking').html(response.message);
                        $('#msg-booking').addClass(' alert-success');
                        $('#msg-booking').show();
                        window.setTimeout(function () {
                            $('#msg-booking').hide()
                        }, 3000);
                    } else if (response.statusCode == "0") {
                        $('#msg-booking').html(response.message);
                        $('#msg-booking').addClass(' alert-danger');
                        $('#msg-booking').show();
                        window.setTimeout(function () {
                            $('#msg-booking').hide()
                        }, 3000);
                    } else alert("Lỗi tải dữ liệu, vui lòng thử lại sau ít phút.");
                },
                error: function (xhr, status, error) {
                    alert("Hệ thống gặp sự cố, vui lòng thử lại sau ít phút." + " Chi tiết lỗi: " + error);
                    console.log("Hệ thống gặp sự cố, vui lòng thử lại sau ít phút." + " Chi tiết lỗi: " + error);
                }
            })
        } else {
            $('#msg-booking').html('Vui lòng nhập đầy đủ thông tin.');
            $('#msg-booking').addClass(' alert-danger');
            $('#msg-booking').show();
            window.setTimeout(function () {
                $('#msg-booking').hide()
            }, 3000);
        }
        e.preventDefault();
    })
})