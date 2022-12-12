<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    {{-- {{ $checklist->nom }} --}}
                    {{ $list_name }}
                </h5>
            </div>
            <div class="card-body table-responsive">
                @if($list_tasks->count())
                <table class="table table-hover">
                    <tbody>
                        @foreach ($list_tasks as $tache)
                            <tr>
                                <td>
                                    <input class="form-check-input me-1" type="checkbox"
                                        wire:click="taches_completes({{ $tache->id }})"
                                        @if (in_array($tache->id, $completed_tasks)) checked="checked" @endif />
                                </td>
                                <td wire:click.prevent="toggle_task({{ $tache->id }})">
                                    <i class="fa fa-tasks fa-lg text-primary me-3"></i>
                                    <strong data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top"
                                        data-bs-custom-class="tooltip-primary"
                                        title="Cliquez ici">{{ $tache->nom }}</strong>
                                        @if (!is_null($list_type))
                                            <div style="font-style: italic; font-size: 11px">
                                                {{ $tache->checklist->nom }}
                                                @if (optional($user_tasks->where('tache_id' , $tache->id)->first())->due_date)
                                                | {{ __('Echéance') }} {{ $user_tasks->where('tache_id', $tache->id)->first()->due_date->format('M d, Y') }}
                                                @endif
                                            </div>
                                            
                                        @endif
                                </td>
                
                                <td>
                                    @if (optional($user_tasks->where('tache_id', $tache->id)->first())->is_important)
                                        <a wire:click.prevent="mark_as_important({{ $tache->id }})" class="bx bxs-star"  href="#">
                                            
                                        </a>
                                    @else
                                        <a wire:click.prevent="mark_as_important({{ $tache->id }})" class="bx bx-star" href="#">
                                           
                                        </a>
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
                @else
                {{ __('Aucune tâche trouvée') }}
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-4">
        @if (!is_null($current_task))
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title m-0 me-2">{{ $current_task->nom }}</h5>
                    <div class="">
                        {{-- <a href="#" class="bx bx-star"></a> --}}
                        @if ($current_task->is_important)
                            <a wire:click.prevent="mark_as_important({{ $current_task->id }})"  class="bx bxs-star"href></a>
                        @else
                            <a wire:click.prevent="mark_as_important({{ $current_task->id }})"  class="bx bx-star"href></a>  
                        @endif
                    </div>
                  </div>
            </div>
            <br>
            <div class="card">
                <div class="card-body">
                    &#9788;
                    &nbsp;
                    @if ($current_task->added_to_my_day_at)
                        <a href="#"
                            wire:click.prevent="add_to_my_day({{ $current_task->id }})">{{ __('Supprimer de ma journée') }}</a>
                    @else
                        <a href="#"
                            wire:click.prevent="add_to_my_day({{ $current_task->id }})">{{ __('Ajouter dans ma journée') }}</a>
                    @endif
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-body">
                    &#9993;
                    &nbsp;
                    <a href="#">{{ __('Me rappeler') }}</a>
                    <hr />
                    &#9745;
                    &nbsp;
                    @if ($current_task->due_date)
                    Echeance {{ $current_task->due_date->format('M j, Y') }}
                        &nbsp;&nbsp;
                        <a href="#" wire:click.prevent="set_due_date({{ $current_task->id }})">{{ __('Supprimer') }}</a>
                        @else
                        <a href="#" wire:click.prevent="toggle_due_date">{{ __('Ajouter une date d\'échéance') }}</a>
                        @if ($due_date_opened)
                        <ul class="timeline">
                            <li class="timeline-item timeline-item-transparent">
                              <span class="timeline-point timeline-point-primary"></span>
                              <div class="timeline-event">
                                <div class="timeline-header mb-1">
                                    <a href="#" wire:click.prevent="set_due_date({{ $current_task->id }}, '{{ today()->toDateString() }}')">
                                        <h6 class="mb-0">{{ __('Aujourd\'hui') }}</h6>
                                    </a>
                                </div>
                              </div>
                            </li>
                            <li class="timeline-item timeline-item-transparent">
                              <span class="timeline-point timeline-point-warning"></span>
                              <div class="timeline-event">
                                <div class="timeline-header mb-1">
                                    <a href="#" wire:click.prevent="set_due_date({{ $current_task->id }}, '{{ today()->addDay()->toDateString() }}')">
                                        <h6 class="mb-0">{{ __('Demain') }}</h6>
                                    </a>
                                </div>
                              </div>
                            </li>
                            <li class="timeline-item timeline-item-transparent">
                              <span class="timeline-point timeline-point-info"></span>
                              <div class="timeline-event">
                                <div class="timeline-header mb-1">
                                    <a href="#" wire:click.prevent="set_due_date({{ $current_task->id }}, '{{ today()->addWeek()->startOfWeek()->toDateString() }}')">
                                        <h6 class="mb-0">{{ __('Semaine Prochaine') }}</h6>
                                    </a>
                                </div>
                              </div>
                            </li>
                            <li class="timeline-item timeline-item-transparent">
                                <span class="timeline-point timeline-point-info"></span>
                                <div class="timeline-event">
                                  <div class="timeline-header mb-1">
                                    <h6 class="mb-0">{{ __('Choisir une Date') }}</h6>
                                  </div>
                                  <div class="d-flex">
                                   <input wire:model="due_date" class="form-control" type="date"  id="html5-date-input" name="picker_date">
                                  </div>
                                </div>
                              </li>
                          </ul>  
                        @endif
                    @endif
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-body">
                    &#9998;
                    &nbsp;
                    {{-- <a href="#">{{ __('Note') }}</a> --}}
                        @if($current_task->note)
                            <a href="#" wire:click.prevent="toggle_note">{{ __('Note') }}</a>
                            @if (!$note_opened)
                            <p>
                                {{ $current_task->note }}
                                <br>
                                <a href="#" wire:click.prevent="toggle_note">{{ __('Modifier') }}</a>
                            </p>
                            @endif
                            @else
                            <a href="#" wire:click.prevent="toggle_note">{{ __('Note') }}</a>
                        @endif
                        @if ($note_opened)
                            <div >
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-message2" class="input-group-text"><i class="bx bx-comment"></i></span>
                                    <textarea wire:model="note" id="basic-icon-default-message" class="form-control" rows="5"></textarea>
                                  </div>
                            </div> 
                            <br> 
                            <div class="justify-content-end">
                                <div class="col-sm-10">
                                  <button type="submit" wire:click="save_note" class="btn btn-primary">{{ __('Sauvegarder') }}</button>
                                </div>
                              </div>  
                        @endif
                </div>
            </div>
        @endif
    </div>
</div>
