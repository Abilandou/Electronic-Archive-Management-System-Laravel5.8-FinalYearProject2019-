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
             <button title="Add New Faculty" class="tooltipped btn" data-toggle="modal" data-target="#addFacModal"><i class="material-icons" >add</i>Add New</button>
         </a>
        </h3>
      </div>
      <div class="divider"></div>
      <div class="card z-depth-2">
        <div class="card-content">
          <table class=" mdl-data-table centered highlight table table-bordered responsive-table" id="myDataTable">
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
{{--                  @if(!$faculty->hasRole('Root'))--}}
                  <tr class="@if($faculty->id % 2 == 0) @else indigo lighten-4 @endif">
                    <td>{{ $faculty->id }}</td>
                    <td>{{ $faculty->name }}</td>
                    <td>{{ Str::limit( $faculty->description, 100) }}</td>
                    <td>
                      <a href="faculty{{ $faculty->id }}" title="View Details" class="tooltipped" data-target="#faculty{{ $faculty->id }}" data-toggle="modal"  data-delay="50" data-tooltip="View Details">
                        <i class="material-icons">visibility</i>
                      </a>
                      <a href="faculties/{{ $faculty->id }}/edit" title="Edit Faculty" class="tooltipped" data-position="right"  data-delay="50" data-tooltip="Edit Faculty" >
                        <i class="material-icons">mode_edit</i>
                      </a>
                      <a href="{{ url('/delete-faculty/'.$faculty->id) }}" id="delnow" title="Delete This Faculty" class="tooltipped" data-position="right"  data-delay="50" data-tooltip="Delete This Faculty" >
                        <i class="material-icons red-text">delete</i>
                      </a>

                    </td>
                  </tr>
{{--                  @endif--}}
                   <div class="modal indigo" id="faculty{{ $faculty->id }}">
                          <header class="modal-header white-text align-center indigo">
                              <h4>Details for: <i>{{ $faculty->name }}</i></h4><br/>
                          </header>
                          <div class=" container-fluid  modal-content">

                              <div class="container">
                                  <b>Name</b>: <h5>{{ $faculty->name }}</h5>
                                  <br />

                                  <b>Description</b>: <p class="text-justify">{{ $faculty->description }}</p><br/>
                                  <b>Departments</b>:
                                  @if(count($faculty->departments->pluck('name')) > 0)
                                      <p class="text-justify">{{ $faculty->departments->pluck('name') }}</p>
                                  @else
                                      <p class="text-justify teal-text">No departments added yet</p>
                                  @endif
                                    <br/>
                                  <b>Faculty Member(s)</b>:
                                  @if(count($faculty->users->pluck('name')) > 0)
                                      <p class="text-justify">{{ $faculty->users->pluck('name') }}</p>
                                  @else
                                      <p class="text-justify teal-text">No Member added yet</p>
                                  @endif
                              </div>
                          </div>
                      </div>
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
{{--        <p class="right">{{$faculties->links('vendor.pagination.materializecss')}}</p>--}}
    </div>
  </div>
</div>

<!-- Modal For Adding Faculty -->

<div class="modal teal" id="addFacModal">
    <header class="modal-header white-text align-center teal">
        <h4 class="modal-header-text">Add Faculty</h4><br/>
    </header>
    <div class=" container-fluid  modal-content">

        <div class="container">
            <form method="post" action="{{ url('faculties') }}" >
                {{ csrf_field() }}
                <div class="input-field">
                    <input type="text"
                       name="name"
                       required
                       id="faculty_name"
                    >
                    <label><b>Faculty Name(required)</b></label>
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
