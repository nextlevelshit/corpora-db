@extends('master')

@section('title', 'Suchergebnisse')

@section('content')
    <div class="search">
        <div class="row">
            <div class="column">
                <p>{{ $results }} Suchergebnisse für <strong>{{ $search['term'] }}</strong></p>
                <form action="{{ route('search.results') }}" method="post">
                    {{ csrf_field() }}
                    <div class="input-group">
                        <input class="input-group-field" type="text" autocomplete="off" autocorrect="off" name="term" value="{{ $search['term'] }}">
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
            @if (count($results) > 0)
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
                    <ul class="tabs" data-active-collapse="true" id="results" data-tabs>
                        <li class="tabs-title is-active">
                            <a href="#results-entries" aria-selected="true">Einträge ({{ count($entries) }})</a>
                        </li>
                        <li class="tabs-title">
                            <a href="#results-authors">Autoren ({{ count($authors) }})</a>
                        </li>
                        <li class="tabs-title">
                            <a href="#results-texts">Texte ({{ count($texts) }})</a>
                        </li>
                    </ul>
                    <div class="tabs-content" data-tabs-content="results">
                        <div class="tabs-panel is-active" id="results-entries">
                            @if (count($entries) > 0)
                                <ul class="search-list">
                                    @foreach ($entries as $entry)
                                        <li class="search-list-item">
                                            <div class="row">
                                                <div class="small-1 column">
                                                    <label class="search-list-item-check">
                                                        <input type="checkbox" class="search-list-item-check-input" name="entries[]" value="{{ $entry->id }}">
                                                        <div class="search-list-item-check-trigger">
                                                            <i class="fa fa-check-square-o"></i>
                                                        </div>
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
                                                        @if (count($entry->author()) > 0)
                                                            @foreach ($entry->author()->get() as $author)
                                                                <li class="search-list-item-info-item"><a href="{{ route('author.details', $author->id) }}">
                                                                {{ $author->name }}</a></li>
                                                            @endforeach
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
                                <h4>Es wurden keine Einträge zu diesem Suchbegriff gefunden.</h4>
                            @endif
                        </div>
                        <div class="tabs-panel" id="results-authors">
                            @if (count($authors) > 0)
                                <ul class="search-list">
                                    @foreach ($authors as $author)
                                        <li class="search-list-item">
                                            <div class="row">
                                                <div class="small-1 column">
                                                    {{-- <label class="search-list-item-check">
                                                        <input type="checkbox" class="search-list-item-check-input" name="authors[]" value="{{ $author->id }}">
                                                        <div class="search-list-item-check-trigger">
                                                            <i class="fa fa-check-square-o"></i>
                                                        </div>
                                                    </label> --}}
                                                </div>
                                                <div class="small-11">
                                                    <h4 class="search-list-item-result">
                                                        <a href="{{ route('author.details', $author->id) }}">
                                                            {{ $author->name }}
                                                        </a>
                                                    </h4>
                                                    <ul class="search-list-item-info">
                                                        @if ($author->entries)
                                                            <li class="search-list-item-info-item">{{ count($author->entries) }} Einträge</li>
                                                        @endif
                                                        @if ($author->year)
                                                            <li class="search-list-item-info-item">Geboren {{ $author->year }}</li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <h4>Es wurden keine Autoren zu diesem Suchbegriff gefunden.</h4>
                            @endif
                        </div>
                        <div class="tabs-panel" id="results-texts">
                            @if (count($texts) > 0)
                                <ul class="search-list">
                                    @foreach ($texts as $text)
                                        <li class="search-list-item">
                                            <div class="row">
                                                <div class="small-1 column">
                                                    {{-- <label class="search-list-item-check">
                                                        <input type="checkbox" class="search-list-item-check-input" name="texts[]" value="{{ $text->id }}">
                                                        <div class="search-list-item-check-trigger">
                                                            <i class="fa fa-check-square-o"></i>
                                                        </div>
                                                    </label> --}}
                                                </div>
                                                <div class="small-11">
                                                    <h4 class="search-list-item-result">
                                                        <a href="{{ route('entry.show', $text->entry->id) }}" target="_blank">
                                                            {{ $text->entry->title }}
                                                        </a>
                                                    </h4>
                                                    <ul class="search-list-item-info">
                                                        @if ($text->entry)
                                                            <li class="search-list-item-info-item">
                                                                Download: <a href="{{ $text->path }}" target="_blank">
                                                                    {{ $text->path }}
                                                                </a>
                                                            </li>
                                                        @endif
                                                    </ul>
                                                    @if ($text->result)
                                                        {{-- <p>{{ str_limit($text->result, $limit=320, $end='...') }}</p> --}}
                                                            <p>{!! str_replace($search['term'], '<strong>'.$search['term'].'</strong>', $text->result) !!}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <h4>Es wurden keine Texte zu diesem Suchbegriff gefunden.</h4>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
