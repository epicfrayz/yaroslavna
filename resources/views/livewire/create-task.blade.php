<form wire:submit.prevent="add">

	<div class="mb-3">
		<label for="todo-task-create-name" class="form-label">Название задачи</label>
		<input type="text" class="form-control @error('name') is-invalid @enderror" id="todo-task-create-name" wire:model="name">
		@error('name')
			<div class="invalid-feedback">{{ $message }}</div>
		@enderror
	</div>

	<div class="mb-3">
		<label for="todo-task-create-description" class="form-label">Название задачи</label>
		<textarea class="form-control @error('description') is-invalid @enderror"  id="todo-task-create-description" cols="30" rows="10" wire:model="description"></textarea>
		@error('description')
			<div class="invalid-feedback">{{ $message }}</div>
		@enderror
	</div>

	<div>
		<button type="submit" class="btn btn-primary">Добавить</button>
	</div>

</form>