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
                {{--  <input type="button" class="button hollow tiny search-export-button" value="Alle Einträge markieren" disabled>  --}}
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
                <a href="#results-entries" aria-selected="true">
                  Einträge ({{ count($entries) }})
                </a>
              </li>
              <li class="tabs-title">
                <a href="#results-authors">
                  Autoren ({{ count($authors) }})
                </a>
              </li>
              <li class="tabs-title">
                <a href="#results-texts">
                  Textdateien ({{ count($texts) }})
                </a>
              </li>
            </ul>
            <div class="tabs-content" data-tabs-content="results">
              <div class="tabs-panel is-active" id="results-entries">
                @include('search.results.entries')
              </div>
              <div class="tabs-panel" id="results-authors">
                @include('search.results.authors')
              </div>
              <div class="tabs-panel" id="results-texts">
                @include('search.results.texts')
              </div>
            </div>
          </div>
        </div>
      @endif
    </form>
  </div>
@endsection
  