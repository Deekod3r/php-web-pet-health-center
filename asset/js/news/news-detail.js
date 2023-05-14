//console.log("token="+sessionStorage.getItem('token')); 
function loadDataCategoryNews(data) {
    var categoryNewsData = "";
    data.forEach(element => {
        categoryNewsData += "<li class='list-group-item d-flex justify-content-between align-items-center'>"
        categoryNewsData += "<a class='text-dark mb-2' href=''>" + element.cn_name + "</a>"
        categoryNewsData += "<span class='badge badge-primary badge-pill'>HOT</span>"
        categoryNewsData += "</li>"
    });
    $('.list-category-news').append(categoryNewsData);
}

function loadDataNews(data) {
    $('.news-title').append(data.news_title);
    $('.category-news').append(data.cn_id);
    $('.news-content').append(data.news_content);
    $('.news-date-release').append(data.news_date_release);
}

function loadDataRecentNews(data) {
    var recentNewsData = "";
    data.forEach(element => {
        recentNewsData += "<div class='d-flex align-items-center border-bottom mb-3 pb-3'>"
        recentNewsData += "<img class='img-fluid' src='asset/img/blog-1.jpg' style='width: 30%; height: 30%;' alt=''>"
        recentNewsData += "<div class='d-flex flex-column pl-3'>"
        recentNewsData += "<a class='text-dark mb-2' href='?controller=news&action=detail_news&id=" + element.news_id + "'>" + element.news_title + "</a>"
        recentNewsData += "<div class='d-flex'>"
        recentNewsData += "<small class='mr-3'><i class='fa fa-user text-muted'></i> Admin</small>"
        //recentNewsData += "<small class='mr-3'><i class='fa fa-folder text-muted'></i> " + element.cn_id + "</small>"
        recentNewsData += "<small class='mr-3'><i class='fa fa-calendar text-muted'></i> " + element.news_date_release.substring(0,10) + "</small>"
        recentNewsData += "</div>"
        recentNewsData += "</div>"
        recentNewsData += "</div>"
    });
    $('.recent-news').append(recentNewsData);
}

$(document).ready(function () {
    $.ajax({
        type: 'GET',
        url: '?controller=news&action=data_news',
        data: {
            idNews: new URLSearchParams(document.location.href).get('id')
        },
        //cache: false,
        //contentType: "application/json; charset=utf-8",
        dataType: 'json',
        success: function (response) {
            //console.log(response);
            // response = JSON.stringify(response);
            // response = JSON.parse(response);
            if (response.statusCode == "1") {
                loadDataNews(response.data.news[0]);
                loadDataShop();
            } else alert("Lỗi tải dữ liệu, vui lòng thử lại sau ít phút.");
        },
        error: function (xhr, status, error) {
            alert("Hệ thống gặp sự cố, vui lòng thử lại sau ít phút.");
        }
    })

    $.ajax({
        type: 'GET',
        url: '?controller=categorynews&action=data_category_news',
        // data: {
        // },
        //cache: false,
        //contentType: "application/json; charset=utf-8",
        dataType: 'json',
        success: function (response) {
            //console.log(response);
            // response = JSON.stringify(response);
            // response = JSON.parse(response);
            if (response.statusCode == "1") {
                loadDataCategoryNews(response.data.categoryNews);
            } else alert("Lỗi tải dữ liệu, vui lòng thử lại sau ít phút.");
        },
        error: function (xhr, status, error) {
            alert("Hệ thống gặp sự cố, vui lòng thử lại sau ít phút.");
        }
    })

    $.ajax({
        type: 'GET',
        url: '?controller=news&action=data_news',
        data: {
            limit: 3
        },
        //cache: false,
        //contentType: "application/json; charset=utf-8",
        dataType: 'json',
        success: function (response) {
            console.log(response);
            // response = JSON.stringify(response);
            // response = JSON.parse(response);
            if (response.statusCode == "1") {
                loadDataRecentNews(response.data.news);
            } else alert("Lỗi tải dữ liệu, vui lòng thử lại sau ít phút.");
        },
        error: function (xhr, status, error) {
            alert("Hệ thống gặp sự cố, vui lòng thử lại sau ít phút.");
        }
    })

})