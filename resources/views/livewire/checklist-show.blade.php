<div class="card">
    <div class="card-header">
        <h5 class="card-title">
            {{ $checklist->nom }}
        </h5>
    </div>
    <div class="card-body table-responsive">
        {{-- <table class="table table-striped">
            @foreach ($checklist->taches as $tache)
                <tr>
                    <td></td>
                    <td  wire:click="toggle_task({{ $tache->id }})">{{ $tache->nom }}</td>
                    <td> <i class="menu-icon tf-icons bx bx-"></i></td>
                </tr>
                @if (in_array($tache->id, $opened_tasks))
                <tr>
                    <td></td>
                    <td colspan="2">{!! $tache->description !!}</td>
                </tr>
                @endif
            @endforeach
        </table> --}}
        <table class="table table-hover">
            <tbody>
                @foreach ($checklist->taches->where('user_id', NULL) as $tache)
                    <tr>
                        <td >
                            <input class="form-check-input me-1" type="checkbox" wire:click="taches_completes({{ $tache->id }})"
                             @if (in_array($tache->id, $completed_tasks)) checked="checked" @endif />
                        </td>
                        <td wire:click="toggle_task({{ $tache->id }})">
                            <i class="fa fa-tasks fa-lg text-primary me-3"></i>
                            <strong>{{ $tache->nom }}</strong>
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
                                    <img src="{{ asset('assets/img/pngwing.png') }}" alt="collapse-image" height="125"
                                        class="me-4 mb-sm-0 mb-2">
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
