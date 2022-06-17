import flatpickr from 'flatpickr';
import monthSelectPlugin from 'flatpickr/dist/plugins/monthSelect/index';


import {
    Japanese
} from 'flatpickr/dist/l10n/ja.js';

const setting_for_month = {
    'locale': Japanese,
    'plugins': [new monthSelectPlugin({
        // 'altFormat': 'Y年-f',
        'dateFormat': 'Y-m',
    })],
    // 'minDate': 'today',
    // maxDate: new Date().fp_incr(30),
}

const setting_for_date = {
    "locale": Japanese,
    // 'minDate': 'today',
    // maxDate: new Date().fp_incr(30),
}

const setting_for_time = {
    'locale': Japanese,
    enableTime: true,
    noCalendar: true,
    dateFormat: 'H:i',
    time_24hr: true,
    minTime: '9:00',
    maxTime: '20:00',
    minuteIncrement: 10,
}


flatpickr('#date-picker', setting_for_month);
flatpickr('#date', setting_for_date);
flatpickr('#start_time', setting_for_time);
flatpickr('#end_time', setting_for_time);
