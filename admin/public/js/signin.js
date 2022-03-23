$("#usuarioLogQS").keyup(function () {
    var u4 = $(this).val();
    var mu4 = u4.toLowerCase();
    $("#usuarioLogQS").val(mu4);
});
$("#usuarioLogQS").keyup(function () {
    this.value = (this.value + "").replace(/[^a-zA-ZñÑáéíóúÁÉÍÓÚ]/g, "");
});

function ValidarLoginQS() {
    var usuarioLog = $("#usuarioLogQS").val();
    var passwordLog = $("#usuarioPassQS").val();

    if (usuarioLog.length == 0 || passwordLog.length == 0) {
        Swal.fire({
            icon: "warning",
            title: "Ingrese usuario y contraseña por favor",
            showConfirmButton: false,
            timer: 1500
        });
        return false
    }
}
$("#btnLoginQS").on("click", function () {
    ValidarLoginQS()
});
$("#usuarioLogQS").change(function () {
    var cuenta = $(this).val();
    var datos = new FormData();

    datos.append("validarCuentaLog", cuenta);

    $.ajax({
        url: "public/views/src/ajaxUsuarios.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            if (respuesta) {
                $("#usuarioPassQS").focus();
                $("#mensajeLogQS").addClass("d-none");
            } else {
                $("#usuarioLogQS").val("");
                $("#usuarioLogQS").focus();
                $("#mensajeLogQS").removeClass("d-none");
            }
        },
    });
});