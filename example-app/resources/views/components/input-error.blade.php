@props(['messages'])

@if (!empty($messages))
    <ul class="text-sm text-red-600 space-y-1">
    {{-- <ul {{ $attributes->merge(['class' => 'text-sm text-red-600 space-y-1']) }}> --}}
        {{-- @foreach ((array) $messages as $message) --}}
        @foreach ($messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
