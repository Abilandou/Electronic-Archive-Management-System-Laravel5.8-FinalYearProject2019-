@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="section">
			<div class="col m1 hide-on-med-and-down">
				@include('snippets.sidebar')
			</div>
			<div class="col m11  hide-on-med-and-down">
				<div class="card-panel teal">
					<h4>Department Name: {{ $department->name }}</h4>
					<div>
						<h4>Department Description</h4>
						<p>
							{{ $department->description }}
						</p>
					</div>
					<div class="divider"></div>
					<div>
						<h4>Faculty Name</h4>
						<p>
							{{ $department->faculty['name'] }}
						<h6>Faculty Description</h6>
						<p>{{ $department->faculty['description'] }}</p>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
