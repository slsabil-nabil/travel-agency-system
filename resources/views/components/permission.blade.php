@props(['ability'])

@if(auth()->check() && auth()->user()->can($ability))
    {{ $slot }}
@endif
