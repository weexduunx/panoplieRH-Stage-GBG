<x-app-layout title="Gestion des checklists">
	<div class="card">
		<div class="card-header">
			<h5 class="card-title">
				{{ $checklist->nom }}
			</h5>
		</div>
		<div class="card-body">
			<table class="table">
				@foreach ($checklist->taches as $tache )
					<tr>
						<td></td>
						<td class="task-description-toggle" data-id="{{ $tache->id }}">{{ $tache->nom }}</td>
						<td> <i class="menu-icon tf-icons bx bx-"></i></td>
					</tr>
					<tr class="d-none" id="task-description-{{ $tache->id }}">
						<td></td>
						<td colspan="2">{!! $tache->description !!}</td>
					</tr>
				@endforeach
			</table>
		</div>
	</div>

</x-app-layout>
