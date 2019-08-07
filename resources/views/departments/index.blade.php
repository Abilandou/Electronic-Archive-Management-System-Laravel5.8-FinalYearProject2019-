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

                    <h3 class="flow-text"><i class="material-icons">house</i>Departments
                        <a  href="#" style="margin-left:900px;">
                            <button title="Add New Department" class="tooltipped btn" data-toggle="modal" data-target="#addDeptModal" ><i class="material-icons" >add</i>Add New</button>
                        </a>
                    </h3>
                </div>
                <div class="divider"></div>
                <div class="card z-depth-2">
                    <div class="card-content">
                        <table class="bordered striped centered highlight responsive-table table-bordered table" id="myDataTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Faculty</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($departments) > 0)
                                @foreach($departments as $sec => $department)
                                    {{--@if(!$department->hasRole('Root')) --}}
                                    <tr class="@if($department->id % 2 == 0) @else indigo lighten-4 @endif">
                                        <td>{{ $department->id }}</td>
                                        <td>{{ $department->name }}</td>
                                        <td>
                                            {{ $department->faculty['name'] }}
                                        </td>
                                        <td>{{ str_limit( $department->description, 100) }}</td>
                                        <td>
                                             <a href="department{{ $department->id }}" title="View Details" class="tooltipped" data-target="#department{{ $department->id }}" data-toggle="modal"  data-delay="50" data-tooltip="View Details">
                                                <i class="material-icons">visibility</i>
                                            </a>
                                            <a href="departments/{{ $department->id }}/edit" title="Edit Department" class="tooltipped" data-position="right"  data-delay="50" data-tooltip="Edit Department" >
                                                <i class="material-icons">mode_edit</i>
                                            </a>
                                            <a href="{{ url('/delete-department/'.$department->id) }}" id="delnow" title="Delete This Department" class="tooltipped" data-position="right"  data-delay="50" data-tooltip="Delete This Department" >
                                                <i class="material-icons red-text">delete</i>
                                            </a>

                                        </td>
                                    </tr>
                                    <div class="modal indigo" id="department{{ $department->id }}">
                                      <header class="modal-header white-text align-center indigo">
                                          <h4>Details for: <i>{{ $department->name }}</i></h4><br/>
                                      </header>
                                      <div class=" container-fluid  modal-content">

                                          <div class="container">
                                              <b>Name</b>: <h5>{{ $department->name }}</h5>
                                              <br />

                                              <b>Description</b>: <p class="text-justify">{{ $department->description }}</p>
                                              <br />

                                              <b class="text-underline">Faculty Name</b>: <h6>{{ $department->faculty_name['name'] }}</h6>
                                          </div>
                                      </div>
                                    </div>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4"><h5 class="teal-text">No Department has been added</h5></td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <p class="right">{{$departments->links('vendor.pagination.materializecss')}}</p>
            </div>
        </div>
    </div>

    <!-- Modal For Adding Department -->

    <div class="modal teal" id="addDeptModal">
        <header class="modal-header white-text align-center teal">
            <h4 class="modal-header-text">Add Department</h4><br/>
        </header>
        <div class=" container-fluid  modal-content">

            <div class="container">
                <form method="post" action="{{ url('departments') }}" >
                    {{ csrf_field() }}
                    <div class="input-field">
                        <input type="text"
                               name="name"
                               required
                               id="department_name"
                        >
                        <label><b>Department Name(required)</b></label>
                    </div>
                    <div class="form-group">
                        <label><b>Department Description(optional)</b></label>
                        <textarea  placeholder=" Faculty Description"
                                   name="description"
                                   id="department_desc"
                                   class="textarea"
                        >
                    </textarea>
                    </div>
                    <div class="form-group">
                        <label>Faculty</label>
                        <select name="faculty_id" class="browser-default">
                            <option value="" disabled selected>Choose Faculty</option>
                            @foreach($faculties as $faculty)
                            <option value="{{ $faculty->id  }}">{{ $faculty->name  }}</option>
                             @endforeach
                        </select>
                    </div>

                    <div class="form-group ">
                        <button type="submit"
                                class=" text-lighten-4 float-right btn mb-3 ">
                            <i class="material-icons modal-close" >add</i>Add
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
