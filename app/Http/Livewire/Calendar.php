<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Livewire\Component;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class Calendar extends Component {

    public $date;
    public $today;
    public $day = [];
    public $month = [];
    public $year;
    public $firstDayOfMonth;
    public $lastDayOfMonth;
    public $numberOfWeeks;
    public $currentMonth;
    public $lastMonth;
    public $lastDayOfLastMonth;
    public $nextMonth;

    private $counter;
    private $week = [];

    public function mount() {

        $this->date = new CarbonImmutable;
        // $this->date = $this->date->day(1)->month(1);
        // $this->today = $this->date->format('Y年m月');
        // // dd($this->date);

        // $this->currentMonth = $this->date->month;
        // $this->firstDayOfMonth = $this->date->day(1)->dayOfWeek;
        // $this->lastDayOfMonth = $this->date->daysInMonth;
        // // dd($this->lastDayOfMonth, $this->date);
        // $this->lastMonth = $this->date->subMonthNoOverflow();
        // // dd($this->date, $this->lastMonth);
        // $this->lastDayOfLastMonth = $this->lastMonth->daysInMonth;

        // $this->nextMonth = $this->date->addMonth();

        $this->settingDate($this->date);

        $this->settingMonth($this->firstDayOfMonth, $this->lastDayOfLastMonth, $this->lastDayOfMonth, $this->year);

        $this->numberOfWeeks = count($this->month);

        // dd($this->month);
    }

    private function settingDate($date) {
        $this->today = $date->format('Y年m月');
        // dd($date);
        $this->year = $date->year;
        $this->currentMonth = $date->month;
        $this->firstDayOfMonth = $date->day(1)->dayOfWeek;
        $this->lastDayOfMonth = $date->daysInMonth;
        // dd($this->lastDayOfMonth, $date);
        $this->lastMonth = $date->subMonthNoOverflow();
        // dd($date, $this->lastMonth);
        $this->lastDayOfLastMonth = $this->lastMonth->daysInMonth;

        $this->nextMonth = $date->addMonth();
    }

    private function settingMonth($firstDayOfMonth, $lastDayOfLastMonth, $lastDayOfMonth, $year) {
        if ($firstDayOfMonth !== 0) {
            $this->counter = $this->firstDayOfMonth;
            for ($i = 0; $i < $this->counter; $i++) {
                // 前月の日付を追加

                $checkDay = $lastDayOfLastMonth - $this->counter + $i + 1;

                $day = Carbon::createFromDate($year, $this->lastMonth->month, $checkDay)->format('Y-m-d');

                $check = $this->checkReservation($day);

                $setDay = $this->setDay($day, $check);
                // dd($setDay);
                // array_push($this->week, $this->lastDayOfLastMonth - $this->counter + $i);
                // dd($this->lastDayOfLastMonth - $this->counter + $i);

                $this->week[] = $setDay;
            }
        }

        for ($i = 1; $i <= $lastDayOfMonth; $i++) {
            if ($this->counter < 6) {
                $day = Carbon::createFromDate($year, $this->currentMonth, $i)->format('Y-m-d');
                $check = $this->checkReservation($day);
                $setDay = $this->setDay($day, $check);
                // dd($setDay);
                $this->week[] = $setDay;
                $this->counter++;

                if ($i == $this->lastDayOfMonth) {
                    for ($j = 1; $j < 7; $j++) {
                        //来月の日にちを埋める
                        $day = Carbon::createFromDate($year, $this->nextMonth->month, $j)->format('Y-m-d');
                        // dd($day);
                        $check = $this->checkReservation($day);
                        $setDay = $this->setDay($day, $check);
                        // dd($setDay);
                        $this->week[] = $setDay;
                        if ($this->counter == 6) {
                            $this->month[] = $this->week;
                        }
                        $this->counter++;
                    }
                }
            } else {
                $day = Carbon::createFromDate($year, $this->currentMonth, $i)->format('Y-m-d');
                $check = $this->checkReservation($day);
                $setDay = $this->setDay($day, $check);
                // dd($setDay);
                $this->week[] = $setDay;
                $this->month[] = $this->week;
                $this->week = [];
                $this->counter = 0;
            }
        }
        // dd($this->month);
        return $this->month;
    }

    public function changeToNextMonth() {

        $this->month = [];
        $this->week = [];
        $this->counter = 0;

        $this->date = $this->date->day($this->date->daysInMonth)->addMonthNoOverflow();
        $year = $this->date->year;

        $this->settingDate($this->date);

        $this->settingMonth($this->firstDayOfMonth, $this->lastDayOfLastMonth, $this->lastDayOfMonth, $year);

        $this->numberOfWeeks = count($this->month);
    }


    public function changeToLastMonth() {
        $this->month = [];
        $this->week = [];
        $this->counter = 0;

        $this->date = $this->date->day(1)->subMonthNoOverflow();
        $year = $this->date->year;

        $this->settingDate($this->date);

        $this->settingMonth($this->firstDayOfMonth, $this->lastDayOfLastMonth, $this->lastDayOfMonth, $year);

        $this->numberOfWeeks = count($this->month);
    }

    public function getMonth($month) {



        $this->month = [];
        $this->week = [];
        $this->counter = 0;

        $this->date = new CarbonImmutable($month);
        $year = $this->date->year;


        $this->settingDate($this->date);

        $this->settingMonth($this->firstDayOfMonth, $this->lastDayOfLastMonth, $this->lastDayOfMonth, $year);

        $this->numberOfWeeks = count($this->month);
    }


    public function render() {
        return view('livewire.calendar');
    }

    private function checkReservation($date) {
        // $checkReservation = DB::table('reservations')
        //     ->whereDate('start_date', '=', $date)
        //     ->exists();

        $checkReservation = Reservation::whereDate('start_date', '=', $date)
            ->exists();

        // $checkOwnReservation = DB::table('reservations')
        //     ->where('user_id', '=', Auth::id())
        //     ->whereDate('start_date', '=', $date)
        //     ->exists();

        $checkOwnReservation = Reservation::where('user_id', '=', Auth::id())
            ->whereDate('start_date', '=', $date)
            ->exists();

        if ($checkOwnReservation) {
            return 1;
            //自分の予約がある
        } elseif ($checkOwnReservation == false && $checkReservation) {
            return 2;
            //他人の予約のみある
        } else {
            return 0;
            //予約が無い
        }
    }

    private function setDay($day, $checkReservation) {

        $today = new Carbon($day);

        $dayOfWeek = dayOfWeekJapanese($today->format('Y-m-d'));


        return [
            'date' => $today->day,
            'dayOfWeek' => $dayOfWeek,
            'checkReservation' => $checkReservation,
            'today' => $day,
        ];
    }
}
