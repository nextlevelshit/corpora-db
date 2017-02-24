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
        </div>
    </div>

    <form action="{{ route('entry.text.store', $entry->id) }}" method="post">
        {{-- <input type="hidden" name="_method" value="PUT"> --}}
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="row">
            <div class="medium-6 column">
                <label>Zustand
                    <select name="state_id">
                        @foreach ($states as $state)
                            <option value="{{ $state->id }}" @if ($state->id === old('state_id')) @endif>{{ $state->title }}</option>
                        @endforeach
                    </select>
                </label>
            </div>
        </div>
        <div class="row">
            <div class="medium-12 column">
                <label>Kommentar
                   <textarea name="comment">
                       {{ old('comment') }}
                   </textarea>
                </label>
            </div>
        </div>
        <div class="row">
            <div class="medium-6 column">
                <a href="#" class="hollow button">
                    {{-- TODO: add functionality to abort button --}}
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

@section('javascript')
    window.Laravel = { csrfToken: '{{ csrf_token() }}' };
@endsection
