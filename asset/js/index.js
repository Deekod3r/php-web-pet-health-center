//console.log("token="+sessionStorage.getItem('token')); 
function loadDataFeedback(data) {
    // var feedbackData = "";
    // data.forEach(element => {
    //     feedbackData += "<div class='bg-white mx-3 p-4' style='height: 180px'>";
    //     feedbackData += "<div class='d-flex align-items-end mb-3 mt-n4 ml-n4' style='height:100px'>";
    //     feedbackData += "<img class='img-fluid' src='asset/img/customer.png' style='width: 80px; height: 80px;'>";
    //     feedbackData += "<div class='ml-3'>";
    //     feedbackData += "<h5>Ẩn danh</h5>";
    //     for (i = 0; i < element.fb_rating; i++) {
    //         feedbackData += "<span style='font-size: 20px; vertical-align:bottom'><img class='img-fluid' src='asset/img/star.png' style='width: 20px; height: 20px; display: inline'></span>";
    //     }
    //     for (i = element.fb_rating; i < 5; i++) {
    //         feedbackData += "<span style='font-size: 20px; vertical-align:bottom'><img class='img-fluid' src='asset/img/non-star.png' style='width: 18px; height: 18px; display: inline'></span>";
    //     }
    //     feedbackData += "<is style='display: block'>" + element.fb_time + "</is>"
    //     feedbackData += "</div>";
    //     feedbackData += "</div>";
    //     feedbackData += "<p class='m-0'>" + element.fb_content + "</p>";
    //     feedbackData += "</div>";
        //console.log(feedbackData);
    //});
}

// function loadDataPage() {
//     $.ajax({
//         type: 'GET',
//         url: '?controller=feedback&action=data_feedback',
//         data: {
//             limit: 5,
//             index: 1
//         },
//         //cache: false,
//         //contentType: "application/json; charset=utf-8",
//         dataType: 'json',
//         success: function (response) {
//             // response = JSON.stringify(response);
//             // response = JSON.parse(response);
//             console.log(response);
//             if (response.statusCode == "1") {
//                 loadDataFeedback(response.data.feedback);
//             } else alert("Lỗi tải dữ liệu, vui lòng thử lại sau ít phút.");
//         },
//         error: function (xhr, status, error) {
//             alert("Hệ thống gặp sự cố, vui lòng thử lại sau ít phút.");
//         }
//     })
// }

$(document).ready(function () {
    loadDataShop();
    //loadDataPage();
})