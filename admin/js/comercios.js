$(document).ready(function(){ 

$("#fileToUpload").change(function() {
    var file = this.files[0];
    var imagefile = file.type;
    var match= ["image/jpeg","image/png","image/jpg","image/webp","image/gif"];

    if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]) || (imagefile==match[3]) || (imagefile==match[4]) )){
        alert('Por favor seleccione un formato de imagen válido (JPEG/JPG/PNG/GIF/WEBP).');
        $("#fileToUpload").val('');
        return false;
    }

    if(this.files[0].size > 614400){
        alert("El archivo es demasiado grande!");
        $("#fileToUpload").val('');
        return false;
     };
});

});
/* DOCUMENT READY END */

$('#form_comercio').on('submit',function(e){
    
    e.preventDefault();

    if($('#email').val().length < 5){
        $('#email').attr('class','form-control is-invalid');
        return false;
    }else{
        $('#email').attr('class','form-control is-valid');
    }

    if($('#pass').val().length < 5){
        $('#pass').attr('class','form-control is-invalid');
        return false;
    }else{
        $('#pass').attr('class','form-control is-valid');
    }

    if($('#nombre').val().length < 2){
        $('#nombre').attr('class','form-control is-invalid');
        return false;
    }else{
        $('#nombre').attr('class','form-control is-valid');
    }

    if($('#address').val() < 4){
        $('#address').attr('class','form-control is-invalid');
        return false;
    }else{
        $('#address').attr('class','form-control is-valid');
    }

    if($('#phone').val() < 4){
        $('#phone').attr('class','form-control is-invalid');
        return false;
    }else{
        $('#phone').attr('class','form-control is-valid');
    }

    if($('#rubro').val() < 4){
        $('#rubro').attr('class','form-control is-invalid');
        return false;
    }else{
        $('#rubro').attr('class','form-control is-valid');
    }


    if($("#fileToUpload").val() == ''){
        $('#fileToUpload').attr('class','form-control is-invalid');
        return false;
    }else{
        $('#fileToUpload').attr('class','form-control is-valid');
    }


/* var formData = new FormData($("#form_producto")[0]); */

$.ajax({
    url: "../ajax/uploadComercio.php",
    type: "POST",
    data : new FormData(this),
    processData: false,
    contentType: false,
    success: function(res){

       var response = JSON.parse(res);

        if(response.result){
            alert(response.message);
            location.reload();
        }else{
            alert(response.message);
        }



    },
    error: function(xhr, ajaxOptions, thrownError) {
       console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
});

});