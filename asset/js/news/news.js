const limitNewsPage = 3;

var newsKey = new URLSearchParams(document.location.href).get("news-key");
var categoryNews = new URLSearchParams(document.location.href).get("category-news");

newsKey = newsKey != undefined && newsKey != null ? newsKey : "";
categoryNews = categoryNews != undefined && categoryNews != null ? categoryNews : "";

url = "?controller=news&action=news_page";

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
        url: "?controller=news&action=data_news",
        data: {
            limit: limitNewsPage,
            index: page,
            newsKey: newsKey,
            categoryNews: categoryNews
        },
        dataType: "json",
        success: function (response) {
            //console.log(response);
            if (response.responseCode == responseCode.success) {
                param = "";
                if (newsKey != null && newsKey != "") param += "&news-key=" + newsKey;
                if (categoryNews != null && categoryNews != "")
                    param += "&category-news=" + categoryNews;
                if (page > 1) {
                    window.history.pushState(null, "", url + param + "&page=" + page);
                } else window.history.pushState(null, "", url + param);
                loadDataNews(response.data.news);
                loadPaging(page, Math.ceil(response.data.count / limitNewsPage));
            } else if (response.responseCode == responseCode.dataEmpty) {
                window.history.pushState(null, "", url);
                $('#data-news').html("<p style='margin:auto; margin-bottom:20px; color:black; font-size:20px; color:red; font-weight:bold'>Không có tin tức phù hợp.</p>");
                $('#page').html("");
            } else alert("RES: " + response.responseCode + ": " + response.message + "Vui lòng thử lại sau ít phút.");
        },
        error: function (xhr) {
            alert("ER: Hệ thống gặp sự cố, vui lòng thử lại sau ít phút. Chi tiết lỗi: " + xhr.responseText + ", " + xhr.status + ", " + xhr.error);
        }
    });
}

function loadDataNews(data) {
    var newsData = "";
    data.forEach((element) => {
        newsData += "<div class='col-lg-4 mb-4'>";
        newsData += "   <div class='card border-0 mb-2'>";
        newsData +="       <img class='card-img-top' src='"+ element.news_img +"' alt='' height=230px>";
        newsData += "       <div class='card-body bg-light p-4'>";
        newsData +="           <h4 class='card-title text-truncate text-wrap block-ellipsis-title'>" + element.news_title +"</h4>";
        newsData += "           <div class='mb-3'>";
        newsData += "              <div class='row'>";
        newsData +="               <small class='mr-2 col-lg-3 col-md-3 col-sm-3'><i class='fa fa-user text-muted'></i> Admin</small>";
        newsData +="               <small class='mr-2 col-lg-8 col-md-8 col-sm-8'><i class='fa fa-calendar text-muted'></i> " +element.news_date_release + "</small>";
        newsData += "              </div>";
        newsData +="               <small class='mr-2'><i class='fa fa-folder text-muted'></i> " + element.cn_name + "</small>";
        newsData += "           </div>";
        newsData +="           <p class='text-wrap block-ellipsis-desc'>" + element.news_description +"</p>";
        newsData +="           <a class='font-weight-bold' href='?controller=news&action=detail_news&id=" +element.news_id + "'>Xem chi tiết</a>";
        newsData += "       </div>";
        newsData += "   </div>";
        newsData += "</div>";
    });
    $("#data-news").html(newsData);
}

$(document).ready(function () {

    indexPage = new URLSearchParams(document.location.href).get('page');

    indexPage = indexPage != null && indexPage != 1 ? indexPage : 1;

    loadDataPage(indexPage);

    loadDataShop();

    $.ajax({
        type: "GET",
        url: "?controller=categorynews&action=data_category_news",
        dataType: "json",
        success: function (response) {
            //console.log(response);
            if (response.responseCode == responseCode.success) {
                var categoryNewsData = "";
                response.data.categoryNews.forEach((element) => {
                    select = "";
                    if (categoryNews ==  element.cn_id) select = "selected";
                    categoryNewsData += "<option value='" + element.cn_id +"' " + select + ">" +element.cn_name +"</option>";
                });
                $("#category-news").append(categoryNewsData);
            } else if (response.responseCode != responseCode.dataEmpty) alert("RES: " + response.responseCode + ": " + response.message + "Vui lòng thử lại sau ít phút.");

        },
        error: function (xhr) {
            alert("ER: Hệ thống gặp sự cố, vui lòng thử lại sau ít phút. Chi tiết lỗi: " + xhr.responseText + ", " + xhr.status + ", " + xhr.error);
        }
    });

    $("#form-search-news").submit(function (e) {
        newsKey = $("#news-key").val()
        categoryNews = $("#category-news").val()
        $.ajax({
            type: "GET",
            url: "?controller=news&action=data_news",
            data: {
                limit: limitNewsPage,
                index: 1,
                newsKey: newsKey,
                categoryNews: categoryNews
            },
            dataType: "json",
            success: function (response) {
                //console.log(response);
                if (response.responseCode == responseCode.success) {
                    param = "";
                    if (newsKey != null && newsKey != "")
                        param += "&news-key=" + newsKey;
                    if (categoryNews != null && categoryNews != "")
                        param += "&category-news=" + categoryNews;
                    window.history.pushState(null, "", url + param);
                    loadDataNews(response.data.news);
                    loadPaging(1, Math.ceil(response.data.count / limitNewsPage));
                } else if (response.responseCode == responseCode.dataEmpty) {
                    window.history.pushState(null, "", url);
                    $('#data-news').html("<p style='margin:auto; margin-bottom:20px; color:black; font-size:20px; color:red; font-weight:bold'>Không có tin tức phù hợp.</p>");
                    $('#page').html("");
                } else alert("RES: " + response.responseCode + ": " + response.message + "Vui lòng thử lại sau ít phút.");
            },
            error: function (xhr) {
                alert("ER: Hệ thống gặp sự cố, vui lòng thử lại sau ít phút. Chi tiết lỗi: " + xhr.responseText + ", " + xhr.status + ", " + xhr.error);
            }
        });
        e.preventDefault();
    });
});
