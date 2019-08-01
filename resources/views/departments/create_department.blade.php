@extends('layouts.app')

@section('content')
<div class="row">
  <div class="section">
    <div class="col m1 hide-on-med-and-down">
      @include('snippets.sidebar')
    </div>
    <div class="col m11 s12">
      <div class="row">
        <div class="divider"></div>
      </div>

      <div class="row">
        <div class="col m8 s12">
          <div class="card hoverable">
            <div class="card-content">
              <form action="{{ url('/add-department') }}" method="post" id="dept-form" >
                {{ csrf_field() }}
                <div class="form-group">
                    <label><b>Department Name</b></label>
                    <input type="text" placeholder="Enter Department Name" name="name" id="dept_name">
                </div>

                <div class="form-group">
                    <label><b>Department Description(optional)</b></label>
                    <textarea  placeholder=" Department Description" name="description" id="dept_desc"></textarea>
                </div>

                <div class="input-field">
                <select>
                <option value="" disabled selected>Choose your option</option>
                <option value="1">Option 1</option>
                <option value="2">Option 2</option>
                <option value="3">Option 3</option>
                </select>
                <label>Materialize Select</label>
                
                </div>

                <div class="form-group ">
                  <button type="submit" class="btn float-right">Add </button>
                </div>
              </form>
            </div>
        </div>
        </div>
        <div class="col m4 hide-on-med-and-down">
          <div class="card-panel teal">
            <h4>Notice</h4>
            <p>
              <ul>
                <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</li>
              </ul>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
