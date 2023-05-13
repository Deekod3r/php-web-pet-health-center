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

function loadDataFeedback(data) {
    var feedbackData = "";
    data.forEach(element => {
        feedbackData += "<div class='media mb-4'> "
        feedbackData += "   <img src='asset/img/customer.png' alt='Image' class='img-fluid mr-3 mt-1' style='width: 45px;'>"
        feedbackData += "   <div class='media-body'>"
        feedbackData += "       <h6 style='margin-bottom:0'>Ẩn danh | <small>" + element.fb_time + "</small></h6>"
        for (i = 0; i < element.fb_rating; i++) {
            feedbackData += "   <span style='font-size: 20px;'><img class='img-fluid' src='asset/img/star.png' style='width: 15px; height: 15px; display: inline' alt=''></span>"
        }
        for (i = element.fb_rating; i < 5; i++) {
            feedbackData += "   <span style='font-size: 20px;'><img class='img-fluid' src='asset/img/non-star.png' style='width: 13px; height: 13px; display: inline' alt=''></span>"
        }
        feedbackData += "     <p>" + element.fb_content + "</p>"
        feedbackData += "      <button class='btn btn-sm btn-light' style='display:none'></button> "
        feedbackData += "  </div>"
        feedbackData += "</div>"
    });
    $('#countFeedback').html(data.length + " đánh giá")
    $('#dataFeedback').append(feedbackData);
}

$(document).ready(function () {
    $.ajax({
        type: 'GET',
        url: 'https://carepet65.com/routes.php?controller=feedback&action=data_feedback',
        // data: {
        //     token: sessionStorage.getItem('token')
        // },
        //cache: false,
        //contentType: "application/json; charset=utf-8",
        dataType: 'json',
        success: function (response) {
            //console.log(response);
            // response = JSON.stringify(response);
            // response = JSON.parse(response);
            if (response.statusCode == "1") {
                loadDataFeedback(response.data.feedback); 
                loadDataShop();
                loadPaging(0, 0);
            } else alert("Lỗi tải dữ liệu, vui lòng thử lại sau ít phút.");
        },
        error: function (xhr, status, error) {
            alert("Hệ thống gặp sự cố, vui lòng thử lại sau ít phút.");
        }
    })
})