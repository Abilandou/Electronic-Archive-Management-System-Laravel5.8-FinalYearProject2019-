@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col m12 s12">
				<div class="col m1 s1"></div>
				<div class="col m10 s10">
					@include('snippets.messages')
					<div class="card">
						<div class="card-header card-panel add_user_header">
							Add New System Maintainer
						</div>
						<div class="card-body">
							<div class="card-content">
								<form method="POST" action="{{ url('add-maintainer')  }}">
									@csrf
									<div class="col m10 s10">
										<div class="input-field col m5 s5"><i class="material-icons prefix">person</i>
											<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="name" autofocus>
											<label for="name" >Name</label>
											@error('name')
											<span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
											@enderror
										</div>
										<div class="input-field col m5 s5 right"><i class="material-icons prefix">email</i>
											<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email">
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
											<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
											<label for="password" >Password</label>
											@error('password')
											<span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
											@enderror
										</div>
										<div class="input-field col m5 s5 right"><i class="material-icons prefix">vpn_key</i>
											<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
											<label for="password" >Confirm Password</label>
										</div>
									</div>
									<div class="col m10 s10">
										<div class="form-check col m5 s5 mt-5">
											<label>
												<input type="checkbox" value="1" checked="checked" required name="maintainer" class="is-checked">
												<span>Is a System Maintainer</span>
											</label>
										</div>
									</div>
									<div class="col m10 s10 my-3">
										<div class="form-group">
											<input type="submit" class="btn right " value="Add Maintainer">
										</div>
									</div>

								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="col m1 s1"></div>
			</div>
		</div>
	</div>

@endsection
