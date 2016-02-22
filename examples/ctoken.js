j$= jQuery.noConflict();
j$(document).ready(function(){
    j$('#enviaToken').on('click', function(){
            var clave = j$('#token').val();
            //alert(clave);
            var form = {
                'token' : token,
                'number' : numero
            }
            j$.ajax({
                data: form,
                url: 'cToken.php',
                type: 'post',
                success:  function (response) {
                            j$("#respuesta").html(response);
                    }
            });
    });
});