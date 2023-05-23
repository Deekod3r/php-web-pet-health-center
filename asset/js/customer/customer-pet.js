//console.log("token="+sessionStorage.getItem('token')); 

$(document).ready(function() {
    loadDataShop();

    $.ajax({
        type: 'GET',
        url: '?controller=pet&action=data_customer_pet',
        data: {
            token: sessionStorage.getItem('token')
        },
        dataType: 'json',
        success: function(response) {
            console.log(response);
            if(response.responseCode == responseCode.success) {
                var petData = "";
                response.data.pets.forEach(element => {
                    petType = element.pet_type == typePet.cat ? "Mèo" : "Chó";
                    petGender = element.pet_gender == gender.female ? "Cái" : "Đực";
                    petData += "<tr class='color-text'>"
                    petData += "<td scope='row' class=''>" + element.pet_id +"</td>"
                    petData += "<td>" + element.pet_name +"</td>"
                    petData += "<td>" + petType +"</td>"
                    petData += "<td>" + element.pet_species + "</td>"
                    petData += "<td>" + petGender +"</td>"
                    petData += "<td>" + element.pet_note +"</td>"
                    petData += "</tr>"
                });
                $('#body-table').html(petData);
            } else if (response.responseCode == responseCode.dataEmpty) {
                $('.pet').html("<p style='margin:auto; margin-bottom:20px; color:black; font-size:20px; color:red; font-weight:bold'>Thông tin trống.</p>");           
            } else alert("RES: " + response.responseCode + ": " + response.message + "Vui lòng thử lại sau ít phút.");
        },
        error: function (xhr) {
            alert("ER: Hệ thống gặp sự cố, vui lòng thử lại sau ít phút. Chi tiết lỗi: " + xhr.responseText + ", " + xhr.status + ", " + xhr.error);
        }
    })
})