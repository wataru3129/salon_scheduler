<div class="py-12 px-5">
    <div id="calendar">
        <h3 id="header">
            <input id="date-picker" class="block mt-1 mx-auto mb-2" type="text" name="calendar"
                value="{{ $today }}" wire:change="getMonth($event.target.value)" />
            {{ $today }}
        </h3>

        <!-- ボタンクリックで月移動 -->
        <div id="next-prev-button">
            <button id="prev" wire:click="changeToLastMonth()">‹</button>
            <button id="next" wire:click="changeToNextMonth()">›</button>
        </div>
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
                        @if (($index == 0 && $month[$index][$i] > 7) || ($index == $numberOfWeeks - 1 && $month[$index][$i] < 22))
                            <th class="text-slate-300">{{ $month[$index][$i] }}</th>
                        @else
                            <th>{{ $month[$index][$i] }}</th>
                        @endif
                    @endfor
                </tr>
            @endforeach
        </table>
    </div>
</div>
