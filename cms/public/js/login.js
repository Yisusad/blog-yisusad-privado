// Funcion para crear cookies en JS
function createCookie(nombre, valor, diasExpiracion) {
    
    var hoy = new Date();

    hoy.setTime(hoy.getTime() + (diasExpiracion*24*60*60*1000));

    var fechaExpiracion = "expires=" + hoy.toUTCString();

    document.cookie = nombre + "=" + valor + ";" + fechaExpiracion;
}


//Capturar el evento de cambio de valor en el input email_login para variable cookie
$(".email_login").change(function() {

    var email = $(this).val();
    createCookie("email_login", email, 1);
});