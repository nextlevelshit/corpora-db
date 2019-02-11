<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} | @yield('title')</title>
    <!-- Styles -->
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
    <script>
        // Load CSRF Token from Laravel
        window.Laravel = { csrfToken: '{{ csrf_token() }}' };
    </script>
</head>
<body>
    <div class="off-canvas-wrapper">
        <div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>
            <div class="off-canvas position-left reveal-for-large" id="my-info" data-off-canvas data-position="left">

                @include('_components.navigation')

            </div>
            <div class="off-canvas-content" data-off-canvas-content>
                <div class="title-bar hide-for-large">
                    <div class="title-bar-left">
                        <button class="menu-icon" type="button" data-open="my-info"></button>
                        <span class="title-bar-title">Menü</span>
                    </div>
                </div>

                @if ( !empty($notification) )
                    @component('_components.notification')
                        @slot('title')
                            {{ $notification->title }}
                        @endslot

                        @slot('class')
                            success
                        @endslot

                        {!! $notification->content !!}
                    @endcomponent
                @endif

                @if ( $errors->any() )
                    {{--  @dump($errors)  --}}

                    @component('_components.notification')
                        @slot('title')
                            Es ist ein Fehler aufgetreten
                        @endslot

                        @slot('class')
                            alert
                        @endslot
                    @endcomponent
                @endif

                <div class="small-up-12 medium-up-12 large-up-10">
                    <div id="corpora">
