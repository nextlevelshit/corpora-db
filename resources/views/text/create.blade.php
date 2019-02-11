@extends('master')

@section('title', 'Text importieren')

@section('content')
    <div class="row">
        <div class="column">
            <p>
                Zugehöriger Eintrag:
                <a href="{{ route('entry.show', $entry->id )}}">
                    {{ $entry->title }}
                </a>
            </p>
            <hr/>
        </div>
    </div>

    <form action="{{ route('entry.text.store', $entry->id) }}"
          method="post"
          enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="row">
            <div class="medium-6 column">
                <label>Dateityp
                    <select name="state_id">
                        @foreach ($states as $state)
                            <option value="{{ $state->id }}" @if ($state->id == old('state_id')) selected @endif>{{ $state->title }}</option>
                        @endforeach
                    </select>
                </label>
            </div>
            <div class="medium-6 column">
                <label class="{{ $errors->has('path') ? 'is-invalid-label' : '' }}">Datei hochladen
                   <input type="file"
                        class="button"
                        name="path">
                    @if ($errors->has('path'))
                        <span class="form-error is-visible">{{ $errors->first('path') }}</span>
                    @endif
                </label>
            </div>
        </div>
        <div class="row">
            <div class="medium-12 column">
                <label>Kommentar
                   <textarea name="comment">{{ old('comment') }}</textarea>
                </label>
            </div>
        </div>
        <div class="row">
            <div class="column medium-12">
                <hr/>
            </div>
            <div class="medium-6 column">
                <a href="{{ route('entry.text.create', $entry->id) }}" class="hollow button">
                    Abbrechen
                </a>
            </div>
            <div class="medium-6 column">
                <input type="submit"
                       class="button float-right"
                       value="Text importieren">
            </div>
        </div>
    </form>
@endsection
