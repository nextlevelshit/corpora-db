@extends('master')

@section('title', $author->name)

@section('content')
    @include('_components.back')

    <div class="entry-details">
        <div class="row">
            <div class="column medium-6">
                <div class="entry-details-value">
                    {{ $author->name }}
                </div>
                <div class="entry-details-key">
                    Name
                </div>
            </div>
            <div class="column medium-6">
                <div class="entry-details-value">
                    {{ $author->year }}
                </div>
                <div class="entry-details-key">
                    Geburtsjahr
                </div>
            </div>
        </div>
    </div>

    @include('_components.back')
@endsection
