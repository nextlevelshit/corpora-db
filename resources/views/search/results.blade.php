@extends('master')

@section('title', 'Suchergebnisse')

@section('content')
    <div class="row">
        <div class="column">
            <p>Suchergebnisse für <strong>{{ $search['term'] }}</strong></p>
            <form action="{{ route('search.results') }}" method="post">
                {{ csrf_field() }}
                <div class="input-group">
                    <input class="input-group-field" type="text" name="term" value="{{ $search['term'] }}">
                    <div class="input-group-button">
                        <input type="submit" class="button" value="Suchen">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
