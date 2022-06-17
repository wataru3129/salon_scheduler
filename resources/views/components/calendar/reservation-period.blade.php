@php
if ($isMyReservation) {
    $bgColor = 'bg-blue-300';
} else {
    $bgColor = 'bg-orange-200';
}
@endphp

<div class="py-1 px-2 h-8 border border-gray-200 {{ $bgColor }}">
    @if (!is_null($content))
        {{ $content }}
    @endif
</div>
