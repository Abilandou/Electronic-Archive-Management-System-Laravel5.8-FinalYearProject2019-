@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-sm-1 col-xs-1 col-xl-1 col-md-1">@include('snippets.sidebar')</div>
    <div class="col-sm-8 col-xs-8 col-xl-8 col-md-8 ">
        <h5 class="mt-4">Add Department</h5>
        <div class="divider"></div>
        <div class="card hoverable mr-4 ">
            <form action="{{ url('/add-department') }}" method="post" id="dept-form" >
                {{ csrf_field() }}
                <div class="form-group col-4" >
                    <label>Name</label>
                    <input name="name" type="text" class="form-control" >
                </div>
                <div class="input-field col-4" >
                    <label>Faculty</label>
                    <select name="faculty_id" class="browser-default">
                        <option class="disabled" >Select Faculty for this department</option>
                        <option></option>
                    </select>
                </div>

                <div class="form-group" >
                    <label>Description</label>
                    <textarea class="textarea" name="description"></textarea>
                </div>

                <div class="form-group ">
                  <button type="submit" class="btn float-right">Add </button>
                </div>
              </form>
        </div>
    </div>
    <div class="col-sm-3 col-xs-3 col-xl-3 col-md-3"></div>
  </div>
@endsection
