<link rel="stylesheet" href="{{ asset('css/app.css') }}">


{{-- <x-app-layout> --}}
<div class="wrapper w-full m-0">
    {{-- <x-slot name="header"> --}}
    <h1 id="header" class="h-5 text-center"></h1>
    {{-- </x-slot> --}}
    <div class="" id="next-prev-button">
        <button id="prev" onclick="prev()"></button>
        <button id="next" onclick="next()"></button>
    </div>

    <div id="calendar"></div>
</div>

<script>
    {{ mix('js/calendar-test.js') }}
</script>

{{-- </x-app-layout> --}}


{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />
            </div>
        </div>
    </div>
</x-app-layout> --}}
