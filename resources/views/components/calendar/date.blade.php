@php
$class = [];

if ($month === 'notThisMonth') {
    $class[] = 'text-slate-400';
}

switch ($reservation) {
    case 1:
        $class[] = 'bg-blue-300';
        break;
    case 2:
        $class[] = 'bg-orange-200';
        break;
}
@endphp

<th @class ($class)>{{ $date }}</th>
