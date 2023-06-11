const limitFeedbackPage = 3;
const allStar = document.querySelectorAll('.rating .star')
const ratingValue = document.querySelector('.rating input')
url = "?controller=feedback&action=feedback_page"

var rating = {
	"r1": 0,
	"r2": 0,
	"r3": 0,
	"r4": 0,
	"r5": 0
}

function calculatePercentage() {
	let totalStars = 0;

	// Tính tổng số sao
	Object.values(rating).forEach(value => {
		totalStars += value;
	});
	// Tính phần trăm và cập nhật giá trị cho mỗi loại sao
	Object.keys(rating).forEach(key => {
		let percentage = (rating[key] / totalStars) * 100;
		rating[key] = percentage.toFixed(2); // Làm tròn đến 2 chữ số thập phân
	});
    console.log(rating);
}

function initializeStatistics() {
	Object.keys(rating).forEach(key => {
        $("#c-" + key).html(`${rating[key]}%`)
        $(".bar-" + key)[0].style.width = `${rating[key]}%`
    })
}


allStar.forEach((item, idx) => {
	item.addEventListener('click', function () {
		let click = 0
		ratingValue.value = idx + 1

		allStar.forEach(i => {
			i.classList.replace('bxs-star', 'bx-star')
			i.classList.remove('active')
		})
		for (let i = 0; i < allStar.length; i++) {
			if (i <= idx) {
				allStar[i].classList.replace('bx-star', 'bxs-star')
				allStar[i].classList.add('active')
			} else {
				allStar[i].style.setProperty('--i', click)
				click++
			}
		}
	})
})

function resetStar(){
    allStar.forEach(i => {
        i.classList.replace('bxs-star', 'bx-star')
        i.classList.remove('active')
    })
}

function loadPaging(index, endPage) {
    index = parseInt(index);
    endPage = parseInt(endPage);
    page = "";
    page += "   <div class='col-lg-12'>";
    page += "   <nav aria-label='Page navigation'>";
    page += "   <ul class='pagination justify-content-center mb-4'>";
    page += "   <li class='page-item head'>";
    page +="       <a class='page-link'  style='cursor:pointer' onclick='loadDataPage(" + 1 + ")'>";
    page += "       <span aria-hidden='true'>&laquo; Trang đầu</span>";
    page += "       </a>";
    page += "   </li>";

    page += "   <li class='page-item head' id='previous'>";
    page +="       <a class='page-link'  style='cursor:pointer' aria-label='Previous' onclick='loadDataPage(" +(index - 1) + ")'>";
    page += "       <span aria-hidden='true'>&laquo; Trước</span>";
    page += "       </a>";
    page += "   </li>";

    if (index > 2) {
        page += "   <li class='page-item'><a class='page-link' style='cursor:pointer'  onclick='loadDataPage(" + (index - 2) +")'>" + (index - 2) + "</a></li>";
        page += "   <li class='page-item'><a class='page-link' style='cursor:pointer' onclick='loadDataPage(" +(index - 1) + ")'>" + (index - 1) +"</a></li>";
    } else if (index > 1) {
        page += "   <li class='page-item'><a class='page-link' style='cursor:pointer' onclick='loadDataPage(" + (index - 1) + ")'>" +(index - 1) +"</a></li>";
    }
    page += "   <li class='page-item active'><a class='page-link' style='cursor:pointer' onclick='loadDataPage(" +index +")'>" + index +"</a></li>";
    for (let i = index + 1; i <= endPage; i++) {
        page += "    <li class='page-item'><a class='page-link' style='cursor:pointer'  onclick='loadDataPage(" + i + ")'>" +i + "</a></li>";
        if (i == index + 3) break;
    }

    page += "    <li class='page-item foot' id='next'>";
    page += "        <a class='page-link'  aria-label='Next' style='cursor:pointer' onclick='loadDataPage(" + (index + 1) +")'>";
    page += "         <span aria-hidden='true'>Sau &raquo;</span>";
    page += "        </a>";
    page += "     </li>";
    
    page += "   <li class='page-item foot'>";
    page +="       <a class='page-link'  style='cursor:pointer' onclick='loadDataPage(" + endPage + ")'>";
    page += "       <span aria-hidden='true'>Trang cuối &raquo;</span>";
    page += "       </a>";
    page += "   </li>";
    page += "     </ul>";
    page += " </nav>";
    page += " </div> ";
    $("#page").html(page);
    // if (index <= 1) $("#previous").addClass("disabled");
    // if (index >= endPage) $("#next").addClass("disabled");
    if (index <= 1) $('.head').addClass("disabled");
    if (index >= endPage) $('.foot').addClass("disabled");
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
            console.log(response);
            if (response.responseCode == responseCode.success) {
                $('#countFeedback').html(response.data.count + " đánh giá")
                if (page > 1) {
                    window.history.pushState(null, "", url + "&page=" + page);
                } else window.history.pushState(null, "", url);
                loadDataFeedback(response.data.feedbacks);
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
                $('#btn-send-feedback').prop('disabled',false);
                $('#btn-send-feedback').val('Gửi');
            } else {
                $('#btn-send-feedback').prop('disabled',true);
                $('#btn-send-feedback').val('Hãy trải nghiệm dịch vụ của CarePET và để lại phản hồi sau');
            }
        },
        error: function (xhr) {
            alert("ER: Hệ thống gặp sự cố, vui lòng thử lại sau ít phút. Chi tiết lỗi: " + xhr.responseText + ", " + xhr.status + ", " + xhr.error);
        }
    });
}

function loadStatistics() {
    $.ajax({
        type: 'GET',
        url: '?controller=feedback&action=data_statistic_feedback',
        dataType: 'json',
        success: function (response) {
            console.log(response);
            if (response.responseCode == responseCode.success) {
                //$('#countFeedback').html(response.data.count + " đánh giá")
                response.data.feedbacks.forEach(element => {
                    rate = element.fb_rating;
                    rating["r"+rate+""] = parseInt(rating["r"+rate+""]) + element.count;
                    //console.log(rating["r"+rate+""]);
                })
                calculatePercentage(rating);
                initializeStatistics();
                //console.log(rating);
            } else alert("RES: " + response.responseCode + ": " + response.message + "Vui lòng thử lại sau ít phút.");
        },
        error: function (xhr) {
            alert("ER: Hệ thống gặp sự cố, vui lòng thử lại sau ít phút. Chi tiết lỗi: " + xhr.responseText + ", " + xhr.status + ", " + xhr.error);
        }
    });
}

$(document).ready(function () {


    if (sessionStorage.getItem('token') != null && sessionStorage.getItem('token') != '') {
        $('#form').show();
    }

    loadStatistics();

    loadDataShop();

    indexPage = new URLSearchParams(document.location.href).get('page');

    indexPage = indexPage != null && indexPage != 1 ? indexPage : 1;

    loadDataPage(indexPage);

    checkCanFeedback();

    $('#form-feedback').submit(function (e) {
        if (sessionStorage.getItem('token') != null && sessionStorage.getItem('token') != '') {
            if ($("#rating").val() != null && $("#fb-content").val() != '') {
                $.ajax({
                    type: 'POST',
                    url: '?controller=feedback&action=send_feedback',
                    data: {
                        token: sessionStorage.getItem('token'),
                        rating: $("#rating").val().trim(),
                        fbContent: $("#fb-content").val().trim()
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
                            rating = {
                                "r1": 0,
                                "r2": 0,
                                "r3": 0,
                                "r4": 0,
                                "r5": 0
                            }
                            checkCanFeedback();
                            resetStar();
                            loadStatistics();
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