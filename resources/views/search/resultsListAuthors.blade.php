@if (count($authors) > 0)
  <ul class="search-list">
    @foreach ($authors as $author)
      <li class="search-list-item">
        <div class="row">
          <div class="small-1 column">
            {{-- <label class="search-list-item-check">
              <input type="checkbox" class="search-list-item-check-input" name="authors[]" value="{{ $author->id }}">
              <div class="search-list-item-check-trigger">
                <i class="fa fa-check-square-o"></i>
              </div>
            </label> --}}
          </div>
          <div class="small-11">
            <h4 class="search-list-item-result">
              <a href="{{ route('author.details', $author->id) }}">
                {{ $author->name }}
              </a>
            </h4>
            <ul class="search-list-item-info">
              @if ($author->entries)
                <li class="search-list-item-info-item">
                  {{ count ($author->entries) }} Einträge
                </li>
              @endif
              @if ($author->year)
                <li class="search-list-item-info-item">
                  Geboren {{ $author->year }}
                </li>
              @endif
            </ul>
          </div>
        </div>
      </li>
    @endforeach
  </ul>
@else
  <h4>Es wurden keine Autoren zu diesem Suchbegriff gefunden.</h4>
@endif