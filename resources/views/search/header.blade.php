<div>
  <div class="logo text-center">Corpora<span>DB</span></div>
</div>
<div class="row">
  <div class="column">
    <form action="{{ route('search.results') }}" method="post">
      {{ csrf_field() }}
      <div class="text-center">
        <input name="term" type="text" value="@if (!empty($search['term'])){{ $search['term'] }}@endif" autocorrect="off" autocomplete="off">
      </div>
      @if (!empty($results))
        <p class="text-center">{{ $results }} Suchergebnisse für <strong>„{{ $search['term'] }}“</strong></p>
      @else
        <p class="text-center">
          <small><strong>Tipp!</strong> Suchen Sie nach <i>Titeln</i>, <i>Erscheinungsjahren</i>, <i>Autor*innen</i> oder sogar nach <i>Textstellen</i> innerhalb der importierten Textdateien.</small>
        </p>
      @endif
      <div class="text-center">
        {{--  <a data-tooltip aria-haspopup="true" class="button large hollow" data-disable-hover="true" tabindex="2" title="">
          <i class="fa fa-question-circle"></i>
        </a>  --}}
        <button type="submit" class="button large">
          Corpora-Suche
        </button>
      </div>
    </form>
  </div>
</div>