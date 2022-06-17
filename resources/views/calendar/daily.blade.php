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
                        <div class="py-1 px-2 border border-gray-200 text-center">{{ $today }}</div>
                        <div class="py-1 px-2 border border-gray-200 text-center">{{ $dayOfWeek }}</div>
                        @for ($i = 0; $i < 65; $i++)
                            {{-- <div class="py-1 px-2 h-8 border border-gray-200">
                            {{ \Constant::RESERVATION_TIME[$i] }}
                            {{ $i }}
                        </div> --}}
                            {{-- @endfor --}}

                            {{-- @for ($j = 0; $j < 21; $j++) --}}

                            @if (!is_null($reservations->firstWhere('start_date', $today . ' ' . \Constant::RESERVATION_TIME[$i])))
                                @php
                                    
                                    $reservationId = $reservations->firstWhere('start_date', $today . ' ' . \Constant::RESERVATION_TIME[$i])->id;
                                    $reservationBy = $reservations->firstWhere('start_date', $today . ' ' . \Constant::RESERVATION_TIME[$i])->user->name;
                                    $reservationById = $reservations->firstWhere('start_date', $today . ' ' . \Constant::RESERVATION_TIME[$i])->user->id;
                                    $customerName = $reservations->firstWhere('start_date', $today . ' ' . \Constant::RESERVATION_TIME[$i])->customer->name;
                                    $reservationInfo = $reservations->firstWhere('start_date', $today . ' ' . \Constant::RESERVATION_TIME[$i]);
                                    $reservationPeriod = \Carbon\Carbon::parse($reservationInfo->start_date)->diffInMinutes($reservationInfo->end_date) / 10 - 3;
                                    
                                    // dd($maxPeople,$numberOfPeople,$reservationAvailable)
                                    if (!is_null($reservations->firstWhere('user_id', $myId))) {
                                        $bgColor = 'bg-blue-300';
                                    } else {
                                        $bgColor = 'bg-orange-200';
                                    }
                                    
                                @endphp
                                <div class="py-1 px-2 h-8 border border-gray-200 {{ $bgColor }}">
                                    {{ $reservationBy }}
                                </div>
                                <div class="py-1 px-2 h-8 border border-gray-200 {{ $bgColor }}">
                                    {{ $reservationInfo->startTime }}-{{ $reservationInfo->endTime }}
                                </div>
                                @if ($reservationById == $myId)
                                    <div class="py-1 px-2 h-8 border border-gray-200 {{ $bgColor }}">
                                        {{ $customerName }}
                                    </div>
                                    @php
                                        $reservationPeriod--;
                                    @endphp
                                @endif

                                @if ($reservationPeriod > 0)
                                    @for ($j = 0; $j < $reservationPeriod; $j++)
                                        <div class="py-1 px-2 h-8 border border-gray-200 {{ $bgColor }}">
                                        </div>
                                    @endfor
                                    @php
                                        $i = $reservationPeriod;
                                    @endphp
                                @endif
                            @else
                                <div class="py-1 px-2 h-8 border border-gray-200"></div>
                                {{-- <x-calendar.reservation-period is-my-reservation="{{ $isMyReservation }}"
                                    content="" /> --}}

                            @endif


                        @endfor

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ mix('js/flatpickr.js') }}"></script>
</x-app-layout>
