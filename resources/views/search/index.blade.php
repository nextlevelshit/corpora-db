@extends('master')

@section('title', 'Suche')

@section('content')
    <div class="row">
        <div class="column">
            <p>Das ist die Suchmaske</p>
            <form action="{{ route('search.results') }}" method="post">
                {{ csrf_field() }}
                <div class="input-group">
                    <input class="input-group-field" name="term" type="text" value="{{ old('term') }}" autocorrect="off" autocomplete="off">
                    <div class="input-group-button">
                        <input type="submit" class="button" value="Suchen">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
