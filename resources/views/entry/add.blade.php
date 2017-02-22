@extends('master')

@section('title', 'Neuer Eintrag')

@section('content')
    <div class="row">
        <div class="column">
            <p>Neuen Eintrag erstellen</p>
        </div>
    </div>

    <form action="/entry" method="post">
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <example></example>

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
                <label>Autor
                    <input type="text"
                    name="authors"
                    placeholder="Mehrere Eingaben mit Kommata trennen">
                </label>
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
            <div class="medium-12 column">
                <label>
                    What books did you read over summer break?
                    <textarea placeholder="None"></textarea>
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
