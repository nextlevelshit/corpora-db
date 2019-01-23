@if (count($authors) > 0)
  <ul class="search-list">
    {{--  @each('search.results.entriesItem', $authors, 'author')  --}}
  </ul>
@else
  <h4>Es wurden keine Autoren zu diesem Suchbegriff gefunden.</h4>
@endif