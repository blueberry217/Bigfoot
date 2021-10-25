
$(document).ready(function() {

function brands(){
    $.ajax({
        url: "getData.php",
        type: "POST",

        success: function(data, textStatus, QJxhr) {

            var dataResult = JSON.parse(data);

            $("#models").html(`<option value="">--Select Brand First--</option>`);

            $("#brands").append(`<option value="">--Select Brand--</option>`); 

                for( i=0; i < dataResult.brandData.length; i++ ){

            $("#brands").append(`<option value="${dataResult.brandData[i].id}">${dataResult.brandData[i].name}</option>`); 

            }
        }
    });
}

$("#brands").change(function(){
    id = {};
    brandID = $(this).val();
    if(brandID != ""){
        id["id"] = brandID;
        $.ajax({
            url: "getModels.php",
            type: "POST",
            data: id,

            success: function(data, textStatus, QJxhr) {

                var dataResult = JSON.parse(data);

                $("#models").html("");

                $("#models").append(`<option value="">--Select Model--</option>`);

                    for( i=0 ; i < dataResult.modelData.length ;i++){

                $("#models").append(`<option value="${dataResult.modelData[i].id}">${dataResult.modelData[i].name}</option>`); 

                }
            }
        }); 

    }
    else{

        alert("Please Select a Brand");
        brands();

    }

});

$("#models").change(function(){
    id = {};
    if($(this).val() != ""){
        id["bid"] = brandID;
        id["mid"] = $(this).val();
        $.ajax({
            url: "getSizes.php",
            type: "POST",
            data: id,

            success: function(data, textStatus, QJxhr) {

                var dataResult = JSON.parse(data);

                $("#sizes").html("");$("#sizes").append(`<li>${dataResult.sizeData.name}</li>`);
                
            }
        });
    }
    else{

        alert("Please Select a Model");
        brands();

    }

});   

brands();
});