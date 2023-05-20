//console.log("token="+sessionStorage.getItem('token')); 
function loadDataFeedback(data) {
    let feedbackData = "";
    data.forEach(element => {
        //feedbackData = "";
        feedbackData += "<div class='bg-white mx-3 p-4' style='height: 180px'>";
        feedbackData += "<div class='d-flex align-items-end mb-3 mt-n4 ml-n4' style='height:100px'>";
        feedbackData += "<img class='img-fluid' src='asset/img/customer.png' style='width: 80px; height: 80px;'>";
        feedbackData += "<div class='ml-3'>";
        feedbackData += "<h5>" + element.ctm_name + "</h5>";
        for (i = 0; i < element.fb_rating; i++) {
            feedbackData += "<span style='font-size: 20px; vertical-align:bottom'><img class='img-fluid' src='asset/img/star.png' style='width: 20px; height: 20px; display: inline; margin-right:2px'></span>";
        }
        for (i = element.fb_rating; i < 5; i++) {
            feedbackData += "<span style='font-size: 20px; vertical-align:bottom'><img class='img-fluid' src='asset/img/non-star.png' style='width: 17px; height: 17px; display: inline; margin-right:2px'></span>";
        }
        feedbackData += "<is style='display: block'>" + element.fb_time + "</is>"
        feedbackData += "</div>";
        feedbackData += "</div>";
        feedbackData += "<p class='m-0'>" + element.fb_content + "</p>";
        feedbackData += "</div>";
        //$('.owl-carousel').append(feedbackData);
    });
    $('.owl-carousel').html(feedbackData);
    $('.owl-carousel').owlCarousel('destroy')
    $('.owl-carousel').owlCarousel('update')
    $('.owl-carousel').owlCarousel({
        items: 3,
        loop: true,
        autoplay: true,
        autoplayTimeout: 1000,
        autoplayHoverPause: true,
        nav: true,
        dots: true
    });
}

function loadDataPage() {
    $.ajax({
        type: 'GET',
        url: '?controller=feedback&action=data_feedback',
        data: {
            limit: 5        
        },
        dataType: 'json',
        success: function (response) {
            //console.log(response);
            if (response.responseCode == responseCode.success) {
                loadDataFeedback(response.data.feedback);
            } else if (response.responseCode != responseCode.dataEmpty) alert("RES: " + response.responseCode + ": " + response.message + "Vui lòng thử lại sau ít phút.");

        },
        error: function (xhr) {
            alert("ER: Hệ thống gặp sự cố, vui lòng thử lại sau ít phút. Chi tiết lỗi: " + xhr.responseText + ", " + xhr.status + ", " + xhr.error);
        }
    })
}

$(document).ready(function () {
    loadDataShop();
    loadDataPage();
})