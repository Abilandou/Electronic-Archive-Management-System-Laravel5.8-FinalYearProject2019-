@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col m12 s12">
			<div class="col m1 s1"></div>
			<div class="col m10 s10">
				@include('snippets.messages')
				<div class="card">
					<div class="card-panel card-header add_user_header ">
						Editing:  {{ $user->name  }}
					</div>
					<div class="card-content">
						<form action="/edit-fac-user/{{ $user->id }}" method="post">
							{{ csrf_field() }}
							<div class="col m10 s10">
								<div class="input-field col m5 s5"><i class="material-icons prefix">person</i>
									<input name="name" required type="text" value="{{ $user->name }}" class="form-control @error('name') is-invalid @enderror">
									<label for="name" >Name</label>
									@error('name')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>
								<div class="input-field col m5 s5 right"><i class="material-icons prefix">email</i>
									<input name="email" value="{{ $user->email }}" required type="email" class="form-control  @error('email') is-invalid @enderror" >
									<label for="email" >Email</label>
									@error('email')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>
							</div>
							<div class="col m10 s10">
								<div class="input-field col m5 s5"><i class="material-icons prefix">vpn_key</i>
									<input name="password" type="password" class="form-control  @error('password') is-invalid @enderror">
									<label for="password" >Password</label>
									@error('password')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>
								<div class="input-field col m5 s5 right"><i class="material-icons prefix">vpn_key</i>
									<input name="password_confirmation" type="password" class="form-control">
									<label for="password" >Confirm Password</label>
								</div>
							</div>
							<div class="col m10 s10">
								<div class="col m5 s5"><i class="material-icons prefix">group</i>
									<label>Department</label>
									<select name="department_id" class="browser-default">
										<option value="" disabled selected>Choose Department</option>
										@foreach($departments as $department)
											<option value="{{ $department->id  }}"
												@if($department->id == $user->department_id)
													selected
											    @endif
											>{{ $department->name  }}</option>
										@endforeach
									</select>
								</div>
								<div class="form-check ml-5 col m5 s5 right">
									<h5><b>User Role</b></h5>
									@foreach($roles as $role)
										<label>
											<input class="browser-default" type="checkbox"  name="roles[]" value="{{ $role->id }}">
											<span><p>{{ $role->name }}</p></span>
										</label>
									@endforeach
								</div>
							</div>
							<div class="col m10 s10 my-3">
								<div class="form-group">
									<input type="submit" class="btn right " value="submit">
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col m1 s1"></div>
		</div>
	</div>
</div>

@endsection