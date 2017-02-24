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
    <div class="margin"></div>
    <div class="row">
        <div class="column">
            <ul class="search-list">
                @foreach ($entries as $entry)
                    <li class="search-list-item">
                        <div>
                            <a href="{{ route('entry.show', $entry->id) }}">
                                {{ $entry->title }}
                                @if ($entry->identifier)
                                    <sup>[{{ $entry->identifier }}]</sup>
                                @endif
                            </a>
                        </div>
                        <ul class="search-list-item-info">
                            @if ($entry->author)
                                <li>{{ $entry->author->title }}</li>
                            @endif
                            @if ($entry->genre)
                                <li>{{ $entry->genre->title }}</li>
                            @endif
                            <li>{{ $entry->updated_at->format('d.m.Y H:i') }}</li>
                        </ul>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
