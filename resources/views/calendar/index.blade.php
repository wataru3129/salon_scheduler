<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-flash-message status="session('status')" />
                {{-- <x-jet-welcome /> --}}

                {{-- <div class="wrapper">
                    <!-- xxxx年xx月を表示 -->
                    <h3 id="header"></h3>

                    <!-- ボタンクリックで月移動 -->
                    <div id="next-prev-button">
                        <button id="prev">‹</button>
                        <button id="next">›</button>
                    </div>

                    <!-- カレンダー -->
                    <div id="calendar"></div>
                </div>

                <hr> --}}
                {{-- <script src="{{ mix('js/calendar-test.js') }}"></script> --}}



                @livewire('calendar')


            </div>
        </div>
    </div>
    <script src="{{ mix('js/flatpickr.js') }}"></script>
</x-app-layout>
