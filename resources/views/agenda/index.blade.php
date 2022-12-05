<x-app-layout title="Agenda">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                {{ __('Plannificateur') }}
            </h5>

            {{-- <div class="mb-4">
				<a href="" class="btn btn-primary">
					{{ __('Create new') }}
				</a>
			</div> --}}
            <livewire:agenda/>
        </div>
    </div>
</x-app-layout>
