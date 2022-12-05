<x-app-layout title="Modification du checklist Group">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                {{ __('Editer le checklist Group') }}
            </h5>
            <div class="row">
                <!-- Basic Layout -->
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Formulaire de modification</h5> 
                            <small class="text-muted float-end">
                                <form action="{{ route('admin.checklist_groups.destroy', $checklistGroup) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                    onclick="return confirm('{{ __('Etes-vous sûr de vouloir supprimer ce checklist group?')}}')">
                                        {{ __('Supprimer ce checklist groupe')}}
                                    </button>
                                </form>
                            </small>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>Le nom a déjà été pris: {{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.checklist_groups.update', $checklistGroup) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="nom">{{ __('Nom') }}</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="nom" value="{{ $checklistGroup->nom }}">
                                    </div>
                                </div>
                                <div class="row justify-content-end">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-sm btn-primary">{{ __('Editer')}}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

</x-app-layout>
