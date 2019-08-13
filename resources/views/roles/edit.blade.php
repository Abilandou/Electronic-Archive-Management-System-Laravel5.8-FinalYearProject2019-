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
							Editing Role:  {{ $single_role->name  }}
						</div>
						<div class="card-content">
							<form action="/edit-role/{{ $single_role->id }}" method="post">
								{{ csrf_field() }}
								<div class="col m10 s10">
									<div class="input-field col m5 s5"><i class="material-icons prefix">person</i>
										<input name="name" required type="text" value="{{ $single_role->name }}" class="form-control @error('name') is-invalid @enderror">
										<label for="name" >Name</label>
										@error('name')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>
								</div>
								<div class="col m10 s10">
									<h5>Assign Permission(s) To This Role</h5>
									<div class="form-check">

										@foreach($permissions as $permission)
											<label>
												<input class="browser-default" type="checkbox" name="permissions[]" value="{{ $permission->id }}">
												<span><p>{{ ucfirst($permission->name) }}</p></span>
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