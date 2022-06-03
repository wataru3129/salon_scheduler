<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            予約一覧
        </h2>
    </x-slot>

    {{-- <link href="main.css" rel="{{ mix('css/clandar.css') }}"> --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <section class="text-gray-600 body-font relative">
                    <div class="container px-5 py-24 mx-auto">
                        <div class="mx-auto">
                            <x-flash-message status="session('status')" />
                            <section class="text-gray-600 body-font">
                                <div class="container px-5 py-24 mx-auto">
                                    <div class="flex flex-col text-center w-full mb-20">
                                        <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2 text-gray-900">
                                            Pricing</h1>
                                        <p class="lg:w-2/3 mx-auto leading-relaxed text-base">Banh mi cornhole echo
                                            park skateboard authentic
                                            crucifix neutra tilde lyft biodiesel artisan direct trade mumblecore 3
                                            wolf moon twee</p>
                                    </div>
                                    <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                                        <table class="table-auto w-full text-left whitespace-no-wrap">
                                            <thead>
                                                <tr>
                                                    <th
                                                        class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">
                                                        日付</th>
                                                    <th
                                                        class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                        開始時間</th>
                                                    <th
                                                        class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                        終了時間</th>
                                                    <th
                                                        class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                        顧客名</th>
                                                    <th
                                                        class="w-10 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br">
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($reservations as $reservation)
                                                    <tr>
                                                        <td class="px-4 py-3">{{ $reservation->reservedDate }}
                                                        </td>
                                                        <td class="px-4 py-3">{{ $reservation->start_time }}</td>
                                                        <td class="px-4 py-3">{{ $reservation->end_time }}</td>
                                                        <td class="px-4 py-3">
                                                            {{ $reservation->customer->name }}</td>
                                                        <td class="w-10 text-center">
                                                            <input name="plan" type="radio">
                                                        </td>
                                                    </tr>
                                                @endforeach


                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="flex pl-4 mt-4 lg:w-2/3 w-full mx-auto">
                                        <a class="text-indigo-500 inline-flex items-center md:mb-2 lg:mb-0">Learn
                                            More
                                            <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2"
                                                viewBox="0 0 24 24">
                                                <path d="M5 12h14M12 5l7 7-7 7"></path>
                                            </svg>
                                        </a>
                                        <button
                                            class="flex ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">Button</button>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
    {{-- <script src="{{ mix('js/flatpickr.js') }}"></script> --}}
</x-app-layout>
