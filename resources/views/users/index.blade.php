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
				@if($single_user->maintainer == '1')
					<h3 class="flow-text"><i class="material-icons">group</i>Faculty's Administrator
						<a  href="{{ url('users/create')  }}" style="margin-left:950px;">
							<button title="Add New Faculty Admin" class="tooltipped btn" data-position="top"  data-delay="50" data-tooltip="Add New User"><i class="material-icons" >add</i>Add New</button>
						</a>
					</h3>
				@else
					<h3 class="flow-text"><i class="material-icons">group</i>Faculty Users
						<button style="margin-left:850px;" title="Add New User To Faculty" class="tooltipped btn" data-target="#facAdminAddUser" data-toggle="modal"><i class="material-icons" >add</i>Add New</button>
					</h3>
				@endif
			</div>
			<div class="divider"></div>
			<div class="card z-depth-2">
				<div class="card-content">
					<table class="striped centered highlight table table-bordered responsive-table" id="myDataTable">
						<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Email</th>
							<th>Department</th>
							<th>Faculty</th>
							<th>Actions</th>
						</tr>
						</thead>
						<tbody>
						@if(count($users) > 0)
							@foreach($users as $user)
								{{--@if(!$user->hasRole('Root')) --}}
								<tr class="@if($user->id % 2 == 0) @else indigo lighten-4 @endif">
									<td>{{ $user->id }}</td>
									<td>{{ $user->name }}</td>
									<td>{{ $user->email }}</td>
									@if($user->is_admin == '1')
										<td>Is a faculty admin</td>
									@else
										<td>{{ $user->department_name['name'] }}</td>
									@endif
									<td>{{ $user->faculty_name['name'] }}</td>
									<td>
										<a href="#userDetail{{$user->id}}" title="View Details" class="tooltipped" data-toggle="modal">
											<i class="material-icons">visibility</i>
										</a>
										<a href="users/{{ $user->id }}/edit" title="Edit Faculty" class="tooltipped" data-position="right"  data-delay="50" data-tooltip="Edit Faculty" >
											<i class="material-icons">mode_edit</i>
										</a>
										@if($user->is_admin != '1')
										<a href="{{ url('/delete-user/'.$user->id) }}" id="delnow" title="Delete This Faculty" class="tooltipped" data-position="right"  data-delay="50" data-tooltip="Delete This Faculty" >
											<i class="material-icons red-text">delete</i>
										</a>
										@endif
									</td>
								</tr>
								<!-- Modal For User Detail -->
								<div class="modal teal" id="userDetail{{$user->id}}">
									<header class="modal-header white-text align-center teal">
										<h4 class="modal-header">Detail Information for: {{ $user->name  }}</h4><br/>
									</header>
									<div class=" container-fluid  modal-content">
										<p><b>Name: </b>{{$user->name}}</p>
										<p class="right"><b>Email: </b>{{$user->email}}</p>
										<p class="right"><b>UserBio: </b>{{$user->userBio}}</p>
										<p class="right"><b>Profile: </b>{{$user->profilePic}}</p>
										<p><b>Status: </b>@if($user->is_admin == '1') Is a faculty Administrator @else User @endif</p>
									</div>
								</div>
							@endforeach
						@else
							<tr>
								<td colspan="4"><h5 class="teal-text">No User has been added Except You</h5></td>
							</tr>
						@endif
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- Modal For Adding User To Faculty -->
<div class="modal teal" id="facAdminAddUser">
	<header class="modal-header white-text align-center teal">
		<h4 class="modal-header-text">Add User To Faculty</h4><br/>
	</header>
	<div class=" container-fluid  modal-content">
		<div class="row">
			<div class="col m12 s12">
				<div class="col m1 s1"></div>
				<div class="col m12 s12">
					<form action="{{ url('/add-fac-user')  }}" method="post">
						{{ csrf_field() }}
						<div class="col m12 s12">
							{{--Value for the faculty id--}}
							<input name="faculty_id" type="hidden"  value="{{ Auth::user()->faculty_id }}" />
							<div class="input-field col m6 s6"><i class="material-icons prefix">person</i>
								<input name="name" required type="text" class="form-control" />
								<label for="name" >Name</label>
							</div>
							<div class="input-field col m6 s6 right"><i class="material-icons prefix">email</i>
								<input name="email" required type="email" class="form-control" />
								<label for="email" >Email</label>
							</div>
						</div>
						<div class="col m12 s12">
							<div class="input-field col m6 s6"><i class="material-icons prefix">vpn_key</i>
								<input name="password" required type="password" class="form-control" />
								<label for="password" >Password</label>
							</div>
							<div class="input-field col m6 s6"><i class="material-icons prefix">vpn_key</i>
								<input name="password_confirmation" required type="password" class="form-control" />
								<label for="password" >Confirm Password</label>
							</div>
						</div>
						<div class="col m12 s12 mb-3">
							<div class="col m6 s6">
								<label>Department</label>
								<select name="department_id" class="browser-default">
									<option value="" disabled selected>Choose Department</option>
									@foreach($departments as $department)
										<option value="{{ $department->id  }}">{{ $department->name  }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-radio mt-5">
							<h5>User Role</h5>
							@foreach($roles as $role)
								<label>
									<input class="browser-default" type="radio"  name="role" value="{{ $role->id }}">
									<span><p>{{ $role->name }}</p></span>
								</label>
							@endforeach
						</div>
						<div class="col m12 s12">
							<div class="form-group">
								<input type="submit" class="btn right " value="submit">
							</div>
						</div>
					</form>
				</div>
				<div class="col m1 s1"></div>
			</div>
		</div>
	</div>
</div>


@endsection
