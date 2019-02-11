@extends('master')

@section('title', 'Eintrag hinzufügen')

@section('content')
  <div class="row">
    <div class="column">
      <p>Einträge beinhalten alle Metainformationen und können nach dem Erstellen mit Textdokumenten verknüpft werden.</p>
      <hr/>
    </div>
  </div>

  <form action="{{ route('entry.store') }}" method="post">
    {{ csrf_field() }}
    
    <div class="row">
      <div class="medium-12 column">
        <label class="{{ $errors->has('title') ? 'is-invalid-label' : '' }}">
          Titel
          <input type="text"
          name="title"
          placeholder="Pflichtfeld"
          autocorrect="off" autocomplete="off"
          class="{{ $errors->has('title') ? 'is-invalid-input' : '' }}"
          value="{{ old('title') }}">
          @if ($errors->has('title'))
            <span class="form-error is-visible">{{ $errors->first('title') }}</span>
          @endif
        </label>
      </div>
    </div>
    <div class="row">
      <div class="medium-6 column">
        <auto-complete title="Autor*in" name="author" table="authors" api="{{ url('/api') }}" value="{{ old('author') }}" placeholder="Mehrfacheingabe mit Enter trennen"></auto-complete>
      </div>
      <div class="medium-6 column">
        <label>Erscheinungsjahr
          <input type="text"
            name="year"
            placeholder=""
            value="{{ old('year') }}">
        </label>
      </div>
    </div>
    <div class="row">
      <div class="medium-6 column">
        <label>Gattung
          <select name="genre_id">
            <option value="">Bitte auswählen...</option>
            @foreach ($genres as $genre)
              <option value="{{ $genre->id }}" @if ($genre->id == old('genre_id')) selected @endif>{{ $genre->title }}</option>
            @endforeach
          </select>
        </label>
      </div>
      <div class="medium-6 column">
        <label>Identifier
          <input type="text" name="identifier" placeholder="Text eindeutig markieren" value="{{ old('identifier') }}" disabled>
        </label>
      </div>
    </div>
    
    <div class="row">
      <div class="column medium-12">
        <hr/>
      </div>
      <div class="medium-6 column">
        <button type="reset" class="hollow button">
          Abbrechen
        </button>
      </div>
      <div class="medium-6 column">
        <input type="submit" class="button float-right" value="Eintrag speichern">
      </div>
    </div>
  </form>
@endsection

@section('javascript')
  window.Laravel = { csrfToken: '{{ csrf_token() }}' };
@endsection
