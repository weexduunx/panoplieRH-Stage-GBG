<x-auth-layout title="Authentification">
	
	<form id="formAuthentication" class="mb-3" action="{{ route('login') }}" method="POST">
		@csrf
		<div class="mb-3">
			<x-label for="email" :value="__('Email')" />
			<x-input type="text" name="email" id="email" :value="old('email')" :placeholder="__('Entrer votre email')" autofocus />
			<x-invalid error="email" />
		</div>
		<div class="mb-3 form-password-toggle">
			<div class="d-flex justify-content-between">
				<x-label for="password" :value="__('Mot de passe')" />
				@if (Route::has('password.request'))
				<a href="{{ route('password.request') }}">
					<small>{{ __('Mot de passe oublié?') }}</small>
				</a>
				@endif
			</div>
			<div class="input-group input-group-merge">
				<x-input type="password" name="password" id="password" :placeholder="__('Mot de passe')" aria-describedby="password" />
				<span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
				<x-invalid error="password" />
			</div>
		</div>
		<div class="mb-3">
			<div class="form-check">
				<input class="form-check-input" type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : ''}} />
				<label class="form-check-label" for="remember">
					{{ __('Souviens-toi de moi') }}
				</label>
			</div>
		</div>
		<div class="mb-3">
			<x-button type="submit" class="btn btn-primary d-grid w-100" :value="__('Se connecter')" onClickDisabled />
		</div>
	</form>

	@if(Route::has('register'))
	<p class="text-center">
		<span>{{ __('Nouveau sur la boîte à outils?') }}</span>
		<a href="{{ route('register') }}">
			<span>{{ __('Créer un compte') }}</span>
		</a>
	</p>
	@endif
</x-auth-layout>