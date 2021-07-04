@extends('layout')

@section('title', env('APP_NAME')." | ".__('Portfolio'))

@section('content')
	<div class="container">
		<div class="d-flex justify-content-between align-items-center mb-3">
			@isset($category)
				<div>
					<h1 class="display-4 mb-0">{{ $category }}</h1>	
					<a href="{{ route('projects.index') }}">Volver al portafolio</a>
				</div>
			@else
				<h1 class="display-4 mb-0">@lang('Projects')</h1>
			@endisset
			@auth
				<a class="btn btn-primary" href="{{ route('projects.create') }}">@lang('New project')</a>
			@endauth		
		</div>
		<p class="lead text-secondary">
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua.
		</p>
		<ul class="d-flex flex-wrap justify-content-between align-items-start">
			@forelse($projects as $project)
				<div class="card border-0 shadow-sm mt-4 mx-auto" style="width: 18rem">
					@if($project->image)
						<img class="card-img-top" style="height: 150px; object-fit: cover;" src="/storage/{{ $project->image }}" alt="{{ $project->title }}">
					@endif
					<div class="card-body">
						<h5 class="card-title">
							<a href="{{ route('projects.show', $project) }}">{{ $project->title }}</a>
						</h5>
						<h6 class="card-subtitle">{{ $project->created_at->format('d/m/Y') }}</h6>
						<p class="card-text text-truncate">{{ $project->description }}</p>
						<div class="d-flex justify-content-between align-items-center">
							<a class="btn btn-primary btn-sm" href="{{ route('projects.show', $project) }}">
								Ver mas...
							</a>
							@if($project->category_id)
								<a href="{{ route('categories.show', $project->category) }}" class="badge badge-pill badge-secondary">{{ $project->category->name }}</a>
							@endif
						</div>						
					</div>
				</div>
			@empty
				<div class="card">
					<div class="card-body">
						No hay proyectos para mostrar
					</div>
				</div>
			@endforelse
			{{ $projects->links() }}
		</ul>
	</div>
@endsection