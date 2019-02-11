@if (count($texts) > 0)
  <ul class="search-list">
    @foreach ($texts as $text)
      <li class="search-list-item">
        {{--  <div class="row">
          <div class="small-2 medium-1 column">
            <label class="search-list-item-check">
              <input type="checkbox" class="search-list-item-check-input" name="texts[]" value="{{ $text->id }}">
              <div class="search-list-item-check-trigger">
                <i class="fa fa-check-square-o"></i>
              </div>
            </label>
          </div>
          <div class="small-10 medium-11">  --}}
            <h4 class="search-list-item-result">
              <a href="{{ route('entry.show', $text->entry->id) }}" target="_blank">
                {{ $text->entry->title }}
              </a>
            </h4>
            <ul class="search-list-item-info">
              @if ($text->entry)
                <li class="search-list-item-info-item">
                  Download: <a href="{{ $text->path }}" target="_blank">
                    {{ $text->path }}
                  </a>
                </li>
              @endif
            </ul>
            @if ($text->result)
              {{-- <p>{{ str_limit($text->result, $limit=320, $end='...') }}</p> --}}
              <p>
                {!! str_replace($term, '<mark>'.$term.'</mark>', $text->result) !!}
              </p>
            @endif
          {{--  </div>
        </div>  --}}
      </li>
    @endforeach
  </ul>
@else
  <h4>Es wurden keine Texte zu diesem Suchbegriff gefunden.</h4>
@endif
