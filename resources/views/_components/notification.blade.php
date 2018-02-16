<div class="callout {{ $class }}">
  <div class="row">
    <div class="column">
      <h3>{{ $title }}</h3>
      @if (count($errors))
        <p>Bitte überprüfen Sie Ihre Eingabe.</p>
      @else
        {!!$slot!!}
      @endif
    </div>
  </div>
</div>
