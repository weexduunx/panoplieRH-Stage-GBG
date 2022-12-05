<div class="card">
    <div class="card-body">
        <h2>Créer une tâche</h2>
        <p class="card-separator"></p>
        @error('description') <span class="error">- {{ $message }}</span> @enderror

        <form  wire:submit.prevent="submit">
            <div class="input-group mb-3">
                <input wire:model="description" type="text" class="form-control" placeholder="par ici.." aria-label="Recipient's username" aria-describedby="button-addon2">
                <button class="btn btn-outline-primary" >Ajouter</button>
              </div>
        </form>

    </div>
</div>
