<x-app-layout title="Modification">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                {{ __('Modifier') }}
            </h5>

            <div class="mb-4">
                <a href="{{ route('admin.users.index') }}" class="btn btn-dark">
                    {{ __('Retour') }}
                </a>
            </div>

            @include('admin.users._partials.form')

        </div>
    </div>
</x-app-layout>