@if (count($entries) > 0)
  <ul class="search-list">
    <li class="search-list-item">
      <div class="row">
        <div class="small-2 medium-1 column">
          <mark-all identifier=".search-list-item-check-input"></mark-all>
        </div>
        <div class="small-10 medium-11">
          <h4>
            Alle {{ count($entries) }} Einträge markieren
          </h4>
          <p>Markieren Sie </p>
        </div>
      </div>
    </li>
    <hr>
    @each('search.results.entriesItem', $entries, 'entry')
  </ul>
@else
  <h4>Es wurden keine Einträge zu diesem Suchbegriff gefunden.</h4>
@endif