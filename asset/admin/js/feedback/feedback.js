const limitfeedbackPage = 4;

var numberStar;

url = "?controller=feedback&action=feedback_page_ad";

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

function loadPaging(index, endPage) {
    index = parseInt(index);
    endPage = parseInt(endPage);
    page = "";
    page += "   <div class='col-lg-12'>";
    page += "   <nav aria-label='Page navigation'>";
    page += "   <ul class='pagination justify-content-center mb-4'>";
    page += "   <li class='page-item head'>";
    page +=
        "       <a class='page-link'  style='cursor:pointer' onclick='loadDataPage(" +
        1 +
        ")'>";
    page += "       <span aria-hidden='true'>&laquo; Trang đầu</span>";
    page += "       </a>";
    page += "   </li>";

    page += "   <li class='page-item head' id='previous'>";
    page +=
        "       <a class='page-link'  style='cursor:pointer' aria-label='Previous' onclick='loadDataPage(" +
        (index - 1) +
        ")'>";
    page += "       <span aria-hidden='true'>&laquo; Trước</span>";
    page += "       </a>";
    page += "   </li>";

    if (index > 2) {
        page +=
            "   <li class='page-item'><a class='page-link' style='cursor:pointer'  onclick='loadDataPage(" +
            (index - 2) +
            ")'>" +
            (index - 2) +
            "</a></li>";
        page +=
            "   <li class='page-item'><a class='page-link' style='cursor:pointer' onclick='loadDataPage(" +
            (index - 1) +
            ")'>" +
            (index - 1) +
            "</a></li>";
    } else if (index > 1) {
        page +=
            "   <li class='page-item'><a class='page-link' style='cursor:pointer' onclick='loadDataPage(" +
            (index - 1) +
            ")'>" +
            (index - 1) +
            "</a></li>";
    }
    page +=
        "   <li class='page-item active'><a class='page-link' style='cursor:pointer' onclick='loadDataPage(" +
        index +
        ")'>" +
        index +
        "</a></li>";
    for (let i = index + 1; i <= endPage; i++) {
        page +=
            "    <li class='page-item'><a class='page-link' style='cursor:pointer'  onclick='loadDataPage(" +
            i +
            ")'>" +
            i +
            "</a></li>";
        if (i == index + 3) break;
    }

    page += "    <li class='page-item foot' id='next'>";
    page +=
        "        <a class='page-link'  aria-label='Next' style='cursor:pointer' onclick='loadDataPage(" +
        (index + 1) +
        ")'>";
    page += "         <span aria-hidden='true'>Sau &raquo;</span>";
    page += "        </a>";
    page += "     </li>";

    page += "   <li class='page-item foot'>";
    page +=
        "       <a class='page-link'  style='cursor:pointer' onclick='loadDataPage(" +
        endPage +
        ")'>";
    page += "       <span aria-hidden='true'>Trang cuối &raquo;</span>";
    page += "       </a>";
    page += "   </li>";
    page += "     </ul>";
    page += " </nav>";
    page += " </div> ";
    $("#page").html(page);
    // if (index <= 1) $("#previous").addClass("disabled");
    // if (index >= endPage) $("#next").addClass("disabled");
    if (index <= 1) $(".head").addClass("disabled");
    if (index >= endPage) $(".foot").addClass("disabled");
}

function loadDataPage(page){
    $.ajax({
        type: "GET",
        url: "?controller=feedback&action=data_feedback",
        data: {
            number: numberStar,
            index: page,
            limit: limitfeedbackPage,
            token: sessionStorage.getItem("token")
        },
        dataType: "json",
        success: function (response) {
            //console.log(response);
            if (response.responseCode == responseCode.success) {
                $('#countFeedback').html(response.data.count + " đánh giá")
                param = "";
                if (numberStar != null && numberStar != "") param += "&feedback-star=" + numberStar;
                if (page > 1) {
                    window.history.pushState(null, "", url + param + "&page=" + page);
                } else window.history.pushState(null, "", url + param);
                loadDatafeedback(response.data.feedbacks);
                loadPaging(page, Math.ceil(response.data.count / limitfeedbackPage));
            } else if (response.responseCode == responseCode.dataEmpty) {
                $('#countFeedback').html("0 đánh giá")
                window.history.pushState(null, "", url);
                $("#page").html("");
                $("#data-feedback").html(
                    "<p style='font-size:20px; color:red; font-weight:bold; text-align:center'>Thông tin trống.</p>"
                );
            } else
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
        },
    });
}

function loadDatafeedback(data){
    var feedbackData = "";
    data.forEach((element) => {
        display = element.fb_status ? "Hiển thị" : "Ẩn";
        feedbackData += "<tr>";
        feedbackData += "<th scope='row'>" + element.fb_id + "</th>";
        feedbackData += "<td>" + element.fb_content + "</td>";
        feedbackData += "<td>" + element.fb_rating + "</td>";
        feedbackData += "<td>" + element.fb_time + "</td>";
        feedbackData += "<td>" + element.ctm_id + " - " + element.ctm_name + "</td>";
        feedbackData += "<td>" + display + "</td>";
        feedbackData += "<td><a class='btn btn-primary' onclick='loadDataDetailFeedback("+ element.fb_id  +")'  data-toggle='modal' data-target='#myModal1'>Sửa</a></td>";
        feedbackData += "</tr>";
    });
    $("#data-feedback").html(feedbackData);
}

function resetAddForm() {
    $("#form-add-feedback")[0].reset();
}

function loadDataDetailFeedback(id) {
    $.ajax({
        type: "GET",
        url: "?controller=feedback&action=data_detail_feedback",
        data: {
            feedbackId: id,
            token: sessionStorage.getItem("token")
        },
        dataType: "json",
        success: function (response) {
            console.log(response);
            if (response.responseCode == responseCode.success) {
                $("#feedback-id-edit").val(id)
                $("#feedback-active").val(response.data.feedback.fb_status)
            } else
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
        },
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

function searchFeedback(star) {
    numberStar = star;
    loadDataPage(1); 
}

$(document).ready(function(){

    loadStatistics();

    indexPage = new URLSearchParams(document.location.href).get("page");

    indexPage = indexPage != null && indexPage != 1 ? indexPage : 1;

    loadDataPage(indexPage);

    $("#form-add-feedback").submit(function (e) {
        feedbackNameAdd = $("#feedback-name-add").val().trim();
        ctmPhoneAdd = $("#ctm-phone-add").val().trim();
        feedbackSpeciesAdd = $("#feedback-species-add").val().trim();
        feedbackTypeAdd = $("#type-feedback-add").val().trim();
        feedbackGenderAdd = $("#gender-feedback-add").val().trim();
        feedbackNoteAdd = $("#feedback-note-add").val().trim();
        if (feedbackNameAdd == "" || ctmPhoneAdd == "" || feedbackSpeciesAdd == "" || feedbackTypeAdd == "" || feedbackGenderAdd == "" ) {
            $("#msg-feedback").html("CLI: Thông tin không được bỏ trống.");
            $("#msg-feedback").addClass(" alert-danger");
            $("#msg-feedback").show();
            window.setTimeout(function () {
                $("#msg-feedback").hide();
                $("#msg-feedback").removeClass(" alert-danger");
            }, 3000);
            return false;
        } 
        if (!regNumber.test(ctmPhoneAdd)) {
            $("#msg-feedback").html("CLI: Số điện thoại không hợp lệ.");
            $("#msg-feedback").addClass(" alert-danger");
            $("#msg-feedback").show();
            window.setTimeout(function () {
                $("#msg-feedback").hide();
                $("#msg-feedback").removeClass(" alert-danger");
            }, 3000);
            return false;
        }
        $.ajax({
            type: "POST",
            url: "?controller=feedback&action=add_feedback",
            data: {
                feedbackName: feedbackNameAdd,
                feedbackType: feedbackTypeAdd,
                ctmPhone: ctmPhoneAdd,
                feedbackSpecies: feedbackSpeciesAdd,
                feedbackGender: feedbackGenderAdd,
                feedbackNote: feedbackNoteAdd,
                token: sessionStorage.getItem("token")
            },
            dataType: "json",
            success: function (response) {
                //console.log(response);
                if (response.responseCode == responseCode.success) {
                    $("#msg-feedback").html("CLI: Thêm đánh giá thành công.");
                    $("#msg-feedback").addClass(" alert-success");
                    $("#msg-feedback").show();
                    $("#form-add-feedback")[0].reset();
                    window.setTimeout(function () {
                        $("#msg-feedback").hide();
                        $("#msg-feedback").removeClass(" alert-success");
                    }, 3000);
                    loadDataPage(1);
                } else {
                    $("#msg-feedback").html(response.message);
                    $("#msg-feedback").addClass(" alert-danger");
                    $("#msg-feedback").show();
                    window.setTimeout(function () {
                        $("#msg-feedback").hide();
                        $("#msg-feedback").removeClass(" alert-danger");
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

    // $("#form-search-feedback").submit(function (e) {
    //     feedbackName = $("#feedback-name").val().trim();
    //     ctmPhone = $("#ctm-phone").val().trim();
    //     feedbackType = $("#type-feedback").val().trim();
    //     genderfeedback = $("#gender-feedback").val().trim();
    //     loadDataPage(1);
    //     e.preventDefault();
    // });

    $("#form-edit-feedback").submit(function (e) {
        feedbackIdEdit = $("#feedback-id-edit").val().trim();
        feedbackStatusEdit = $("#feedback-active").val().trim();
        if (feedbackIdEdit == "" || feedbackStatusEdit == "") {
            $("#msg-feedback-edit").html("CLI: Thông tin không được bỏ trống.");
            $("#msg-feedback-edit").addClass(" alert-danger");
            $("#msg-feedback-edit").show();
            window.setTimeout(function () {
                $("#msg-feedback-edit").hide();
                $("#msg-feedback-edit").removeClass(" alert-danger");
            }, 3000);
            return false;
        } 
        //return false;
        $.ajax({
            type: "POST",
            url: "?controller=feedback&action=edit_feedback",
            data: {
                feedbackIdEdit: feedbackIdEdit,
                feedbackStatusEdit: feedbackStatusEdit,
                token: sessionStorage.getItem("token")
            },
            dataType: "json",
            success: function (response) {
                //console.log(response);
                if (response.responseCode == responseCode.success) {
                    $("#msg-feedback-edit").html("CLI: Sửa đánh giá thành công.");
                    $("#msg-feedback-edit").addClass(" alert-success");
                    $("#msg-feedback-edit").show();
                    $("#form-edit-feedback")[0].reset();
                    window.setTimeout(function () {
                        $("#msg-feedback-edit").hide();
                        $("#msg-feedback-edit").removeClass(" alert-success");
                    }, 3000);
                    loadDataPage(new URLSearchParams(document.location.href).get("page") || 1);
                } else {
                    $("#msg-feedback-edit").html(response.message);
                    $("#msg-feedback-edit").addClass(" alert-danger");
                    $("#msg-feedback-edit").show();
                    window.setTimeout(function () {
                        $("#msg-feedback-edit").hide();
                        $("#msg-feedback-edit").removeClass(" alert-danger");
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
})