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
                response.data.pet.forEach(element => {
                    petData += "<tr class='color-text'>"
                    petData += "<td scope='row' class=''>" + element.pet_id +"</td>"
                    petData += "<td>" + element.pet_name +"</td>"
                    petData += "<td>" + element.pet_type +"</td>"
                    petData += "<td>" + element.pet_species + "</td>"
                    petData += "<td>" + element.pet_gender +"</td>"
                    petData += "<td>" + element.pet_note +"</td>"
                    petData += "</tr>"
                });
                $('#body-table').html(petData);
            } else if (response.responseCode == responseCode.dataEmpty) {
                $('.pet').html("<p style='margin:auto; margin-bottom:20px; color:black; font-size:20px; color:red; font-weight:bold'>Thông tin trống.</p>");           
            } else alert(response.responseCode + ": " + response.message + "Vui lòng thử lại sau ít phút.");
        },
        error: function (xhr) {
            alert(
                "Hệ thống gặp sự cố, vui lòng thử lại sau ít phút. Chi  tiết lỗi: " +
                xhr.responseText +
                ", " +
                xhr.status +
                ", " +
                xhr.error
            );
        }
    })
})