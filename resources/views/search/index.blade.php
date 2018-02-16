@extends('master')

@section('title', '')

@section('content')
    <div>
        <div class="logo text-center">Corpora<span>DB</span></div>
    </div>
    <div class="row">
        <div class="column">
            {{--  <p>Das ist die Suchmaske</p>  --}}
            <form action="{{ route('search.results') }}" method="post">
                {{ csrf_field() }}
                <div class="text-center">
                    <input name="term" type="text" value="{{ old('term') }}" autocorrect="off" autocomplete="off">
                </div>
                <div class="text-center">
                    <a href="{{ route('search.results') }}" class="button large hollow">Erweiterte Suche</a>
                    <input type="submit" class="button large" value="Suchen">
                </div>
            </form>
        </div>
    </div>
@endsection
