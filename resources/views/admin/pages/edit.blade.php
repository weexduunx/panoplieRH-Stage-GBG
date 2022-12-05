<x-app-layout title="{{ $page->title }}">
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
                                {{ __('Editer :') }} {{ $page->title }}
                            </h5>
                        </div>
                        <form action="{{ route('admin.pageUpdate', [ $page]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $page->id }}">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label" for="title">{{ __('Titre') }}</label>
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                class="bx bx-task"></i></span>
                                        <input value="{{ $page->title }}" type="text" class="form-control"
                                            name="title">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"
                                        for="content">{{ __('Contenu') }}</label>
                                    <textarea name="content" class="form-control" rows="5" id="tache-textarea">{{ $page->content }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="bx bxs-edit"></i>
                                    {{ __('Editer la page') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
