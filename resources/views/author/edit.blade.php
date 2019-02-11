@extends('master')

@section('title', 'Autor*in bearbeiten')

@section('content')
  <div class="row">
    <div class="column">
      <p>
        {{ $author->name }}: <a href="{{ route('author.show', $author->id) }}">{{ route('author.show', $author->id) }}</a>
      </p>
      <hr/>
    </div>
  </div>

  <form action="{{ route('author.update', $author->id) }}" method="post">
    {{ method_field('PUT') }}
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
            value="{{ $author->name }}">
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
          value="{{ $author->year }}">
        </label>
      </div>
    </div>
    <div class="row">
      <div class="medium-12 column">
        <hr/>
      </div>
      <div class="medium-6 column">
        <a href="{{ route('author.show', $author->id) }}" class="hollow button">
          Abbrechen
        </a>
      </div>
      <div class="medium-6 column">
        <input type="submit"
        class="button float-right"
        value="Autor*in speichern">
      </div>
    </div>
  </form>
@endsection