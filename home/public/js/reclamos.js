// FORMATEO DE CAMPOS EN MAYUSCULAS
$("#nDocUsuario").attr("maxlength", "12");
$("#nDocRep").attr("maxlength", "12");
$("#rsUsuario").attr("maxlength", "150");
$("#rsRep").attr("maxlength", "150");
$("#nomUsuario").attr("maxlength", "150");
$("#APUsuario").attr("maxlength", "150");
$("#AMUsuario").attr("maxlength", "150");
$("#emailUsuario").attr("maxlength", "50");
$("#DomUsuario").attr("maxlength", "100");
$("#telefUsuario").attr("maxlength", "9");
$("#telefRep").attr("maxlength", "9");

$("#nomRep").attr("maxlength", "150");
$("#APRep").attr("maxlength", "150");
$("#AMRep").attr("maxlength", "150");
$("#emailRep").attr("maxlength", "50");
$("#DomRep").attr("maxlength", "100");

$("#nomUsuario").keyup(function () {
    var nombUsuario = $(this).val();
    var mayusNU = nombUsuario.toUpperCase();
    $("#nomUsuario").val(mayusNU);
});

$("#nomRep").keyup(function () {
    var nombRep = $(this).val();
    var mayusNR = nombRep.toUpperCase();
    $("#nomRep").val(mayusNR);
});

$("#APRep").keyup(function () {
    var nombRep = $(this).val();
    var mayusNR = nombRep.toUpperCase();
    $("#APRep").val(mayusNR);
});

$("#AMRep").keyup(function () {
    var nombRep = $(this).val();
    var mayusNR = nombRep.toUpperCase();
    $("#AMRep").val(mayusNR);
});

$("#rsRep").keyup(function () {
    var nombRep = $(this).val();
    var mayusNR = nombRep.toUpperCase();
    $("#rsRep").val(mayusNR);
});

$("#APUsuario").keyup(function () {
    var APUsuario = $(this).val();
    var mayusAP = APUsuario.toUpperCase();
    $("#APUsuario").val(mayusAP);
});

$("#AMUsuario").keyup(function () {
    var AMUsuario = $(this).val();
    var mayusAM = AMUsuario.toUpperCase();
    $("#AMUsuario").val(mayusAM);
});

$("#DomUsuario").keyup(function () {
    var domUsuario = $(this).val();
    var mayusDom = domUsuario.toUpperCase();
    $("#DomUsuario").val(mayusDom);
});

$("#DomRep").keyup(function () {
    var domRep = $(this).val();
    var mayusDomR = domRep.toUpperCase();
    $("#DomRep").val(mayusDomR);
});

$("#rsRep").keyup(function () {
    var domRep = $(this).val();
    var mayusDomR = domRep.toUpperCase();
    $("#rsRep").val(mayusDomR);
});

$("#rsUsuario").keyup(function () {
    var domRep = $(this).val();
    var mayusDomR = domRep.toUpperCase();
    $("#rsUsuario").val(mayusDomR);
});

$("#rsUsuario").keyup(function () {
    this.value = (this.value + "").replace(/[^a-zA-Z0-9ñÑáéíóúüÁÉÍÓÚÜ -#.,°\-/]/g, "");
});
$("#rsRep").keyup(function () {
    this.value = (this.value + "").replace(/[^a-zA-Z0-9ñÑáéíóúüÁÉÍÓÚÜ -#.,°\-/]/g, "");
});


$("#nDocUsuario,#telefUsuario,#telefRep,#nDocRep").keyup(function () {
    this.value = (this.value + "").replace(/[^0-9]/g, "");
});

$("#nomUsuario,#APUsuario,#AMUsuario,#nomRep").keyup(function () {
    this.value = (this.value + "").replace(/[^a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]/g, "");
});
$("#nomRep").keyup(function () {
    this.value = (this.value + "").replace(/[^a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]/g, "");
});

$("#DomUsuario").keyup(function () {
    this.value = (this.value + "").replace(/[^a-zA-Z0-9ñÑáéíóúüÁÉÍÓÚÜ -#.,°\-/]/g, "");
});


$("#DomRep").keyup(function () {
    this.value = (this.value + "").replace(/[^a-zA-Z0-9ñÑáéíóúüÁÉÍÓÚÜ -#.,°\-/]/g, "");
});

$("#detReclamo").keyup(function () {
    this.value = (this.value + "").replace(/[^a-zA-Z0-9ñÑáéíóúüÁÉÍÓÚÜ -#.:,\-/]/g, "");
});
$("#emailUsuario").focusout(function () {
    if (
        validadorEmail($("#emailUsuario").val()) === false &&
        $("#emailUsuario").val() !== ""
    ) {
        toastr.error("Ingrese un correo válido", "E-mail de Usuario");
        $("#emailUsuario").val("");
        $("#emailUsuario").focus();
    }
});

$("#emailRep").focusout(function () {
    if (
        validadorEmail($("#emailRep").val()) === false &&
        $("#emailRep").val() !== ""
    ) {
        toastr.error("Ingrese un correo válido", "E-mail de Representante");
        $("#emailRep").val("");
        $("#emailRep").focus();
    }
});


$("#cajaFecha").inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
$('#cajaFecha').datepicker({
    'format': 'dd/mm/yyyy',
    'autoclose': true,
    'orientation': 'bottom',
    'language': 'es',
    'endDate': new Date(),
});
// Bloque de Usuario
$("#radiorep2").prop("checked", true);
$("#representante").val("2");

// Filtro Tipo de Documento
$("#tDocUsuario").on("change", function () {
    let comboDocUsuario = $(this).val();
    if (comboDocUsuario > 0) {
        var datos = new FormData();
        datos.append("idTipoDoc", comboDocUsuario);
        $.ajax({
            url: "public/views/src/ajaxUtilitarios.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (respuesta) {
                if (respuesta) {
                    $("#nDocUsuario").attr("maxlength", "" + respuesta["longTipDoc"] + "");
                    if (comboDocUsuario == 1) {
                        $("#btnDNIUsuario").removeClass("d-none");
                        $("#UsuarioNatural").removeClass("d-none");
                        $("#rsUsuarioBlock").addClass("d-none");
                        $("#nDocUsuario").val("");
                        $("#nomUsuario").prop('required', true);
                        $("#APUsuario").prop('required', true);
                        $("#AMUsuario").prop('required', true);
                        $("#rsUsuario").prop('required', false);
                        $("#rsUsuario").val("");
                        $("#nDocUsuario").val("");
                        $("#nomUsuario").val("");
                        $("#APUsuario").val("");
                        $("#AMUsuario").val("");
                        $("#nomUsuario").prop("readonly", false);
                        $("#APUsuario").prop("readonly", false);
                        $("#AMUsuario").prop("readonly", false);
                        $("#rsUsuario").prop("readonly", false);
                    }
                    else if (comboDocUsuario == 7) {
                        $("#btnDNIUsuario").removeClass("d-none");
                        $("#rsUsuarioBlock").removeClass("d-none");
                        $("#UsuarioNatural").addClass("d-none");
                        $("#nomUsuario").prop('required', false);
                        $("#APUsuario").prop('required', false);
                        $("#AMUsuario").prop('required', false);
                        $("#rsUsuario").prop('required', true);

                        $("#nDocUsuario").val("");
                        $("#rsUsuario").val("");
                        $("#nomUsuario").val("");
                        $("#APUsuario").val("");
                        $("#AMUsuario").val("");
                        $("#nomUsuario").prop("readonly", false);
                        $("#APUsuario").prop("readonly", false);
                        $("#AMUsuario").prop("readonly", false);
                        $("#rsUsuario").prop("readonly", false);
                    }
                    else {
                        $("#btnDNIUsuario").addClass("d-none");
                        $("#UsuarioNatural").removeClass("d-none");
                        $("#rsUsuarioBlock").addClass("d-none");
                        $("#nDocUsuario").val("");
                        $("#nomUsuario").prop('required', true);
                        $("#APUsuario").prop('required', true);
                        $("#AMUsuario").prop('required', true);
                        $("#rsUsuario").prop('required', false);
                        $("#rsUsuario").val("");
                        $("#nDocUsuario").val("");
                        $("#nomUsuario").val("");
                        $("#APUsuario").val("");
                        $("#AMUsuario").val("");
                        $("#nomUsuario").prop("readonly", false);
                        $("#APUsuario").prop("readonly", false);
                        $("#AMUsuario").prop("readonly", false);
                        $("#rsUsuario").prop("readonly", false);

                    }
                }
            },
        });
    }
    else {
        $("#btnDNIUsuario").addClass("d-none");
        $("#UsuarioNatural").removeClass("d-none");
        $("#rsUsuarioBlock").addClass("d-none");
        $("#rsUsuario").val("");
        $("#nomUsuario").val("");
        $("#APUsuario").val("");
        $("#AMUsuario").val("");
        $("#nDocUsuario").val("");
        $("#nomUsuario").prop("readonly", false);
        $("#APUsuario").prop("readonly", false);
        $("#AMUsuario").prop("readonly", false);
    }

});
// Filtro Tipo de Documento

// Búsqueda de Datos por N° Documento y Tipo
$("#btnDNIU").on("click", function () {
    var tipDoc = $("#tDocUsuario").val();
    var nDoc = $("#nDocUsuario").val();
    if (tipDoc == 1 && nDoc.length == 8) {
        $.ajax({
            type: "GET",
            url:
                "https://dniruc.apisperu.com/api/v1/dni/" +
                nDoc +
                "?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Im9jYXN0cm9wLnRpQGdtYWlsLmNvbSJ9.XtrYx8wlARN2XZwOZo6FeLuYDFT6Ljovf7_X943QC_E",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: function (data) {
                if (data["dni"] != null) {
                    toastr.success("Datos cargados con éxito", "RENIEC");

                    $("#nomUsuario").val(data["nombres"]);
                    $("#APUsuario").val(data["apellidoPaterno"]);
                    $("#AMUsuario").val(data["apellidoMaterno"]);

                    $("#nomUsuario").prop("readonly", true);
                    $("#APUsuario").prop("readonly", true);
                    $("#AMUsuario").prop("readonly", true);

                    $("#sexUsuario").focus();
                }
                else {
                    toastr.warning("Ingrese datos manualmente", "RENIEC");
                    $("#nomUsuario").val("");
                    $("#APUsuario").val("");
                    $("#AMUsuario").val("");

                    $("#nomUsuario").prop("readonly", false);
                    $("#APUsuario").prop("readonly", false);
                    $("#AMUsuario").prop("readonly", false);

                    $("#nomUsuario").focus();
                }
            },
            failure: function (data) {
                toastr.info("No se pudo conectar los datos", "RENIEC");
            },
            error: function (data) {
                $("#nomUsuario").val("");
                $("#APUsuario").val("");
                $("#AMUsuario").val("");

                $("#nomUsuario").prop("readonly", false);
                $("#APUsuario").prop("readonly", false);
                $("#AMUsuario").prop("readonly", false);

                $("#nomUsuario").focus();
            },
        });
    }
    else if (tipDoc == 7 && nDoc.length == 11) {
        $.ajax({
            type: "GET",
            url:
                "https://dniruc.apisperu.com/api/v1/ruc/" +
                nDoc +
                "?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Im9jYXN0cm9wLnRpQGdtYWlsLmNvbSJ9.XtrYx8wlARN2XZwOZo6FeLuYDFT6Ljovf7_X943QC_E",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: function (data) {
                if (data["ruc"] != null) {
                    toastr.success("Datos cargados con éxito", "SUNAT");
                    $("#rsUsuario").val(data["razonSocial"]);
                    $("#rsUsuario").prop("readonly", true);
                    $("#sexUsuario").focus();
                }
                else {
                    toastr.warning("Ingrese datos manualmente", "SUNAT");
                    $("#rsUsuario").val("");
                    $("#rsUsuario").prop("readonly", false);
                    $("#rsUsuario").focus();
                }
            },
            failure: function (data) {
                toastr.info("No se pudo conectar los datos", "SUNAT");
            },
            error: function (data) {
                $("#rsUsuario").val("");
                $("#rsUsuario").prop("readonly", false);
                $("#rsUsuario").focus();
            },
        });
    }
});
// Búsqueda de Datos por N° Documento y Tipo

// Carga de Ubigeo
$("#DepUsuario").on("change", function () {
    let comboDepartamento = $(this).val();
    if (comboDepartamento > 0) {
        $.ajax({
            url: "public/views/src/ajaxUtilitarios.php",
            method: "POST",
            dataType: "html",
            data: { idDepartamento: comboDepartamento }
        }).done(function (respuesta) {
            $("#ProvUsuario").html(respuesta);
        }).fail(function () {
            console.log("error");
        });
    }
    else {
        $("#ProvUsuario").html(
            '<option value="0">Seleccione departamento primero</option>'
        );
        $("#DistUsuario").html(
            '<option value="0">Seleccione provincia primero</option>'
        );
    }
});

$("#ProvUsuario").on("change", function () {
    let comboProvincia = $(this).val();
    if (comboProvincia > 0) {
        $.ajax({
            url: "public/views/src/ajaxUtilitarios.php",
            method: "POST",
            dataType: "html",
            data: { idProvincia: comboProvincia }
        }).done(function (respuesta) {
            $("#DistUsuario").html(respuesta);
        }).fail(function () {
            console.log("error");
        });
    }
    else {
        $("#DistUsuario").html(
            '<option value="0">Seleccione provincia primero</option>'
        );
    }
});

$("#recCG").on("change", function () {
    let comboDerecho = $(this).val();
    if (comboDerecho > 0) {
        $.ajax({
            url: "public/views/src/ajaxUtilitarios.php",
            method: "POST",
            dataType: "html",
            data: { idDerecho: comboDerecho }
        }).done(function (respuesta) {
            $("#recCE").html(respuesta);
        }).fail(function () {
            console.log("error");
        });
    }
    else {
        $("#recCE").html(
            '<option value="0">Seleccione la causa específica del reclamo</option>'
        );
    }
});

function validadorEmail(email) {
    var regex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
    if (regex.test(email)) {
        return true;
    } else {
        return false;
    }
}
// Filtro Tipo de Documento Representante
$("#tDocRep").on("change", function () {
    let comboDocUsuario = $(this).val();
    if (comboDocUsuario > 0) {
        var datos = new FormData();
        datos.append("idTipoDoc", comboDocUsuario);
        $.ajax({
            url: "public/views/src/ajaxUtilitarios.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (respuesta) {
                if (respuesta) {
                    $("#nDocRep").attr("maxlength", "" + respuesta["longTipDoc"] + "");
                    if (comboDocUsuario == 1) {

                        $("#btnDNIRepresentante").removeClass("d-none");
                        $("#RepNatural").removeClass("d-none");
                        $("#RepJuridica").addClass("d-none");

                        $("#nomRep").prop('required', true);
                        $("#APRep").prop('required', true);
                        $("#AMRep").prop('required', true);
                        $("#rsRep").prop('required', false);

                        $("#rsRep").val("");
                        $("#nDocRep").val("");
                        $("#nomRep").val("");
                        $("#APRep").val("");
                        $("#AMRep").val("");

                        $("#nomRep").prop("readonly", false);
                        $("#APRep").prop("readonly", false);
                        $("#AMRep").prop("readonly", false);
                        $("#rsRep").prop("readonly", false);
                    }
                    else if (comboDocUsuario == 7) {
                        $("#btnDNIRepresentante").removeClass("d-none");
                        $("#RepJuridica").removeClass("d-none");
                        $("#RepNatural").addClass("d-none");

                        $("#nomRep").prop('required', false);
                        $("#APRep").prop('required', false);
                        $("#AMRep").prop('required', false);
                        $("#rsRep").prop('required', true);

                        $("#nDocRep").val("");
                        $("#rsRep").val("");
                        $("#nomRep").val("");
                        $("#APRep").val("");
                        $("#AMRep").val("");
                        $("#nomRep").prop("readonly", false);
                        $("#APRep").prop("readonly", false);
                        $("#AMRep").prop("readonly", false);
                        $("#rsRep").prop("readonly", false);
                    }
                    else {
                        $("#btnDNIRepresentante").addClass("d-none");
                        $("#RepNatural").removeClass("d-none");
                        $("#RepJuridica").addClass("d-none");
                        $("#nDocRep").val("");
                        $("#nomRep").prop('required', true);
                        $("#APRep").prop('required', true);
                        $("#AMRep").prop('required', true);
                        $("#rsRep").prop('required', false);
                        $("#rsRep").val("");
                        $("#nDocRep").val("");
                        $("#nomRep").val("");
                        $("#APRep").val("");
                        $("#AMRep").val("");
                        $("#nomRep").prop("readonly", false);
                        $("#APRep").prop("readonly", false);
                        $("#AMRep").prop("readonly", false);
                        $("#rsRep").prop("readonly", false);

                    }
                }
            },
        });
    }
    else {
        $("#btnDNIRepresentante").addClass("d-none");
        $("#RepNatural").removeClass("d-none");
        $("#RepJuridica").addClass("d-none");
        $("#rsRep").val("");
        $("#nomRep").val("");
        $("#APRep").val("");
        $("#AMRep").val("");
        $("#nDocRep").val("");
        $("#nomRep").prop('required', true);
        $("#APRep").prop('required', true);
        $("#AMRep").prop('required', true);
        $("#rsRep").prop('required', false);
        $("#nomRep").prop("readonly", false);
        $("#APRep").prop("readonly", false);
        $("#AMRep").prop("readonly", false);
    }

});

$("#radiorep1").click(function () {
    if ($("#radiorep1").is(":checked")) {
        $("#representante").val("1");

        $("#bloqueRep1").removeClass("d-none");
        $("#RepNatural").removeClass("d-none");
        $("#bloqueRep2").removeClass("d-none");
        $("#bloqueRep3").removeClass("d-none");
        $("#RepJuridica").addClass("d-none");
        $("#btnDNIRepresentante").addClass("d-none");
        $("#rsRep").val("");
        $("#nomRep").val("");
        $("#APRep").val("");
        $("#AMRep").val("");
        $("#emailRep").val("");
        $("#APRep").val("");
        $("#AMRep").val("");
        $("#nDocRep").val("");
        $("#emailRep").val("");
        $("#telefRep").val("");
        $("#DomRep").val("");
        $("#nomRep").prop('required', true);
        $("#nDocRep").prop('required', true);

        $("#APRep").prop('required', true);
        $("#AMRep").prop('required', true);
        $("#DomRep").prop("required", true);
        $("#telefRep").prop("required", true);
        $("#emailRep").prop("required", true);


        $("#rsRep").prop('required', false);
        $("#nomRep").prop("readonly", false);
        $("#APRep").prop("readonly", false);
        $("#AMRep").prop("readonly", false);
        $("#tDocRep")[0].selectedIndex = 0;

    } else {
        $("#representante").val("2");
    }
});
$("#radiorep2").click(function () {
    if ($("#radiorep2").is(":checked")) {
        $("#representante").val("2");

        $("#bloqueRep1").addClass("d-none");
        $("#RepNatural").addClass("d-none");
        $("#bloqueRep2").addClass("d-none");
        $("#bloqueRep3").addClass("d-none");
        $("#RepJuridica").addClass("d-none");
        $("#btnDNIRepresentante").addClass("d-none");
        $("#rsRep").val("");
        $("#nomRep").val("");
        $("#APRep").val("");
        $("#AMRep").val("");
        $("#emailRep").val("");
        $("#telefRep").val("");
        $("#DomRep").val("");
        $("#nomRep").prop('required', false);
        $("#APRep").prop('required', false);
        $("#AMRep").prop('required', false);
        $("#rsRep").prop('required', false);
        $("#nDocRep").prop('required', false);
        $("#nomRep").prop("readonly", false);
        $("#APRep").prop("readonly", false);
        $("#AMRep").prop("readonly", false);
        $("#DomRep").prop("required", false);
        $("#telefRep").prop("required", false);
        $("#emailRep").prop("required", false);

        $("#tDocRep")[0].selectedIndex = 0;
    } else {
        $("#representante").val("1");
    }
});
// Filtro Tipo de Documento Representante
// Búsqueda de Datos por N° Documento y Tipo
$("#btnDNIRep").on("click", function () {
    var tipDoc = $("#tDocRep").val();
    var nDoc = $("#nDocRep").val();
    if (tipDoc == 1 && nDoc.length == 8) {
        $.ajax({
            type: "GET",
            url:
                "https://dniruc.apisperu.com/api/v1/dni/" +
                nDoc +
                "?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Im9jYXN0cm9wLnRpQGdtYWlsLmNvbSJ9.XtrYx8wlARN2XZwOZo6FeLuYDFT6Ljovf7_X943QC_E",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: function (data) {
                if (data["dni"] != null) {
                    toastr.success("Datos cargados con éxito", "RENIEC");

                    $("#nomRep").val(data["nombres"]);
                    $("#APRep").val(data["apellidoPaterno"]);
                    $("#AMRep").val(data["apellidoMaterno"]);

                    $("#nomRep").prop("readonly", true);
                    $("#APRep").prop("readonly", true);
                    $("#AMRep").prop("readonly", true);

                    $("#emailRep").focus();
                }
                else {
                    toastr.warning("Ingrese datos manualmente", "RENIEC");
                    $("#nomRep").val("");
                    $("#APRep").val("");
                    $("#AMRep").val("");

                    $("#nomRep").prop("readonly", false);
                    $("#APRep").prop("readonly", false);
                    $("#AMRep").prop("readonly", false);

                    $("#nomRep").focus();
                }
            },
            failure: function (data) {
                toastr.info("No se pudo conectar los datos", "RENIEC");
            },
            error: function (data) {
                $("#nomRep").val("");
                $("#APRep").val("");
                $("#AMRep").val("");

                $("#nomRep").prop("readonly", false);
                $("#APRep").prop("readonly", false);
                $("#AMRep").prop("readonly", false);

                $("#nomRep").focus();
            },
        });
    }
    else if (tipDoc == 7 && nDoc.length == 11) {
        $.ajax({
            type: "GET",
            url:
                "https://dniruc.apisperu.com/api/v1/ruc/" +
                nDoc +
                "?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Im9jYXN0cm9wLnRpQGdtYWlsLmNvbSJ9.XtrYx8wlARN2XZwOZo6FeLuYDFT6Ljovf7_X943QC_E",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: function (data) {
                if (data["ruc"] != null) {
                    toastr.success("Datos cargados con éxito", "SUNAT");
                    $("#rsRep").val(data["razonSocial"]);
                    $("#rsRep").prop("readonly", true);
                    $("#emailRep").focus();
                }
                else {
                    toastr.warning("Ingrese datos manualmente", "SUNAT");
                    $("#rsRep").val("");
                    $("#rsRep").prop("readonly", false);
                    $("#rsRep").focus();
                }
            },
            failure: function (data) {
                toastr.info("No se pudo conectar los datos", "SUNAT");
            },
            error: function (data) {
                $("#rsRep").val("");
                $("#rsRep").prop("readonly", false);
                $("#rsRep").focus();
            },
        });
    }
});
// Búsqueda de Datos por N° Documento y Tipo
$("#cajaFecha").change(function () {
    var fechaEva2 = $(this).val();
    var newFechaEva2 = fechaEva2.split("/").reverse().join("-");
    var fevOr2 = $("#fcomparacion").val();

    if (newFechaEva2 > fevOr2) {
        Swal.fire({
            icon: "error",
            title: "La fecha de Ocurrencia no puede ser mayor a la Fecha Actual",
            showConfirmButton: false,
            timer: 1300
        });
        $("#cajaFecha").val("");
        $("#cajaFecha").focus();
    }
});
// Validador de Campos
$("#btnEnviarReclamo").on("click", function () {
    let repOpcion = $('input[name="repCon"]:checked').val();
    // alert(repOpcion)
    $.validator.addMethod(
        "valueNotEquals",
        function (value, element, arg) {
            return arg !== value;
        },
        "Value must not equal arg."
    );
    if (repOpcion == 1) {
        $("#formRegReclamo").validate({
            rules: {
                tDocRep: {
                    valueNotEquals: "0",
                    required: true,
                },
            },
            messages: {
                tDocRep: {
                    valueNotEquals: "Seleccione Tipo de Documento de Representante",
                    required: "Seleccione Tipo de Documento de Representante",
                },
            },
            errorElement: "span",
            errorPlacement: function (error, element) {
                error.addClass("invalid-feedback");
                element.closest(".form-group").append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass("is-invalid");
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass("is-invalid");
            },
        });
    }
    else {
        $("#formRegReclamo").validate({
            rules: {
                tDocUsuario: {
                    valueNotEquals: "0",
                    required: true,
                },
                sexUsuario: {
                    valueNotEquals: "0",
                    required: true,
                },
                DepUsuario: {
                    valueNotEquals: "0",
                    required: true,
                },
                ProvUsuario: {
                    valueNotEquals: "0",
                    required: true,
                },
                DistUsuario: {
                    valueNotEquals: "0",
                    required: true,
                },
                tipoUsuario: {
                    valueNotEquals: "0",
                    required: true,
                },
                recCG: {
                    valueNotEquals: "0",
                    required: true,
                },
                recCE: {
                    valueNotEquals: "0",
                    required: true,
                },
                nDocUsuario: {
                    required: true,
                },
                DomUsuario: {
                    required: true,
                },
                emailUsuario: {
                    required: true,
                },
                telefUsuario: {
                    required: true,
                },
                cajaFecha: {
                    required: true,
                },
            },
            messages: {
                tDocUsuario: {
                    valueNotEquals: "Seleccione Tipo de Documento",
                    required: "Seleccione Tipo de Documento",
                },
                sexUsuario: {
                    valueNotEquals: "Seleccione sexo",
                    required: "Seleccione sexo",
                },
                DepUsuario: {
                    valueNotEquals: "Seleccione Departamento",
                    required: "Seleccione Departamento",
                },
                ProvUsuario: {
                    valueNotEquals: "Seleccione Provincia",
                    required: "Seleccion Provincia",
                },
                DistUsuario: {
                    valueNotEquals: "Seleccione Distrito",
                    required: "Seleccione Distrito",
                },
                tipoUsuario: {
                    valueNotEquals: "Seleccione tipo de usuario",
                    required: "Seleccione tipo de usuario",
                },
                recCG: {
                    valueNotEquals: "Seleccione Derecho afectado",
                    required: "Seleccione Derecho afectado",
                },
                recCE: {
                    valueNotEquals: "Seleccione Causa específica",
                    required: "Seleccione Causa específica",
                },
                nDocUsuario: {
                    required: "Ingrese N° de Documento",
                },
                DomUsuario: {
                    required: "Ingrese Domicilio",
                },
                emailUsuario: {
                    required: "Ingrese correo electrónico",
                },
                telefUsuario: {
                    required: "Ingrese N° de Telf. o Celular",
                },
                cajaFecha: {
                    required: "Ingrese fecha de ocurrencia",
                },
            },
            errorElement: "span",
            errorPlacement: function (error, element) {
                error.addClass("invalid-feedback");
                element.closest(".form-group").append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass("is-invalid");
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass("is-invalid");
            },
        });
    }
});
// LRV202203211541196c2ce2b824541d10644f1e50dc54960af5ffae38
// receivedDataPrmt("LRV202203211541196c2ce2b824541d10644f1e50dc54960af5ffae38")
// function receivedDataPrmt(prmtData) {
//     var datos = new FormData();
//     datos.append("codigoReclamo", prmtData);
//     $.ajax({
//         url: "public/views/src/ajaxEnvioEmail.php",
//         method: "POST",
//         data: datos,
//         cache: false,
//         contentType: false,
//         processData: false,
//         dataType: "json"
//     });
// }

// $("#btnEnviarReclamo").click(function (e) {
//     e.preventDefault();
//     var form = $("#formRegReclamo");
//     validacion = form.valid();
//     if (validacion == true) {
//         let timerInterval
//         Swal.fire({
//             title: 'Estamos procesando su reclamo!',
//             html: 'Su registro culminará en unos segundos.No cierre o recargue su navegador. Espere por favor...',
//             timer: 26000,
//             timerProgressBar: true,
//             didOpen: () => {
//                 Swal.showLoading()
//                 const b = Swal.getHtmlContainer().querySelector('b')
//                 timerInterval = setInterval(() => {
//                     b.textContent = Swal.getTimerLeft()
//                 }, 100)
//             },
//             willClose: () => {
//                 clearInterval(timerInterval)
//             }
//         }).then((result) => {
//             /* Read more about handling dismissals below */
//             if (result.dismiss === Swal.DismissReason.timer) {
//                 console.log('I was closed by the timer')
//             }
//         })
//         var data = $("#formRegReclamo").serialize();
//         $.ajax({
//             method: "POST",
//             url: "public/views/src/ajaxEnvioEmail.php",
//             data: data,
//             success: function (e) {
//                 console.log(e);
//               if (e == "1") {
//                 Swal.fire({
//                   icon: "success",
//                   title:
//                     "Se ha registrado su reclamo con éxito. Verifique el mensaje de confirmación en su correo electrónico.",
//                   showConfirmButton: false,
//                   timer: 1800,
//                 });
//                 function redirect() {
//                   window.location = "registro-reclamo";
//                 }
//                 setTimeout(redirect, 1800);
//                 // document.getElementById("formReclamo").reset();
//                 // $("#radiorep2").prop("checked", true);
//                 // $("#btnDNIUsuario").addClass("d-none");
//                 // $("#btnDNIRepresentante").addClass("d-none");
//                 // $("#btnRUCRepresentante").addClass("d-none");
//                 // $("#bloqueRep1").addClass("d-none");
//                 // $("#bloqueRep2").addClass("d-none");
//                 // $("#bloqueRep3").addClass("d-none");
//               } else {
//                 Swal.fire({
//                   type: "error",
//                   title:
//                     "Error al registrar, ingrese correctamente los datos de su reclamo. Aségurese de completar todos los campos requeridos",
//                   showConfirmButton: false,
//                   timer: 3000,
//                 });
//               }
//             },
//           });
//           return false;
//     }
//     else {
//         Swal.fire({
//             icon: "error",
//             title:
//                 "Error al registrar, ingrese correctamente los datos de su reclamo. Aségurese de completar todos los campos requeridos",
//             showConfirmButton: false,
//             timer: 1400,
//         });
//     }
// })
// Validador de Campos