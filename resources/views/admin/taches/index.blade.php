<div class="card mb-4">
    @if ($errors->storetache->any())
        <div class="alert alert-danger alert-dismissible">
            <ul>
                @foreach ($errors->storetache->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
    @endif
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">{{ __('Ajouter une tâche') }}</h5>
        <small class="text-muted float-end">
        </small>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.store', [$checklist]) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label" for="nom">{{ __('Nom') }}</label>
                <div class="input-group input-group-merge">
                    <span id="basic-icon-default-fullname2" class="input-group-text"><i
                            class="bx bx-task"></i></span>
                    <input value="{{ old('nom') }}" type="text" class="form-control"
                        name="nom">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label"
                    for="basic-icon-default-message">{{ __('Description') }}</label>

                <textarea name="description" class="form-control" rows="5" id="tache-textarea">{{ old('description') }}</textarea>
            </div>
            <br>
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="bx bxs-plus-circle"></i>
                {{ __('Ajouter une tâche') }}
            </button>
        </form>
    </div>
</div>