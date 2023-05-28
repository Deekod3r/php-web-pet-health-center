const limitnewsPage = 6;

var newsName = new URLSearchParams(document.location.href).get("news-name");
var categorynews = new URLSearchParams(document.location.href).get(
    "category-news"
);
var typPet = new URLSearchParams(document.location.href).get("type-pet");
var startPrice = new URLSearchParams(document.location.href).get("start-price");
var endPrice = new URLSearchParams(document.location.href).get("end-price");
var statusnews = new URLSearchParams(document.location.href).get("status");

newsName = newsName != undefined && newsName != null ? newsName : "";
categorynews =
    categorynews != undefined && categorynews != null
        ? categorynews
        : "";
typPet = typPet != undefined && typPet != null ? typPet : "";
startPrice =
    startPrice != undefined && startPrice != null && startPrice > 0
        ? startPrice
        : 0;
endPrice =
    endPrice != undefined && endPrice != null && endPrice > 0 ? endPrice : 0;
statusnews = statusnews != undefined && statusnews != null ? statusnews : "";

url = "?controller=news&action=news_page_ad";

function loadPaging(index, endPage) {
    index = parseInt(index);
    endPage = parseInt(endPage);
    page = "";
    page += "   <div class='col-lg-12'>";
    page += "   <nav aria-label='Page navigation'>";
    page += "   <ul class='pagination justify-content-center mb-4'>";
    page += "   <li class='page-item head'>";
    page +=
        "       <a class='page-link'  style='cursor:pointer' onclick='loadDataPage(" +
        1 +
        ")'>";
    page += "       <span aria-hidden='true'>&laquo; Trang đầu</span>";
    page += "       </a>";
    page += "   </li>";

    page += "   <li class='page-item head' id='previous'>";
    page +=
        "       <a class='page-link'  style='cursor:pointer' aria-label='Previous' onclick='loadDataPage(" +
        (index - 1) +
        ")'>";
    page += "       <span aria-hidden='true'>&laquo; Trước</span>";
    page += "       </a>";
    page += "   </li>";

    if (index > 2) {
        page +=
            "   <li class='page-item'><a class='page-link' style='cursor:pointer'  onclick='loadDataPage(" +
            (index - 2) +
            ")'>" +
            (index - 2) +
            "</a></li>";
        page +=
            "   <li class='page-item'><a class='page-link' style='cursor:pointer' onclick='loadDataPage(" +
            (index - 1) +
            ")'>" +
            (index - 1) +
            "</a></li>";
    } else if (index > 1) {
        page +=
            "   <li class='page-item'><a class='page-link' style='cursor:pointer' onclick='loadDataPage(" +
            (index - 1) +
            ")'>" +
            (index - 1) +
            "</a></li>";
    }
    page +=
        "   <li class='page-item active'><a class='page-link' style='cursor:pointer' onclick='loadDataPage(" +
        index +
        ")'>" +
        index +
        "</a></li>";
    for (let i = index + 1; i <= endPage; i++) {
        page +=
            "    <li class='page-item'><a class='page-link' style='cursor:pointer'  onclick='loadDataPage(" +
            i +
            ")'>" +
            i +
            "</a></li>";
        if (i == index + 3) break;
    }

    page += "    <li class='page-item foot' id='next'>";
    page +=
        "        <a class='page-link'  aria-label='Next' style='cursor:pointer' onclick='loadDataPage(" +
        (index + 1) +
        ")'>";
    page += "         <span aria-hidden='true'>Sau &raquo;</span>";
    page += "        </a>";
    page += "     </li>";

    page += "   <li class='page-item foot'>";
    page +=
        "       <a class='page-link'  style='cursor:pointer' onclick='loadDataPage(" +
        endPage +
        ")'>";
    page += "       <span aria-hidden='true'>Trang cuối &raquo;</span>";
    page += "       </a>";
    page += "   </li>";
    page += "     </ul>";
    page += " </nav>";
    page += " </div> ";
    $("#page").html(page);
    // if (index <= 1) $("#previous").addClass("disabled");
    // if (index >= endPage) $("#next").addClass("disabled");
    if (index <= 1) $(".head").addClass("disabled");
    if (index >= endPage) $(".foot").addClass("disabled");
}

function loadDataPage(page) {
    $.ajax({
        type: "GET",
        url: "?controller=news&action=data_news",
        data: {
            limit: limitnewsPage,
            index: page,
            newsName: newsName,
            categorynews: categorynews,
            typePet: typPet,
            endPrice: endPrice,
            startPrice: startPrice,
            statusnews: statusnews,
        },
        dataType: "json",
        success: function (response) {
            //console.log(response);
            if (response.responseCode == responseCode.success) {
                param = "";
                if (newsName != null && newsName != "") param += "&news-name=" + newsName;
                if (categorynews != null && categorynews != "")
                    param += "&category-news=" + categorynews;
                if (typPet != null && typPet != "") param += "&type-pet=" + typPet;
                if (startPrice != null && startPrice != 0)
                    param += "&price-start=" + startPrice;
                if (endPrice != null && endPrice != 0)
                    param += "&price-end=" + endPrice;
                if (statusnews != null && statusnews != "")
                    param += "&status-news=" + statusnews;
                if (page > 1) {
                    window.history.pushState(null, "", url + param + "&page=" + page);
                } else window.history.pushState(null, "", url + param);
                loadDatanews(response.data.news);
                loadPaging(page, Math.ceil(response.data.count / limitnewsPage));
            } else if (response.responseCode == responseCode.dataEmpty) {
                window.history.pushState(null, "", url);
                $("#page").html("");
                $("#data-news").html(
                    "<p style='font-size:20px; color:red; font-weight:bold; text-align:center'>Thông tin trống.</p>"
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

function loadDatanews(data) {
    var newsData = "";
    data.forEach((element) => {
        // news_price =
        //     element.news_price == 0
        //         ? "Liên hệ"
        //         : new Intl.NumberFormat("vi-VN", {
        //             style: "currency",
        //             currency: "VND",
        //         }).format(element.news_price);
        // news_pet = "Chó và mèo";
        // if (element.news_pet == typePet.cat) news_pet = "Mèo";
        // else if (element.news_pet == typePet.dog) news_pet = "Chó";
        if (element.news_active == statusObject.active) news_active = "Công khai";
        else news_active = "Ẩn";
        newsData += "<tr>";
        newsData += "<th scope='row'>" + element.news_id + "</th>";
        newsData += "<td><img src='" + element.news_img + "' width='80px' height='80px' /></td>";
        newsData += "<td>" + element.news_title + "</td>";
        newsData += "<td>" + element.news_date_release + "</td>";
        newsData += "<td>" + element.cn_name + "</td>";
        newsData += "<td>" + element.ad_username + "</td>";
        newsData += "<td>" + news_active + "</td>";
        newsData += "<td>";
        newsData += "<a href='?controller=news&action=news_edit_page&id=" + element.news_id + "' class='btn btn-secondary' style='color:white'>Sửa</a>";
        newsData += " ";
        newsData += "<a href='' class='btn btn-danger' data-toggle='modal' data-target='#myModal' onclick='deleteConfirm(" + element.news_id + ")'>Xoá</a>";
        newsData += "</td>";
        newsData += "</tr>";
    });
    $("#data-news").html(newsData);
}

function deleteConfirm(id) {
    $("#id-news").html(id);
}

function loadDataCategoryNews() {
    $("#category-news").html("<option value=''>Tất cả</option>");
    //$("#data-cn").html("");
    $.ajax({
        type: "GET",
        url: "?controller=categorynews&action=data_category_news",
        dataType: "json",
        success: function (response) {
            //console.log(response);
            if (response.responseCode == responseCode.success) {
                var categorynewsDataCbx = "";
                var categorynewsDataTbl = "";
                response.data.categoryNews.forEach((element) => {
                    categorynewsDataCbx += "<option value='" + element.cn_id +"'>" +element.cn_name + "</option>";
                    categorynewsDataTbl += "<tr>";
                    categorynewsDataTbl += "<th scope='row'>"+ element.cn_id +"</th>"
                    categorynewsDataTbl += "<td>"+ element.cn_name +"</td>"
                    categorynewsDataTbl += "<td><a class='btn btn-dark' data-toggle='modal' data-target='#myModal3' onclick='editcn(\""+ element.cn_id + "\",\""+ element.cn_name +"\")' >Sửa</a></td>"
                    categorynewsDataTbl += "</tr>";
                });
                $("#category-news").append(categorynewsDataCbx);
                $("#data-cn").html(categorynewsDataTbl);
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

function editcn(id,name) {
    $("#cn-id-edit").val(id);
    $("#cn-name-edit").val(name);
}

$(document).ready(function () {
    
    if (sessionStorage.getItem("addnews")) {
        $("#msg-news").html(sessionStorage.getItem("msgnews"));
        $("#msg-news").addClass(" alert-success");
        $("#msg-news").show();
        window.setTimeout(function () {
            $("#msg-news").hide();
            $("#msg-news").html("");
            $("#msg-news").removeClass(" alert-success");
            sessionStorage.removeItem("addnews");
            sessionStorage.removeItem("msgnews");
        }, 3000);
    }

    indexPage = new URLSearchParams(document.location.href).get("page");

    indexPage = indexPage != null && indexPage != 1 ? indexPage : 1;

    loadDataPage(indexPage);

    loadDataCategoryNews();

    // $('#submit').click(function () {
    //     newsName = $("#news-name").val();
    //     categorynews = $("#category-news").val();
    //     typPet = $("#type-pet").val();
    //     startPrice = $("#price-start").val();
    //     endPrice = $("#price-end").val();
    //     statusnews = $("#news-status").val();
    //     console.log(newsName, categorynews, typPet, startPrice, endPrice,statusnews);
    // })

    $("#form-search-news").submit(function (e) {
        newsName = $("#news-name").val();
        categorynews = $("#category-news").val();
        typPet = $("#type-pet").val();
        startPrice =
            $("#price-start").val() != "" && $("#price-start").val() > 0
                ? $("#price-start").val()
                : 0;
        endPrice =
            $("#price-end").val() != "" && $("#price-end").val() > 0
                ? $("#price-end").val()
                : 0;
        statusnews = $("#news-status").val();
        if (endPrice >= startPrice && endPrice >= 0) {
            loadDataPage(1);
        } else {
            $("#msg-news").html("Khoảng giá tiền chưa hợp lệ.");
            $("#msg-news").addClass(" alert-danger");
            $("#msg-news").show();
            window.setTimeout(function () {
                $("#msg-news").hide();
                $("#msg-news").removeClass(" alert-danger");
            }, 3000);
        }
        // $.ajax({
        //     type: "GET",
        //     url: "?controller=news&action=data_news",
        //     data: {
        //         limit: limitnewsPage,
        //         index: 1,
        //         newsName: newsName,
        //         categorynews: categorynews,
        //         typePet: typPet,
        //     },
        //     dataType: "json",
        //     success: function (response) {
        //         //console.log(response);
        //         if (response.responseCode == responseCode.success) {
        //             param = "";
        //             if (newsName != null && newsName != "") param += "&news-name=" + newsName;
        //             if (categorynews != null && categorynews != "")
        //                 param += "&category-news=" + categorynews;
        //             if (typPet != null && typPet != "") param += "&type-pet=" + typPet;
        //             window.history.pushState(null, "", url + param);
        //             loadDatanews(response.data.newss);
        //             loadPaging(1, Math.ceil(response.data.count / limitnewsPage));
        //         } else if (response.responseCode == responseCode.dataEmpty) {
        //             window.history.pushState(null, "", url);
        //             $("#data-news").html(
        //                 "<p style='margin:auto; margin-bottom:20px; color:black; font-size:20px; color:red; font-weight:bold'>Không có dịch vụ phù hợp.</p>"
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

    $("#form-add-cn").submit(function (e) {
        let cnName = $("#cn-name").val();
        //newsImg = $("#news-img")[0].files[0];
        // console.log(sessionStorage.getItem('token')); return false;
        if (cnName == "") {
            $("#msg-cn").html("CLI: Thông tin không được bỏ trống.");
            $("#msg-cn").addClass(" alert-danger");
            $("#msg-cn").show();
            window.setTimeout(function () {
                $("#msg-cn").hide();
                $("#msg-cn").removeClass(" alert-danger");
            }, 3000);
            return false;
        }
        //console.log(newsName, newsDescription, categorynews, newsPrice, newsStatus, typPet,newsImg.name, sessionStorage.getItem('token'));
        let token = sessionStorage.getItem("token");
        //return false;
        $.ajax({
            type: "POST",
            url: "?controller=categorynews&action=add_category_news",
            data: {
                token: token,
                cnName: cnName,
            },
            dataType: "json",
            success: function (response) {
                //console.log(response);
                if (response.responseCode == responseCode.success) {
                    $("#msg-cn").html("Thêm dữ liệu thành công.");
                    $("#msg-cn").addClass(" alert-success");
                    $("#msg-cn").show();
                    $("#cn-name").val("");
                    loadDataCategoryNews();
                    window.setTimeout(function () {
                        $("#msg-cn").hide();
                        $("#msg-cn").removeClass(" alert-success");
                    }, 3000);
                } else {
                    $("#msg-cn").html(response.message);
                    $("#msg-cn").addClass(" alert-danger");
                    $("#msg-cn").show();
                    window.setTimeout(function () {
                        $("#msg-cn").hide();
                        $("#msg-cn").removeClass(" alert-danger");
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

    $("#form-edit-cn").submit(function (e) {
        let cnId = $("#cn-id-edit").val();
        let cnName = $("#cn-name-edit").val();
        //newsImg = $("#news-img")[0].files[0];
        // console.log(sessionStorage.getItem('token')); return false;
        if (cnName == "" || cnId == "") {
            $("#msg-cn-edit").html("CLI: Thông tin không được bỏ trống.");
            $("#msg-cn-edit").addClass(" alert-danger");
            $("#msg-cn-edit").show();
            window.setTimeout(function () {
                $("#msg-cn-edit").hide();
                $("#msg-cn-edit").removeClass(" alert-danger");
            }, 3000);
            return false;
        }
        //console.log(newsName, newsDescription, categorynews, newsPrice, newsStatus, typPet,newsImg.name, sessionStorage.getItem('token'));
        let token = sessionStorage.getItem("token");
        //return false;
        $.ajax({
            type: "POST",
            url: "?controller=categorynews&action=edit_category_news",
            data: {
                token: token,
                cnName: cnName,
                cnId: cnId
            },
            dataType: "json",
            success: function (response) {
                //console.log(response);
                if (response.responseCode == responseCode.success) {
                    $("#msg-cn-edit").html("Sửa dữ liệu thành công.");
                    $("#msg-cn-edit").addClass(" alert-success");
                    $("#msg-cn-edit").show();
                    $("#cn-name-edit").val("");
                    $("#cn-id-edit").val("");
                    loadDataCategoryNews();
                    window.setTimeout(function () {
                        $("#msg-cn-edit").hide();
                        $("#msg-cn-edit").removeClass(" alert-success");
                    }, 3000);
                } else {
                    $("#msg-cn-edit").html(response.message);
                    $("#msg-cn-edit").addClass(" alert-danger");
                    $("#msg-cn-edit").show();
                    window.setTimeout(function () {
                        $("#msg-cn-edit").hide();
                        $("#msg-cn-edit").removeClass(" alert-danger");
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

    $("#confirm-delete").click(function () {
        $.ajax({
            type: "POST",
            url: "?controller=news&action=delete_news",
            data: {
                token: sessionStorage.getItem("token"),
                idnews: $("#id-news").html(),
            },
            dataType: "json",
            success: function (response) {
                //console.log(response);
                if (response.responseCode == responseCode.success) {
                    $("#msg-news").html("Xoá dịch vụ thành công.");
                    $("#msg-news").addClass(" alert-success");
                    $("#msg-news").show();
                    window.setTimeout(function () {
                        $("#msg-news").hide();
                        $("#msg-news").removeClass(" alert-success");
                    }, 3000);
                    loadDataPage(1);
                } else if (response.responseCode == responseCode.fail) {
                    $("#msg-news").html("Xoá dịch vụ thất bại.");
                    $("#msg-news").addClass(" alert-danger");
                    $("#msg-news").show();
                    window.setTimeout(function () {
                        $("#msg-news").hide();
                        $("#msg-news").removeClass(" alert-danger");
                    }, 3000);
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
    });
});
