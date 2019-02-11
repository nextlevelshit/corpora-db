<nav class="navigation">
    <div class="navigation-header --inverted">
        <a href="{{ route('search.index') }}">
            Corpora<span>DB</span>
        </a>
    </div>
    {{--  Main Navigation --}}
    <ul class="navigation-list">
        <li class="navigation-list-item">
            <a class="navigation-list-item-link" href="{{ route('search.index') }}">
                <i class="fa fa-search"></i> Suchmaschine 
            </a>
        </li>
        <li class="navigation-list-item">
            <a class="navigation-list-item-link" href="{{ route('entry.create') }}">
                <i class="fa fa-file-text-o"></i> Eintrag hinzufügen 
            </a>
        </li>
        <li class="navigation-list-item">
            <a class="navigation-list-item-link" href="{{ route('author.create') }}">
                <i class="fa fa-user"></i> Autor*in hinzufügen 
            </a>
        </li>
        <li class="navigation-list-item-title">
            Übersicht
        </li>
        <li class="navigation-list-item">
            <a class="navigation-list-item-link" href="{{ route('entry.index') }}">
                <i class="fa fa-copy"></i> Einträge
            </a>
        </li>
        <li class="navigation-list-item">
            <a class="navigation-list-item-link" href="{{ route('author.index') }}">
                <i class="fa fa-users"></i> Autor*innen
            </a>
        </li>
    </ul>
    <hr>
    {{-- Latest Search Requests --}}
    <ul class="navigation-list">
        @if ($latestSearchRequests)
            <ul class="navigation-list">
                <li class="navigation-list-item-title">
                    Zuletzt gesucht
                </li>
                @foreach ($latestSearchRequests as $request)
                    <li class="navigation-list-item">
                        <a class="navigation-list-item-link" href="{{ route('export.show', $request->id) }}">
                            {{ str_limit($request->title, $limit=40, $end='...') }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </ul>
    {{-- Latest Activities --}}
    <ul class="navigation-list">
        @if ($latestExports)
            <ul class="navigation-list">
                <li class="navigation-list-item-title">
                    Zuletzt exportiert
                </li>
                @foreach ($latestExports as $export)
                    <li class="navigation-list-item">
                        <a class="navigation-list-item-link" href="{{ route('export.show', $export->id) }}">
                            {{ str_limit($export->title, $limit=40, $end='...') }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </ul>
    {{-- Latest Entries  --}}
    @if ($latestEntries)
        <ul class="navigation-list">
            <li class="navigation-list-item-title">
                Neuste Einträge
            </li>
            @foreach ($latestEntries as $entry)
                <li class="navigation-list-item">
                    <a class="navigation-list-item-link" href="{{ route('entry.show', $entry->id) }}">
                        {{ str_limit($entry->title, $limit=40, $end='...') }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</nav>
