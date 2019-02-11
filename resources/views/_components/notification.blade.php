<div class="callout {{ $class }}">
  <div class="row">
    <div class="column medium-8 large-9">
      <h3>{{ $title }}</h3>
      @if (count($errors))
        @if ($errors->has('message'))
          <p>{{ $errors->first('message')}}</p>
        @else
          <p>Bitte überprüfen Sie Ihre Eingabe.</p>
        @endif
      @else
        {!!$slot!!}
      @endif
    </div>
  </div>
</div>
