document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');

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
            //alert(info.dateStr);
            $("#formModal").modal();
        }
    });

    calendar.render();
});
