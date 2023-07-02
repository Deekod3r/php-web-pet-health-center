$(document).ready(function () {

    $.ajax({
        type: "GET",
        url: "?controller=categorynews&action=data_category_news",
        dataType: "json",
        success: function (response) {
            //console.log(response);
            if (response.responseCode == responseCode.success) {
                var categoryNewsData = "";
                response.data.categoryNews.forEach((element) => {
                    categoryNewsData +=
                        "<option value='" +
                        element.cn_id +
                        "'>" +
                        element.cn_name +
                        "</option>";
                });
                $("#category-news").append(categoryNewsData);
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

    $.ajax({
        type: "GET",
        url: "?controller=news&action=data_detail_news",
        data : {
            idNews: new URLSearchParams(document.location.href).get("id")
        },
        dataType: "json",
        success: function (response) {
            console.log(response);
            if (response.responseCode == responseCode.success) {
                news = response.data.news;
                $('#news-id').val(news.news_id);
                $('#news-title').html(news.news_title);
                $('#news-desc').html(news.news_description);
                $('#news-status').val(news.news_active);
                $('#category-news').val(news.cn_id);
                // $('#news-img').attr("src",news.news_img);
                $('#news-content').html(news.news_content);
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
    });

    $("#form-edit-news").submit(function (e) {
        newsId = $('#news-id').val().trim();
        newsTitle = $("#news-title").val().trim();
        newsDescription = $("#news-desc").val().trim();
        categoryNews = $("#category-news").val().trim();
        newsContent = $("#news-content").val().trim();
        newsStatus = $("#news-status").val().trim();
        newsImg = $("#news-img")[0].files[0];
        //alert(newsImg.name);
        //return false;
        // console.log(sessionStorage.getItem('token')); return false;
        if (newsTitle == '' || newsDescription == '' || categoryNews == '' || newsContent == '' || newsStatus == '' || newsId == '') {
            $('#msg-news').html("CLI: Thông tin không được bỏ trống.");
            $('#msg-news').show()
            window.setTimeout(function () {
                $('#msg-news').hide()
            }, 3000);
            return false;
        }
        let formData = new FormData();
        if (newsImg != null) {
            type = newsImg.type.substring(6);
            if (type != 'jpg' && type != 'jpeg' && type != 'png' && type != 'gif') {
                $('#msg-news').html("CLI: Định dạng file không phù hợp. Vui lòng tải các file có đinh dạng: jpg, jpeg, png, gif");
                $('#msg-news').show()
                window.setTimeout(function () {
                    $('#msg-news').hide()
                }, 3000);
                return false;
            }
            formData.append('newsImg',newsImg,Date.now()+ newsImg.name);
        }
        // console.log(newsTitle, newsDescription, categoryNews, newsContent, newsStatus);
        // return false;
        formData.append('newsId', newsId);
        formData.append('newsTitle', newsTitle);
        formData.append('newsDescription', newsDescription);
        formData.append('categoryNews', categoryNews);
        formData.append('newsContent', newsContent);
        formData.append('newsStatus', newsStatus);
        formData.append('token',sessionStorage.getItem('token'));
        $.ajax({
            type: "POST",
            url: "?controller=news&action=edit_news",
            data: formData,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);
                if (response.responseCode == responseCode.success) {
                    sessionStorage.setItem('addNews', true);
                    sessionStorage.setItem('msgNews', "Sửa tin tức thành công");
                    window.location.href = "?controller=news&action=news_page_ad";
                } else {
                    $('#msg-news').html(response.message);
                    $('#msg-news').show()
                    window.setTimeout(function () {
                        $('#msg-news').hide()
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

});
