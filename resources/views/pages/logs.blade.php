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


					<h3 class="flow-text"><i class="material-icons">view_list</i>User's Activities
						<a  href="{{ url('logDel') }}" style="margin-left:900px;">
							<button title="Add New Faculty" class="tooltipped btn" data-toggle="modal" data-target="#addFacModal"><i class="material-icons" >add</i>clear all</button>
						</a>
					</h3>
				</div>
				<div class="divider"></div>
				<div class="row">
{{--					@if(count($logs > 0))--}}
						@foreach($logs as $key => $log)
							<div class="card horizontal hoverable blue-grey darken-1">
								<div class="card-content white-text">
									<div class="col s3">
										<h4 class="center yellow-text z-depth-5">{{ $log->id }}</h4>{{--_  {{ ++$key }} --}}
										<br>
										<blockquote>{{ $log->created_at->toDayDateTimeString() }}</blockquote>
									</div>
									<div class="col s9">
										<blockquote>
											<ul>
												<li>Subject => {{ $log->subject }}</li>
												<li>URL => {{ $log->url }}</li>
												<li>Method => {{ $log->method }}</li>
												<li>IP => {{ $log->ip }}</li>
												<li>Agent => {{ $log->agent }}</li>
												<li>User ID => {{ $log->user_id }}</li>
											</ul>
										</blockquote>
									</div>
								</div>
							</div>
{{--							<p class="right">{{$logs->links('vendor.pagination.materializecss')}}</p>--}}
						@endforeach
{{--						@else--}}
{{--						<div class="card-panel blue-grey">--}}
{{--							<p class="flow-text white-text">--}}
{{--								No Logs have been recorded yet ...--}}
{{--							</p>--}}
{{--						</div>--}}
{{--					@endif--}}

				</div>

				{{--        <p class="right">{{$faculties->links('vendor.pagination.materializecss')}}</p>--}}
			</div>
		</div>
	</div>



@endsection
