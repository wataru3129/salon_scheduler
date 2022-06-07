<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            予約詳細
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">



                <section class="text-gray-600 body-font relative">
                    <div class="container px-5 py-24 mx-auto">


                        <div class="md:w-2/3 mx-auto">
                            <x-jet-validation-errors class="mb-4" />
                            <x-flash-message status="session('status')" />
                            <form method="GET"
                                action="{{ route('reservations.edit', ['reservation' => $reservation->id]) }}">
                                <div class="-m-2">
                                    <div class="p-2 w-1/2">
                                        <div class="relative">
                                            <x-jet-label for="date" class="leading-7 text-sm text-gray-600"
                                                value="日付" />
                                            {{ $reservation->reservedDate }}
                                        </div>
                                    </div>
                                    <div class="p-2 w-1/2">
                                        <div class="relative">
                                            <x-jet-label for="start_time" class="leading-7 text-sm text-gray-600"
                                                value="開始時間" />
                                            {{ $reservation->startTime }}
                                        </div>
                                    </div>
                                    <div class="p-2 w-1/2">
                                        <div class="relative">
                                            <x-jet-label for="end_time" class="leading-7 text-sm text-gray-600"
                                                value="終了時間" />
                                            {{ $reservation->endTime }}
                                        </div>
                                    </div>
                                    <div class="p-2 w-1/2">
                                        <div class="relative">
                                            <x-jet-label for="customer_name" class="leading-7 text-sm text-gray-600"
                                                value="顧客名" />
                                            @if ($reservation->customer->name !== '設定なし')
                                                {{ $reservation->customer->name }}
                                            @endif
                                        </div>
                                    </div>
                                    <div class="p-2 w-full">
                                        <div class="relative">
                                            <x-jet-label for="content" class="leading-7 text-sm text-gray-600"
                                                value="内容" />
                                            {{ $reservation->content }}
                                        </div>
                                    </div>
                                    @if (\Carbon\Carbon::parse($reservation->start_date)->format('Y年m月d日') >= \Carbon\Carbon::today()->format('Y年m月d日'))
                                        <div class="p-2 flex w-full justify-center">


                                            <x-jet-button class="bg-indigo-500 hover:bg-indigo-600">
                                                修正する
                                            </x-jet-button>

                                        </div>
                                    @endif
                                    {{-- <button
                                        class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">
                                        新規追加</button> --}}
                                    {{-- <x-jet-button
                                            class="flex mx-auto border-0 py-2 px-8 focus:outline-none rounded text-lg">
                                            戻る</x-jet-button> --}}

                                </div>
                            </form>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
    <script src="{{ mix('js/flatpickr.js') }}"></script>
</x-app-layout>
