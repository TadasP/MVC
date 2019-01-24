$(document).ready(function(){

    $('#registrate').click(function(){

        event.preventDefault();
        var name = $('#registrationName').val();
        var email = $('#registrationEmail').val();
        var password = $('#registrationPassword').val();
        var rpassword = $('#registrationRPassword').val();
        
        $.ajax({
            type: "POST",
            url: "http://localhost:8081/2lvl/Tadas/Model-view-controler/index.php/users/storeUser",
            data: {name:name, email:email, password:password, rpassword:rpassword},
            cache: false,
            success: function(data){
                $("#alert").val(data);
                $('#alert').css('visibility', 'visible');
            }
        });
    });
});
