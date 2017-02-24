@extends('master')

@section('title', 'Suchergebnisse')

@section('content')
    <div class="search">
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
                            <h4 class="search-list-item-result">
                                <a href="{{ route('entry.show', $entry->id) }}">
                                    {{ $entry->title }}
                                    @if ($entry->identifier)
                                        <sup>[{{ $entry->identifier }}]</sup>
                                    @endif
                                </a>
                            </h4>
                            <ul class="search-list-item-info">
                                @if ($entry->author)
                                    <li class="search-list-item-info-item">{{ $entry->author->name }}</li>
                                @endif
                                @if ($entry->genre)
                                    <li class="search-list-item-info-item">{{ $entry->genre->title }}</li>
                                @endif
                                <li class="search-list-item-info-item">{{ $entry->updated_at->format('d.m.Y H:i') }}</li>
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
