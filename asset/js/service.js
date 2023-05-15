const limitServicePage = 6;
var svName = '';
var categoryService = '';
var typePet = '';

function loadPaging(index, endPage) {
    page = "";
    page += "   <div class='col-lg-12'>"
    page += "     <nav aria-label='Page navigation'>"
    page += "   <ul class='pagination justify-content-center mb-4'>"
    page += "   <li class='page-item ' id='previous'>"
    page += "       <a class='page-link'  aria-label='Previous' onclick='loadDataPage(" + (index - 1) + ")'>"
    page += "       <span aria-hidden='true'>&laquo; Previous</span>"
    page += "       </a>"
    page += "   </li>"
    if (index > 2) {
        page += "   <li class='page-item'><a class='page-link'  onclick='loadDataPage(" + (index - 2) + ")'>" + (index - 2) + "</a></li>"
        page += "   <li class='page-item'><a class='page-link'  onclick='loadDataPage(" + (index - 1) + ")'>" + (index - 1) + "</a></li>"
    } else if (index > 1) {
        page += "   <li class='page-item'><a class='page-link'  onclick='loadDataPage(" + (index - 1) + ")'>" + (index - 1) + "</a></li>"
    }
    page += "   <li class='page-item active'><a class='page-link'  onclick='loadDataPage(" + index + ")'>" + index + "</a></li>"
    for (let i = index + 1; i <= endPage; i++) {
        page += "    <li class='page-item'><a class='page-link'   onclick='loadDataPage(" + i + ")'>" + i + "</a></li>"
    }
    page += "    <li class='page-item' id='next'>"
    page += "        <a class='page-link'  aria-label='Next' onclick='loadDataPage(" + (index + 1) + ")'>"
    page += "         <span aria-hidden='true'>Next &raquo;</span>"
    page += "        </a>"
    page += "     </li>"
    page += "     </ul>"
    page += " </nav>"
    page += " </div> "
    $('#page').html(page);
    if (index <= 1) $('#previous').addClass('disabled');
    if (index >= endPage) $('#next').addClass('disabled');
}

function loadDataPage(page) {
    $.ajax({
        type: 'GET',
        url: '?controller=service&action=data_service',
        data: {
            limit: limitServicePage,
            index: page,
            svName: svName,
            categoryService: categoryService,
            typePet: typePet
        },
        //cache: false,
        //contentType: "application/json; charset=utf-8",
        dataType: 'json',
        success: function (response) {
            //console.log(response);
            //console.log(page);
            // response = JSON.stringify(response);
            // response = JSON.parse(response);
            if (response.statusCode == "1") {
                loadDataService(response.data.service);
                loadPaging(page, Math.ceil(response.data.count / limitServicePage));
            } else alert("Lỗi tải dữ liệu, vui lòng thử lại sau ít phút.");
        },
        error: function (xhr, status, error) {
            alert("Hệ thống gặp sự cố, vui lòng thử lại sau ít phút.");
        }
    });
}

function loadDataService(data) {
    var serviceData = "";
    data.forEach(element => {
        sv_price = element.sv_price == 0 ? 'Liên hệ' : new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(element.sv_price);
        serviceData += "<div class='col-lg-4 mb-4'>"
        serviceData += "<div class='card border-1'>"
        serviceData += "<div class='card-header position-relative border-0 p-0 mb-4'>"
        serviceData += "<img class='card-img-top' src='asset/img/orange.jpg' alt='' height=100px>"
        serviceData += "<div class='position-absolute d-flex flex-column align-items-center justify-content-center w-100 h-100' style='top: 0; left: 0; z-index: 1; background: rgba(0, 0, 0, .5); '>"
        serviceData += "<h3 class='text-primary mb-3'></h3>"
        serviceData += "<h1 class='display-5 text-white mb-0'>"
        serviceData += "<small class='align-top' style='font-size: 22px; line-height: 45px; '></small>CarePET<small class='align-bottom' style='font-size: 16px; line-height: 40px; '></small>"
        serviceData += "</h1>"
        serviceData += "</div>"
        serviceData += "</div>"
        serviceData += "<div class='card-body text-center p-0'>"
        serviceData += "<ul class='list-group list-group-flush mb-4'>"
        serviceData += "<li class='list-group-item p-2' style='font-size: 20px; font-weight: bold; height: 70px'><i class='fa fa-check text-secondary mr-2'></i>" + element.sv_name + "</li>"
        serviceData += "<li class='list-group-item p-2' style='font-size: 20px; font-weight: bold; height: 20px'><i class='fa fa-check text-secondary mr-2'></i>Giá: " + sv_price + "</li>"
        serviceData += "</ul>"
        serviceData += "</div>"
        //serviceData += "<div class='card-footer border-0 p-0'>"
        //erviceData += "<div class='row'>"
        serviceData += "<a href='?controller=service&action=data_service?id=" + element.sv_id + "' class='btn btn-info' style='border-radius: 0; background-color: #65C178; border-color: #65C178; '>Xem chi tiết</a>"
        serviceData += "<a href='?controller=appointment&action=appointment_page' class='btn btn-primary' style='border-radius: 0; background-color: #ED6436; border-color: #ED6436; '>Đặt lịch</a>"
        //serviceData += "</div>"
        //serviceData += "</div>"
        serviceData += "</div>"
        serviceData += "</div>"
    });
    $('#data-service').html(serviceData);
};

$(document).ready(function () {

    loadDataPage(1);

    loadDataShop();

    $.ajax({
        type: 'GET',
        url: '?controller=CategoryService&action=data_category_service',
        // data: {
        //     token: sessionStorage.getItem('token')
        // },
        //cache: false,
        //contentType: "application/json; charset=utf-8",
        dataType: 'json',
        success: function (response) {
            //console.log(response);
            // response = JSON.stringify(response);
            // response = JSON.parse(response);
            if (response.statusCode == "1") {
                var categoryServiceData = "";
                response.data.categoryService.forEach(element => {
                    categoryServiceData += "<option value='" + element.cs_id + "'>" + element.cs_name + "</option>"
                });
                $('#category-service').append(categoryServiceData);
            } else alert("Lỗi tải dữ liệu, vui lòng thử lại sau ít phút.");
        },
        error: function (xhr, status, error) {
            alert("Hệ thống gặp sự cố, vui lòng thử lại sau ít phút.");
        }
    })

    $('#form-search-service').submit(function (e) {
        svName = $('#service-name').val()
        categoryService = $('#category-service').val()
        typePet = $('#type-pet').val()
        $.ajax({
            type: 'GET',
            url: '?controller=service&action=data_service',
            data: {
                limit: limitServicePage,
                index: 1,
                svName: svName,
                categoryService: categoryService,
                typePet: typePet
            },
            //cache: false,
            //contentType: "application/json; charset=utf-8",
            dataType: 'json',
            success: function (response) {
                //console.log(response);
                // response = JSON.stringify(response);
                // response = JSON.parse(response);
                if (response.statusCode == "1") {
                    if (response.data.service != null) {
                        loadDataService(response.data.service)
                        loadPaging(1, Math.ceil(response.data.count / limitServicePage));
                    } else $('#data-service').html("<p style='margin:auto; margin-bottom:20px; color:black; font-size:20px'>Thông tin trống.</p>");
                } else alert("Lỗi tải dữ liệu, vui lòng thử lại sau ít phút.");
            },
            error: function (xhr, status, error) {
                alert("Hệ thống gặp sự cố, vui lòng thử lại sau ít phút." + " Chi tiết lỗi: " + error);
                console.log("Hệ thống gặp sự cố, vui lòng thử lại sau ít phút." + " Chi tiết lỗi: " + error);
            }
        })
        e.preventDefault();
    })

})