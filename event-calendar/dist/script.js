// Initialize evo-calendar in your script file or an inline <script> tag
$(document).ready(function () {
    $('#calendar').evoCalendar({
        theme: 'Midnight Blue',
        firstDayOfWeek: 1,
        language: 'es',
        settingName: "hello",

        calendarEvents: [
            {
                id: 'mmnnn',
                name: 'new year',
                date: '01/01/2020',
                type: 'holiday',
                everyYear: true

            },
            {
                id: '0908',
                name: 'new year',
                date: 'January/1/2020',
                type: 'holiday',
                everyYear: true

            },
            {
                name: "Vacation Leave",
                badge: "02/13 - 02/15", // Event badge (optional)
                date: ["February/13/2020", "February/15/2020"], // Date range
                description: "Vacation leave for 3 days.", // Event description (optional)
                type: "event",
                color: "#63d867" // Event custom color (optional)
            }
        ]
    })
});