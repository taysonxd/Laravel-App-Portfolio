@csrf
<div class="custom-file">
  <input name="image" type="file" class="custom-file-input" id="customFile">
  <label class="custom-file-label" for="customFile">Choose file</label>
</div>
<div class="form-group">
	<label for="title">
		@lang('Project title')
	</label>
	<input 
		id="title"
		class="form-control bg-light shadow-sm border-0"
		type="text"
		name="title"
		placeholder="{{ __('Project title')}}"
		value="{{ old('title', $project->title) }}">
</div>
<div class="form-group">
	<label>
		URL
	</label>
	<input
		type="text"
		class="form-control bg-light shadow-sm border-0"
		name="slug"
		placeholder="URL..."
		value="{{ old('slug', $project->slug) }}">
</div>
<div class="form-group">
	<label>
		@lang('Description')<br>
	</label>
	<textarea
		name="description"
		class="form-control bg-light shadow-sm border-0"
		placeholder="{{ __('Project description') }}">{{ old('description', $project->description) }}</textarea>
</div>
<button class="btn btn-primary btn-block">{{ $btnText }}</button>
<a class="btn btn-link btn-block" href="{{ route('projects.index') }}">Cancelar</a>