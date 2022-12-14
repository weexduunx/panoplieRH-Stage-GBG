<x-app-layout title="{{ $checklist->nom }}">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <!-- Basic Layout -->
                <div class="col-xl-6">
                    <div class="card mb-4">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                </button>
                            </div>
                        @endif
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">
                                {{ __('Editer :') }} {{ $checklist->nom }}
                            </h5>
                            <small class="text-muted float-end">
                                <form
                                    action="{{ route('admin.checklist_groups.checklists.destroy', [$checklistGroup, $checklist]) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('{{ __('Etes-vous sûr de vouloir supprimer ce checklist du groupe?') }}')">
                                        <i class="bx bxs-trash"></i>
                                    </button>
                                </form>
                            </small>
                        </div>
                        <form
                            action="{{ route('admin.checklist_groups.checklists.update', [$checklistGroup, $checklist]) }}"
                            method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label" for="nom">{{ __('Nom') }}</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bxs-check-circle"></i></span>
                                        <input type="text" class="form-control" name="nom"
                                            value="{{ $checklist->nom }}">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="bx bxs-edit"></i>
                                    {{ __('Editer checklist') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-xl-6">
                    @include('admin.taches.index')
                </div>
            </div>
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            {{ __('Liste des tâches') }}
                        </h5>
                        <div>
                            @livewire('taches-table', ['checklist' => $checklist])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
