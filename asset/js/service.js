const limitServicePage = 6;

var svName = new URLSearchParams(document.location.href).get("sv-name") || "";
var categoryService = new URLSearchParams(document.location.href).get("category-service") || "";
var typPet = new URLSearchParams(document.location.href).get("type-pet") || "";

// svName = svName != undefined && svName != null ? svName : "";
// categoryService = categoryService != undefined && categoryService != null ? categoryService : "";
// typPet = typPet != undefined && typPet != null ? typPet : "";

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
            console.log(response);
            if (response.responseCode == responseCode.success) {
                param = "";
                if (svName != null && svName != "") param += "&sv-name=" + svName;
                if (categoryService != null && categoryService != "")
                    param += "&category-service=" + categoryService;
                if (typPet != null && typPet != "") param += "&type-pet=" + typPet;
                if (page > 1) {
                    window.history.pushState(null, "", url + param + "&page=" + page);
                } else window.history.pushState(null, "", url + param);
                loadDataService(response.data.services);
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
        icon = "fa-solid fa-paw text-secondary mr-2 fa-lg";
        if (element.sv_pet == typePet.cat) icon = "fa-sharp fa-solid fa-shield-cat text-secondary mr-2 fa-xl";
        else if (element.sv_pet == typePet.dog) icon = "fa-sharp fa-solid fa-shield-dog text-secondary mr-2 fa-xl";
        serviceData += "<div class='col-lg-4 mb-4'>";
        serviceData += "<div class='card border-1'>";
        serviceData += "<div class='card-header position-relative border-0 p-0'>";
        serviceData += "<img class='card-img-top' src='"+ element.sv_img +"' alt='' height=200px>";
        serviceData +="<div class='position-absolute d-flex flex-column align-items-center justify-content-center w-100 h-100' style='top: 0; left: 0; z-index: 1; background: rgba(0, 0, 0, .5); '>";
        serviceData += "<h3 class='text-primary mb-3'></h3>";
        serviceData += "<h1 class='display-5 text-white mb-0'>";
        serviceData += "<small class='align-top' style='font-size: 22px; line-height: 45px; '></small>CarePET<small class='align-bottom' style='font-size: 16px; line-height: 40px; '></small>";
        serviceData += "</h1>";
        serviceData += "</div>";
        serviceData += "</div>";
        serviceData += "<div class='card-body text-center p-0'>";
        serviceData += "<ul class='list-group list-group-flush'>";
        serviceData +=
            "<li class='list-group-item p-2' style='font-size: 17px; font-weight: bold; height: 60px'><i class='"+ icon +"'></i>" +
            element.sv_name +
            "</li>";
        serviceData += "<li class='list-group-item p-1' style='font-size: 15px; font-weight: bold;'><i class='fa fa-solid fa-dollar-sign text-secondary mr-2' aria-hidden='true'></i>Giá: " + sv_price + "</li>";
        serviceData += "</ul>";
        serviceData += "</div>";
        //serviceData += "<div class='card-footer border-0 p-0'>"
        //erviceData += "<div class='row'>"
        serviceData +=
            "<a class='btn btn-info' style='border-radius: 0; background-color: #65C178; border-color: #65C178;' data-toggle='modal' data-target='#myModal' onclick='detailService(" + element.sv_id + ")'>Xem chi tiết</a>";
        serviceData +=
            "<a href='?controller=appointment&action=appointment_page' class='btn btn-primary' style='border-radius: 0; background-color: #ED6436; border-color: #ED6436;' onclick='setService("+ element.cs_id +")'>Đặt lịch</a>";
        //serviceData += "</div>"
        //serviceData += "</div>"
        serviceData += "</div>";
        serviceData += "</div>";
    });
    $("#data-service").html(serviceData);
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

    loadDataShop();

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

    $("#form-search-service").submit(function (e) {
        svName = $("#service-name").val();
        categoryService = $("#category-service").val();
        typPet = $("#type-pet").val();
        loadDataPage(1);
        // $.ajax({
        //     type: "GET",
        //     url: "?controller=service&action=data_service",
        //     data: {
        //         limit: limitServicePage,
        //         index: 1,
        //         svName: svName,
        //         categoryService: categoryService,
        //         typePet: typPet,
        //     },
        //     dataType: "json",
        //     success: function (response) {
        //         //console.log(response);
        //         if (response.responseCode == responseCode.success) {
        //             param = "";
        //             if (svName != null && svName != "") param += "&sv-name=" + svName;
        //             if (categoryService != null && categoryService != "")
        //                 param += "&category-service=" + categoryService;
        //             if (typPet != null && typPet != "") param += "&type-pet=" + typPet;
        //             window.history.pushState(null, "", url + param);
        //             loadDataService(response.data.service);
        //             loadPaging(1, Math.ceil(response.data.count / limitServicePage));
        //         } else if (response.responseCode == responseCode.dataEmpty) {
        //             window.history.pushState(null, "", url);
        //             $("#data-service").html(
        //                 "<p style='margin:auto; margin-bottom:20px; color:black; font-size:20px; color:red; font-weight:bold'>Thông tin trống.</p>"
        //             );
        //             $("#page").html("");
        //         } else
        //             alert(
        //                 "RES: " +
        //                 response.responseCode +
        //                 ": " +
        //                 response.message +
        //                 "Vui lòng thử lại sau ít phút."
        //             );
        //     },
        //     error: function (xhr) {
        //         alert(
        //             "ER: Hệ thống gặp sự cố, vui lòng thử lại sau ít phút. Chi tiết lỗi: " +
        //             xhr.responseText +
        //             ", " +
        //             xhr.status +
        //             ", " +
        //             xhr.error
        //         );
        //     },
        // });
        e.preventDefault();
    });

});
