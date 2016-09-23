$(document).ready(function () {
    $("#show-password").click(function () {
        if ($(this).is(':checked')) {
            $("#password").prop("type", "text");
        } else {
            $("#password").prop("type", "password");
        }
    })

    $("#show-password2").click(function () {
        if ($(this).is(':checked')) {
            $("#confirmPassword").prop("type", "text");
        } else {
            $("#confirmPassword").prop("type", "password");
        }
    })

    $("#change-password").click(function () {
        if ($(this).is(':checked')) {
            $("#passwordContainer").show();
        } else {
            $("#password").val("");
            $("#confirmPassword").val("");
            $("#passwordContainer").hide();

        }
    })
});

function modificarUsuario() {


    var username = $('input[name="username"]').val();
    var firstname = $('input[name="firstname"]').val();
    var lastname = $('input[name="lastname"]').val();
    var email = $('input[name="email"]').val();
    var id = $('input[name="id"]').val();
    var password = $('input[name="password"]').val();
    var confirmPassword = $('input[name="confirmPassword"]').val();

    if ($('#change-password').is(':checked')) {
        var changePassword = 1;
    } else {
        changePassword = 0;
    }



    $.ajax({
        url: "../web/api/editarMiUsuario.php",
        type: 'POST',
        data: {
            changePassword: changePassword,
            username: username,
            firstname: firstname,
            lastname: lastname,
            email: email,
            password: password,
            confirmPassword: confirmPassword,
            id: id
        },
        success: function (data) {

            clearErrors();
            if (data.code == 200) {
                alert(data.message);
            } else {
                showErrors(data.errors);
            }
           
        }


    });
}

function cambiarPassword(id, password, confirmPassword) {
    $.ajax({
        url: "../web/api/cambiarContrasena.php",
        type: 'POST',
        data: {
            password: password,
            confirmPassword: confirmPassword,
            id: id
        },
        success: function (data) {

            alert(data.message);

        }


    });
}

function showErrors(errores) {

    $.each(errores, function (i, item) {
        $('#' + i + '-form-group').addClass('has-error');
        $('#' + i + '-error').text(item);
    }
    )
}
;

function clearErrors() {
    $('.has-error').removeClass('has-error');
    $('li').text('');
}
