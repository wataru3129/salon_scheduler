// const {
//     WeekNumberRoot
// } = require("fullcalendar");
// const {
//     functionsIn
// } = require("lodash");

const WEEK = ['Sun', 'Mon', ' Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

const TODAY = new Date();

let showDate = new Date(TODAY.getFullYear(), TODAY.getMonth(), 1);
window.onload = function () {
    showProcess(TODAY, calendar);
}

function prev() {
    showDate.setMonth(showDate.getMonth() - 1);
    showProcess(showDate);
}

function next() {
    showDate.setMonth(showDate.getMonth() + 1);
    showProcess(showDate);
}

function showProcess(date) {
    let year = date.getFullYear();
    let month = date.getMonth();

    document.querySelector('#header').innerHTML = year + '年' + (month + 1) + '月';

    let calendar = createProcess(year, month);

    document.querySelector('#calendar').innerHTML = calendar;
}

function createProcess(year, month) {
    let calendar = '<table><tr class="dayOfWeek">';

    for (let i = 0; i < WEEK.length; i++) {
        calendar += '<th>' + WEEK[i] + '</th>';

    }
    calendar += '</tr>';

    let count = 0;
    let startDayOfWeek = new Date(year, month, 1).getDate();
    let endDate = new Date(year, month + 1, 0).getDate();

    let row = Math.ceil((startDayOfWeek + endDate) / WEEK.length);

    for (let i = 0; i < row; i++) {
        calendar += '<tr>';
        for (let j; j < WEEK.length; j++) {
            if (i === 0 && j < startDayOfWeek) {
                calendar += '<td class="disabled">' + (lastMonthEndDate - startDayOfWeek + j + 1) + '</td>';
            } else if (count >= endDate) {
                count++;
                if (year === TODAY.getFullYear() && month === (TODAY.getMonth()) && count === TODAY.getDate()) {
                    calendar += '<td class="today">' + count + '</td>';
                } else {
                    calendar += '<td>' + count + '</td>';
                }
            }
        }
        calendar += '</tr>'
    }
    return calendar;
}
