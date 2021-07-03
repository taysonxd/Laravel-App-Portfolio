@extends('layout')

@section('title', env('APP_NAME')." | ".__('About'))

@section('content')
<div class="container">
	<div class="row">
		<div class="col-12 col-lg-6">
			<img class="img-fluid mb-4" src="/img/about.svg" alt="{{ __('About me') }}">
		</div>
		<div class="col-12 col-lg-6">
			<h1 class="display-4 text-primary">
				@lang('About me')
			</h1>
			<p class="lead text-secondary">
				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat.
			</p>
			<a class="btn btn-lg btn-block btn-primary" href="{{ route('contact') }}">
				@lang('Contact me')
			</a>
			<a class="btn btn-lg btn-block btn-outline-primary" href="{{ route('projects.index')}}">
				@lang('Projects')				
			</a>
		</div>
	</div>
</div>
@endsection