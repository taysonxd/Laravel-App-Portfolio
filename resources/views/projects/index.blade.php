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
			@can('create', $newProject)
				<a class="btn btn-primary" href="{{ route('projects.create') }}">@lang('New project')</a>
			@endcan
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
		@can('view-trashed-projects')
			@isset($deletedProjects)
				<h4 class="mt-4">Proyectos en la papelera de reciclaje</h4>
				<ul class="list-group">
					@foreach($deletedProjects as $deletedProject)
						<li class="list-group-item">
							<span class="lead">{{ $deletedProject->title }}</span>
							@can('restore', $deletedProject)
								<form class="d-inline" method="POST" action="{{ route('projects.restore', $deletedProject) }}">
									@csrf @method('PATCH')
									<button class="btn btn-sm btn-info">
										@lang('Restore')
									</button>
								</form>
							@endcan
							@can('force-delete', $deletedProject)
								<form 
									class="d-inline"
									method="POST"
									action="{{ route('projects.force-delete', $deletedProject) }}"
									onsubmit="return confirm('Esta acción no se puede deshacer, ¿esta seguro de eliminar el proyecto?');"
								>
									@csrf @method('DELETE')
									<button class="btn btn-sm btn-danger">
										@lang('Permanent delete')
									</button>
								</form>
							@endcan
						</li>
					@endforeach
				</ul>
			@endisset
		@endcan
	</div>
@endsection