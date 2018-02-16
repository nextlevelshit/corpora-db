@extends('master')

@section('title', $entry->title)

@section('content')
    @include('_components.back')

    <div class="entry-details">
        <div class="row">
            <div class="column medium-12">
                <div class="entry-details-value">
                    {{ $entry->title }}
                </div>
                <div class="entry-details-key">
                    Titel
                </div>
            </div>
        </div>
        <div class="row">
            <div class="column medium-6">
                <div class="entry-details-value --authors">
                    <!--
                    @forelse ($entry->author()->get() as $author)
                        --><a href="{{ route('author.details', $author->id) }}">{{ $author->name }}</a><!--
                    @empty
                        -->-<!--
                    @endforelse
                    -->
                </div>
                <div class="entry-details-key">
                    AuthorIn
                </div>
            </div>
            <div class="column medium-6">
                <div class="entry-details-value">
                    @if ($entry->year)
                        {{ $entry->year }}
                    @else
                        -
                    @endif
                </div>
                <div class="entry-details-key">
                    Erscheinungsjahr
                </div>
            </div>
        </div>
        <div class="row">
            <div class="column medium-6">
                <div class="entry-details-value">
                    @if ($entry->genre)
                        {{ $entry->genre->title }}
                    @else
                        -
                    @endif
                </div>
                <div class="entry-details-key">
                    Gattung
                </div>
            </div>
            <div class="column medium-6">
                <div class="entry-details-value">
                    @if ($entry->identifier)
                        {{ $entry->identifier }}
                    @else
                        -
                    @endif
                </div>
                <div class="entry-details-key">
                    Identifier
                </div>
            </div>
            <div class="column">
                <a href="{{ route('entry.edit', $entry->id) }}" class="button hollow float-right">Eintrag bearbeiten</a>
            </div>
        </div>
        <br>
        <br>
        <div class="row">
            <div class="column">
                <table class="stack">
                    <tr>
                        <th colspan="3" class="text-left">
                            Verknüpfte Textdokumente
                        </th>
                    </tr>
                    @forelse ($entry->textsLatest() as $text)
                        <tr>
                            <td>
                                {{ $text->state->title }}
                            </td>
                            <td>
                                <a href="{{ asset($text->path) }}" target="_blank">
                                    {{ asset($text->path) }}
                                </a>
                            </td>
                            <td>
                                {{ $text->updated_at->format('d.m.Y H:i') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>
                                Keine Texte hinterlegt.
                            </td>
                        </tr>
                    @endforelse
                </table>
                <a href="{{ route('entry.text.create', $entry->id) }}" class="button hollow float-right">Texte importieren</a>
            </div>
        </div>
    </div>

    @include('_components.back')
@endsection
