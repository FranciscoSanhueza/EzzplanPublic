//Propiedades de calendario
document.addEventListener("DOMContentLoaded", function () {
    cargarCalendario();
});

function cargarCalendario() {
    var calendarEl = document.getElementById("calendarioWeb");
    var calendar = new FullCalendar.Calendar(calendarEl, {
        locale: "es",
        plugins: ["dayGrid", "timeGrid", "bootstrap", "interaction"], // an array of strings!
        themeSystem: "bootstrap",
        header: {
            left: "today, prev,next",
            center: "title",
            right: "dayGridMonth,timeGridWeek,timeGridDay"
        },
        dateClick: function (info) {
            if (compararFechaAct(info.date)) {
                alertaInsert(info);
            } else {
                toastM(
                    2,
                    "No es posible registrar mantenciones en fechas anteriores a la actual",
                    "Error"
                );
            }
        },
        events: "/man",
        eventClick: function (info) {
            resetcamposSelect("previusFasesE", "nextFasesE");
            resetcamposSelect("previusEquiposE", "nextEquiposE");
            resetcamposSelect("previusTrabajadoresE", "nextTrabajadoresE");
            resetcamposSelect("previusInsumosE", "nextInsumosE");
            vermas(info.event.id);
            cargarCoreDataModalE(info);
        }
    });

    calendar.render();
}

function vermas(id) {
    var route = "/mantenciones/" + id;
    $.ajax({
        url: route,
        type: "GET",
        dataType: "json",
        success: function (msj) {
            cargarModalExtendData(msj.core);
        },
        error: function (error) {
            console.log(error);
        }
    });
}

$("#btn_insert").click(function () {
    var datos = dataFormInsert();
    var route = window.location;
    var token = $("#_token").val();
    $.ajax({
        url: route,
        headers: {
            "X-CSRF-TOKEN": token
        },
        type: "POST",
        dataType: "json",
        data: datos,

        success: function (msj) {
            toastM(msj.tipo, msj.desc, msj.title);
            $("#insertModal").modal("toggle");
            $("#calendarioWeb").empty();
            cargarCalendario();
            resetcamposSelect("previusFases", "nextFases");
            resetcamposSelect("previusEquipos", "nextEquipos");
            resetcamposSelect("previusTrabajadores", "nextTrabajadores");
            resetcamposSelect("previusInsumos", "nextInsumos");
            limpiar();
        },
        error: function (error) {
            arrError = error.responseJSON.errors;
            for (var i in arrError) {
                toastM(2, arrError[i], "Error al Ingresar");
            }
        }
    });
});

$("#edit_btn").click(function (e) {
    var datos = dataFormEdit();
    var route = window.location + "/" + $("#_id").val();
    var token = $("#_tokenE").val();
    $.ajax({
        url: route,
        headers: {
            "X-CSRF-TOKEN": token
        },
        type: "PUT",
        dataType: "json",
        data: datos,

        success: function (msj) {
            toastM(msj.tipo, msj.desc, msj.title);
            $("#editModal").modal("toggle");
            $("#calendarioWeb").empty();
            cargarCalendario();
            resetcamposSelect("previusFasesE", "nextFasesE");
            resetcamposSelect("previusEquiposE", "nextEquiposE");
            resetcamposSelect("previusTrabajadoresE", "nextTrabajadoresE");
            resetcamposSelect("previusInsumosE", "nextInsumosE");
            limpiar();
        },
        error: function (error) {
            arrError = error.responseJSON.errors;
            for (var i in arrError) {
                toastM(2, arrError[i], "Error al Editar");
            }
        }
    });
});

$("#delete_btn").click(function () {
    var datos = dataFormInsert();
    var route = window.location + "/" + $("#_id").val();
    var token = $("#_token").val();
    $.ajax({
        url: route,
        headers: {
            "X-CSRF-TOKEN": token
        },
        type: "DELETE",
        dataType: "json",
        data: datos,

        success: function (msj) {
            toastM(1, msj.desc, msj.title);
            $("#editModal").modal("toggle");
            $("#calendarioWeb").empty();
            cargarCalendario();
            resetcamposSelect("previusFasesE", "nextFasesE");
            resetcamposSelect("previusEquiposE", "nextEquiposE");
            resetcamposSelect("previusTrabajadoresE", "nextTrabajadoresE");
            resetcamposSelect("previusInsumosE", "nextInsumosE");
            limpiar();
        },
        error: function (error) {
            arrError = error.responseJSON.errors;
            for (var i in arrError) {
                toastM(2, arrError[i], "Error al Eliminar");
            }
        }
    });
});

function pasoSelect(desde, hasta) {
    var an = document.getElementById(desde);
    var nombre = an.options[an.selectedIndex].text;
    var valor = an.value;
    $("#" + desde)
        .find("option[value='" + valor + "']")
        .remove();
    $("#" + hasta).append(
        '<option value="' + valor + '">' + nombre + "</option>"
    );
}

function selecall() {
    var an = document.getElementById("nextFases");
    for (var i = 0; i < an.length; i++) {
        an.options[i].selected = true;
    }
    var bn = document.getElementById("nextEquipos");
    for (var i = 0; i < bn.length; i++) {
        bn.options[i].selected = true;
    }
    var cn = document.getElementById("nextTrabajadores");
    for (var i = 0; i < cn.length; i++) {
        cn.options[i].selected = true;
    }
    var dn = document.getElementById("nextInsumos");
    for (var i = 0; i < dn.length; i++) {
        dn.options[i].selected = true;
    }
    var an = document.getElementById("nextFasesE");
    for (var i = 0; i < an.length; i++) {
        an.options[i].selected = true;
    }
    var bn = document.getElementById("nextEquiposE");
    for (var i = 0; i < bn.length; i++) {
        bn.options[i].selected = true;
    }
    var cn = document.getElementById("nextTrabajadoresE");
    for (var i = 0; i < cn.length; i++) {
        cn.options[i].selected = true;
    }
    var dn = document.getElementById("nextInsumosE");
    for (var i = 0; i < dn.length; i++) {
        dn.options[i].selected = true;
    }
}

function dataFormInsert() {
    selecall();
    var cantidad;
    var salto;
    var fases = $("#nextFases").val();
    var equipos = $("#nextEquipos").val();
    var trabajadores = $("#nextTrabajadores").val();
    var insumos = $("#nextInsumos").val();
    if ($(optionAuto).is(":visible")) {
        cantidad = $("#cantidad").val();
        salto = $("#cicloT").val();
        datos = {
            title: $("#title").val(),
            desc: $("#desc").val(),
            start: $("#start").val(),
            startH: $("#startH").val(),
            end: $("#end").val(),
            endH: $("#endH").val(),
            salto: salto,
            cantidad: cantidad,
            fases: fases,
            equipos: equipos,
            trabajadores: trabajadores,
            insumos: insumos,
            prioridad: $("#prioridad").val(),
            id: $("#responsable").val()
        };
    } else {
        datos = {
            title: $("#title").val(),
            desc: $("#desc").val(),
            start: $("#start").val(),
            startH: $("#startH").val(),
            end: $("#end").val(),
            endH: $("#endH").val(),
            fases: fases,
            equipos: equipos,
            trabajadores: trabajadores,
            insumos: insumos,
            prioridad: $("#prioridad").val(),
            id: $("#responsable").val()
        };
    }

    return datos;
}

function dataFormEdit() {
    selecall();
    var fases = $("#nextFasesE").val();
    var equipos = $("#nextEquiposE").val();
    var trabajadores = $("#nextTrabajadoresE").val();
    var insumos = $("#nextInsumosE").val();
    datos = {
        _id: $("#_id").val(),
        title: $("#titleE").val(),
        desc: $("#descE").val(),
        start: $("#startE").val(),
        startH: $("#startHE").val(),
        end: $("#endE").val(),
        endH: $("#endHE").val(),
        fases: fases,
        equipos: equipos,
        trabajadores: trabajadores,
        insumos: insumos,
        prioridad: $("#prioridadE").val(),
        id: $("#responsableE").val()
    };
    return datos;
}

function limpiar() {
    $("#title").val("");
    $("#desc").val("");
    $("#start").val("");
    $("#startH").val("");
    $("#end").val("");
    $("#endH").val("");
    $("#titleE").val("");
    $("#descE").val("");
    $("#startE").val("");
    $("#startHE").val("");
    $("#endE").val("");
    $("#endHE").val("");
}

//formato de fecha
function formatFecha(fecha) {
    año = fecha.getFullYear();
    mes = fecha.getMonth() + 1;
    if (fecha.getDate() < 10) {
        dia = "0" + fecha.getDate();
    } else {
        dia = fecha.getDate();
    }
    fechaformat = año + "-" + mes + "-" + dia;
    return fechaformat;
}

function compararFechaAct(fecha) {
    var fechaAct = new Date();
    if (fechaAct < fecha) {
        return true;
    } else {
        return false;
    }
}

//formato de hora
function formatHora(hora) {
    if (hora.getMinutes() < 10 && hora.getHours() < 10) {
        horaFormar = "0" + hora.getHours() + ":0" + hora.getMinutes();
    } else {
        if (hora.getHours() < 10) {
            horaFormar = "0" + hora.getHours() + ":" + hora.getMinutes();
        } else {
            horaFormar = hora.getHours() + ":0" + hora.getMinutes();
        }
    }
    return horaFormar;
}

function cargarModalExtendData(array) {
    OrdenarCamposEdit(array.fases, "previusFasesE", "nextFasesE");
    OrdenarCamposEdit(array.equipos, "previusEquiposE", "nextEquiposE");
    OrdenarCamposEdit(
        array.trabajadores,
        "previusTrabajadoresE",
        "nextTrabajadoresE"
    );
    OrdenarCamposEdit(array.insumos, "previusInsumosE", "nextInsumosE");
    /*  var an = document.getElementById(desde);
     var nombre = an.options[an.selectedIndex].text;
     var valor = an.value;
     $("#" + hasta).append('<option value="' + valor + '">' + nombre + '</option>'); */
    //mostrar modal
    $("#editModal").modal();
}

//cargar modal para editar
function cargarCoreDataModalE(info) {
    $("#_id").val(info.event.id);
    //datos
    $("#titleE").val(info.event.title);
    $("#descE").val(info.event.extendedProps.desc);
    //fecha inicio
    fecha = info.event.start;
    fechai = formatFecha(fecha);
    horai = formatHora(fecha);
    $("#startE").val(fechai);
    $("#startHE").val(horai);
    //fecha final
    fecha = info.event.end;
    fechaf = formatFecha(fecha);
    horaf = formatHora(fecha);
    $("#endE").val(fechaf);
    $("#endHE").val(horaf);
    //planificador
    responsable = info.event.extendedProps.responsable_id;
    $("#responsableE option[value=" + responsable + "]").attr("selected", true);
    //prioridad
    prioridad = info.event.extendedProps.prioridad_id;
    $("#prioridadE option[value=" + prioridad + "]").attr("selected", true);
}

//cargar modal para eliminar
function cargarModalI(info) {
    //fecha inicio
    $("#start").val(info.dateStr);
    $("#startH").val("08:00");
    //fecha final la misma inicial
    $("#end").val(info.dateStr);
    $("#endH").val("20:00");
    //mostrar modal
    $("#insertModal").modal();
}

function OrdenarCamposEdit(arr, fueraS, dentroS) {
    var fuera = document.getElementById(fueraS);
    var dentro = document.getElementById(dentroS);
    var fases = arr;
    for (var i = 0; i < fases.length; i++) {
        for (var x = 0; x < fuera.length; x++) {
            if (fases[i].id == fuera.options[x].value) {
                fuera.options[x].remove();
                var opt = document.createElement("option");
                opt.value = fases[i].id;
                if (fases[i].apellido) {
                    opt.innerHTML = fases[i].nombre + " " + fases[i].apellido;
                } else {
                    opt.innerHTML = fases[i].nombre;
                }
                dentro.append(opt);
            }
        }
    }
}

function resetcamposSelect(fueraS, dentroS) {
    var fuera = document.getElementById(fueraS);
    var dentro = document.getElementById(dentroS);
    for (var i = 0; i < dentro.length; i++) {
        var opt = document.createElement("option");
        opt.value = dentro.options[i].value;
        opt.text = dentro.options[i].text;
        fuera.append(opt);
        dentro.options[i].remove();
    }
}

function toastM(tipo, desc, title) {
    if (tipo == 1) {
        toastr.success(desc, title, {
            closeButton: true,
            debug: false,
            newestOnTop: false,
            progressBar: true,
            positionClass: "toast-bottom-right",
            preventDuplicates: false,
            onclick: null,
            showDuration: "300",
            hideDuration: "5000",
            timeOut: "5000",
            extendedTimeOut: "5000",
            showEasing: "swing",
            hideEasing: "linear",
            showMethod: "fadeIn",
            hideMethod: "fadeOut"
        });
    } else if (tipo == 2) {
        toastr.error(desc, title, {
            closeButton: true,
            debug: false,
            newestOnTop: false,
            progressBar: true,
            positionClass: "toast-bottom-right",
            preventDuplicates: false,
            onclick: null,
            showDuration: "300",
            hideDuration: "5000",
            timeOut: "5000",
            extendedTimeOut: "5000",
            showEasing: "swing",
            hideEasing: "linear",
            showMethod: "fadeIn",
            hideMethod: "fadeOut"
        });
    }
}

function alertaInsert(info) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    })

    swalWithBootstrapButtons.fire({
        title: '<strong>Tipo de mantencion a ingresar</strong>',
        html: "<strong>Selecciona el tipo de mantencion a ingresar:</strong>" +
            "<label>Unica: Solo se realizara una vez o sera planificada manualmente\n</label>" +
            "<label>Periodica: Se definira un intervalo de tiempo para ser programada automaticamente (Por un año)</label>",
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: '<div class="col-md-2"><label>Unica</label></div>',
        cancelButtonText: '<div class="col-md-2"><label>Periodica</label></div>',
        reverseButtons: true,
        icon: "question"
    }).then((result) => {
        if (result.value) {
            $('#optionAuto').hide();
            cargarModalI(info);
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            $('#optionAuto').show();
            cargarModalI(info);
        }
    });
}

document.getElementById("previusFases").addEventListener("change", function () {
    pasoSelect("previusFases", "nextFases");
});

document.getElementById("nextFases").addEventListener("change", function () {
    pasoSelect("nextFases", "previusFases");
});

document
    .getElementById("previusEquipos")
    .addEventListener("change", function () {
        pasoSelect("previusEquipos", "nextEquipos");
    });

document.getElementById("nextEquipos").addEventListener("change", function () {
    pasoSelect("nextEquipos", "previusEquipos");
});

document
    .getElementById("previusTrabajadores")
    .addEventListener("change", function () {
        pasoSelect("previusTrabajadores", "nextTrabajadores");
    });

document
    .getElementById("nextTrabajadores")
    .addEventListener("change", function () {
        pasoSelect("nextTrabajadores", "previusTrabajadores");
    });

document
    .getElementById("previusInsumos")
    .addEventListener("change", function () {
        pasoSelect("previusInsumos", "nextInsumos");
    });

document.getElementById("nextInsumos").addEventListener("change", function () {
    pasoSelect("nextInsumos", "previusInsumos");
});

document.getElementById("previusFasesE").addEventListener("change", function () {
    pasoSelect("previusFasesE", "nextFasesE");
});

document.getElementById("nextFasesE").addEventListener("change", function () {
    pasoSelect("nextFasesE", "previusFasesE");
});

document
    .getElementById("previusEquiposE")
    .addEventListener("change", function () {
        pasoSelect("previusEquiposE", "nextEquiposE");
    });

document.getElementById("nextEquiposE").addEventListener("change", function () {
    pasoSelect("nextEquiposE", "previusEquiposE");
});

document
    .getElementById("previusTrabajadoresE")
    .addEventListener("change", function () {
        pasoSelect("previusTrabajadoresE", "nextTrabajadoresE");
    });

document
    .getElementById("nextTrabajadoresE")
    .addEventListener("change", function () {
        pasoSelect("nextTrabajadoresE", "previusTrabajadoresE");
    });

document
    .getElementById("previusInsumosE")
    .addEventListener("change", function () {
        pasoSelect("previusInsumosE", "nextInsumosE");
    });

document.getElementById("nextInsumosE").addEventListener("change", function () {
    pasoSelect("nextInsumosE", "previusInsumosE");
});
