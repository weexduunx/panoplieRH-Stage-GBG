<x-app-layout title="{{ $tache->nom }}">
    <div class="card">

        <div class="card-body">

            <div class="row">
                <!-- Basic Layout -->
                <div class="col-xl-6">
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
                            <h5 class="mb-0">
                                {{ __('Editer :') }} {{ $tache->nom }}
                            </h5>
                            <small class="text-muted float-end">
                                <form
                                    action="{{ route('admin.destroy',  [$checklist, $tache]) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('{{ __('Etes-vous sûr de vouloir supprimer cette tâche?') }}')">
                                        <i class="bx bxs-trash"></i>
                                    </button>
                                </form>
                            </small>
                        </div> 
                        <form
                            action="{{ route('admin.update', [$checklist, $tache]) }}"
                            method="POST">
                            @csrf
                             @method('PUT')
                             <input type="hidden" name="id" value="{{$tache->id}}">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label" for="nom">{{ __('Nom') }}</label>
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                class="bx bx-task"></i></span>
                                        <input value="{{ $tache->nom }}" type="text" class="form-control"
                                            name="nom">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"
                                        for="basic-icon-default-message">{{ __('Description') }}</label>
                                    <textarea name="description" class="form-control" rows="5" id="tache-textarea">{{ $tache->description }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm"  >
                                    <i class="bx bxs-edit"></i>
                                    {{ __('Editer la tâche') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

</x-app-layout>

