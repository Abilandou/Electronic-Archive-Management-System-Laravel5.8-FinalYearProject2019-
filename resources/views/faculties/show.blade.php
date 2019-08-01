@extends('layouts.app')

@section('content')
<div class="row">
  <div class="section">
    <div class="col m1 hide-on-med-and-down">
      @include('snippets.sidebar')
    </div>
    <div class="col m11  hide-on-med-and-down">
        <div class="card-panel teal">
        <h4>Name: {{ $faculty->name }}</h4>
        <div>
            <h4>Description</h4>
            <p>
                {{ $faculty->description }}
            </p>
        </div>
        </div>
    </div>
  </div>
</div>
@endsection
