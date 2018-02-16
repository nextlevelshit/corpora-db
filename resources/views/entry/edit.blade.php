@extends('master')

@section('title', 'Eintrag bearbeiten')

@section('content')
    <div class="row">
        <div class="column">
            <p>
                Zugehöriger Eintrag: <a href="{{ route('entry.show', $entry->id) }}">{{ route('entry.show', $entry->id) }}</a>
            </p>
            <hr/>
        </div>
    </div>

    <form action="{{ route('entry.update', $entry->id) }}" method="post">
        {{ method_field('PUT') }}
        {{ csrf_field() }}

        <div class="row">
            <div class="medium-12 column">
                <label>Titel
                    <input type="text"
                           name="title"
                           placeholder="Unter welchem Titel soll der Eintrag gefunden werden"
                           value="{{ $entry->title }}">
                </label>
            </div>
        </div>
        <div class="row">
            <div class="medium-6 column">
                <autocomplete title="Autor*in"
                              name="author"
                              table="authors"
                              value="{{ $entry->author }}"
                              api="{{ url('/api') }}"></autocomplete>
            </div>
            <div class="medium-6 column">
                <label>Erscheinungsjahr
                    <input type="text"
                           name="year"
                           placeholder="optional"
                           value="{{ $entry->year }}">
                </label>
            </div>
        </div>
        <div class="row">
            <div class="medium-6 column">
                <label>Gattung
                    <select name="genre_id">
                        <option value="">Bitte auswählen...</option>
                        @foreach ($genres as $genre)
                            <option value="{{ $genre->id }}" @if ($genre->id == $entry->genre_id) selected @endif>{{ $genre->title }}</option>
                        @endforeach
                    </select>
                </label>
            </div>
            <div class="medium-6 column">
                <label>Identifier
                    <input type="text"
                           name="identifier"
                           placeholder="Text eindeutig markieren"
                           disabled="disabled"
                           value="{{ $entry->identifier }}">
                </label>
            </div>
        </div>
        <div class="row">
            <div class="medium-12 column">
                <hr/>
            </div>
            <div class="medium-6 column">
                <a href="{{ route('entry.show', $entry->id) }}" class="hollow button">
                    Abbrechen
                </a>
            </div>
            <div class="medium-6 column">
                <input type="submit"
                       class="button float-right"
                       value="Eintrag speichern">
            </div>
        </div>
    </form>
@endsection

@section('javascript')
    window.Laravel = { csrfToken: '{{ csrf_token() }}' };
@endsection
