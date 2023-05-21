const limitFeedbackPage = 4;

url = "?controller=feedback&action=feedback_page"

function loadPaging(index, endPage) {
    index = parseInt(index);
    page = "";
    page += "   <div class='col-lg-12'>"
    page += "     <nav aria-label='Page navigation'>"
    page += "   <ul class='pagination justify-content-center mb-4'>"
    page += "   <li class='page-item ' id='previous'>"
    page += "       <a class='page-link' aria-label='Previous' style='cursor:pointer' onclick='loadDataPage(" + (index - 1) + ")'>"
    page += "       <span aria-hidden='true'>&laquo; Trước</span>"
    page += "       </a>"
    page += "   </li>"
    if (index > 2) {
        page += "   <li class='page-item'><a class='page-link' style='cursor:pointer' onclick='loadDataPage(" + (index - 2) + ")'>" + (index - 2) + "</a></li>"
        page += "   <li class='page-item'><a class='page-link' style='cursor:pointer' onclick='loadDataPage(" + (index - 1) + ")'>" + (index - 1) + "</a></li>"
    } else if (index > 1) {
        page += "   <li class='page-item'><a class='page-link' style='cursor:pointer' onclick='loadDataPage(" + (index - 1) + ")'>" + (index - 1) + "</a></li>"
    }
    page += "   <li class='page-item active'><a class='page-link' style='cursor:pointer' onclick='loadDataPage(" + index + ")'>" + index + "</a></li>"
    for (let i = index + 1; i <= endPage; i++) {
        page += "    <li class='page-item'><a class='page-link' style='cursor:pointer' onclick='loadDataPage(" + i + ")'>" + i + "</a></li>"
    }
    page += "    <li class='page-item' id='next'>"
    page += "        <a class='page-link'  aria-label='Next' style='cursor:pointer' onclick='loadDataPage(" + (index + 1) + ")'>"
    page += "         <span aria-hidden='true'>Sau &raquo;</span>"
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
        dataType: 'json',
        success: function (response) {
            //console.log(response);
            if (response.responseCode == responseCode.success) {
                $('#countFeedback').html(response.data.count + " đánh giá")
                if (page > 1) {
                    window.history.pushState(null, "", url + "&page=" + page);
                } else window.history.pushState(null, "", url);
                loadDataFeedback(response.data.feedback);
                loadPaging(page, Math.ceil(response.data.count / limitFeedbackPage));
            } else alert("RES: " + response.responseCode + ": " + response.message + "Vui lòng thử lại sau ít phút.");
        },
        error: function (xhr) {
            alert("ER: Hệ thống gặp sự cố, vui lòng thử lại sau ít phút. Chi tiết lỗi: " + xhr.responseText + ", " + xhr.status + ", " + xhr.error);
        }
    });
}

function loadDataFeedback(data) {
    var feedbackData = "";
    data.forEach(element => {
        feedbackData += "<div class='media mb-4'> "
        feedbackData += "   <img src='asset/img/customer.png' alt='Image' class='img-fluid mr-3 mt-1' style='width: 45px;'>"
        feedbackData += "   <div class='media-body'>"
        feedbackData += "       <h6 style='margin-bottom:0; font-weight:bold'>" + element.ctm_name + " | <small>" + element.fb_time + "</small></h6>"
        for (i = 0; i < element.fb_rating; i++) {
            feedbackData += "   <span style='font-size: 20px;'><img class='img-fluid' src='asset/img/star.png' style='width: 15px; height: 15px; display: inline' alt=''></span>"
        }
        for (i = element.fb_rating; i < 5; i++) {
            feedbackData += "   <span style='font-size: 20px;'><img class='img-fluid' src='asset/img/non-star.png' style='width: 13px; height: 13px; display: inline' alt=''></span>"
        }
        feedbackData += "     <p style='color:black'>" + element.fb_content + "</p>"
        feedbackData += "      <button class='btn btn-sm btn-light' style='display:none'></button> "
        feedbackData += "  </div>"
        feedbackData += "</div>"
    });
    $('#data-feedback').html(feedbackData);
    //loadDataFeedback(response.data.feedback);
}

if (sessionStorage.getItem('token') != null && sessionStorage.getItem('token') != '') {
    let form = "";
    form += "<form action='?controller=feedback&action=send_feedback' method='post' id='form-feedback'>"
    form += "    <div class='form-group'>"
    form += "        <input type='text' class='form-control border-1' placeholder='Hãy chia sẻ trải nghiệm sử dụng dịch vụ của bạn' name='fbContent'/>"
    form += "   </div>"
    form += "   <div class='form-check' style='display: inline;'>"
    form += "       <input class='form-check-input' type='radio' name='rating' id='rating-1' value=1>"
    form += "       <label class='form-check-label' for='rating-1'>"
    form += "            1<img class='img-fluid' src='asset/img/star.png' style='width: 18px; height: 18px; margin-right:5px; margin-left:5px;' alt=''> |"
    form += "        </label>"
    form += "    </div>"
    form += "    <div class='form-check' style='display: inline;'>"
    form += "        <input class='form-check-input' type='radio' name='rating' id='rating-2' value=2>"
    form += "        <label class='form-check-label' for='rating-2'>"
    form += "            2<img class='img-fluid' src='asset/img/star.png' style='width: 18px; height: 18px; margin-right:5px; margin-left:5px ' alt=''> |"
    form += "        </label>"
    form += "    </div>"
    form += "  <div class='form-check' style='display: inline;'>"
    form += "     <input class='form-check-input' type='radio' name='rating' id='rating-3' value=3>"
    form += "     <label class='form-check-label' for='rating-3'>"
    form += "         3<img class='img-fluid' src='asset/img/star.png' style='width: 18px; height: 18px; margin-right:5px; margin-left:5px ' alt=''> |"
    form += "     </label>"
    form += "  </div>"
    form += "  <div class='form-check' style='display: inline;'>"
    form += "      <input class='form-check-input' type='radio' name='rating' id='rating-4' value=4>"
    form += "      <label class='form-check-label' for='rating-4'>"
    form += "           4<img class='img-fluid' src='asset/img/star.png' style='width: 18px; height: 18px; margin-right:5px; margin-left:5px ' alt=''> |"
    form += "       </label>"
    form += "   </div>"
    form += "   <div class='form-check' style='display: inline;'>"
    form += "       <input class='form-check-input' type='radio' name='rating' id='rating-5' value=5>"
    form += "      <label class='form-check-label' for='rating-5'>"
    form += "           5<img class='img-fluid' src='asset/img/star.png' style='width: 18px; height: 18px; margin-right:5px; margin-left:5px ' alt=''> "
    form += "       </label>"
    form += "   </div>"
    form += "    <div style='margin-top: 10px; margin-bottom: 10px'>"
    form += "        <input class='btn btn-lg btn-primary btn-block border-0' id='btn-send-feedback' type='submit' value='Hãy trải nghiệm dịch vụ của CarePET và để lại phản hồi'>"
    form += "    </div>"
    form += "</form>";
    $('#form').html(form);
}

function checkCanFeedback(){
    $.ajax({
        type: 'GET',
        url: '?controller=customer&action=check_can_feedback',
        data: {
            token: sessionStorage.getItem('token')
        },
        dataType: 'json',
        success: function (response) {
            //console.log(response);
            if (response.responseCode == responseCode.success && response.data.canFeedback) {
                $('#btn-send-feedback').val('Gửi');
            } else {
                $('#btn-send-feedback').prop('disabled',true);
                $('#btn-send-feedback').val('Hãy trải nghiệm dịch vụ của CarePET và để lại phản hồi');
            }
        },
        error: function (xhr) {
            alert("ER: Hệ thống gặp sự cố, vui lòng thử lại sau ít phút. Chi tiết lỗi: " + xhr.responseText + ", " + xhr.status + ", " + xhr.error);
        }
    });
}

$(document).ready(function () {

    loadDataShop();

    indexPage = new URLSearchParams(document.location.href).get('page');

    indexPage = indexPage != null && indexPage != 1 ? indexPage : 1;

    loadDataPage(indexPage);

    checkCanFeedback();

    $('#form-feedback').submit(function (e) {
        if (sessionStorage.getItem('token') != null && sessionStorage.getItem('token') != '') {
            if ($("input[name=rating]:checked").val() != null && $("input[name=fbContent]").val() != '') {
                $.ajax({
                    type: 'POST',
                    url: '?controller=feedback&action=send_feedback',
                    data: {
                        token: sessionStorage.getItem('token'),
                        rating: $("input[name=rating]:checked").val(),
                        fbContent: $("input[name=fbContent]").val()
                    },                 
                    dataType: 'json',
                    success: function (response) {
                        //console.log(response);
                        if (response.responseCode == responseCode.success) {
                            loadDataPage(1);
                            $('#msg-send-feedback').html("Gửi phần hồi thành công, CarePET cảm ơn quý khách.");
                            $('#msg-send-feedback').addClass(' alert-success');
                            $('#msg-send-feedback').show();
                            window.setTimeout(function () {
                                $('#msg-send-feedback').hide()
                                $('#msg-send-feedback').removeClass(' alert-success');
                            }, 3000);
                            checkCanFeedback();
                            $('#form-feedback')[0].reset();
                        } else if (response.responseCode == responseCode.fail) {
                            $('#msg-send-feedback').html(response.message);
                            $('#msg-send-feedback').addClass(' alert-danger');
                            $('#msg-send-feedback').show();
                            window.setTimeout(function () {
                                $('#msg-send-feedback').hide()
                                $('#msg-send-feedback').removeClass(' alert-danger');
                            }, 3000);
                        } else alert(response.responseCode + ": " + response.message + "Vui lòng thử lại sau ít phút.");
                    },
                    error: function (xhr) {
                        alert("ER: Hệ thống gặp sự cố, vui lòng thử lại sau ít phút. Chi tiết lỗi: " + xhr.responseText + ", " + xhr.status + ", " + xhr.error);
                    }
                })
            } else {
                $('#msg-send-feedback').html('CLI: Vui lòng nhập đầy đủ thông tin.');
                $('#msg-send-feedback').addClass(' alert-danger');
                $('#msg-send-feedback').show();
                window.setTimeout(function () {
                    $('#msg-send-feedback').hide()
                    $('#msg-send-feedback').removeClass(' alert-danger');
                }, 3000);
            }
        } else {
            $('#msg-send-feedback').html('CLI: Vui lòng đăng nhập để có thể đánh giá.');
            $('#msg-send-feedback').addClass(' alert-danger');
            $('#msg-send-feedback').show();
            window.setTimeout(function () {
                $('#msg-send-feedback').hide()
                $('#msg-send-feedback').removeClass(' alert-danger');
            }, 3000);
        }
        e.preventDefault();
    })
})