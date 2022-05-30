<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Livewire\Component;

class Calendar extends Component {

    public $date;
    public $today;
    public $month = [];
    // public $year;
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

        $this->settingMonth($this->firstDayOfMonth, $this->lastDayOfLastMonth, $this->lastDayOfMonth);

        $this->numberOfWeeks = count($this->month);

        // dd($this->month);
    }

    private function settingDate($date) {
        $this->today = $date->format('Y年m月');
        // dd($date);

        $this->currentMonth = $date->month;
        $this->firstDayOfMonth = $date->day(1)->dayOfWeek;
        $this->lastDayOfMonth = $date->daysInMonth;
        // dd($this->lastDayOfMonth, $date);
        $this->lastMonth = $date->subMonthNoOverflow();
        // dd($date, $this->lastMonth);
        $this->lastDayOfLastMonth = $this->lastMonth->daysInMonth;

        $this->nextMonth = $date->addMonth();
    }

    private function settingMonth($firstDayOfMonth, $lastDayOfLastMonth, $lastDayOfMonth) {
        if ($firstDayOfMonth !== 0) {
            $this->counter = $this->firstDayOfMonth;
            for ($i = 0; $i < $this->counter; $i++) {

                // array_push($this->week, $this->lastDayOfLastMonth - $this->counter + $i);
                // dd($this->lastDayOfLastMonth - $this->counter + $i);
                $this->week[] = $lastDayOfLastMonth - $this->counter + $i + 1;
            }
        }

        for ($i = 1; $i <= $lastDayOfMonth; $i++) {
            if ($this->counter < 6) {
                $this->week[] = $i;
                $this->counter++;

                if ($i == $this->lastDayOfMonth) {
                    for ($j = 1; $j < 7; $j++) {
                        $this->week[] = $j;
                        if ($this->counter == 6) {
                            $this->month[] = $this->week;
                        }
                        $this->counter++;
                    }
                }
            } else {
                $this->week[] = $i;
                $this->month[] = $this->week;
                $this->week = [];
                $this->counter = 0;
            }
        }
        return $this->month;
    }

    public function changeToNextMonth() {

        $this->month = [];
        $this->week = [];
        $this->counter = 0;

        $this->date = $this->date->day($this->date->daysInMonth)->addMonthNoOverflow();

        $this->settingDate($this->date);

        $this->settingMonth($this->firstDayOfMonth, $this->lastDayOfLastMonth, $this->lastDayOfMonth);

        $this->numberOfWeeks = count($this->month);
    }


    public function changeToLastMonth() {
        $this->month = [];
        $this->week = [];
        $this->counter = 0;

        $this->date = $this->date->day(1)->subMonthNoOverflow();

        $this->settingDate($this->date);

        $this->settingMonth($this->firstDayOfMonth, $this->lastDayOfLastMonth, $this->lastDayOfMonth);

        $this->numberOfWeeks = count($this->month);
    }


    public function render() {
        return view('livewire.calendar');
    }
}
