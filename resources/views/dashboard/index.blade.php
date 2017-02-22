@extends('master')

@section('title', 'Übersicht')

@section('content')
    <div class="row">
        <div class="column">
            <table class="stack">
                @if ($entries->count())
                    <tr>
                        <th>Titel</th>
                        <th>Gattung</th>
                        <th>Änderungsdatum</th>
                    </tr>
                @endif

                @forelse ($entries as $entry)
                    <tr>
                        <td>
                            <a href="{{ route('entry.details', $entry->id) }}">
                                {{ $entry->title }}

                                @if ($entry->identifier)
                                    <sup>[{{ $entry->identifier }}]</sup>
                                @endif
                            </a>
                        </td>

                        <td>
                            {{ $entry->genre->title }}
                        </td>

                        <td>
                            {{ $entry->updated_at->format('d.m.Y H:i') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td>
                            Bisher sind keine Einträge vorhanden. Erstellen Sie den ersten:
                            <a href="{{ route('entry.create') }}">Eintrag erstellen</a>
                        </td>
                    </p>
                @endforelse
            </table>
        </div>
    </div>
@endsection
