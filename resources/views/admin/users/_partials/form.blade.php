<form action="{{ $user->id ? route('admin.users.update', $user->id) : route('admin.users.store') }}" method="POST">
	@csrf

	@if($user->id)
	@method("PUT")
	@endif

	<div class="mb-3">
		<x-label for="name" :value="__('Nom')" />
		<x-input type="text" name="name" id="name" :placeholder="__('Nom')" :value="old('name', $user->name)" autofocus />
		<x-invalid error="name" />
	</div>

	<div class="mb-3">
		<x-label for="email" :value="__('Email')" />
		<x-input type="email" name="email" id="email" :placeholder="__('Email')" :value="old('email', $user->email)" />
		<x-invalid error="email" />
	</div>

	@if($user->id)
	<div class="mb-3">
		<x-label for="password" :value="__('Mot de Passe')" />
		<x-input type="password" name="password" id="password" :placeholder="__('Mot de passe')" />
		<x-invalid error="password">
			<small>{{ __('la valeur du champs sera vide si vous ne le remplissez pas.') }}</small>
		</x-invalid>
	</div>

	<div class="mb-3">
		<x-label for="password_confirmation" :value="__('Confirmation Mot de passe')" />
		<x-input type="password" name="password_confirmation" id="password_confirmation" :placeholder="__('Confirmation mot de passe')" />
		<x-invalid error="password_confirmation">
			<small>{{ __('la valeur du champs sera vide si vous ne le remplissez pas.') }}</small>
		</x-invalid>
	</div>
	@else
	<div class="mb-3">
		<x-label for="password" :value="__('Mot de passe')" />
		<x-input type="password" name="password" id="password" :placeholder="__('Mot de passe')" />
		<x-invalid error="password" />
	</div>

	<div class="mb-3">
		<x-label for="password_confirmation" :value="__('Confirmation mot de passe')" />
		<x-input type="password" name="password_confirmation" id="password_confirmation" :placeholder="__('Confirmation mot de passe')" />
		<x-invalid error="password_confirmation" />
	</div>
	@endif

	<div class="text-end">
		<x-button type="submit" class="btn btn-primary" :value="$user->id ? __('Modifier') : __('Ajouter')" />
	</div>
</form>