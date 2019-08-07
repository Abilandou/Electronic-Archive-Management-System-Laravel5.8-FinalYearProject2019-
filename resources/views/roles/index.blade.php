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
          <h3 class="flow-text"><i class="material-icons">assignment_ind</i> Roles &amp; Permissions</h3>
          <div class="divider"></div>
        </div>
        <div class="row">
          <div class="col m8 s12">
            <div class="card z-depth-2 hoverable">
              <div class="card-content">
                <h5 class="indigo-text">Roles + Permissions</h5>
                <table class="responsive-table table striped table-bordered highlight centered">
                  <thead>
                  <tr>
                    <th>Role</th>
                    <th>Permissions</th>
                    <th></th>
                  </tr>
                  </thead>

                  <tbody>
                  @if(count($roles) > 0)
                    @foreach($roles as $role)
                      <tr>
                        <td>{{ $role->name }}</td>
                        
                         <td></td>
                         
                       </tr>
                    @endforeach
                  @endif
                  </tbody>
                </table>
              </div>
            </div>
            <!-- ====================== -->
            <div class="row">
              <div class="card col m5 s12 z-depth-2 indigo lighten-1">
                <div class="card-content">
                  <h5 class="white-text">Notice</h5>
                  <p class="grey-text text-lighten-2">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo velit alias, veniam mollitia tenetur molestiae amet soluta distinctio laboriosam nobis. Impedit ab perspiciatis, debitis, modi ipsam obcaecati accusamus porro voluptate.
                  </p>
                </div>
              </div>
              <div class="col m7 s12">
                <div class="card z-depth-2 hoverable">
                  <div class="card-content">
                    <h5 class="indigo-text">Roles
                    <button  title="Add New Role" data-toggle="modal" data-target="#addRoleModal" class="btn right tooltipped indigo mb-3"><i class="material-icons" >add</i>Add</button>
                    </h5>

                    <table class="striped highlight table-bordered table centered responsive-table">
                      <thead>
                      <tr>
                        <th>ID.</th>
                        <th>Role</th>
                        <th>Action</th>
                      </tr>
                      </thead>

                      <tbody>
                      @if(count($roles) > 0)
                        @foreach($roles as $role)
                          <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                              <a href="roles/{{ $role->id }}/edit" title="Edit role" class="tooltipped" data-position="right"  data-delay="50" data-tooltip="Edit role" >
                                <i class="material-icons">mode_edit</i>
                              </a>
                              <a href="{{ url('/delete-role/'.$role->id) }}" id="delnow" title="Delete This role" class="tooltipped" data-position="right"  data-delay="50" data-tooltip="Delete This role" >
                                <i class="material-icons red-text">delete</i>
                              </a>

                    </td>
                          </tr>
                        @endforeach
                      @else
                        <tr>
                          <p class="teal-text">No Role Added Yet</p>
                        </tr>
                      @endif
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- ===================================================== -->
          <div class="col m4 s12">
            <div class="card z-depth-2 hoverable">
              <div class="card-content">
                <h5 class="indigo-text">Permissions
                    <button id="permadd" data-toggle="modal" data-target="#addPermModal" title="Add New Permission" class="btn right tooltipped indigo mb-3"><i class="material-icons" >add</i>Add</button>
                  
                </h5>
                <table class="striped highlight table table-bordered centered responsive-table">
                  <thead>
                  <tr>
                    <th>ID.</th>
                    <th>Permission</th>
                    <th>Action</th>
                  </tr>
                  </thead>

                  <tbody>
                  @if(count($permissions) > 0)
                    @foreach($permissions as  $permission)
                      <tr>
                        <td>{{ $permission->id }}</td>
                        <td>{{ $permission->name }}</td>
                        <td>
                        <a href="#" data-target="#permEdit{{ $permission->id }}" data-toggle="modal" title="Edit permission" class="tooltipped" data-position="right"  data-delay="50" data-tooltip="Edit permission" >
                          <i class="material-icons">mode_edit</i>
                        </a>
                        <a href="{{ url('/delete-permission/'.$permission->id) }}" id="delnow" title="Delete This permission" class="tooltipped" data-position="right"  data-delay="50" data-tooltip="Delete This permission" >
                          <i class="material-icons red-text">delete</i>
                        </a>

                    </td>
                      </tr>
                     
                    @endforeach
                  @else
                    <tr>
                      <p class="teal-text">No Permission Added yet</p>
                    </tr>
                  @endif
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<!-- Modal For Adding New Role -->

<div class="modal indigo" id="addRoleModal">
    <header class="modal-header white-text align-center indigo">
        <h4 class="modal-header-text">Add New Role With Permission(s)</h4><br/>
    </header>
    <div class=" container-fluid  modal-content">

        <div class="container">
            <form method="post" action="{{ url('roles') }}" >
                {{ csrf_field() }}
                <div class="input-field">
                    <input type="text"
                       name="name"
                       required
                       id="role_name"
                    >
                    <label><b>Role Name(required)</b></label>
                </div>
                <h5>Role's Permission(s)</h5>
                <div class="form-check">
                    
                    @foreach($permissions as $perm)
                    <label>
                    <input class="browser-default" type="checkbox" name="permissions[]" value="{{ $perm->id }}">
                            <span><p>{{ ucfirst($perm->name) }}</p></span>
                     </label>
                    @endforeach
                    
                  
                </div>
                <div class="form-group ">
                    <button type="submit"
                            class=" text-lighten-4 float-right btn mb-3 ">
                        <i class="material-icons" >add</i>Add Role
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- Modal For Adding New Permission -->

<div class="modal indigo perm" id="addPermModal">
    <header class="modal-header white-text align-center indigo">
        <h4 class="modal-header-text">Add New Permission</h4><br/>
    </header>
    <div class=" container-fluid  modal-content">

        <div class="container">
            <form method="post" action="{{ url('permissions') }}" >
                {{ csrf_field() }}
                <div class="input-field">
                    <input type="text"
                       name="name"
                       required
                       id="role_name"
                    >
                    <label><b>Permission Name(required)</b></label>
                </div>
                <input type="hidden" name="guard_name" value="web">
                <div class="form-group ">
                    <button type="submit"
                            class=" text-lighten-4 float-right btn mb-3 ">
                        <i class="material-icons" >add</i>Add Permission
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


 

@endsection
