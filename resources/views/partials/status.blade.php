@if(session('status'))
	<div class="alert alert-primary text-center alert-dismissible fade show">
		<h4 class="mb-0">{{ session('status') }}</h4>
		<button
			type="button"
			class="close"
			data-dismiss="alert"
			aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
@endif