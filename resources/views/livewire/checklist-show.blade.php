<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    {{ $checklist->nom }}
                </h5>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover">
                    <tbody>
                        @foreach ($checklist->taches->where('user_id', null) as $tache)
                            <tr>
                                <td>
                                    <input class="form-check-input me-1" type="checkbox"
                                        wire:click="taches_completes({{ $tache->id }})"
                                        @if (in_array($tache->id, $completed_tasks)) checked="checked" @endif />
                                </td>
                                <td wire:click="toggle_task({{ $tache->id }})">
                                    <i class="fa fa-tasks fa-lg text-primary me-3"></i>
                                    <strong data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top"
                                        data-bs-custom-class="tooltip-primary"
                                        title="Cliquez ici">{{ $tache->nom }}</strong>
                                </td>
                                <td wire:click="toggle_task({{ $tache->id }})">
                                    @if (in_array($tache->id, $opened_tasks))
                                        <i class='bx bx-caret-down-circle'></i>
                                    @else
                                        <i class='bx bx-caret-up-circle'></i>
                                    @endif
                                </td>
                            </tr>
                            @if (in_array($tache->id, $opened_tasks))
                                <tr>
                                    <td colspan="2">
                                        <div class="d-flex p-3 border">
                                            <img src="{{ asset('assets\img\icons8-liste-de-tâches-96.png') }}"
                                                alt="collapse-image" height="96" class="me-4 mb-sm-0 mb-2">
                                            <span>
                                                {!! $tache->description !!}
                                            </span>
                                        </div>

                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
