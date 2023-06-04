var billId = new URLSearchParams(document.location.href).get("bill") || "";
var active = false;
var save = false;
var listService = [];
var statusBill;
var discount = {
    id: '',
    percent: 0,
    value: 0
};

function calSubTotal() {
    let total = 0;
    if (listService.length > 0) {
        listService.forEach(element => {
            total += parseInt(element.price) * element.quantity;
        });
    }
    $('#sub-total').html(new Intl.NumberFormat("vi-VN", {
        style: "currency",
        currency: "VND",
    }).format(total));
    calTotal();
}

function calReducedValue() {
    valueReduced = 0;
    console.log(discount);
    valueReduced = (Number($('#sub-total').html().replace(/[^\d,]/g, '')) * discount.percent / 100) + discount.value;
    $('#value-discount').html(new Intl.NumberFormat("vi-VN", {
        style: "currency",
        currency: "VND",
    }).format(valueReduced));
}

function calTotal() {
    total = Number($('#sub-total').html().replace(/[^\d,]/g, '')) - Number($('#value-discount').html().replace(/[^\d,]/g, ''));
    $('#total-value').html(new Intl.NumberFormat("vi-VN", {
        style: "currency",
        currency: "VND",
    }).format(total));
}

function clearDiscount() {
    discount.percent = 0;
    discount.value = 0;
    discount.id = '';
    $('#dc-code').html("");
    $('#value-discount').html(new Intl.NumberFormat("vi-VN", {
        style: "currency",
        currency: "VND",
    }).format(0));
}

function changeQuantity(service, type) {
    if (active) {
        var id = service.parentNode.parentNode.parentNode.children[0].textContent;
        let i = 0;
        while (i < listService.length) {
            if (listService[i].id == id) {
                if (type === 'plus') {
                    listService[i].quantity++;
                } else {
                    if (listService[i].quantity > 1) {
                        listService[i].quantity--;
                    }
                }
                break;
            }
            i++;
        }
        clearDiscount();
        loadService();
    }
}

function changePrice(id, service) {
    if (active) {
        let i = 0;
        while (i < listService.length) {
            if (listService[i].id == id) {
                listService[i].price = service.value;
                break;
            }
            i++;
        }
        clearDiscount();
        loadService();
    }
}

function loadService() {
    $('#list-service').html("");
    if (listService.length > 0) {
        listService.forEach(element => {
            str = "";
            str += "<tr>";
            str += "    <td style='width:8.05%'>" + element.id + "</td>";
            str += "    <td style='width:30.15%'>" + element.name + "</td>";
            str += "    <td style='width:8.05%'>Thú cưng</td>";
            if (element.price == 0) {
                str += "    <td style='width:12.6%'><input class='w-100 form-control' type='number' onchange='changePrice(" + element.id + ",this)' value='" + element.price + "'/></td>";
            } else {
                str += "    <td style='width:12.6%'>" + new Intl.NumberFormat("vi-VN", {
                    style: "currency",
                    currency: "VND",
                }).format(element.price) + "</td>";
            }
            str += "    <td style='width:25%; height: 10%;' class=''>";
            str += "        <div class='wrapper m-0'>";
            str += "            <span class='minus' onclick='changeQuantity(this,\"minus\")'>-</span>";
            str += "            <span class='num' id='quantity'>" + element.quantity + "</span>";
            str += "            <span class='plus' onclick='changeQuantity(this,\"plus\")'>+</span>";
            str += "        </div>";
            str += "    </td>";
            str += "    <td style='width:11.95%'>" + new Intl.NumberFormat("vi-VN", {
                style: "currency",
                currency: "VND",
            }).format((element.price * element.quantity)) + "</td>";
            str += "    <td><a class='border-0' onclick='deleteRow(this)' type='button'>Xoá</a></td>";
            str += "</tr>";
            $('#list-service').append(str);
        });
    }
    // clearDiscount();
    calSubTotal();
}

function select(service) {
    if (listService.length > 0) {
        let i = 0;
        while (i < listService.length) {
            if (listService[i].id == service.children[0].textContent) {
                listService[i].quantity++;
                break;
            }
            i++;
        }
        if (i == listService.length) {
            let obj = {
                id: service.children[0].textContent,
                name: service.children[1].textContent,
                price: Number(service.children[2].textContent.replace(/[^\d,]/g, '')),
                quantity: 1
            }
            listService.push(obj);
        }
    } else {
        let obj = {
            id: service.children[0].textContent,
            name: service.children[1].textContent,
            price: Number(service.children[2].textContent.replace(/[^\d,]/g, '')),
            quantity: 1
        }
        listService.push(obj);
    }
    clearDiscount();
    loadService();
}

function deleteRow(r) {
    if (active) {
        var id = r.parentNode.parentNode.children[0].textContent;
        if (listService.length > 0) {
            let i = 0;
            while (i < listService.length) {
                if (listService[i].id == id) {
                    listService.splice(i, 1);
                    break;
                }
                i++;
            }
        }
        loadService();
    }
}


$(document).ready(function () {
    
    $.ajax({
        type: "GET",
        url: "?controller=bill&action=data_bill",
        data: {
            billId: billId,
            token: sessionStorage.getItem("token")
        },
        dataType: "json",
        success: function (response) {
            if (response.responseCode == responseCode.success) {
                //console.log(response)
                $('#dc-code').html(response.data.bills[0].dc_code);
                $('#value-discount').html(new Intl.NumberFormat("vi-VN", {
                    style: "currency",
                    currency: "VND",
                }).format(response.data.bills[0].value_reduced));
                $('#ctm-name').val(response.data.bills[0].ctm_name)
                $('#ctm-phone').val(response.data.bills[0].ctm_phone)
                $('#bill-id').val(response.data.bills[0].bill_id)
                $('#bill-date').val(response.data.bills[0].bill_date_release)
                if (response.data.bills[0].bill_status == statusObject.active) {
                    billStatus = "Đã thanh toán"
                } else billStatus = "Chưa thanh toán"
                $('#bill-status').val(billStatus)
                if (response.data.bills[0].bill_status == statusObject.inActive) {
                    $('.hidden').show()
                    active = true;
                }
            } else
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
        },
    })

    $.ajax({
        type: "GET",
        url: "?controller=bill&action=data_detail_bill",
        data: {
            idBill: billId,
            token: sessionStorage.getItem('token')
        },
        dataType: "json",
        success: function (response) {
            console.log(response);
            if (response.responseCode == responseCode.success) {
                response.data.detailBill.forEach(element => {
                    let obj = {
                        id: element.sv_id,
                        name: element.sv_name,
                        price: element.sv_price,
                        quantity: element.quantity
                    }
                    listService.push(obj);
                });
                loadService(); 
                save = true;
            } else alert(
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
    })



    $('#service-name').keyup(function () {
        if ($('#service-name').val().trim() != "") {
            $.ajax({
                type: "GET",
                url: "?controller=service&action=data_service",
                data: {
                    svName: $('#service-name').val()
                },
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    if (response.responseCode == responseCode.success) {
                        $('.autocom-box').html("")
                        dataService = "";
                        response.data.services.forEach(element => {
                            sv_price =
                                element.sv_price == 0
                                    ? "Liên hệ"
                                    : new Intl.NumberFormat("vi-VN", {
                                        style: "currency",
                                        currency: "VND",
                                    }).format(element.sv_price);
                            $('.autocom-box').append("<li onclick='select(this)'><span class='sv-id'>" + element.sv_id + "</span> - <span class='sv-name'>" + element.sv_name + "</span> - <span class='sv-price'>" + sv_price + "</span></li>");
                        });
                        $('.autocom-box').show()
                        // $('.autocom-box').html(dataService)
                    } else if (response.responseCode == responseCode.dataEmpty) {
                        $('.autocom-box').html("")
                        $('.autocom-box').hide()
                    } else
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
                },
            });
        } else {
            $('.autocom-box').html("")
            $('.autocom-box').hide()
        }
    })

    $('#execute-discount').submit(function (e) {
        let dcCode = $('#discount-code').val().trim();
        let valueBill = Number($('#sub-total').html().trim().replace(/[^\d,]/g, ''));
        if (dcCode == "") {
            $('#alert-bill').html("Vui lòng nhập mã giảm giá.");
            $('#alert-bill').addClass('alert-danger');
            $('#alert-bill').show();
            window.setTimeout(function () {
                $("#alert-bill").hide();
                $("#alert-bill").removeClass(" alert-danger");
            }, 3000);
            return false;
        }

        $.ajax({
            type: "GET",
            url: "?controller=discount&action=execute_discount",
            data: {
                discountCode: dcCode,
                valueBill: valueBill
            },
            dataType: "json",
            success: function (response) {
                console.log(response);
                if (response.responseCode == responseCode.success) {
                    $('#alert-bill').html("Áp dụng mã giảm giá thành công");
                    $('#alert-bill').addClass('alert-success');
                    $('#alert-bill').show();
                    window.setTimeout(function () {
                        $("#alert-bill").hide();
                        $("#alert-bill").removeClass(" alert-success");
                    }, 3000);
                    discount.percent = response.data.dcValuePercent;
                    discount.value = response.data.dcValue;
                    discount.id = response.data.dcId;
                    console.log(discount);
                    $('#dc-code').html(response.data.dcCode);
                    //loadService();
                    calReducedValue();
                    calTotal();
                } else {
                    $('#alert-bill').html(response.message);
                    $('#alert-bill').addClass('alert-danger');
                    $('#alert-bill').show();
                    window.setTimeout(function () {
                        $("#alert-bill").hide();
                        $("#alert-bill").removeClass(" alert-danger");
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
    })

    $('#save').click(function () {
        if (listService.length > 0) {
            services = JSON.stringify(listService);
            $.ajax({
                type: "POST",
                url: "?controller=bill&action=add_detail_bill",
                data: {
                    billId: billId,
                    services: services,
                    token: sessionStorage.getItem('token')
                },
                dataType: "json",
                success: function (response) {
                    if (response.responseCode == responseCode.success) {
                        $('#alert-bill').html("Lưu chi tiết hoá đơn thành công.");
                        $('#alert-bill').addClass('alert-success');
                        $('#alert-bill').show();
                        window.setTimeout(function () {
                            $("#alert-bill").hide();
                            $("#alert-bill").removeClass(" alert-success");
                        }, 3000);
                        save = true;
                    } else {
                        $('#alert-bill').html(response.message);
                        $('#alert-bill').addClass('alert-danger');
                        $('#alert-bill').show();
                        window.setTimeout(function () {
                            $("#alert-bill").hide();
                            $("#alert-bill").removeClass(" alert-danger");
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
            })
        } else {
            alert("Không có dịch vụ nào");
        }
    })

    $('#pay').click(function () {
        if (listService.length > 0 && save) {
            $.ajax({
                type: "POST",
                url: "?controller=bill&action=pay_bill",
                data: {
                    billId: billId,
                    dcId: discount.id,
                    token: sessionStorage.getItem('token')
                },
                dataType: "json",
                success: function (response) {
                    if (response.responseCode == responseCode.success) {
                        $('#alert-bill').html("Thanh toasn thanhf coong.");
                        $('#alert-bill').addClass('alert-success');
                        $('#alert-bill').show();
                        window.setTimeout(function () {
                            $("#alert-bill").hide();
                            $("#alert-bill").removeClass(" alert-success");
                        }, 3000);
                        location.reload();
                    } else {
                        $('#alert-bill').html(response.message);
                        $('#alert-bill').addClass('alert-danger');
                        $('#alert-bill').show();
                        window.setTimeout(function () {
                            $("#alert-bill").hide();
                            $("#alert-bill").removeClass(" alert-danger");
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
            })
        } else {
            alert("Vui lòng thêm dịch vụ và lưu để thanh toán.");
        }
    })

});