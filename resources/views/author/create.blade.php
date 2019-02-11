@extends('master')

@section('title', 'Autor*in hinzufügen')

@section('content')
  <div class="row">
    <div class="column">
      <p>
        Erstellen Sie eine neue Autorin bzw. neuen Autor.
      </p>
      <hr/>
    </div>
  </div>

  <form action="{{ route('author.store') }}" method="post">
    {{ csrf_field() }}
    
    <div class="row">
      <div class="medium-6 column">
        <label class="{{ $errors->has('name') ? 'is-invalid-label' : '' }}">
          Name
          <input type="text"
            name="name"
            placeholder=""
            autocomplete="off"
            class="{{ $errors->has('name') ? 'is-invalid-input' : '' }}"
            value="{{ old('title') }}">
        </label>
        @if ($errors->has('name'))
          <span class="form-error is-visible">
            {{ $errors->first('name') }}
          </span>
        @endif
      </div>
      <div class="medium-6 column">
        <label>Geburtsjahr
          <input type="text"
          name="year"
          placeholder=""
          value="{{ old('year') }}">
        </label>
      </div>
    </div>
    <div class="row">
      <div class="medium-12 column">
        <hr/>
      </div>
      <div class="medium-6 column">
        <button type="reset" class="hollow button">
          Abbrechen
        </button>
      </div>
      <div class="medium-6 column">
        <input type="submit"
        class="button float-right"
        value="Autor*in speichern">
      </div>
    </div>
  </form>
@endsection