@extends('master')

@section('title', 'Neuer Eintrag')

@section('content')
    <p>Neuen Eintrag erstellen</p>

    <form action="/entry" method="post">
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="row">
            <div class="medium-12 columns">
                <label>Titel
                    <input type="text"
                           name="title"
                           placeholder="Unter welchem Titel soll der Eintrag gefunden werden">
                </label>
            </div>
        </div>
        <div class="row">
            <div class="medium-6 columns">
                <label>Autor
                    <input type="text"
                           name="authors"
                           placeholder="Mehrere Eingaben mit Kommata trennen">
                </label>
            </div>
            <div class="medium-6 columns">
                <label>Erscheinungsjahr
                    <input type="number"
                           name="year"
                           placeholder="Bitte leer lassen, falls nicht eindeutig">
                </label>
            </div>
        </div>
        <div class="row">
            <div class="medium-12 columns">
                <label>
                    What books did you read over summer break?
                    <textarea placeholder="None"></textarea>
                </label>
            </div>
        </div>
        <div class="row">
            <div class="medium-6 columns">
                <a href="#" class="hollow button">
                    Abbrechen
                </a>
            </div>
            <div class="medium-6 columns">
                <input type="submit"
                       class="button"
                       value="Eintrag speichern">
            </div>
        </div>
    </form>
@endsection

