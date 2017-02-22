@extends('master')

@section('title', $entry->title)

@section('content')
    @include('_components.back')

    <div class="entry-details">
        <div class="row">
            <div class="column medium-12">
                <div class="entry-details-value">
                    {{ $entry->title }}
                </div>
                <div class="entry-details-key">
                    Titel
                </div>
            </div>
        </div>
        <div class="row">
            <div class="column medium-6">
                <div class="entry-details-value">
                    @if ($entry->author)
                        <a href="{{ route('author.details', $entry->author_id)}}">
                            {{ $entry->author->name }}
                        </a>
                    @else
                        -
                    @endif
                </div>
                <div class="entry-details-key">
                    Authoren
                </div>
            </div>
            <div class="column medium-6">
                <div class="entry-details-value">
                    {{ $entry->year }}
                </div>
                <div class="entry-details-key">
                    Erscheinungsjahr
                </div>
            </div>
        </div>
        <div class="row">
            <div class="column medium-6">
                <div class="entry-details-value">
                    {{ $entry->genre->title }}
                </div>
                <div class="entry-details-key">
                    Gattung
                </div>
            </div>
            <div class="column medium-6">
                <div class="entry-details-value">
                    {{ $entry->identifier }}
                </div>
                <div class="entry-details-key">
                    Identifier
                </div>
            </div>
        </div>
    </div>

    @include('_components.back')
@endsection
