j$= jQuery.noConflict();
j$(document).ready(function(){
    j$('#token').hide();
    j$('#sendNumber').on('click', function(){
            var phone = j$('#phone').val();
            //alert(clave);
            var data = {
                'phone' : phone
            }
            j$.ajax({
                data: data,
                url: 'registerTool.php',
                type: 'post',
                success:  function (response) {
                            j$("#resultNumber").html(response);
                            j$('#token').show();
                    }
            });
    });
    j$('#sendCode').on('click', function(){
            var phone = j$('#phone').val();
            var code = j$('#code').val();
            //alert(clave);
            var data = {
                'phone': phone,
                'code' : code
            }
            j$.ajax({
                data: data,
                url: 'cToken.php',
                type: 'post',
                success:  function (response) {
                            j$("#resultToken").html(response);
                    }
            });
    });
});
