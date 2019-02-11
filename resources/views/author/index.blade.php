@extends('master')

@section('title', 'Übersicht aller Autor*innen')

@section('content')
  <div class="row">
    <div class="column">
      {{ $authors->links() }}
      <table class="stack">
        @if ($authors->count())
          <tr>
            <th class="text-left">Name</th>
            <th class="text-left">Gebursjahr</th>
          </tr>
        @endif

        @forelse ($authors as $author)
          <tr>
            <td>
              <a href="{{ route('author.details', $author->id) }}">{{ $author->name }}</a>
            </td>

            <td>
              @if ($author->year)
                {{ $author->year }}
              @else
                -
              @endif
            </td>
          </tr>
        @empty
          <tr>
            <td>
              Bisher sind keine Autor*innen vorhanden
            </td>
          </tr>
        @endforelse
      </table>
      {{ $authors->links() }}
    </div>
  </div>
@endsection
