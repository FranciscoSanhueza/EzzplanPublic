//Propiedades de calendario
document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendarioWeb');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        locale: 'es',
        plugins: ['dayGrid', 'timeGrid', 'bootstrap', 'interaction'], // an array of strings!
        themeSystem: 'bootstrap',
        header: {
            left: 'today, prev,next',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        dateClick: function (info) {
            cargarModalI(info);
        },
        events: "/man",
        eventClick: function (info) {
            cargarModalE(info);
        }
    });

    calendar.render();
});

$('#btn_insert').click(function () {
    var datos = dataFormInsert();
    var route = $('#insForm').attr('action');
    var token = $('#_token').val();
    $.ajax({
        url: route,
        headers: {
            'X-CSRF-TOKEN': token
        },
        type: 'POST',
        dataType: 'json',
        data: datos,

        success: function (msj) {
            console.log(msj);
            toastM(1, msj.desc, msj.title);
            $("#insertModal").modal('toggle');
            limpiar();
        },
        error: function (error) {
            console.log(error);
            arrError = error.responseJSON.errors;
            for (var i in arrError) {
                toastM(2, arrError[i], "Error al Ingresar");
            }
        }
    });
});

function pasoSelect(desde, hasta) {
    var an = document.getElementById(desde);
    var nombre = an.options[an.selectedIndex].text;
    var valor = an.value;
    $("#" + desde).find("option[value='" + valor + "']").remove();
    $("#" + hasta).append('<option value="' + valor + '">' + nombre + '</option>');
}


function selecall() {
    var an = document.getElementById('nextFases');
    for (var i = 0; i < an.length; i++) {
        an.options[i].selected = true;
    }
    var bn = document.getElementById('nextEquipos');
    for (var i = 0; i < bn.length; i++) {
        bn.options[i].selected = true;
    }
    var cn = document.getElementById('nextTrabajadores');
    for (var i = 0; i < cn.length; i++) {
        cn.options[i].selected = true;
    }
    var dn = document.getElementById('nextInsumos');
    for (var i = 0; i < dn.length; i++) {
        dn.options[i].selected = true;
    }
}

function dataFormInsert() {
    selecall();
    var fases = $("#nextFases").val();
    var equipos = $("#nextEquipos").val();
    var trabajadores = $("#nextTrabajadores").val();
    var insumos = $("#nextInsumos").val();
    datos = {
        'title': $('#title').val(),
        'desc': $('#desc').val(),
        'start': $('#start').val(),
        'startH': $('#startH').val(),
        'end': $('#end').val(),
        'endH': $('#endH').val(),
        'fases': fases,
        'equipos': equipos,
        'trabajadores': trabajadores,
        'insumos': insumos,
        'prioridad': $('#prioridad').val(),
        'id': $('#responsable').val()
    }
    return datos;
}

function limpiar() {
    $('#title').val("");
    $('#desc').val("");
    $('#start').val("");
    $('#startH').val("");
    $('#end').val("");
    $('#endH').val("");
    $('#titleE').val("");
    $('#descE').val("");
    $('#startE').val("");
    $('#startHE').val("");
    $('#endE').val("");
    $('#endHE').val("");
}


//formato de fecha
function formatFecha(fecha) {
    fechaformat = fecha.getFullYear() + "-" + (fecha.getMonth() + 1) + "-" + fecha.getDate();
    return fechaformat;
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

//cargar modal para editar
function cargarModalE(info) {
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
    //mostrar modal
    $("#editModal").modal();
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


function toastM(tipo, desc, title) {
    if (tipo == 1) {
        toastr.success(desc, title, {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-bottom-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        });
    } else if (tipo == 2) {
        toastr.error(desc, title, {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-bottom-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        });
    }

}

document.getElementById("previusFases").addEventListener("change", function () {
    pasoSelect("previusFases", "nextFases");
});

document.getElementById("nextFases").addEventListener("change", function () {
    pasoSelect("nextFases", "previusFases");
});

document.getElementById("previusEquipos").addEventListener("change", function () {
    pasoSelect("previusEquipos", "nextEquipos");
});

document.getElementById("nextEquipos").addEventListener("change", function () {
    pasoSelect("nextEquipos", "previusEquipos");
});

document.getElementById("previusTrabajadores").addEventListener("change", function () {
    pasoSelect("previusTrabajadores", "nextTrabajadores");
});

document.getElementById("nextTrabajadores").addEventListener("change", function () {
    pasoSelect("nextTrabajadores", "previusTrabajadores");
});

document.getElementById("previusInsumos").addEventListener("change", function () {
    pasoSelect("previusInsumos", "nextInsumos");
});

document.getElementById("nextInsumos").addEventListener("change", function () {
    pasoSelect("nextInsumos", "previusInsumos");
});
