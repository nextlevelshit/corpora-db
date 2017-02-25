@extends('master')

@section('title', 'Suchergebnisse')

@section('content')
    <div class="search">
        <div class="row">
            <div class="column">
                <p>Suchergebnisse für <strong>{{ $search['term'] }}</strong></p>
                <form action="{{ route('search.results') }}" method="post">
                    {{ csrf_field() }}
                    <div class="input-group">
                        <input class="input-group-field" type="text" name="term" value="{{ $search['term'] }}">
                        <div class="input-group-button">
                            <input type="submit" class="button" value="Suchen">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <form action="{{ route('search.export') }}" method="post">
            {{-- Add search term to form for autofill if validation fails --}}
            <input type="hidden" name="term" value="{{ $search['term'] }}">
            {{ csrf_field() }}
            @if (count($entries) > 0)
                <div class="row">
                    <div class="column">
                        <div class="search-export">
                            <fieldset class="fieldset">
                                <legend>Exportieren</legend>
                                @if ($states)
                                    @foreach ($states as $state)
                                        <input id="{{ str_slug($state->title) }}" type="checkbox" name="states[]" value="{{ $state->id }}">
                                        <label for="{{ str_slug($state->title) }}">{{ $state->title }}</label>
                                    @endforeach
                                @endif
                                <input type="submit" class="button tiny search-export-button" value="Exportieren">
                                <input type="button" class="button hollow tiny search-export-button" value="Alle Einträge markieren" disabled>
                            </fieldset>
                        </div>
                    </div>
                </div>
            @endif
            <div class="margin"></div>
            <div class="row">
                <div class="column">
                    @if (count($entries) > 0)
                        <ul class="search-list">
                            @foreach ($entries as $entry)
                                <li class="search-list-item">
                                    <div class="row">
                                        <div class="small-1 column">
                                            <label class="search-list-item-check">
                                                <input type="checkbox" class="search-list-item-check-input" name="entries[]" value="{{ $entry->id }}">
                                                <div class="search-list-item-check-trigger"></div>
                                            </label>
                                        </div>
                                        <div class="small-11">
                                            <h4 class="search-list-item-result">
                                                <a href="{{ route('entry.show', $entry->id) }}">
                                                    {{ $entry->title }}
                                                    @if ($entry->identifier)
                                                        <sup>[{{ $entry->identifier }}]</sup>
                                                    @endif
                                                </a>
                                            </h4>
                                            <ul class="search-list-item-info">
                                                @if ($entry->author)
                                                    <li class="search-list-item-info-item">{{ $entry->author->name }}</li>
                                                @endif
                                                @if ($entry->genre)
                                                    <li class="search-list-item-info-item">{{ $entry->genre->title }}</li>
                                                @endif
                                                <li class="search-list-item-info-item">{{ $entry->updated_at->format('d.m.Y H:i') }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <h4>Die Suchanfrage lieferte keine Ergebnisse, bitte versuchen Sie es erneut.</h4>
                    @endif
                </div>
            </div>
        </form>
    </div>
@endsection
