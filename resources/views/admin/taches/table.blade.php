<div class="card">
    <div class="card-body">
        <h5 class="card-title">
            {{ __('Liste des tâches') }}
        </h5>
        <div>
            <table class="table table-hover table-responsive">
                <thead>
                    <tr>
                        <th>Nom de la tâche</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($checklist->taches as $tache)
                        <tr>
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
                                    href="{{ route('admin.checklists.taches.edit', [$checklist, $tache]) }}">
                                    <i class="bx bx-edit-alt me-1"></i>
                                    Editer
                                </a>
                                <form style="display: inline-block"
                                    action="{{ route('admin.checklists.taches.destroy', [$checklist, $tache]) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('{{ __('Etes-vous sûr de vouloir supprimer la tâche ?') }}')">
                                        <i class="bx bx-trash me-1"></i>
                                        Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
