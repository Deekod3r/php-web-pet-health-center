//console.log("token="+sessionStorage.getItem('token')); 

$(document).ready(function() {
    $.ajax({
        type: 'GET',
        url: '?controller=pet&action=data_customer_pet',
        data: {
            token: sessionStorage.getItem('token')
        },
        //cache: false,
        //contentType: "application/json; charset=utf-8",
        dataType: 'json',
        success: function(response) {
            console.log(response);
            // response = JSON.stringify(response);
            // response = JSON.parse(response);
            if(response.statusCode == "1"){
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
                loadDataShop();
            } else alert("Lỗi tải dữ liệu, vui lòng thử lại sau ít phút.");
        },
        error: function(xhr, status, error) {
            alert("Hệ thống gặp sự cố, vui lòng thử lại sau ít phút.");
        }
    })
})