@extends('layout')

@section('title', env('APP_NAME')." | ".$project->title)

@section('content')
<div class="container">
	<div class="row">
		<div class="col-12 col-sm-10 col-lg-8 mx-auto">
			@if($project->image)
				<img class="card-img-top" style="height: 400px; object-fit: cover;" src="/storage/{{ $project->image }}" alt="{{ $project->title }}">
			@endif
			<div class="bg-light p-5 shadow rounded">
				<h1 class="mb-0">{{ $project->title }}</h1>
				@if($project->category_id)
					<a class="badge badge-pill badge-secondary mb-1" href="{{ route('categories.show', $project->category) }}">{{ $project->category->name }}</a>
				@endif
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
						<form id="deleteProject" class="d-none" method="POST" action="{{ route('projects.destroy', $project) }}">
							@csrf
							@method('DELETE')
						</form>	
					</div>	
				</div>
			</div>
		</div>
	</div>
</div>
@endsection