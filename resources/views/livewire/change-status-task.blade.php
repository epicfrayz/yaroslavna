<div>
	<div class="pb-3">
		
		<b>Задача: {{ $task->name }}</b>
		<hr>

		<fieldset>
			<div class="form-check">
				<input 
					type="radio" 
					name="status" 
					wire:model.live="status" 
					value="2" 
					id="status2" 
					{{ ($currentStatus == 2) ? ' checked ' : ''}} 
					/>
				<label class="form-check-label" for="status2">Выполнена</label>
			</div>
			<div class="form-check"> 
				<input 
					type="radio" 
					name="status" 
					wire:model.live="status" 
					value="1" 
					id="status1" {{ ($currentStatus == 1) ? 'checked' : ''}}
					/>
				<label class="form-check-label" for="status1">Открыта</label>
			</div>
		</fieldset>

	</div>
    <button type="button" class="btn btn-primary" x-on:click="$dispatch('saveChangeStatus')">Сохранить</button>
    <button type="button" class="btn btn-secondary" x-on:click="$dispatch('close-modal', {name: 'modal-task-edit'})">Закрыть</button>

</div>
