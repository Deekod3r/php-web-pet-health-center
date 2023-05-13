//console.log("token="+sessionStorage.getItem('token')); 
function loadPaging(count, limit) {
    page = "";
    page += "   <div class='col-lg-12'>"
    page += "     <nav aria-label='Page navigation'>"
    page += "   <ul class='pagination justify-content-center mb-4'>"
    page += "   <li class='page-item disabled'>"
    page += "       <a class='page-link' href='#' aria-label='Previous'>"
    page += "       <span aria-hidden='true'>&laquo; Previous</span>"
    page += "       </a>"
    page += "   </li>"
    page += "   <li class='page-item active'><a class='page-link' href='#'>1</a></li>"
    page += "    <li class='page-item'><a class='page-link' href='#'>2</a></li>"
    page += "    <li class='page-item'><a class='page-link' href='#'>3</a></li>"
    page += "    <li class='page-item'>"
    page += "        <a class='page-link' href='#' aria-label='Next'>"
    page += "         <span aria-hidden='true'>Next &raquo;</span>"
    page += "        </a>"
    page += "     </li>"
    page += "     </ul>"
    page += " </nav>"
    page += " </div> "
    $('#dataNews').append(page);
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
    $.ajax({
        type: 'GET',
        url: 'https://carepet65.com/routes.php?controller=news&action=data_news',
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
                loadDataNews(response.data.news);
                loadDataShop();
                loadPaging(0, 0);
            } else alert("Lỗi tải dữ liệu, vui lòng thử lại sau ít phút.");
        },
        error: function (xhr, status, error) {
            alert("Hệ thống gặp sự cố, vui lòng thử lại sau ít phút.");
        }
    })

    $.ajax({
        type: 'GET',
        url: 'https://carepet65.com/routes.php?controller=categorynews&action=data_category_news',
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
                $('#categoryNews').append(categoryNewsData);
            } else alert("Lỗi tải dữ liệu, vui lòng thử lại sau ít phút.");
        },
        error: function (xhr, status, error) {
            alert("Hệ thống gặp sự cố, vui lòng thử lại sau ít phút.");
        }
    })
})