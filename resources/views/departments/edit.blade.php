@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-sm-1 col-xs-1 col-xl-1 col-md-1">@include('snippets.sidebar')</div>
        <div class="col-sm-1 col-xs-1 col-xl-1 col-md-1"></div>
        <div class="col-sm-8 col-xs-8 col-xl-8 col-md-8 ">
            <h5 class="mt-4"><i><b>Editing...:  </b></i><b class="teal-text">{{ $department->name }}</b></h5>
            @include('snippets.messages')
            <div class="divider"></div>
            <div class="card hoverable mr-4 z-depth-5">
                <form action="{{ url('edit-department/'.$department->id) }} "  class="col-s-12" method="POST">

                    {{ csrf_field() }}
                    <div class="card-content">
                        <div class="input-field">
                            <i class="material-icons prefix">house</i>

                            <input type="text"
                                   name="name"
                                   required
                                   class="validate"
                                   id="department_name"
                                   value="{{ $department->name }}"
                            />
                            <label for="name">Department Name</label>
                        </div>
                        <div class="form-group">
                            <i class="material-icons prefix">view_list</i>
                            <label><b>Department Description(optional)</b></label>
                            <textarea  id="department_desc"
                                       placeholder=" Faculty Description"
                                       name="description"
                                       style="height:150px;"
                            >{{ $department->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Faculty</label>
                            <select name="faculty_id" class="browser-default">
                                <option value="" disabled selected>Choose Faculty</option>
                                @foreach($faculties as $faculty)
                                    <option value="{{ $faculty->id  }}"
                                       @if($faculty->id == $department->faculty_id)
                                        selected
                                        @endif
                                    >{{ $faculty->name  }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn float-right my-2">Save </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-sm-2 col-xs-2 col-xl-2 col-md-2"></div>
    </div>


@endsection
