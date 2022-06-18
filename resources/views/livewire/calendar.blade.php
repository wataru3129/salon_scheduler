@push('css')
    <link href="{{ mix('css/calendar.css') }}" rel="stylesheet">
@endpush

<div class="pb-12 pt-4 px-5">
    <div id="calendar">
        <div id="header">
            <input id="date-picker" class="block mt-1 mx-auto mb-2" type="text" name="calendar"
                value="{{ $today }}" wire:change="getMonth($event.target.value)" />
            {{ $today }}

            <div id="next-prev-button">
                <button id="prev" wire:click="changeToLastMonth()">‹</button>
                <button id="next" wire:click="changeToNextMonth()">›</button>
            </div>
        </div>

        <!-- ボタンクリックで月移動 -->

        {{-- <table class="md:w-4/5"> --}}
        <table>
            <thead>
                <tr>
                    <th>日</th>
                    <th>月</th>
                    <th>火</th>
                    <th>水</th>
                    <th>木</th>
                    <th>金</th>
                    <th>土</th>
                </tr>
            </thead>

            @foreach ($month as $index => $week)
                <tr>
                    @for ($i = 0; $i < 7; $i++)
                        @if (($index == 0 && $month[$index][$i]['date'] > 7) || ($index == $numberOfWeeks - 1 && $month[$index][$i]['date'] < 22))
                            <x-calendar.date date="{{ $month[$index][$i]['date'] }}"
                                reservation="{{ $month[$index][$i]['checkReservation'] }}"
                                today="{{ $month[$index][$i]['today'] }}" month="notThisMonth"
                                dayoff="{{ $month[$index][$i]['dayOff'] }}" />
                        @else
                            <x-calendar.date date="{{ $month[$index][$i]['date'] }}"
                                reservation="{{ $month[$index][$i]['checkReservation'] }}"
                                today="{{ $month[$index][$i]['today'] }}" month="thisMonth"
                                dayoff="{{ $month[$index][$i]['dayOff'] }}" />
                        @endif
                    @endfor
                </tr>
            @endforeach
        </table>
    </div>
</div>
