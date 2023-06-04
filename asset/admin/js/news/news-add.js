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

    // $("#submit").click(function (e) {
    //     newsTitle = $("#news-title").val();
    //     newsDescription = $("#news-description").val();
    //     categorynews = $("#category-news").val();
    //     typPet = $("#type-pet").val();
    //     newsPrice = $("#news-price").val() != '' && $("#news-price").val() > 0 ? $("#news-price").val() : 0 ;
    //     newsStatus = $("#news-status").val();
    //     newsImg = $("#news-img")[0].files[0];
    //     console.log(newsTitle, newsDescription, categorynews, newsPrice, newsStatus, typPet,newsImg.name);
    // })

    $("#form-add-news").submit(function (e) {
        newsTitle = $("#news-title").val().trim();
        newsDescription = $("#news-desc").val().trim();
        categoryNews = $("#category-news").val().trim();
        newsContent = $("#news-content").val().trim();
        newsStatus = $("#news-status").val().trim();
        newsImg = $("#news-img")[0].files[0];
        //alert(newsImg.name);
        //return false;
        // console.log(sessionStorage.getItem('token')); return false;
        if (newsTitle == '' || newsDescription == '' || categoryNews == '' || newsContent == '' || newsStatus == '' || newsImg == null) {
            $('#msg-news').html("CLI: Thông tin không được bỏ trống.");
            $('#msg-news').show()
            window.setTimeout(function () {
                $('#msg-news').hide()
            }, 3000);
            return false;
        }
        type = newsImg.type.substring(6);
        if (type != 'jpg' && type != 'jpeg' && type != 'png' && type != 'gif') {
            $('#msg-news').html("CLI: Định dạng file không phù hợp. Vui lòng tải các file có đinh dạng: jpg, jpeg, png, gif");
            $('#msg-news').show()
            window.setTimeout(function () {
                $('#msg-news').hide()
            }, 3000);
            return false;
        }
        // console.log(newsTitle, newsDescription, categoryNews, newsContent, newsStatus);
        // return false;
        let formData = new FormData();
        formData.append('newsTitle', newsTitle);
        formData.append('newsDescription', newsDescription);
        formData.append('categoryNews', categoryNews);
        formData.append('newsContent', newsContent);
        formData.append('newsStatus', newsStatus);
        formData.append('token',sessionStorage.getItem('token'));
        formData.append('newsImg',newsImg,Date.now()+ newsImg.name);
        $.ajax({
            type: "POST",
            url: "?controller=news&action=add_news",
            data: formData,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);
                if (response.responseCode == responseCode.success) {
                    alert("ok");
                    // sessionStorage.setItem('addNews', true);
                    // sessionStorage.setItem('msgNews', "Thêm tin tức thành công");
                    // window.location.href = "?controller=news&action=news_page_ad";
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
