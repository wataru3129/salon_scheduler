// const {
//     WEEKNumberRoot
// } = require("fullcalendar");
// const {
//     functionsIn
// } = require("lodash");

const WEEK = ['Sun', 'Mon', ' Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

const TODAY = new Date();


// 月末だとずれる可能性があるため、1日固定で取得
let showDate = new Date(TODAY.getFullYear(), TODAY.getMonth(), 1);

// 初期表示
window.onload = function () {
    showProcess(TODAY, calendar);
};
// 前の月表示
function prev() {
    showDate.setMonth(showDate.getMonth() - 1);
    showProcess(showDate);
}

// 次の月表示
function next() {
    showDate.setMonth(showDate.getMonth() + 1);
    showProcess(showDate);
}

// カレンダー表示
function showProcess(date) {
    let year = date.getFullYear();
    let month = date.getMonth();
    document.querySelector('#header').innerHTML = year + "年 " + (month + 1) + "月";

    let calendar = createProcess(year, month);
    document.querySelector('#calendar').innerHTML = calendar;
}

// カレンダー作成
function createProcess(year, month) {
    // 曜日
    let calendar = "<table><tr class='dayOfWeek'>";
    for (let i = 0; i < WEEK.length; i++) {
        calendar += "<th>" + WEEK[i] + "</th>";
    }
    calendar += "</tr>";

    let count = 0;
    let startDayOfWeek = new Date(year, month, 1).getDay();
    let endDate = new Date(year, month + 1, 0).getDate();
    let lastMonthEndDate = new Date(year, month, 0).getDate();
    let row = Math.ceil((startDayOfWeek + endDate) / WEEK.length);

    // 1行ずつ設定
    for (let i = 0; i < row; i++) {
        calendar += "<tr>";
        // 1colum単位で設定
        for (let j = 0; j < WEEK.length; j++) {
            if (i == 0 && j < startDayOfWeek) {
                // 1行目で1日まで先月の日付を設定
                calendar += "<td class='disabled'>" + (lastMonthEndDate - startDayOfWeek + j + 1) + "</td>";
            } else if (count >= endDate) {
                // 最終行で最終日以降、翌月の日付を設定
                count++;
                calendar += "<td class='disabled'>" + (count - endDate) + "</td>";
            } else {
                // 当月の日付を曜日に照らし合わせて設定
                count++;
                if (year == TODAY.getFullYear() &&
                    month == (TODAY.getMonth()) &&
                    count == TODAY.getDate()) {
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

let prevBtn = document.querySelector('#prev');
let nextBtn = document.querySelector('#next');
prevBtn.addEventListener('click', prev, false);
nextBtn.addEventListener('click', next, false);
