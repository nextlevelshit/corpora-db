@extends('master')

@section('content')
  <div class="margin-large">
    <div class="logo text-center">Corpora<span>DB</span></div>
  </div>

  <div class="row align-center">
    <div class="column medium-8">
      @include('search.bar')
    </div>
  </div>
@endsection
