@extends('layout')

@section('title', env('APP_NAME')." | ".__('New project'))

@section('content')
	<div class="container">	
		<div class="row">
			<div class="col-12 col-sm-10 col-lg-6 mx-auto">

				@include('errors.validation-errors')

				<form class="bg-white shadow rounded px-3 py-4" method="POST" action="{{ route('projects.store') }}" enctype="multipart/form-data">
					<h1>@lang('Create new project')</h1>
					<hr>
					@include('projects._form', [ 'btnText' => __('Save') ])
				</form>
			</div>
		</div>
	</div>
@endsection