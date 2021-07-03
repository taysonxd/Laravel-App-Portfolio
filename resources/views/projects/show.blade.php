@extends('layout')

@section('title', env('APP_NAME')." | ".$project->title)

@section('content')
<div class="container">
	<div class="bg-light p-5 shadow rounded">
		<h1>{{ $project->title }}</h1>
		<p class="text-secondary">
			{{ $project->description }}
		</p>
		<p class="text-black-50">
			{{ $project->created_at->diffForHumans() }}
		</p>
		<div class="d-flex justify-content-between align-items-center">
			<a href="{{ route('projects.index') }}">Volver</a>
			<div class="btn-group btn-group-sm">
				@auth
					<a class="btn btn-primary" href="{{ route('projects.edit', $project) }}">
						@lang('Edit')
					</a>
					<a class="btn btn-danger" href="#" onclick="document.getElementById('deleteProject').submit();">
						@lang('Delete')
					</a>
				@endauth
				<form class="d-none" method="POST" action="{{ route('projects.destroy', $project) }}">
					@csrf
					@method('DELETE')
				</form>	
			</div>	
		</div>
	</div>
</div>
@endsection