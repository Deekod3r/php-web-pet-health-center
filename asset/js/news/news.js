const limitNewsPage = 3;

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
    if(index > 2){
        page += "   <li class='page-item'><a class='page-link'  onclick='loadDataPage(" + (index-2) + ")'>" + (index-2) + "</a></li>"
        page += "   <li class='page-item'><a class='page-link'  onclick='loadDataPage(" + (index-1) + ")'>" + (index-1) + "</a></li>"
    }else if (index > 1) {
        page += "   <li class='page-item'><a class='page-link'  onclick='loadDataPage(" + (index-1) + ")'>" + (index-1) + "</a></li>"
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
        url: '?controller=news&action=data_news',
        data: {
            limit: limitNewsPage,
            index: page
        },
        //cache: false,
        //contentType: "application/json; charset=utf-8",
        dataType: 'json',
        success: function (response) {
            console.log(response);
            //console.log(page);
            // response = JSON.stringify(response);
            // response = JSON.parse(response);
            if (response.statusCode == "1") {
                loadDataNews(response.data.news);
                loadPaging(page, Math.ceil(response.data.count/limitNewsPage));
            } else alert("Lỗi tải dữ liệu, vui lòng thử lại sau ít phút.");
        },
        error: function (xhr, status, error) {
            alert("Hệ thống gặp sự cố, vui lòng thử lại sau ít phút.");
        }
    });
}

function loadDataNews(data) {
    var newsData = "";
    data.forEach(element => {
        newsData += "<div class='col-lg-4 mb-4'>"
        newsData += "   <div class='card border-0 mb-2'>"
        newsData += "       <img class='card-img-top' src='asset/img/blog-1.jpg' alt=''>"
        newsData += "       <div class='card-body bg-light p-4'>"
        newsData += "           <h4 class='card-title text-truncate text-wrap' style='height:120px'>" + element.news_title + "</h4>"
        newsData += "           <div class='d-flex mb-3'>"
        newsData += "               <small class='mr-2'><i class='fa fa-user text-muted'></i> Admin</small>"
        newsData += "               <small class='mr-2'><i class='fa fa-folder text-muted'></i> Danh mục</small>"
        newsData += "               <small class='mr-2'><i class='fa fa-calendar text-muted'></i> " + element.news_date_release + "</small>"
        newsData += "           </div>"
        newsData += "           <p style='height:80px' class='text-nowrap'>" + element.news_description + "</p>"
        newsData += "           <a class='font-weight-bold' href='?controller=news&action=detail_news&id=" + element.news_id + "'>Xem chi tiết</a>"
        newsData += "       </div>"
        newsData += "   </div>"
        newsData += "</div>"
    });
    $('#dataNews').html(newsData);
}

$(document).ready(function () {

    loadDataShop();

    loadDataPage(1);

    $.ajax({
        type: 'GET',
        url: '?controller=categorynews&action=data_category_news',
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
                var categoryNewsData = "";
                response.data.categoryNews.forEach(element => {
                    categoryNewsData += "<option value='" + element.cn_id + "'>" + element.cn_name + "</option>"
                });
                $('#category-news').append(categoryNewsData);
            } else alert("Lỗi tải dữ liệu, vui lòng thử lại sau ít phút.");
        },
        error: function (xhr, status, error) {
            alert("Hệ thống gặp sự cố, vui lòng thử lại sau ít phút.");
        }
    })

    $('#form-search-news').submit(function (e) {
        $.ajax({
            type: 'GET',
            url: '?controller=news&action=data_news',
            data: {
                limit: limitNewsPage,
                index: 1,
                newsKey: $('#news-key').val(),
                categoryNews: $('#category-news').val()
            },
            //cache: false,
            //contentType: "application/json; charset=utf-8",
            dataType: 'json',
            success: function (response) {
                console.log(response);
                // response = JSON.stringify(response);
                // response = JSON.parse(response);
                if (response.statusCode == "1") {
                    if(response.data.news != null) {
                        loadDataNews(response.data.news);
                        loadPaging(1, Math.ceil(response.data.count/limitNewsPage));
                    } else $('#data-service').html("<p style='margin:auto; margin-bottom:20px; color:black; font-size:20px'>Thông tin trống.</p>");
                } else alert("Lỗi tải dữ liệu, vui lòng thử lại sau ít phút.");
            },
            error: function (xhr, status, error) {
                alert("Hệ thống gặp sự cố, vui lòng thử lại sau ít phút." + " Chi tiết lỗi: "+ error);
                console.log("Hệ thống gặp sự cố, vui lòng thử lại sau ít phút." + " Chi tiết lỗi: "+ error);
            }
        })
        e.preventDefault();
    })

})