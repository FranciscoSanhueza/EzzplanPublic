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
        events: "http://127.0.0.1:8000/man",
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

        success: function () {
            toastr.success('Mantencion ingresada Correctamente', 'Registrado', {
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
            $("#insertModal").modal('toggle');
            limpiar();
        }
    });
});



function dataFormInsert() {
    datos = {
        'title': $('#title').val(),
        'desc': $('#desc').val(),
        'start': $('#start').val(),
        'startH': $('#startH').val(),
        'end': $('#end').val(),
        'endH': $('#endH').val()
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
