@extends('layouts.app')

@section('content')
<div class="row">
  <div class="section">

    <div class="col m1 hide-on-med-and-down">
      @include('snippets.sidebar')
    </div>
    <div class="col m11 s12">
        @include('snippets.messages')
      <div class="row">

        <h3 class="flow-text"><i class="material-icons">house</i>Faculties
          <a  href="#" style="margin-left:900px;">
             <button id="trigger" title="Add New Faculty" class="tooltipped btn" data-position="top"  data-delay="50" data-tooltip="Add New Faculty"><i class="material-icons" >add</i>Add New</button>
         </a>
        </h3>
      </div>
      <div class="divider"></div>
      <div class="card z-depth-2">
        <div class="card-content">
          <table class="bordered striped centered highlight" id="myDataTable">
            <thead>
              <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @if(count($faculties) > 0)
                @foreach($faculties as $faculty)
                  {{--@if(!$faculty->hasRole('Root')) --}}
                  <tr class="@if($faculty->id % 2 == 0) @else indigo lighten-4 @endif">
                    <td>{{ $faculty->id }}</td>
                    <td>{{ $faculty->name }}</td>
                    <td>{{ str_limit( $faculty->description, 100) }}</td>
                    <td>
                      <a href="faculties/{{$faculty->id}}" title="View Details" class="tooltipped" data-position="right"  data-delay="50" data-tooltip="View Details">
                        <i class="material-icons">visibility</i>
                      </a>
                      <a href="faculties/{{ $faculty->id }}/edit" title="Edit Faculty" class="tooltipped" data-position="right"  data-delay="50" data-tooltip="Edit Faculty" >
                        <i class="material-icons">mode_edit</i>
                      </a>
                      <a href="{{ url('/delete-faculty/'.$faculty->id) }}" id="delnow" title="Delete This Faculty" class="tooltipped" data-position="right"  data-delay="50" data-tooltip="Delete This Faculty" >
                        <i class="material-icons">delete</i>
                      </a>

                    </td>
                  </tr>
                  {{--@endif--}}
                @endforeach
              @else
                <tr>
                  <td colspan="4"><h5 class="teal-text">No Faculty has been added</h5></td>
                </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal For Adding Faculty -->

<div class="modal teal">
    <header class="modal-header white-text align-center teal">
        <h4 class="modal-header-text">Add Faculty</h4><br/>
    </header>
    <div class=" container-fluid  modal-content">

        <div class="container">
            <form method="post" action="{{ url('faculties') }}" >
                {{ csrf_field() }}
                <div class="form-group">
                    <label><b>Faculty Name(required)</b></label>
                    <input type="text"
                       placeholder="Enter Faculty Name"
                       name="name"
                       required
                       id="faculty_name"
                    >
                </div>
                <div class="form-group">
                    <label><b>Faculty Description(optional)</b></label>
                    <textarea  placeholder=" Faculty Description"
                       name="description"
                       id="faculty_desc"
                       class="textarea"
                    >
                    </textarea>
                </div>
                <div class="form-group ">
                    <button type="submit"
                            class=" text-lighten-4 float-right btn mb-3 ">
                        <i class="material-icons" >add</i>Add
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
