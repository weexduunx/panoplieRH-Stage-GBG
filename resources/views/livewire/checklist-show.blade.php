<div class="row">
    <div class="col-md-8">
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
    <div class="col-md-4">
        @if(!is_null($current_task))
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="m-2">
                            <a href="#">&star;</a>
                        </div>
                        <div class="d-flex flex-column">
                            <small>{{ $current_task->id }}</small>
                            <h4 class="mb-0">{{ $current_task->nom }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-body">
                    &#9788;
                    &nbsp;
                    @if ($current_task->added_to_my_day_at)
                    <a href="#" wire:click.prevent="add_to_my_day({{  $current_task->id  }})">{{ __('Supprimer de ma journée') }}</a>
                    @else
                    <a href="#" wire:click.prevent="add_to_my_day({{  $current_task->id  }})">{{ __('Ajouter dans ma journée') }}</a>
                    @endif
                </div>  
            </div>
            <br>
            <div class="card">
                <div class="card-body">
                    &#9993;
                    &nbsp;
                    <a href="#" >{{ __('Me rappeler') }}</a>
                    <hr />
                    &#9745;
                    &nbsp;
                    <a href="#">{{ __('Ajouter une date d\'échéance') }}</a>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-body">
                    &#9998;
                    &nbsp;
                    <a href="#">{{ __('Note') }}</a>
                </div>
            </div>
        @endif
    </div>
</div>
