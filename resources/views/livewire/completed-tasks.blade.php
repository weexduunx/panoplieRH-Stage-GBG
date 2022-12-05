<div class="card ">
    <div class="card-body justify-content-center">
        <h2>Tâches complétes</h2>

        <p class="card-separator"></p>
        
        <ul class="task-list">
            @foreach($tasks as $key => $task)
                <div x-data="{ open: false }">
                    <li @click="open = true" class="task">
                        <span class="badge rounded-pill bg-success"><i class="fas fa-check"></i></span>
                        - {{ $task->description }}
                        <span class="task-completed-date">(Terminée le: {{$task->completed_at}})</span>
                    </li>

                    <ul x-show.transition.in.duration.150ms="open" @click.away="open = false" x-cloak>
                        <li wire:click="returnTask({{$task->id}})" @click="open = false" class="task-buttons">
                            <span class="badge rounded-pill bg-warning"> <i class="fas fa-undo-alt"></i></span>
                           
                        </li>
                        <li wire:click="deleteTask({{$task->id}})" @click="open = false" class="task-buttons">
                            <span class="badge rounded-pill bg-danger"><i class="fas fa-trash-alt"></i></span>
                            
                        </li>
                    </ul>
                </div>
            @endforeach
        </ul>
    </div>
</div>

<style>
    [x-cloak] { display: none; }
</style>
