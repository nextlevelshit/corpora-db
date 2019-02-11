<div class="search-bar">
  <form action="{{ route('search.results') }}" method="get">
    {{--  {{ csrf_field() }}  --}}
    <input name="term" class="" type="text" value="@if (!empty($term)){{ $term }}@endif" autocorrect="off" autocomplete="off">
    <button type="submit" class="button">
      Corpora-Suche
    </button>
  </form>
</div>