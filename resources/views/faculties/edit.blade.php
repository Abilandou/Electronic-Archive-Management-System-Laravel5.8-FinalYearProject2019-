@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-sm-1 col-xs-1 col-xl-1 col-md-1">@include('snippets.sidebar')</div>
    <div class="col-sm-11 col-xs-11 col-xl-11 col-md-11 ">
        <h5 class="mt-4"><i><b>Editing...:  </b></i><b class="teal-text">{{ $faculty->name }}</b></h5>
        <div class="divider"></div>
        <div class="card hoverable mr-4 ">
        <form action="{{ url('edit-faculty/'.$faculty->id) }} "  class="col-s-12" method="POST">

                {{ csrf_field() }}
                <div class="card-content">
                <div class="form-group">
                    <i class="material-icons prefix">house</i>
                    <label for="name">Faculty Name</label>
                    <input type="text"
                        name="name"
                        required
                        class="validate"
                        id="faculty_name"
                        value="{{ $faculty->name }}"
                    />
                </div>
                <div class="form-group">
                    <i class="material-icons prefix">view_list</i>
                    <label><b>Faculty Description(optional)</b></label>
                    <textarea  id="faculty_desc"
                        placeholder=" Faculty Description"
                        name="description"
                        style="height:150px;"
                    >{{ $faculty->description }}</textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn float-right my-2">Save </button>
                </div>
            </div>
            </form>
        </div>
    </div>
  </div>


@endsection
