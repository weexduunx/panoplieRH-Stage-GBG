<x-app-layout title="Ajout d'un groupe de checklist">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                {{ __('Nouveau checklist Group') }}
            </h5>
            <div class="row">
                <!-- Basic Layout -->
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">
                                <i class="bx bx-list-check bx-lg"></i>
                            </h5>
                            <small class="text-muted float-end">Nouveau checklist group</small>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>Le nom a déjà été pris: {{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <form action="{{ route('admin.checklist_groups.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label" for="nom">{{ __('Nom') }}</label>
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                class="bx bx-task"></i></span>
                                        <input value="{{ old('nom') }}" type="text" class="form-control"
                                            name="nom" placeholder="{{ __('ici le nom du checklist group') }}">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="bx bxs-plus-circle"></i>
                                    {{ __('Ajouter un groupe ') }}
                                </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>

</x-app-layout>
