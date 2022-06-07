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
                    <div class="mx-auto">
                        <x-flash-message status="session('status')" />
                        <section class="text-gray-600 body-font">
                            <div class="container px-5 py-24 mx-auto">
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
                                                    class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br">
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($reservations as $reservation)
                                                <tr>
                                                    <td class="px-4 py-3">{{ $reservation->reservedDate }}
                                                    </td>
                                                    <td class="px-4 py-3">{{ $reservation->startTime }}</td>
                                                    <td class="px-4 py-3">{{ $reservation->endTime }}</td>
                                                    <td class="px-4 py-3">
                                                        @if ($reservation->customer->name !== '設定なし')
                                                            {{ $reservation->customer->name }}
                                                        @endif
                                                    </td>
                                                    <td class="px-4 py-3 text-center">
                                                        <a class="bg-indigo-500 hover:bg-indigo-600 inline-flex items-center px-6 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"
                                                            href="{{ route('reservations.show', ['reservation' => $reservation->id]) }}">詳細</a>
                                                    </td>
                                                </tr>
                                            @endforeach


                                        </tbody>
                                    </table>

                                    {{ $reservations->links() }}
                                </div>
                            </div>
                        </section>
                    </div>
                </section>

            </div>
        </div>
    </div>
    {{-- <script src="{{ mix('js/flatpickr.js') }}"></script> --}}
</x-app-layout>
