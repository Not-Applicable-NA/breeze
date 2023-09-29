import { Calendar } from "fullcalendar";

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new Calendar(calendarEl, {
        initialView: 'dayGridMonth'
    });
    calendar.render();
});