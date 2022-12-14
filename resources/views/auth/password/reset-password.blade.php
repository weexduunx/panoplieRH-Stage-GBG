<x-auth-layout title="Réinitialiser le mot de passe">
	<h4 class="mb-2">
		{{ __('réinitialisez votre mot de passe') }}
	</h4>
	<p class="mb-4">
		{{ __('Vous n\'êtes qu\'à une étape d\'une voie de votre nouveau mot de passe, récupérez votre mot de passe maintenant.') }}
	</p>

	<form id="formAuthentication" class="mb-3" action="{{ route('password.update') }}" method="POST">
		@csrf

		<x-input type="hidden" name="token" id="token" :placeholder="__('Token')" :value="$request->route('token')" />

		<div class="mb-3">
			<x-label for="email" :value="__('Email')" />
			<x-input type="email" name="email" id="email" :placeholder="__('Entrer votre Email')" :value="old('email', $request->email)" autofocus />
			<x-invalid error="email" />
		</div>

		<div class="mb-3 form-password-toggle">
			<div class="d-flex justify-content-between">
				<x-label for="password" :value="__('Password')" />
			</div>
			<div class="input-group input-group-merge">
				<x-input type="password" name="password" id="password" :placeholder="__('Mot de passe')" aria-describedby="password" />
				<span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
				<x-invalid error="password" />
			</div>
		</div>

		<div class="mb-3 form-password-toggle">
			<div class="d-flex justify-content-between">
				<x-label for="password_confirmation" :value="__('Password confirmation')" />
			</div>
			<div class="input-group input-group-merge">
				<x-input type="password" name="password_confirmation" id="password_confirmation" :placeholder="__('Password confirmation')" aria-describedby="password" />
				<span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
				<x-invalid error="password_confirmation" />
			</div>
		</div>

		<x-button type="submit" class="btn btn-primary d-grid w-100" :value="__('Reset password')" onClickDisabled />
	</form>

	<div class="text-center">
		<a href="{{ route('login') }}" class="d-flex align-items-center justify-content-center">
			<i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
			{{ __('Back to login') }}
		</a>
	</div>

</x-auth-layout>