import { Calendar } from "fullcalendar";

document.addEventListener('DOMContentLoaded', function() {
    let calendarEl = document.getElementById('calendar');
    let calendar = new Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'ja',
        dayCellContent: function (arg) {
            return arg.date.getDate();
        }
    });
    calendar.render();
});