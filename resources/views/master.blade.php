@include('_components.header')

@include('_components.navigation')

@section('title', 'test')

@if ( ! empty($notification) )
    @component('_components.notification')
        @slot('title')
            {{ $notification->title }}
        @endslot
        {{ $notification->content }}
    @endcomponent
@endif

<h1>@yield('title')</h1>

@yield('content')

@include('_components.footer')
