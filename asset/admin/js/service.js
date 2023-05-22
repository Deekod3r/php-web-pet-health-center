const limitServicePage = 6;

var svName = new URLSearchParams(document.location.href).get("sv-name");
var categoryService = new URLSearchParams(document.location.href).get(
    "category-service"
);
var typPet = new URLSearchParams(document.location.href).get("type-pet");

svName = svName != undefined && svName != null ? svName : "";
categoryService =
    categoryService != undefined && categoryService != null
        ? categoryService
        : "";
typPet = typPet != undefined && typPet != null ? typPet : "";

url = "?controller=service&action=service_page";

function loadPaging(index, endPage) {
    index = parseInt(index);
    endPage = parseInt(endPage);
    page = "";
    page += "   <div class='col-lg-12'>";
    page += "   <nav aria-label='Page navigation'>";
    page += "   <ul class='pagination justify-content-center mb-4'>";
    page += "   <li class='page-item head'>";
    page +="       <a class='page-link'  style='cursor:pointer' onclick='loadDataPage(" + 1 + ")'>";
    page += "       <span aria-hidden='true'>&laquo; Trang đầu</span>";
    page += "       </a>";
    page += "   </li>";

    page += "   <li class='page-item head' id='previous'>";
    page +="       <a class='page-link'  style='cursor:pointer' aria-label='Previous' onclick='loadDataPage(" +(index - 1) + ")'>";
    page += "       <span aria-hidden='true'>&laquo; Trước</span>";
    page += "       </a>";
    page += "   </li>";

    if (index > 2) {
        page += "   <li class='page-item'><a class='page-link' style='cursor:pointer'  onclick='loadDataPage(" + (index - 2) +")'>" + (index - 2) + "</a></li>";
        page += "   <li class='page-item'><a class='page-link' style='cursor:pointer' onclick='loadDataPage(" +(index - 1) + ")'>" + (index - 1) +"</a></li>";
    } else if (index > 1) {
        page += "   <li class='page-item'><a class='page-link' style='cursor:pointer' onclick='loadDataPage(" + (index - 1) + ")'>" +(index - 1) +"</a></li>";
    }
    page += "   <li class='page-item active'><a class='page-link' style='cursor:pointer' onclick='loadDataPage(" +index +")'>" + index +"</a></li>";
    for (let i = index + 1; i <= endPage; i++) {
        page += "    <li class='page-item'><a class='page-link' style='cursor:pointer'  onclick='loadDataPage(" + i + ")'>" +i + "</a></li>";
        if (i == index + 3) break;
    }

    page += "    <li class='page-item foot' id='next'>";
    page += "        <a class='page-link'  aria-label='Next' style='cursor:pointer' onclick='loadDataPage(" + (index + 1) +")'>";
    page += "         <span aria-hidden='true'>Sau &raquo;</span>";
    page += "        </a>";
    page += "     </li>";
    
    page += "   <li class='page-item foot'>";
    page +="       <a class='page-link'  style='cursor:pointer' onclick='loadDataPage(" + endPage + ")'>";
    page += "       <span aria-hidden='true'>Trang cuối &raquo;</span>";
    page += "       </a>";
    page += "   </li>";
    page += "     </ul>";
    page += " </nav>";
    page += " </div> ";
    $("#page").html(page);
    // if (index <= 1) $("#previous").addClass("disabled");
    // if (index >= endPage) $("#next").addClass("disabled");
    if (index <= 1) $('.head').addClass("disabled");
    if (index >= endPage) $('.foot').addClass("disabled");
}

function loadDataPage(page) {
    $.ajax({
        type: "GET",
        url: "?controller=service&action=data_service",
        data: {
            limit: limitServicePage,
            index: page,
            svName: svName,
            categoryService: categoryService,
            typePet: typPet,
        },
        dataType: "json",
        success: function (response) {
            //console.log(response);
            if (response.responseCode == responseCode.success) {
                param = "";
                if (svName != null && svName != "") param += "&sv-name=" + svName;
                if (categoryService != null && categoryService != "")
                    param += "&category-service=" + categoryService;
                if (typPet != null && typPet != "") param += "&type-pet=" + typPet;
                if (page > 1) {
                    window.history.pushState(null, "", url + param + "&page=" + page);
                } else window.history.pushState(null, "", url);
                loadDataService(response.data.service);
                loadPaging(page, Math.ceil(response.data.count / limitServicePage));
            } else if (response.responseCode == responseCode.dataEmpty) {
                window.history.pushState(null, "", url);
                $("#page").html("");
                $("#data-service").html(
                    "<p style='margin:auto; margin-bottom:20px; color:black; font-size:20px; color:red; font-weight:bold'>Thông tin trống.</p>"
                );
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
}

function loadDataService(data) {
    var serviceData = "";
    data.forEach((element) => {
        sv_price =
            element.sv_price == 0
                ? "Liên hệ"
                : new Intl.NumberFormat("vi-VN", {
                    style: "currency",
                    currency: "VND",
                }).format(element.sv_price);
        sv_pet = "Chó và mèo";
        if (element.sv_pet == typePet.cat) sv_pet = "Mèo";
        else if (element.sv_pet == typePet.dog) sv_pet = "Chó";
        if (element.sv_status == statusObject.active) sv_status = "Hoạt động";
        else sv_status = "Tạm dừng";
        serviceData += "<tr>"
        serviceData += "<th scope='row'>" + element.sv_id + "</th>"
        serviceData += "<td><img src='" + element.sv_img + "' width='80px' height='80px' /></td>"
        serviceData += "<td>" + element.sv_name + "</td>"
        serviceData += "<td>" + sv_price + "</td>"
        serviceData += "<td>" + sv_pet + "</td>"
        serviceData += "<td>" + element.cs_name + "</td>"
        serviceData += "<td>" + sv_status + "</td>"
        serviceData += "<td>"
        serviceData += "<a href='?controller=service&action=edit_service_page&id="+ element.sv_id +"' class='badge badge-info'>Sửa</a>"
        serviceData += " "
        serviceData += "<a href='' class='badge badge-danger' data-toggle='modal' data-target='#myModal' onclick='deleteConfirm("+ element.sv_id +")'>Xoá</a>"
        serviceData += "</td>"
        serviceData += "</tr>"
    });
    $("#data-service").html(serviceData);
}

function deleteConfirm(id) {
    $('#id-service').html(id);
}

function detailService(id) { 
    $.ajax({
        type: "GET",
        url: "?controller=service&action=data_detail_service",
        data : {
            idService: id
        },
        dataType: "json",
        success: function (response) {
            console.log(response);
            if (response.responseCode == responseCode.success) {
                sv = response.data.service;
                switch(sv.sv_pet) {
                    case typePet.both: type = "Chó và mèo"; break;
                    case typePet.cat: type = "Mèo"; break;
                    case typePet.dog: type = "Chó"; break;
                }
                sv_price = sv.sv_price == 0 ? "Liên hệ" : new Intl.NumberFormat("vi-VN", {style: "currency",currency: "VND",}).format(sv.sv_price);
                $('#sv-id').html("<b class='text'>Mã dịch vụ</b>: " + sv.sv_id);
                $('#sv-name').html("<b class='text'>Tên dịch vụ</b>: " + sv.sv_name);
                $('#sv-desc').html("<b class='text'>Mô tả</b>: " + sv.sv_description);
                $('#sv-price').html("<b class='text'>Giá</b>: " + sv_price);
                $('#typ-pet').html("<b class='text'>Phân loại</b>: " + type);
                $('#cs-name').html("<b class='text'>Danh mục</b>: " + sv.cs_name);
                $('#sv-img').attr("src",sv.sv_img);
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
    })
}

$(document).ready(function () {

    indexPage = new URLSearchParams(document.location.href).get("page");

    indexPage = indexPage != null && indexPage != 1 ? indexPage : 1;

    loadDataPage(indexPage);

    $("#form-search-service").submit(function (e) {
        svName = $("#service-name").val();
        categoryService = $("#category-service").val();
        typPet = $("#type-pet").val();
        $.ajax({
            type: "GET",
            url: "?controller=service&action=data_service",
            data: {
                limit: limitServicePage,
                index: 1,
                svName: svName,
                categoryService: categoryService,
                typePet: typPet,
            },
            dataType: "json",
            success: function (response) {
                //console.log(response);
                if (response.responseCode == responseCode.success) {
                    param = "";
                    if (svName != null && svName != "") param += "&sv-name=" + svName;
                    if (categoryService != null && categoryService != "")
                        param += "&category-service=" + categoryService;
                    if (typPet != null && typPet != "") param += "&type-pet=" + typPet;
                    window.history.pushState(null, "", url + param);
                    loadDataService(response.data.service);
                    loadPaging(1, Math.ceil(response.data.count / limitServicePage));
                } else if (response.responseCode == responseCode.dataEmpty) {
                    window.history.pushState(null, "", url);
                    $("#data-service").html(
                        "<p style='margin:auto; margin-bottom:20px; color:black; font-size:20px; color:red; font-weight:bold'>Không có dịch vụ phù hợp.</p>"
                    );
                    $("#page").html("");
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
        e.preventDefault();
    });

    $('#confirm-delete').click(function(){
        $.ajax({
            type: "POST",
            url: "?controller=service&action=delete_service",
            data: {
                token: sessionStorage.getItem("token"),
                idService: $('#id-service').html(),
            },
            dataType: "json",
            success: function (response) {
                //console.log(response);
                if (response.responseCode == responseCode.success) {
                    $("#msg-delete-service").html("Huỷ lịch hẹn thành công.");
                    $("#msg-delete-service").addClass(" alert-success");
                    $("#msg-delete-service").show();
                    window.setTimeout(function () {
                        $("#msg-delete-service").hide();
                    }, 3000);
                    loadDataPage(1);
                } else if (response.responseCode == responseCode.fail) {
                    $("#msg-delete-service").html(response.message);
                    $("#msg-delete-service").addClass(" alert-danger");
                    $("#msg-delete-service").show();
                    window.setTimeout(function () {
                        $("#msg-delete-service").hide();
                    }, 3000);
                    loadDataPage(1);
                } else alert("RES: " + response.responseCode + ": " + response.message + "Vui lòng thử lại sau ít phút.");
            },
            error: function (xhr) {
                alert("ER: Hệ thống gặp sự cố, vui lòng thử lại sau ít phút. Chi tiết lỗi: " + xhr.responseText + ", " + xhr.status + ", " + xhr.error);
            }
        });
    })
});
