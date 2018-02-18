@extends('master')

@section('title', '')

@section('content')
<div class="search">
  @include('search.header')
  <form action="{{ route('search.export') }}" method="post">
    {{-- Add search term to form for autofill if validation fails --}}
    <input type="hidden" name="term" value="{{ $search['term'] }}">
    {{ csrf_field() }}
    @if (!empty($results) > 0)
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
            <div>
              <small><strong>Tipp!</strong> Gewünschte Dateitypen auswählen, Einträge mit einem Haken markieren und »Exportieren« betätigen, so stellen Sie sich ihren gewünschten Korpus zusammen.</small>
            </div>
          </fieldset>
        </div>
      </div>
    </div>
    @endif
    @if (!empty($entries))
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
            <a href="#results-texts">Textdateien ({{ count($texts) }})</a>
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
                      @if ($entry->year)
                        <li class="search-list-item-info-item">{{ $entry->year }} erschienen</li>
                      @endif
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
      @endif
    </form>
  </div>
  @endsection
  