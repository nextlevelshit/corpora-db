@extends('master')

@section('title', $author->name)

@section('content')
    @include('_components.back')

    <div class="entry-details">
        <div class="row">
            <div class="column medium-6">
                <div class="entry-details-value">
                    {{ $author->name }}
                </div>
                <div class="entry-details-key">
                    Name
                </div>
            </div>
            <div class="column medium-6">
                <div class="entry-details-value">
                    @if ($author->year)
                        {{ $author->year }}
                    @else
                        -
                    @endif
                </div>
                <div class="entry-details-key">
                    Geburtsjahr
                </div>
            </div>
            <div class="column">
                <a href="{{ route('author.edit', $author->id) }}" class="button hollow float-right">Autor*in bearbeiten</a>
            </div>
        </div>
        <br>
        <br>
        <div class="row">
            <div class="column">
                <table class="stack">
                    <tr>
                        <th colspan="3" class="text-left">
                            Passende Einträge zum Autor bzw. zur Autorin
                        </th>
                    </tr>
                    @forelse ($author->entries as $entry)
                        <tr>
                            <td>
                                <a href="{{ route('entry.show', $entry->id) }}">
                                    {{ $entry->title }}

                                    @if ($entry->identifier)
                                        <sup>
                                            [{{ $entry->identifier }}]
                                        </sup>
                                    @endif
                                </a>
                            </td>
                            <td>
                                {{ $entry->year }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>
                                Keine Einträge hinterlegt.
                            </td>
                        </tr>
                    @endforelse
                </table>
            </div>
        </div>
    </div>

    @include('_components.back')
@endsection
