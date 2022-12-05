<table class="table table-hover table-responsive" wire:sortable="updateTaskOrder" >
    <thead>
        <tr>
            <th>Nom de la tâche</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($checklist->taches as $tache)
            <tr wire:sortable.item="{{ $tache->id }}" wire:key="task-{{ $tache->id }}" >
                <td><i class="bx bx-task bx-sm  me-3"></i>
                    <strong>
                        {{ $tache->nom }}
                    </strong>
                </td>
                <td>
                    {{ $tache->description }}
                </td>
                <td>
                    <a  class="btn btn-sm btn-secondary" href="{{ route('admin.edit', [$checklist, $tache]) }}">
                        <i class="bx bx-edit me-1"></i>
                    </a>
                <form style="display: inline-block"
                    action="{{ route('admin.destroy', [$checklist, $tache]) }}"  method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm"
                        onclick="return confirm('{{ __('Etes-vous sûr de vouloir supprimer la tâche ?') }}')">
                        <i class="bx bx-trash me-1"></i>
                    </button>
                </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>