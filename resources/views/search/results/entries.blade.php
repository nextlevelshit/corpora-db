@if (count($entries) > 0)
  <ul class="search-list mark-all">
    <li class="search-list-item">
      <div class="row">
        <div class="small-2 medium-1 column">
          <mark-all parent="#entriesList" identifier=".search-list-item-check-input"></mark-all>
        </div>
        <div class="small-10 medium-11 column">
          <h5>
            Alle {{ count($entries) }} Einträge markieren
          </h5>
        </div>
      </div>
    </li>
  </ul>  
  
  <ul class="search-list" id="entriesList">
    @each('search.results.entriesItem', $entries, 'entry')
  </ul>
@else
  <h4>Es wurden keine Einträge zu diesem Suchbegriff gefunden.</h4>
@endif