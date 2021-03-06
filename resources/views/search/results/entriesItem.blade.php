<li class="search-list-item">
  <div class="row">
    <div class="small-2 medium-1 column">
      <label class="search-list-item-check">
        <input type="checkbox" class="search-list-item-check-input" value="{{ $entry->id }}">
        <div class="search-list-item-check-trigger">
          <i class="fa fa-check-square-o"></i>
        </div>
      </label>
    </div>
    <div class="small-10 medium-11 column">
      <h4 class="search-list-item-result">
        <a href="{{ route('entry.show', $entry->id) }}">
          {{ $entry->title }}
          @if ($entry->identifier)
            <sup>[{{ $entry->identifier }}]</sup>
          @endif
        </a>
      </h4>
      <ul class="search-list-item-info">
        @if (count($entry->author()) > 0)
          @foreach ($entry->author()->get() as $author)
            <li class="search-list-item-info-item">
              <a href="{{ route('author.show', $author->id) }}">
                {{ $author->name }}
              </a>
            </li>
          @endforeach
        @endif
        @if ($entry->genre)
          <li class="search-list-item-info-item">
            {{ $entry->genre->title }}
          </li>
        @endif
        @if ($entry->year)
          <li class="search-list-item-info-item">
            {{ $entry->year }}
          </li>
        @endif
        @foreach ($entry->textsLatest() as $text)
          <li class="search-list-item-info-item">
            <a href="{{ asset($text->path) }}" target="_blank">
              {{ $text->state->title }}
            </a>
          </li>
        @endforeach
      </ul>
    </div>
  </div>
</li>