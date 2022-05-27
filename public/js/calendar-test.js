/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***************************************!*\
  !*** ./resources/js/calendar-test.js ***!
  \***************************************/
// const {
//     WEEKNumberRoot
// } = require("fullcalendar");
// const {
//     functionsIn
// } = require("lodash");
var WEEK = ['Sun', 'Mon', ' Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
var TODAY = new Date(); // 月末だとずれる可能性があるため、1日固定で取得

var showDate = new Date(TODAY.getFullYear(), TODAY.getMonth(), 1); // 初期表示

window.onload = function () {
  showProcess(TODAY, calendar);
}; // 前の月表示


function prev() {
  showDate.setMonth(showDate.getMonth() - 1);
  showProcess(showDate);
} // 次の月表示


function next() {
  showDate.setMonth(showDate.getMonth() + 1);
  showProcess(showDate);
} // カレンダー表示


function showProcess(date) {
  var year = date.getFullYear();
  var month = date.getMonth();
  document.querySelector('#header').innerHTML = year + "年 " + (month + 1) + "月";
  var calendar = createProcess(year, month);
  document.querySelector('#calendar').innerHTML = calendar;
} // カレンダー作成


function createProcess(year, month) {
  // 曜日
  var calendar = "<table><tr class='dayOfWeek'>";

  for (var i = 0; i < WEEK.length; i++) {
    calendar += "<th>" + WEEK[i] + "</th>";
  }

  calendar += "</tr>";
  var count = 0;
  var startDayOfWeek = new Date(year, month, 1).getDay();
  var endDate = new Date(year, month + 1, 0).getDate();
  var lastMonthEndDate = new Date(year, month, 0).getDate();
  var row = Math.ceil((startDayOfWeek + endDate) / WEEK.length); // 1行ずつ設定

  for (var _i = 0; _i < row; _i++) {
    calendar += "<tr>"; // 1colum単位で設定

    for (var j = 0; j < WEEK.length; j++) {
      if (_i == 0 && j < startDayOfWeek) {
        // 1行目で1日まで先月の日付を設定
        calendar += "<td class='disabled'>" + (lastMonthEndDate - startDayOfWeek + j + 1) + "</td>";
      } else if (count >= endDate) {
        // 最終行で最終日以降、翌月の日付を設定
        count++;
        calendar += "<td class='disabled'>" + (count - endDate) + "</td>";
      } else {
        // 当月の日付を曜日に照らし合わせて設定
        count++;

        if (year == TODAY.getFullYear() && month == TODAY.getMonth() && count == TODAY.getDate()) {
          calendar += "<td class='TODAY'>" + count + "</td>";
        } else {
          calendar += "<td>" + count + "</td>";
        }
      }
    }

    calendar += "</tr>";
  }

  return calendar;
}

var prevBtn = document.querySelector('#prev');
var nextBtn = document.querySelector('#next');
prevBtn.addEventListener('click', prev, false);
nextBtn.addEventListener('click', next, false);
/******/ })()
;