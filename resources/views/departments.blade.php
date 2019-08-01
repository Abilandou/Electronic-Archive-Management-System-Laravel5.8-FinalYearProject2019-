@extends('layouts.app')

@section('content')
<div class="row">
  <div class="section">
    <div class="col m1 hide-on-med-and-down">
      @include('snippets.sidebar')
    </div>
    <div class="col m11 s12">
      <div class="row">
        <h3 class="flow-text"><i class="material-icons">group</i> Departments
          <a href="{{ url('/add-department') }}" ><button  class="btn modal-trigger right">Add New</button>
        </h3>
        <div class="divider"></div>
      </div>
      <div class="card z-depth-2">
        <div class="card-content">
          <table class="bordered centered highlight" id="myDataTable">
            <thead>
              <tr>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Faculty</th>
                  <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @if(count($departments) > 0)
                @foreach($departments as $department)
                  {{--@if(!$department->hasRole('Root')) --}}
                  <tr>
                    <td>{{ $department->name }}</td>
                    <td>{{ $department->description }}</td>
                    <td>{{ $department->faculty_id }}</td>


                    <td>

                      <a href="#" class="left"><i class="material-icons">visibility</i></a>
                      <a href="/departments/{{ $department->id }}/edit" class="center"><i class="material-icons">mode_edit</i></a>
                      <a href="" class="right data-delete" data-form="departments-{{ $department->id }}"><i class="material-icons">delete</i></a>

                    </td>
                  </tr>
                  {{--@endif--}}
                @endforeach
              @else
                <tr>
                  <td colspan="4"><h5 class="teal-text">No department has been added</h5></td>
                </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
