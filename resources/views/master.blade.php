@include('_components.header')

@hasSection('title')
  <div class="margin-large"></div>

  <div class="row">
    <div class="column">
      <h1>@yield('title')</h1>
    </div>
  </div>
@endif

@yield('content')

@include('_components.footer')
