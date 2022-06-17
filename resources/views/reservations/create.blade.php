<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            新規予約登録
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
                            <form method="POST" action="{{ route('reservations.store') }}">
                                @csrf
                                <div class="-m-2">
                                    <div class="p-2 w-1/2">
                                        <div class="relative">
                                            <x-jet-label for="date" class="leading-7 text-sm text-gray-600"
                                                value="日付" />
                                            <x-jet-input type="text" id="date" name="date"
                                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                                :value="old('date', isset($entry_date) ? $entry_date : '')" required />
                                        </div>
                                    </div>
                                    <div class="p-2 w-1/2">
                                        <div class="relative">
                                            <x-jet-label for="start_time" class="leading-7 text-sm text-gray-600"
                                                value="開始時間" />
                                            <x-jet-input type="text" id="start_time" name="start_time"
                                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                                :value="old(
                                                    'start_time',
                                                    isset($entry_start_time) ? $entry_start_time : '',
                                                )" required />
                                        </div>
                                    </div>
                                    <div class="p-2 w-1/2">
                                        <div class="relative">
                                            <x-jet-label for="end_time" class="leading-7 text-sm text-gray-600"
                                                value="終了時間" />
                                            <x-jet-input type="text" id="end_time" name="end_time"
                                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                                :value="old(
                                                    'end_time',
                                                    isset($entry_end_time) ? $entry_end_time : '',
                                                )" required />
                                        </div>
                                    </div>
                                    <div class="p-2 w-1/2">
                                        <div class="relative">
                                            <x-jet-label for="customer_name" class="leading-7 text-sm text-gray-600"
                                                value="顧客名" />
                                            <x-jet-input type="text" id="customer_name" name="customer_name"
                                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                                :value="old(
                                                    'customer_name',
                                                    isset($entry_customer_name) ? $entry_customer_name : '',
                                                )" />
                                        </div>
                                    </div>
                                    <div class="p-2 w-full">
                                        <div class="relative">
                                            <x-jet-label for="content" class="leading-7 text-sm text-gray-600"
                                                value="内容" />
                                            <x-textarea id="content" name="content"
                                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">
                                                {{ old('content', isset($entry_content) ? $entry_content : '') }}
                                            </x-textarea>
                                        </div>
                                    </div>
                                    <div class="p-2 flex w-full justify-center">
                                        <x-jet-button class="bg-indigo-500 hover:bg-indigo-600">
                                            新規追加
                                        </x-jet-button>
                                        {{-- <x-jet-button
                                            class="flex mx-auto border-0 py-2 px-8 focus:outline-none rounded text-lg">
                                            戻る</x-jet-button> --}}
                                    </div>

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
