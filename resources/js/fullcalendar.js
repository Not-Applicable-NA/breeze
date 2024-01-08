import { Calendar } from "fullcalendar";
import googleCalendarPlugin from '@fullcalendar/google-calendar';

document.addEventListener('DOMContentLoaded', function() {
    let calendarEl = document.getElementById('calendar');
    let calendar = new Calendar(calendarEl, {
        plugins: [googleCalendarPlugin],
        googleCalendarApiKey: calendarApiKey,
        initialView: 'dayGridMonth',
        locale: 'ja',
        events: {
            googleCalendarId: calendarId
        },
        dayCellContent: function (arg) {
            return arg.date.getDate();
        }
    });
    calendar.render();
});