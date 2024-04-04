<div>
    <b>Задача: {{ $task->name }}</b>
    <hr>

    <div class="input-group mb-3">
        <input class="form-control @error('name') is-invalid @enderror" type="text" value="{{ $name }}" wire:model.live="name" >
		@error('name')
			<div class="invalid-feedback">{{ $message }}</div>
		@enderror
    </div>

    <div class="input-group mb-3">
        <textarea class="form-control @error('description') is-invalid @enderror" cols="30" rows="10" wire:model.live="description">{{ $task->description }}</textarea>
		@error('description')
			<div class="invalid-feedback">{{ $message }}</div>
		@enderror
    </div>
    

    <button type="button" class="btn btn-primary" x-on:click="$dispatch('save')">Сохранить</button>
    <button type="button" class="btn btn-secondary" x-on:click="$dispatch('close-modal', {name: 'modal-task-edit'})">Закрыть</button>
</div>
