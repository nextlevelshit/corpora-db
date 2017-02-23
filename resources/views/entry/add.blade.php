@extends('master')

@section('title', 'Neuer Eintrag')

@section('content')
    <div class="row">
        <div class="column">
            <p>Neuen Eintrag erstellen</p>
        </div>
    </div>

    <form action="/entry" method="post">
        {{-- <input type="hidden" name="_method" value="PUT"> --}}
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="row">
            <div class="medium-12 column">
                <label>Titel
                    <input type="text"
                    name="title"
                    placeholder="Unter welchem Titel soll der Eintrag gefunden werden">
                </label>
            </div>
        </div>
        <div class="row">
            <div class="medium-6 column">
                <autocomplete title="Autor" name="author" table="authors" placeholder="Mehrere Eingaben mit Kommata trennen"></autocomplete>
            </div>
            <div class="medium-6 column">
                <label>Erscheinungsjahr
                    <input type="number"
                    name="year"
                    placeholder="Bitte leer lassen, falls nicht eindeutig">
                </label>
            </div>
        </div>
        <div class="row">
            <div class="medium-6 column">
                <label>Gattung
                    <select name="genre_id">
                        @foreach ($genres as $genre)
                            <option value="{{ $genre->id }}">{{ $genre->title }}</option>
                        @endforeach
                    </select>
                </label>
            </div>
            <div class="medium-6 column">
                <label>Identifier
                    <input type="text"
                    name="identifier"
                    placeholder="Text eindeutig markieren">
                </label>
            </div>
        </div>
        <div class="row">
            <div class="medium-6 column">
                <a href="#" class="hollow button">
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
