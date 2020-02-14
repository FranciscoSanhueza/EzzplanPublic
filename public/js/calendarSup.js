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
