const limitFeedbackPage = 5;

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
    if (index > 2) {
        page += "   <li class='page-item'><a class='page-link'  onclick='loadDataPage(" + (index - 2) + ")'>" + (index - 2) + "</a></li>"
        page += "   <li class='page-item'><a class='page-link'  onclick='loadDataPage(" + (index - 1) + ")'>" + (index - 1) + "</a></li>"
    } else if (index > 1) {
        page += "   <li class='page-item'><a class='page-link'  onclick='loadDataPage(" + (index - 1) + ")'>" + (index - 1) + "</a></li>"
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
        url: '?controller=feedback&action=data_feedback',
        data: {
            limit: limitFeedbackPage,
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
                $('#countFeedback').html(response.data.count + " đánh giá")
                loadDataFeedback(response.data.feedback);
                loadPaging(page, Math.ceil(response.data.count / limitFeedbackPage));
            } else alert("Lỗi tải dữ liệu, vui lòng thử lại sau ít phút.");
        },
        error: function (xhr, status, error) {
            alert("Hệ thống gặp sự cố, vui lòng thử lại sau ít phút.");
        }
    });
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
    $('#dataFeedback').html(feedbackData);
    //loadDataFeedback(response.data.feedback);
}

$(document).ready(function () {

    if (sessionStorage.getItem('token') == null || sessionStorage.getItem('token') == '') $('#form-feedback').hide();

    loadDataShop();

    loadDataPage(1);

    $('#form-feedback').submit(function (e) {
        if (sessionStorage.getItem('token') != null && sessionStorage.getItem('token') != '') {
            if ($("input[name=rating]:checked").val() != '' && $("input[name=fbContent]").val() != '') {
                $.ajax({
                    type: 'POST',
                    url: '?controller=feedback&action=send_feedback',
                    data: {
                        token: sessionStorage.getItem('token'),
                        rating: $("input[name=rating]:checked").val(),
                        fbContent: $("input[name=fbContent]").val()
                    },
                    //cache: false,
                    //contentType: "application/json; charset=utf-8",
                    dataType: 'json',
                    success: function (response) {
                        //console.log(response);
                        // response = JSON.stringify(response);
                        // response = JSON.parse(response);
                        if (response.statusCode == "1") {
                            loadDataPage(1);
                            $('#msg-send-feedback').html(response.message);
                            $('#msg-send-feedback').addClass(' alert-success');
                            $('#msg-send-feedback').show();
                            window.setTimeout(function () {
                                $('#msg-send-feedback').hide()
                                $('#msg-send-feedback').removeClass('alert-success');
                            }, 3000);
                        } else if (response.statusCode == "0" || response.statusCode == "-1") {
                            $('#msg-send-feedback').html(response.message);
                            $('#msg-send-feedback').addClass(' alert-danger');
                            $('#msg-send-feedback').show();
                            window.setTimeout(function () {
                                $('#msg-send-feedback').hide()
                                $('#msg-send-feedback').removeClass('alert-danger');
                            }, 3000);
                        } else alert("Lỗi tải dữ liệu, vui lòng thử lại sau ít phút.");
                    },
                    error: function (xhr, status, error) {
                        alert("Hệ thống gặp sự cố, vui lòng thử lại sau ít phút.");
                    }
                })
            } else {
                $('#msg-send-feedback').html('Vui lòng nhập đầy đủ thông tin.');
                $('#msg-send-feedback').addClass(' alert-danger');
                $('#msg-send-feedback').show();
                window.setTimeout(function () {
                    $('#msg-send-feedback').hide()
                    $('#msg-send-feedback').removeClass('alert-danger');
                }, 3000);
            }
        } else {
            $('#msg-send-feedback').html('Vui lòng đăng nhập để có thể đánh giá.');
            $('#msg-send-feedback').addClass(' alert-danger');
            $('#msg-send-feedback').show();
            window.setTimeout(function () {
                $('#msg-send-feedback').hide()
                $('#msg-send-feedback').removeClass('alert-danger');
            }, 3000);
        }
        e.preventDefault();
    })
})