<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            予約カレンダー
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg flex justify-center">
                <x-flash-message status="session('status')" />
                <div class="flex md:w-2/3 justify-center my-8">
                    <x-calendar.calendar-time />
                    <div class="w-2/3">
                        <div class="py-1 px-2 border border-gray-200 text-center">{{ $todayForView }}</div>
                        <div class="py-1 px-2 border border-gray-200 text-center">{{ $dayOfWeek }}</div>
                        @for ($i = 0; $i < 67; $i++)
                            @if (in_array(\Constant::RESERVATION_TIME[$i], $isReservationTime))
                                @php
                                    $reservation = $reservationInfo[\Constant::RESERVATION_TIME[$i]];
                                    $counter = $reservation['reservationPeriod'];
                                    $i += $counter;
                                    
                                @endphp
                                <div class="py-1 px-2 h-8 border border-gray-200 {{ $reservation['bgColor'] }}">
                                    {{ $reservation['start_time'] }}-{{ $reservation['end_time'] }}
                                </div>
                                <div class="py-1 px-2 h-8 border border-gray-200 {{ $reservation['bgColor'] }}">
                                    {{ $reservation['user'] }}
                                </div>


                                @php
                                    $counter--;
                                @endphp
                                @if ($reservation['isMyReservation'])
                                    <div class="py-1 px-2 h-8 border border-gray-200 {{ $reservation['bgColor'] }}">
                                        {{ $reservation['customer'] }}
                                    </div>
                                    <div class="py-1 px-2 h-8 border border-gray-200 {{ $reservation['bgColor'] }}">
                                        <a
                                            href="{{ route('reservations.show', ['reservation' => $reservation['id']]) }}">
                                            予約詳細
                                        </a>
                                    </div>
                                    @php
                                        $counter -= 2;
                                    @endphp
                                @endif

                                @for ($j = 0; $j < $counter; $j++)
                                    <div class="py-1 px-2 h-8 border border-gray-200 {{ $reservation['bgColor'] }}">
                                    </div>
                                @endfor
                            @else
                                <div class="py-1 px-2 h-8 border border-gray-200">
                                    {{ \Constant::RESERVATION_TIME[$i] }}
                                </div>
                            @endif
                        @endfor

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ mix('js/flatpickr.js') }}"></script>
</x-app-layout>
