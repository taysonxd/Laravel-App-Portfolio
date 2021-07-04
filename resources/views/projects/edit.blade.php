@extends('layout')

@section('title', env('APP_NAME')." | ".__('Project edit'))

@section('content')
<div class="container">
	<div class="col-12 col-sm-10 col-lg-8 mx-auto">

		@include('errors.validation-errors')

		<form class="bg-white shadow rounded py-3 px-4" enctype="multipart/form-data" method="POST" action="{{ route('projects.update', $project) }}">
			@method('PUT')
			<h1>@lang('Edit the project')</h1>
			<hr>
			@include('projects._form', [ 'btnText' => __('Update') ])
		</form>
	</div>
</div>
@endsection