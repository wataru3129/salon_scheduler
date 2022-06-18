@php
$class = [];

if ($month === 'notThisMonth') {
    $class[] = 'text-slate-400';
}

if ($dayoff) {
    $class[] = 'bg-red-300';
} else {
    switch ($reservation) {
        case 1:
            $class[] = 'bg-blue-300';
            break;
        case 2:
            $class[] = 'bg-orange-200';
            break;
    }
}

@endphp

@if ($reservation == 0 || $dayoff)
    <th @class ($class)>{{ $date }}</th>
@else
    <th @class ($class)>
        <a href="{{ route('daily', ['day' => $today]) }}">
            {{ $date }}
        </a>
    </th>
@endif
