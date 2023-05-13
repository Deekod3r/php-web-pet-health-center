//console.log("token="+sessionStorage.getItem('token')); 
function loadDataFeedback(data){
    var feedbackData = "";
    // feedbackData += "<div class='d-flex flex-column text-center mb-5'>";
    // feedbackData += "<h4 class='text-secondary mb-3'>Feedback</h4>";
    // feedbackData += "<h1 class='display-4 m-0'>Đánh giá của <span class='text-primary'>khách hàng</span></h1>";
    // feedbackData += "</div>";
    // feedbackData += "<div class='owl-carousel testimonial-carousel owl-loaded owl-drag' id='feedback1' >";
    data.forEach(element => {
        feedbackData += "<div class='bg-white mx-3 p-4' style='height: 180px'>";
        feedbackData += "<div class='d-flex align-items-end mb-3 mt-n4 ml-n4' style='height:100px'>";
        feedbackData += "<img class='img-fluid' src='asset/img/customer.png' style='width: 80px; height: 80px;'>";
        feedbackData += "<div class='ml-3'>";
        feedbackData += "<h5>Ẩn danh</h5>";
        for (i = 0; i < element.fb_rating; i++) {
            feedbackData += "<span style='font-size: 20px; vertical-align:bottom'><img class='img-fluid' src='asset/img/star.png' style='width: 20px; height: 20px; display: inline'></span>";
        }
        for (i = element.fb_rating; i < 5; i++) {
            feedbackData += "<span style='font-size: 20px; vertical-align:bottom'><img class='img-fluid' src='asset/img/non-star.png' style='width: 18px; height: 18px; display: inline'></span>";
        }
        feedbackData += "<is style='display: block'>"+ element.fb_time +"</is>"
        feedbackData += "</div>";
        feedbackData += "</div>";
        feedbackData += "<p class='m-0'>"+ element.fb_content +"</p>";
        feedbackData += "</div>";
        //console.log(feedbackData);
    });
    //feedbackData += "</div>";
    $('#feedback1').append(feedbackData);;
    $('#feedback1').addClass('owl-carousel ');
    $('#feedback1').addClass(' testimonial-carousel');
    $('#feedback1').addClass(' owl-loaded ');
    $('#feedback1').addClass(' owl-drag');
    $('#feedback1').show();

}

$(document).ready(function() {
    $.ajax({
        type: 'GET',
        url: 'https://carepet65.com/routes.php?controller=feedback&action=data_feedback',
        // data: {
        //     token: sessionStorage.getItem('token')
        // },
        cache: false,
        //contentType: "application/json; charset=utf-8",
        dataType: 'json',
        success: function(response) {
            // response = JSON.stringify(response);
            // response = JSON.parse(response);
            console.log(response);
            if(response.statusCode == "1"){
                loadDataFeedback(response.data.feedback);
                loadDataShop();
            } else alert("Lỗi tải dữ liệu, vui lòng thử lại sau ít phút.");
        },
        error: function(xhr, status, error) {
            alert("Hệ thống gặp sự cố, vui lòng thử lại sau ít phút.");
        }
    })
})