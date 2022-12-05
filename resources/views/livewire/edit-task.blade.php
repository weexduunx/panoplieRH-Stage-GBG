<div>
    @if(! empty($task))
        <div class="card">
            <div class="card-body">
                <h1>Modifier la tâche</h1>

                @error('description') <span class="error">- {{ $message }}</span> @enderror
                <form class="" wire:submit.prevent="submit">
                    <div class="input-group mb-3">
                        <input wire:model="description" type="text" class="form-control" placeholder="par ici.." aria-label="" aria-describedby="button-addon2">
                        <button class="btn btn-outline-primary" >Modifier</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
