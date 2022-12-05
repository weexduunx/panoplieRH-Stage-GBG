<x-auth-layout title="S'inscrire">

	<form id="formAuthentication" class="mb-3" action="{{ route('register') }}" method="POST">
		@csrf
		<div class="mb-3">
			<x-label for="name" :value="__('Nom')" />
			<x-input type="text" name="name" id="name" :placeholder="__('Nom')" :value="old('name')" autofocus />
			<x-invalid error="name" />
		</div>
		<div class="mb-3">
			<x-label for="email" :value="__('Email')" />
			<x-input type="email" name="email" id="email" :placeholder="__('Email')" :value="old('email')" />
			<x-invalid error="email" />
		</div>
		<div class="mb-3">
			<x-label for="website" :value="__('Site Web')" />
			<x-input type="text" name="website" id="website" :placeholder="__('Site web')" :value="old('website')" autofocus />
			<x-invalid error="website" />
		</div>
		<div class="mb-3 form-password-toggle">
			<div class="d-flex justify-content-between">
				<x-label for="password" :value="__('Mot de passe')" />
			</div>
			<div class="input-group input-group-merge">
				<x-input type="password" name="password" id="password" :placeholder="__('Mot de passe')" aria-describedby="password" />
				<span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
				<x-invalid error="password" />
			</div>
		</div>
		<div class="mb-3 form-password-toggle">
			<div class="d-flex justify-content-between">
				<x-label for="password_confirmation" :value="__('Confirmation mot de passe')" />
			</div>
			<div class="input-group input-group-merge">
				<x-input type="password" name="password_confirmation" id="password_confirmation" :placeholder="__('Password confirmation')" aria-describedby="password" />
				<span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
				<x-invalid error="password_confirmation" />
			</div>
		</div>
		<div class="mb-3">
			<div class="form-check">
				<input class="form-check-input @error('terms') is-invalid @enderror" type="checkbox" id="terms-conditions" name="terms" {{ old('terms') ? 'checked' : '' }}>
				<label class="form-check-label" for="terms-conditions">
					{{ __('J\'accepte la') }}
					<a href="javascript:void(0);">{{ __('politique et les termes de confidentialité') }}</a>
				</label>
				<x-invalid error="terms" />
			</div>
		</div>
		<div class="mb-3">
			<x-button type="submit" class="btn btn-primary d-grid w-100" :value="__('S\'inscrire')" onClickDisabled />
		</div>

		@if(Route::has('login'))
		<p class="text-center">
			<span>{{ __('Vous avez déjà un compte?') }}</span>
			<a href="{{ route('login') }}">
				<span>{{ __('Connectez-vous') }}</span>
			</a>
		</p>
		@endif
	</form>
</x-auth-layout>