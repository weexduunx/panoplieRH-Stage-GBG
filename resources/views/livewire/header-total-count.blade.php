<div class="row ">
    <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
        <div class="card">
            <div class="row row-bordered g-0">
                <div class="col-sm-9">
                    <div class="card-body">
                        <h5 class="card-title text-primary">{{ __('Revue des tâches') }} </h5>
                        <p class="mb-4">Vous avez fait
                            <span class="fw-bold">---%</span>
                            Plus de tâches aujourd'hui.
                        </p>
                        
                        <div class="row">
                            @foreach ($checklists as $checklist)
                                <div class="col-lg-3 ">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title d-flex align-items-start justify-content-between">
                                                <div class="avatar flex-shrink-0">
                                                    <img src="{{ asset('assets/img/icons/unicons/icons8-tester-96.png') }}"
                                                        alt="Credit Card" class="rounded">
                                                </div>
                                            </div>
                                            <span>{{ $checklist->nom }}</span>
                                            <h3 class="card-title text-nowrap mb-1">
                                                {{ $checklist->user_taches_count }}/{{ $checklist->taches_count }}</h3>
                                            <div class="progress">
                                                @if ($checklist->taches_count > 0)
                                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
                                                        role="progressbar" 
                                                        style="width: {{ $checklist->user_taches_count / $checklist->taches_count * 100 }}%;" 
                                                        aria-valuenow="{{ $checklist->user_taches_count / $checklist->taches_count * 100 }}"
                                                        aria-valuemin="0" aria-valuemax="100">{{ $checklist->user_taches_count / $checklist->taches_count * 100 }}%
                                                    </div>
                                                @else
                                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
                                                        role="progressbar" style="width: 0%;" aria-valuenow="75"
                                                        aria-valuemin="0" aria-valuemax="100">75%
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card-body">
                        <div class="text-center">
                            <h5>Total des tâches et tâches complétes</h5>
                            <small>par groupe de tâches</small>
                        </div>
                    </div>
                    <div class="text-center pt-3 mb-2 fw-bold">
                        <h1>{{ $checklists->sum('user_taches_count') }}/{{ $checklists->sum('taches_count') }}</h1>
                    </div>
                    <div class="text-center fw-semibold pt-3 mb-2">{{ $checklists->sum('user_taches_count') / $checklists->sum('taches_count') * 100}}% des tâches sont complétes</div>

                    {{-- <div class="d-flex px-xxl-4 px-lg-2 p-4 gap-xxl-3 gap-lg-1 gap-3 justify-content-between">
                        <div class="d-flex">
                            <div class="me-2">
                                <span class="badge bg-label-primary p-2"><i
                                        class="bx bx-dollar text-primary"></i></span>
                            </div>
                            <div class="d-flex flex-column">
                                <small>2022</small>
                                <h6 class="mb-0">$32.5k</h6>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="me-2">
                                <span class="badge bg-label-info p-2"><i class="bx bx-wallet text-info"></i></span>
                            </div>
                            <div class="d-flex flex-column">
                                <small>2021</small>
                                <h6 class="mb-0">$41.2k</h6>
                            </div>
                        </div>
                    </div> --}}

                </div>
            </div>
        </div>
    </div>
</div>
