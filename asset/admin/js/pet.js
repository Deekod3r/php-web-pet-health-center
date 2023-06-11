const limitPetPage = 6;

var petName = new URLSearchParams(document.location.href).get("pet-name");
var petType = new URLSearchParams(document.location.href).get("type-pet");
var ctmPhone = new URLSearchParams(document.location.href).get("ctm-phone");
var genderPet = new URLSearchParams(document.location.href).get("gender-pet");

petName = petName != undefined && petName != null ? petName : "";
petType = petType != undefined && petType != null ? petType : "";
ctmPhone = ctmPhone != undefined && ctmPhone != null ? ctmPhone : "";
genderPet = genderPet != undefined && genderPet != null ? genderPet : "";

url = "?controller=pet&action=pet_page_ad";

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
        url: "?controller=pet&action=data_pet",
        data: {
            petName: petName,
            petType: petType,
            ctmPhone: ctmPhone,
            genderPet: genderPet,
            index: page,
            limit: limitPetPage,
            token: sessionStorage.getItem("token")
        },
        dataType: "json",
        success: function (response) {
            //console.log(response);
            if (response.responseCode == responseCode.success) {
                param = "";
                if (petName != null && petName != "") param += "&pet-name=" + petName;
                if (ctmPhone != null && ctmPhone != "")
                    param += "&ctm-phone=" + ctmPhone;
                if (petType != null && petType != "") param += "&type-pet=" + petType;
                if (genderPet != null && genderPet != "") param += "&gender-pet=" + genderPet;
                if (page > 1) {
                    window.history.pushState(null, "", url + param + "&page=" + page);
                } else window.history.pushState(null, "", url + param);
                loadDataPet(response.data.pets);
                loadPaging(page, Math.ceil(response.data.count / limitPetPage));
            } else if (response.responseCode == responseCode.dataEmpty) {
                window.history.pushState(null, "", url);
                $("#page").html("");
                $("#data-pet").html(
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

function loadDataPet(data){
    var petData = "";
    data.forEach((element) => {
        petGender = element.pet_gender == gender.male ? "Đực" : "Cái";
        petTyp = element.pet_type == typePet.cat ? "Mèo" : "Chó";
        petData += "<tr>";
        petData += "<th scope='row'>" + element.pet_id + "</th>";
        petData += "<td>" + element.pet_name + "</td>";
        petData += "<td>" + petTyp + "</td>";
        petData += "<td>" + element.pet_species + "</td>";
        petData += "<td>" + petGender + "</td>";
        petData += "<td>" + element.pet_note + "</td>";
        petData += "<td>" + element.ctm_phone + " - " + element.ctm_name + "</td>";
        petData += "<td><a class='btn btn-primary' onclick='loadDataDetailPet("+ element.pet_id  +")'  data-toggle='modal' data-target='#myModal1'>Sửa</a></td>";
        petData += "</tr>";
    });
    $("#data-pet").html(petData);
}

function resetAddForm() {
    $("#form-add-pet")[0].reset();
}

function loadDataDetailPet(id) {
    $.ajax({
        type: "GET",
        url: "?controller=pet&action=data_detail_pet",
        data: {
            petId: id,
            token: sessionStorage.getItem("token")
        },
        dataType: "json",
        success: function (response) {
            console.log(response);
            if (response.responseCode == responseCode.success) {
                $("#pet-id-edit").val(id)
                $("#pet-name-edit").val(response.data.pet.pet_name)
                $("#pet-species-edit").val(response.data.pet.pet_species)
                $("#type-pet-edit").val(response.data.pet.pet_type)
                $("#gender-pet-edit").val(response.data.pet.pet_gender)
                $("#pet-note-edit").val(response.data.pet.pet_note)
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

$(document).ready(function(){

    indexPage = new URLSearchParams(document.location.href).get("page");

    indexPage = indexPage != null && indexPage != 1 ? indexPage : 1;

    loadDataPage(indexPage);

    $("#form-add-pet").submit(function (e) {
        petNameAdd = $("#pet-name-add").val().trim();
        ctmPhoneAdd = $("#ctm-phone-add").val().trim();
        petSpeciesAdd = $("#pet-species-add").val().trim();
        petTypeAdd = $("#type-pet-add").val().trim();
        petGenderAdd = $("#gender-pet-add").val().trim();
        petNoteAdd = $("#pet-note-add").val().trim();
        if (petNameAdd == "" || ctmPhoneAdd == "" || petSpeciesAdd == "" || petTypeAdd == "" || petGenderAdd == "" ) {
            $("#msg-pet-add").html("CLI: Thông tin không được bỏ trống.");
            $("#msg-pet-add").addClass(" alert-danger");
            $("#msg-pet-add").show();
            window.setTimeout(function () {
                $("#msg-pet-add").hide();
                $("#msg-pet-add").removeClass(" alert-danger");
            }, 3000);
            return false;
        } 
        if (!regNumber.test(ctmPhoneAdd)) {
            $("#msg-pet-add").html("CLI: Số điện thoại không hợp lệ.");
            $("#msg-pet-add").addClass(" alert-danger");
            $("#msg-pet-add").show();
            window.setTimeout(function () {
                $("#msg-pet-add").hide();
                $("#msg-pet-add").removeClass(" alert-danger");
            }, 3000);
            return false;
        }
        $.ajax({
            type: "POST",
            url: "?controller=pet&action=add_pet",
            data: {
                petName: petNameAdd,
                petType: petTypeAdd,
                ctmPhone: ctmPhoneAdd,
                petSpecies: petSpeciesAdd,
                petGender: petGenderAdd,
                petNote: petNoteAdd,
                token: sessionStorage.getItem("token")
            },
            dataType: "json",
            success: function (response) {
                //console.log(response);
                if (response.responseCode == responseCode.success) {
                    $("#msg-pet-add").html("CLI: Thêm thú cưng thành công.");
                    $("#msg-pet-add").addClass(" alert-success");
                    $("#msg-pet-add").show();
                    $("#form-add-pet")[0].reset();
                    window.setTimeout(function () {
                        $("#msg-pet-add").hide();
                        $("#msg-pet-add").removeClass(" alert-success");
                    }, 3000);
                    loadDataPage(1);
                } else {
                    $("#msg-pet-add").html(response.message);
                    $("#msg-pet-add").addClass(" alert-danger");
                    $("#msg-pet-add").show();
                    window.setTimeout(function () {
                        $("#msg-pet-add").hide();
                        $("#msg-pet-add").removeClass(" alert-danger");
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

    $("#form-search-pet").submit(function (e) {
        petName = $("#pet-name").val().trim();
        ctmPhone = $("#ctm-phone").val().trim();
        petType = $("#type-pet").val().trim();
        genderPet = $("#gender-pet").val().trim();
        loadDataPage(1);
        e.preventDefault();
    });

    $("#form-edit-pet").submit(function (e) {
        petIdEdit = $("#pet-id-edit").val().trim();
        petNameEdit = $("#pet-name-edit").val().trim();
        petSpeciesEdit = $("#pet-species-edit").val().trim();
        petTypeEdit = $("#type-pet-edit").val().trim();
        petGenderEdit = $("#gender-pet-edit").val().trim();
        petNoteEdit = $("#pet-note-edit").val().trim() != "" ? $("#pet-note-edit").val().trim() : '';
        if (petNameEdit == "" || petSpeciesEdit == "" || petTypeEdit == "" || petGenderEdit == "" || petIdEdit == "") {
            $("#msg-pet-edit").html("CLI: Thông tin không được bỏ trống.");
            $("#msg-pet-edit").addClass(" alert-danger");
            $("#msg-pet-edit").show();
            window.setTimeout(function () {
                $("#msg-pet-edit").hide();
                $("#msg-pet-edit").removeClass(" alert-danger");
            }, 3000);
            return false;
        } 
        $.ajax({
            type: "POST",
            url: "?controller=pet&action=edit_pet",
            data: {
                petId: petIdEdit,
                petName: petNameEdit,
                petType: petTypeEdit,
                petSpecies: petSpeciesEdit,
                petGender: petGenderEdit,
                petNote: petNoteEdit,
                token: sessionStorage.getItem("token")
            },
            dataType: "json",
            success: function (response) {
                //console.log(response);
                if (response.responseCode == responseCode.success) {
                    $("#msg-pet-edit").html("CLI: Sửa thú cưng thành công.");
                    $("#msg-pet-edit").addClass(" alert-success");
                    $("#msg-pet-edit").show();
                    $("#form-add-pet")[0].reset();
                    window.setTimeout(function () {
                        $("#msg-pet-edit").hide();
                        $("#msg-pet-edit").removeClass(" alert-success");
                    }, 3000);
                    loadDataPage(new URLSearchParams(document.location.href).get("page") || 1);
                } else {
                    $("#msg-pet-edit").html(response.message);
                    $("#msg-pet-edit").addClass(" alert-danger");
                    $("#msg-pet-edit").show();
                    window.setTimeout(function () {
                        $("#msg-pet-edit").hide();
                        $("#msg-pet-edit").removeClass(" alert-danger");
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