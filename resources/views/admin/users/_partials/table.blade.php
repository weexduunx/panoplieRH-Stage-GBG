<div class="table-responsive">
	<table class="table table-hover  mb-4">
		<thead>
			<tr>
				<th>{{ __('#') }}</th>
				<th>{{ __('Nom & Prénom') }}</th>
				<th>{{ __('Email') }}</th>
				<th>{{ __('Date de la création') }}</th>
				<th>{{ __('Vérifié') }}</th>
				<th>{{ __('Action') }}</th>
			</tr>
		</thead>
		<tbody>
			@forelse($users as $user)
			<tr>
				<td>{{ $user->id }}</td>
				<td>{{ $user->name }}</td>
				<td>{{ $user->email }}</td>
				<td>{{ $user->created_at }}</td>
				<td>
					<span class="badge rounded-pill bg-{{ $user->email_verified_at ? 'success' : 'danger' }}">
						{{ $user->email_verified_at ? __('Verifié') : __('Non vérifié') }}
					</span>
				</td>
				<td>
					{!! actionBtn(route('admin.users.edit', $user->id), 'info', 'edit') !!}
					{!! actionBtn(route('admin.users.delete', $user->id), 'danger', 'trash', ["onclick='del(this)'"]) !!}
				</td>
			</tr>
			@empty
			<tr>
				<td colspan="100%" class="text-center">
					{{ __('No data to display.') }}
				</td>
			</tr>
			@endforelse
		</tbody>
	</table>

	<!-- Delete forms with javascript -->
	<form method="POST" class="d-none" id="delete-form">
		@csrf
		@method("DELETE")
	</form>

	{!! $users->links() !!}
</div>

@push('js')
<script>
	function del(element) {
		event.preventDefault()
		let form = document.getElementById('delete-form');
		form.setAttribute('action', element.getAttribute('href'))
		swalConfirm('Êtes-vous sûr ?', `Vous ne pourrez pas revenir en arrière.`, 'Oui, supprimez-le!', () => {
			form.submit()
		})
	}
</script>
@endpush