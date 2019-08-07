@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col m12 s12">
			<div class="col m1 s1"></div>
			<div class="col m10 s10">
				<div class="card">
					<div class="card-panel card-header add_user_header ">
						Add New Faculty Administrator
					</div>
					<div class="card-content">
						<form action="{{ url('users')  }}" method="post">
							{{ csrf_field() }}
							<div class="col m10 s10">
								<div class="input-field col m5 s5"><i class="material-icons prefix">person</i>
									<input name="name" required type="text" class="form-control">
									<label for="name" >Name</label>
								</div>
								<div class="input-field col m5 s5 right"><i class="material-icons prefix">email</i>
									<input name="email" required type="email" class="form-control" >
									<label for="email" >Email</label>
								</div>
							</div>
							<div class="col m10 s10">
								<div class="input-field col m5 s5"><i class="material-icons prefix">vpn_key</i>
									<input name="password" required type="password" class="form-control">
									<label for="password" >Password</label>
								</div>
								<div class="input-field col m5 s5 right"><i class="material-icons prefix">vpn_key</i>
									<input name="password_confirmation" required type="password" class="form-control">
									<label for="password" >Confirm Password</label>
								</div>
							</div>
							<div class="col m10 s10">
								<div class="col m5 s5"><i class="material-icons prefix">house</i>
									<label>Faculty</label>
									<select name="faculty_id" class="browser-default">
										<option value="" disabled selected>Choose Faculty</option>
										@foreach($faculties as $faculty)
											<option value="{{ $faculty->id  }}">{{ $faculty->name  }}</option>
										@endforeach
									</select>
								</div>
								<div class="form-check col m5 s5 right mt-5">
									<label>
										<input type="checkbox" value="1" checked="checked" required name="is_admin" class="is-checked">
										<span>Is a Faculty Administrator</span>
									</label>
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