import { Calendar } from "fullcalendar";
import googleCalendarPlugin from '@fullcalendar/google-calendar';
import tippy from "tippy.js";
import 'tippy.js/dist/tippy.css';

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
        nowIndicator: true,
        headerToolbar: {
            left: 'dayGridMonth,timeGridWeek',
            center: 'title',
            right: 'today prev,next',
        },
        buttonText: {
            today: '今日',
            month: '月',
            week: '週',
        },
        allDayText: '終日',
        
        dayCellContent: function (arg) {
            return arg.date.getDate();
        },

        eventClick: function (arg) {
            window.open(arg.event.extendedProps.description);
            arg.jsEvent.preventDefault();
        },

        eventDidMount: function (arg) {
            tippy(
                arg.el,
                {
                    allowHTML: true,
                    content: '<p style="font-size:125%;">' + arg.event.title + '</p>',
                }
            );
        }
    });
    calendar.render();
});