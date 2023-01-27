<x-app-layout title="Liste des Evenements">
	<div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                {{-- <div class="card-header">
                    {{ __('Liste des évenements') }}
                </div> --}}
                <div class="d-flex align-items-end row">
                    <div class="col-sm-12">
                        <div class="card-body">
                            <h5 class="card-title text-primary">{{ __('Liste des évenements') }}</h5>
                            <ul class="list-group list-group-flush">
                                @forelse ($events as $event)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>{{ $event->name }}</strong><br>
                                            <span class="text-muted">
                                                @if ($event->allday)
                                                    {{ $event->started_at->format('l jS F Y') }}
                                                    (all day)
                                                @else
                                                    {{ $event->started_at->format('l jS F Y \a\t H:i') }}
                                                    ({{ $event->duration }})
                                                @endif
                                            </span>
                                        </div>
                                        <span
                                            class="badge badge-pill" 
                                            style="background-color: {{ $event->calendar->color }};"
                                        >
                                            {{ $event->calendar->name }}
                                        </span>
                                    </li>
                                @empty
                                    <li class="list-group-item">
                                        Aucun évènement..
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
