const limitAdminPage = 5;

var adminUsername = new URLSearchParams(document.location.href).get("admin-username") || '';
var adminRole = new URLSearchParams(document.location.href).get("admin-role") || '';
var adminStatus = new URLSearchParams(document.location.href).get("admin-status") || '';
var genderadmin = new URLSearchParams(document.location.href).get("gender-admin") || '';

url = "?controller=admin&action=admin_page";

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
        url: "?controller=admin&action=data_admin",
        data: {
            adminUsername: adminUsername,
            adminRole: adminRole,
            adminStatus: adminStatus,
            index: page,
            limit: limitAdminPage,
            token: sessionStorage.getItem("token")
        },
        dataType: "json",
        success: function (response) {
            console.log(response);
            if (response.responseCode == responseCode.success) {
                param = "";
                if (adminUsername != null && adminUsername != "") param += "&admin-username=" + adminUsername;
                if (adminStatus != null && adminStatus != "")
                    param += "&admin-status=" + adminStatus;
                if (adminRole != null && adminRole != "") param += "&admin-role=" + adminRole;
                if (genderadmin != null && genderadmin != "") param += "&gender-admin=" + genderadmin;
                if (page > 1) {
                    window.history.pushState(null, "", url + param + "&page=" + page);
                } else window.history.pushState(null, "", url + param);
                loadDataAdmin(response.data.admins);
                loadPaging(page, Math.ceil(response.data.count / limitAdminPage));
            } else if (response.responseCode == responseCode.dataEmpty) {
                window.history.pushState(null, "", url);
                $("#page").html("");
                $("#data-admin").html(
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

function loadDataAdmin(data){
    var adminData = "";
    data.forEach((element) => {
        roleAdmin = "";
        switch (element.ad_role) {
            case role.adminManager:
                roleAdmin = "Quản lý"
                break;
            case role.adminSale:
                roleAdmin = "Nhân viên bán hàng"
                break;
            case role.adminNews:
                roleAdmin = "Nhân viên tin tức"
                break;
            default:
                break;
        }
        statusAdmin = element.ad_status == statusObject.active ? "Hoạt động" : "Khoá";
        adminData += "<tr>";
        adminData += "<th scope='row'>" + element.ad_id + "</th>";
        adminData += "<td>" + element.ad_username + "</td>";
        // adminData += "<td>" + element.ad_password + "</td>";
        adminData += "<td>" + roleAdmin + "</td>";
        adminData += "<td>" + statusAdmin + "</td>";
        adminData += "<td><a class='btn btn-primary' onclick='loadDataDetailAdmin("+ element.ad_id  +")'  data-toggle='modal' data-target='#myModal1'>Sửa</a></td>";
        adminData += "</tr>";
    });
    $("#data-admin").html(adminData);
}

function resetAddForm() {
    $("#form-add-admin")[0].reset();
}

function loadDataDetailAdmin(id) {
    $.ajax({
        type: "GET",
        url: "?controller=admin&action=data_detail_admin",
        data: {
            adminId: id,
            token: sessionStorage.getItem("token")
        },
        dataType: "json",
        success: function (response) {
            //console.log(response);
            if (response.responseCode == responseCode.success) {
                $("#admin-id-edit").val(id)
                $("#admin-status-edit").val(response.data.admin.ad_status)
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

    $("#form-add-admin").submit(function (e) {
        adminUsernameAdd = $("#admin-username-add").val().trim();
        adminRoleAdd = $("#admin-role-add").val().trim();
        adminPasswordAdd = $("#admin-password-add").val().trim();
        if (adminUsernameAdd == "" || adminRoleAdd == "" || adminPasswordAdd == "") {
            $("#msg-admin-add").html("CLI: Thông tin không được bỏ trống.");
            $("#msg-admin-add").addClass(" alert-danger");
            $("#msg-admin-add").show();
            window.setTimeout(function () {
                $("#msg-admin-add").hide();
                $("#msg-admin-add").removeClass(" alert-danger");
            }, 3000);
            return false;
        } 
        //return false;
        $.ajax({
            type: "POST",
            url: "?controller=admin&action=add_admin",
            data: {
                adminUsername: adminUsernameAdd,
                adminRole: adminRoleAdd,
                adminPassword: adminPasswordAdd,
                token: sessionStorage.getItem("token")
            },
            dataType: "json",
            success: function (response) {
                //console.log(response);
                if (response.responseCode == responseCode.success) {
                    $("#msg-admin-add").html("CLI: Thêm admin thành công.");
                    $("#msg-admin-add").addClass(" alert-success");
                    $("#msg-admin-add").show();
                    $("#form-add-admin")[0].reset();
                    window.setTimeout(function () {
                        $("#msg-admin-add").hide();
                        $("#msg-admin-add").removeClass(" alert-success");
                    }, 3000);
                    loadDataPage(1);
                } else {
                    $("#msg-admin-add").html(response.message);
                    $("#msg-admin-add").addClass(" alert-danger");
                    $("#msg-admin-add").show();
                    window.setTimeout(function () {
                        $("#msg-admin-add").hide();
                        $("#msg-admin-add").removeClass(" alert-danger");
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

    $("#form-search-admin").submit(function (e) {
        adminUsername = $("#admin-username").val().trim();
        adminStatus = $("#admin-status").val().trim();
        adminRole = $("#admin-role").val().trim();
        loadDataPage(1);
        e.preventDefault();
    });

    $("#form-edit-admin").submit(function (e) {
        adminIdEdit = $("#admin-id-edit").val().trim();
        adminStatusEdit = $("#admin-status-edit").val().trim();
        adminPasswordEdit = $("#admin-password").val();
        if (adminIdEdit == "" || adminStatusEdit == "") {
            $("#msg-admin-edit").html("CLI: Thông tin không được bỏ trống.");
            $("#msg-admin-edit").EditClass(" alert-danger");
            $("#msg-admin-edit").show();
            window.setTimeout(function () {
                $("#msg-admin-edit").hide();
                $("#msg-admin-edit").removeClass(" alert-danger");
            }, 3000);
            return false;
        } 
        $.ajax({
            type: "POST",
            url: "?controller=admin&action=edit_admin",
            data: {
                adminIdEdit: adminIdEdit,
                adminStatusEdit: adminStatusEdit,
                adminPasswordEdit: adminPasswordEdit,
                token: sessionStorage.getItem("token")
            },
            dataType: "json",
            success: function (response) {
                //console.log(response);
                if (response.responseCode == responseCode.success) {
                    $("#msg-admin-edit").html("CLI: Sửa admin thành công.");
                    $("#msg-admin-edit").addClass(" alert-success");
                    $("#msg-admin-edit").show();
                    $("#form-add-admin")[0].reset();
                    window.setTimeout(function () {
                        $("#msg-admin-edit").hide();
                        $("#msg-admin-edit").removeClass(" alert-success");
                    }, 3000);
                    loadDataPage(new URLSearchParams(document.location.href).get("page") || 1);
                } else {
                    $("#msg-admin-edit").html(response.message);
                    $("#msg-admin-edit").addClass(" alert-danger");
                    $("#msg-admin-edit").show();
                    window.setTimeout(function () {
                        $("#msg-admin-edit").hide();
                        $("#msg-admin-edit").removeClass(" alert-danger");
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