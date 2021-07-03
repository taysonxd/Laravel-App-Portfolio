@extends('layout')

@section('title', env('APP_NAME')." | ".__('Contact us'))

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-12 col-sm-10 col-lg-6 mx-auto">
				<form class="bg-white shadow rounded px-3 py-4" method="POST" action="{{ route('contact.store') }}">
					@csrf
					<h1 class="display-4">@lang("Contact")</h1>
					<hr>
					<div class="form-group">
						<label for="name">@lang('Name')</label>
						<input 
							id="name"
							class="form-control bg-light shadow-sm @error('name') is-invalid @else border-0 @enderror"
							type="text"
							name="name"
							placeholder="{{ __('Name') }}..."
							value="{{ old('name') }}">
						@error('name')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="form-group">
						<label for="email">@lang('Email')</label>
						<input 
							id="email"
							class="form-control bg-light shadow-sm @error('email') is-invalid @else border-0 @enderror"
							type="email"
							name="email"
							placeholder="{{ __('Email') }}..."
							value="{{ old('email') }}">
						@error('email')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="form-group">
						<label for="subject">@lang('Subject')</label>
						<input
							id="subject"
							class="form-control bg-light shadow-sm @error('subject') is-invalid @else border-0 @enderror"
							type="text"
							name="subject"
							placeholder="{{ __('Subject') }}..."
							value="{{ old('subject') }}">
						@error('subject')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="form-group">
						<label for="message">@lang('Message')</label>
						<textarea
							id="message"
							class="form-control bg-light shadow-sm @error('message') is-invalid @else border-0 @enderror"
							name="message"
							placeholder="{{ __('Message') }}...">
								{{ old('message') }}
						</textarea>
						@error('message')
							<span class="invalid-feedback" role="alert">
								<strong>$message</strong>
							</span>
						@enderror
					</div>
					<button class="btn btn-primary btn-lg btn-block">@lang('Send message')</button>
				</form>	
			</div>
		</div>
	</div>
@endsection