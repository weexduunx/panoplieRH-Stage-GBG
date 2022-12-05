<x-auth-layout title="Mot de passe oublié">
	<h4 class="mb-2">
		{{ __('Mot de passe oublié? 🔒') }}
	</h4>
	<p class="mb-4">
		{{ __("Entrez votre e-mail et nous vous enverrons des instructions pour réinitialiser votre mot de passe") }}
	</p>

	<form id="formAuthentication" class="mb-3" action="{{ route('password.email') }}" method="POST">
		@csrf
		<div class="mb-3">
			<x-label for="email" :value="__('Email')" />
			<x-input type="email" name="email" id="email" :placeholder="__('Entrer votre Email')" :value="old('email')" autofocus />
			<x-invalid error="email" />
		</div>
		<x-button type="submit" class="btn btn-primary d-grid w-100" :value="__('Envoyer un lien de réinitialisation')" onClickDisabled />
	</form>

	<div class="text-center">
		<a href="{{ route('login') }}" class="d-flex align-items-center justify-content-center">
			<i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
			{{ __('Retour à la page de connexion') }}
		</a>
	</div>
</x-auth-layout>