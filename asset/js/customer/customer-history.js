const limitBillPage = 1;

url = "?controller=bill&action=customer_history";

function loadPaging(index, endPage) {
    page = "";
    page += "   <div class='col-lg-12'>"
    page += "     <nav aria-label='Page navigation'>"
    page += "   <ul class='pagination justify-content-center mb-4'>"
    page += "   <li class='page-item ' id='previous'>"
    page += "       <a class='page-link'  aria-label='Previous' style='cursor:pointer' onclick='loadDataPage(" + (index - 1) + ")'>"
    page += "       <span aria-hidden='true'>&laquo; Trước</span>"
    page += "       </a>"
    page += "   </li>"
    if (index > 2) {
        page += "   <li class='page-item'><a class='page-link' style='cursor:pointer' onclick='loadDataPage(" + (index - 2) + ")'>" + (index - 2) + "</a></li>"
        page += "   <li class='page-item'><a class='page-link' style='cursor:pointer' onclick='loadDataPage(" + (index - 1) + ")'>" + (index - 1) + "</a></li>"
    } else if (index > 1) {
        page += "   <li class='page-item'><a class='page-link' style='cursor:pointer' onclick='loadDataPage(" + (index - 1) + ")'>" + (index - 1) + "</a></li>"
    }
    page += "   <li class='page-item active'><a class='page-link' style='cursor:pointer' onclick='loadDataPage(" + index + ")'>" + index + "</a></li>"
    for (let i = index + 1; i <= endPage; i++) {
        page += "    <li class='page-item'><a class='page-link' style='cursor:pointer' onclick='loadDataPage(" + i + ")'>" + i + "</a></li>"
    }
    page += "    <li class='page-item' id='next'>"
    page += "        <a class='page-link'  aria-label='Next' style='cursor:pointer' onclick='loadDataPage(" + (index + 1) + ")'>"
    page += "         <span aria-hidden='true'>Sau &raquo;</span>"
    page += "        </a>"
    page += "     </li>"
    page += "     </ul>"
    page += " </nav>"
    page += " </div> "
    $('#page').html(page);
    if (index <= 1) $('#previous').addClass(' disabled');
    if (index >= endPage) $('#next').addClass(' disabled');
}

function loadDataPage(page) {
    $.ajax({
        type: 'GET',
        url: '?controller=bill&action=data_customer_history',
        data: {
            token: sessionStorage.getItem('token'),
            limit: limitBillPage,
            index: page
        },
        dataType: 'json',
        success: function (response) {
            //console.log(response);
            if (response.responseCode == responseCode.success) {
                if (page > 1) {
                    window.history.pushState(null, "", url + "&page=" + page);
                } else window.history.pushState(null, "", url);
                loadDataHistory(response.data.bill);
                loadPaging(page, Math.ceil(response.data.count / limitBillPage));
            } else if (response.responseCode == responseCode.dataEmpty) {
                $('#page').html("");
                $('.history').html("<p style='margin:auto; margin-bottom:20px; color:black; font-size:20px; color:red; font-weight:bold'>Thông tin trống.</p>");           
            } else alert("RES: " + response.responseCode + ": " + response.message + "Vui lòng thử lại sau ít phút.");
        },
        error: function (xhr) {
            alert("ER: Hệ thống gặp sự cố, vui lòng thử lại sau ít phút. Chi tiết lỗi: " + xhr.responseText + ", " + xhr.status + ", " + xhr.error);
        }
    });
}

function loadDataHistory(data) {
    var billData = "";
    data.forEach(element => {
        discount = element.dc_id == null ? 'Không' : element.dc_code;
        billData += "<tr class=''>"
        billData += "<td scope='row' class=''>" + element.bill_id + "</td>"
        billData += "<td>" + element.bill_date_release + "</td>"
        billData += "<td>" + discount + "</td>"
        billData += "<td>" + new Intl.NumberFormat("vi-VN", {style: "currency",currency: "VND",}).format(element.sub_total) + "</td>"
        billData += "<td>" + new Intl.NumberFormat("vi-VN", {style: "currency",currency: "VND",}).format(element.value_reduced) + "</td>"
        billData += "<td>" + new Intl.NumberFormat("vi-VN", {style: "currency",currency: "VND",}).format(element.total_value) + "</td>"
        billData += "<td><a style='font-weight:600; cursor:pointer' class='text-bg-info' onclick='detailBill(" + element.bill_id + ")' data-toggle='modal' data-target='#myModal'>Xem chi tiết</a></td>"
        billData += "</tr>"
    });
    $('#body-table').html(billData);
}

function detailBill(id) { 
    $('#detail-body').html('');
    $.ajax({
        type: "GET",
        url: "?controller=bill&action=data_detail_bil'",
        data : {
            idBill: id,
            token: sessionStorage.getItem('token')
        },
        dataType: "json",
        success: function (response) {
            console.log(response);
            if (response.responseCode == responseCode.success) {
                $('.bill-id').html(id);
                // switch(sv.sv_pet) {
                //     case typePet.both: type = "Chó và mèo"; break;
                //     case typePet.cat: type = "Mèo"; break;
                //     case typePet.dog: type = "Chó"; break;
                // }
                let total = 0;
                response.data.detailBill.forEach(element => {
                    total += element.value;
                    sv_price = new Intl.NumberFormat("vi-VN", {style: "currency",currency: "VND",}).format(element.sv_price);    
                    value = new Intl.NumberFormat("vi-VN", {style: "currency",currency: "VND",}).format(element.value);                            
                    detailData = "";
                    detailData += "<tr class=''>";
                    detailData += "    <td scope='row' style='color:black'>"+ element.pet_id +"</td>";
                    detailData += "    <td style='color:black'>"+ element.pet_name +"</td>";
                    detailData += "    <td style='color:black'>"+ element.sv_id +"</td>";
                    detailData += "    <td style='color:black'>"+ element.sv_name +"</td>";
                    detailData += "    <td style='color:black'>"+ sv_price +"</td>";
                    detailData += "    <td style='color:black'>"+ element.quantity +"</td>";
                    detailData += "    <td style='color:black'>"+ value +"</td>";
                    detailData += "</tr>";
                    $('#detail-body').append(detailData);
                });
                $('#sub-total').html(new Intl.NumberFormat("vi-VN", {style: "currency",currency: "VND",}).format(total));
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

    loadDataShop();

    indexPage = new URLSearchParams(document.location.href).get('page');

    indexPage = indexPage != null && indexPage != 1 ? indexPage : 1;

    loadDataPage(indexPage);

    //console.log(sessionStorage.getItem('token'));

    function popUp(){
        
    }
})