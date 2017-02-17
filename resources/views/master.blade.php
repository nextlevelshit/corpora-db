@include('_components.header')

@section('title', 'test')

@if ( ! empty($notification) )
    @component('notification')
        @slot('title')
            {{ $notification->title }}
        @endslot
        {{ $notification->content }}
    @endcomponent
@endif

@yield('content')

@include('_components.footer')
