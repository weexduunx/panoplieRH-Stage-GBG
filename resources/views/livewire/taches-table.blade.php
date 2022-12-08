<table class="table table-hover table-responsive" >
    <thead>
        <tr>
            <th></th>
            <th></th>
            <th>Nom de la tâche</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($checklist->taches as $tache)
            <tr  >
                <td colspan="2">
                    @if ($tache->position > 1)
                    <a href="#" wire:click.prevent="task_up({{ $tache->id }})">
                        &uarr;
                    </a>
                    @endif 
                    @if ($tache->position < $tache->max('position'))
                    <a href="#" wire:click.prevent="task_down({{ $tache->id }})">
                        &darr;
                    </a> 
                    @endif  
                </td>
                <td><i class="bx bx-task bx-sm  me-3"></i>
                    <strong>
                        {{ $tache->nom }}
                    </strong>
                </td>
                <td>
                    {!! $tache->description !!}
                </td>
                <td>
                    <a class="btn btn-sm btn-secondary"
                        href="{{ route('admin.edit', [$checklist, $tache->id]) }}">
                        <i class="bx bx-edit-alt me-1"></i>

                    </a>
                    <form style="display: inline-block"
                        action="{{ route('admin.destroy', [$checklist, $tache->id]) }}"
                        method="POST">
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