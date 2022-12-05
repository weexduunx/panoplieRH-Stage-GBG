<x-app-layout title="Ajout d'un Checklist">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                {{ __('Ajout d\'un checklist dans') }} {{ $checklistGroup->nom }}
            </h5>
            <div class="row">
                <!-- Basic Layout -->
                <div class="col-xl-6">
                    <div class="card mb-4">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">
                                <i class="bx bx-check-circle bx-lg"></i>
                            </h5>
                            <small class="text-muted float-end">
                                Nouveau checklist
                            </small>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.checklist_groups.checklists.store', $checklistGroup) }}"
                                method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label" for="nom">{{ __('Nom') }}</label>
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                class="bx bx-task"></i></span>
                                        <input value="{{ old('nom') }}" type="text" class="form-control" name="nom"
                                        placeholder="{{ __('ici le nom du checklist') }}">
                                        
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="bx bxs-check"></i>
                                    {{ __('Ajouter un checklist') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</x-app-layout>
