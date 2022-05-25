/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***************************************!*\
  !*** ./resources/js/calendar-test.js ***!
  \***************************************/
// const {
//     WeekNumberRoot
// } = require("fullcalendar");
// const {
//     functionsIn
// } = require("lodash");
var WEEK = ['Sun', 'Mon', ' Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
var TODAY = new Date();
var showDate = new Date(TODAY.getFullYear(), TODAY.getMonth(), 1);

window.onload = function () {
  showProcess(TODAY, calendar);
};

function prev() {
  showDate.setMonth(showDate.getMonth() - 1);
  showProcess(showDate);
}

function next() {
  showDate.setMonth(showDate.getMonth() + 1);
  showProcess(showDate);
}

function showProcess(date) {
  var year = date.getFullYear();
  var month = date.getMonth();
  document.querySelector('#header').innerHTML = year + '年' + (month + 1) + '月';
  var calendar = createProcess(year, month);
  document.querySelector('#calendar').innerHTML = calendar;
}

function createProcess(year, month) {
  var calendar = '<table><tr class="dayOfWeek">';

  for (var i = 0; i < WEEK.length; i++) {
    calendar += '<th>' + WEEK[i] + '</th>';
  }

  calendar += '</tr>';
  var count = 0;
  var startDayOfWeek = new Date(year, month, 1).getDate();
  var endDate = new Date(year, month + 1, 0).getDate();
  var row = Math.ceil((startDayOfWeek + endDate) / WEEK.length);

  for (var _i = 0; _i < row; _i++) {
    calendar += '<tr>';

    for (var j; j < WEEK.length; j++) {
      if (_i === 0 && j < startDayOfWeek) {
        calendar += '<td class="disabled">' + (lastMonthEndDate - startDayOfWeek + j + 1) + '</td>';
      } else if (count >= endDate) {
        count++;

        if (year === TODAY.getFullYear() && month === TODAY.getMonth() && count === TODAY.getDate()) {
          calendar += '<td class="today">' + count + '</td>';
        } else {
          calendar += '<td>' + count + '</td>';
        }
      }
    }

    calendar += '</tr>';
  }

  return calendar;
}
/******/ })()
;