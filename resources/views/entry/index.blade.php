@extends('master')

@section('title', 'Übersicht aller Einträge')

@section('content')
  <div class="row">
    <div class="column">
      {{ $entries->links() }}
      <table class="stack">
        @if ($entries->count())
          <tr>
            <th class="text-left">Titel</th>
            <th class="text-left">Autor*in</th>
            <th class="text-left">Gattung</th>
            <th class="text-left">Erscheinungsjahr</th>
          </tr>
        @endif

        @forelse ($entries as $entry)
          <tr>
            <td>
              <a href="{{ route('entry.show', $entry->id) }}">
                {{ $entry->title }}

                @if ($entry->identifier)
                  <sup>[{{ $entry->identifier }}]</sup>
                @endif
              </a>
            </td>

            <td>
              @forelse ($entry->author()->get() as $author)
                <div>
                  <a href="{{ route('author.show', $author->id) }}">{{ $author->name }}</a>
                </div>
              @empty
                -
              @endforelse
            </td>

            <td>
              @if ($entry->genre)
                {{ $entry->genre->title }}
              @else
                -
              @endif
            </td>

            <td>
              @if ($entry->year)
                {{ $entry->year }}
              @else
                -
              @endif
            </td>
          </tr>
        @empty
          <tr>
            <td>
              Bisher sind keine Einträge vorhanden. Erstellen Sie den ersten:
              <a href="{{ route('entry.create') }}">Eintrag erstellen</a>
            </td>
          </tr>
        @endforelse
      </table>
      {{ $entries->links() }}
    </div>
  </div>
@endsection
