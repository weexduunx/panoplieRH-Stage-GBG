
<x-app-layout title="Gestion des Utilisateurs">
	<div class="card">
		<div class="card-body">
			<h5 class="card-title">
				{{ __('Gestion des utilisateurs') }}
			</h5>
			<div class="mb-4">
				<a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm">
					<i class="fa fa-plus"></i>
					{{ __('Ajouter') }}
				</a>
			</div>

			@include('admin.users._partials.table')

		</div>
	</div>
</x-app-layout>