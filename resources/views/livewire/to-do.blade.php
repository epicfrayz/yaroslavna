<section class="container">
	<div class="row justify-content-center">
		<div class="col-10" @created="$refresh">

			<div class="py-4">
				<button type="button" class="btn btn-primary" x-data x-on:click.prevent="$dispatch('open-modal', {name: 'modal-task-add'})">Добавить задачу</button>
			</div>
			

			<h1>Список задача:</h1>

			<div class="mb-3">
				<span>Фильтр по статусу:</span>
				<select class="form-select" wire:model.live="filterStatus">
					<option selected value='0'>Все</option>
					@foreach (\App\Models\Status::all() as $state)
						<option value="{{ $state->id }}">{{ $state->name }}</option>
					@endforeach
				</select>
			</div>

			@foreach($tasks as $task)
				<div class="border mb-3 p-2" wire:key="{{ $task['id'] }}">
					<div class="row">
						<div class="col-8">
							@if ( isset($task['status_id']) )
								<div>
									Статус:
									@if ( $task['status_id'] == 1 )
										<span class="badge bg-primary">Открыта</span>
									@elseif ( $task['status_id'] == 2 )
										<span class="badge bg-success">Выполнена</span>
									@endif
								</div>
							@endif
							<b>{{ $task['name'] }}</b>
							<p>{{ $task['description'] }}</p>
						</div>
						<div class="col-4">
							<div class="d-grid">
								<button class="btn btn-primary mb-2" type="button" wire:click.prevent="statuses({{ $task['id'] }})">История статусов</button>

								<button class="btn btn-primary mb-2" type="button" wire:click.prevent="changeStatus({{ $task['id'] }})">Сменить статус</button>
								<button class="btn btn-danger mb-2" type="submit" wire:click.prevent="delete({{ $task['id'] }})">Удалить</button>
								<button class="btn btn-primary" type="button" wire:click.prevent="edit({{ $task['id'] }})">Редактировать</button>
							</div>
						</div>
					</div>
				</div>
				
			@endforeach

			@if ( $base_tasks )
			{{ $base_tasks->links() }}
			@endif

		</div>
	</div>
	
	@if ( $selectedTask )
		<x-modal name="modal-task-edit" title="Редактирование задачи">
			<x-slot:body>
				@livewire(EditTask::class, ['task' => $selectedTask], key($selectedTask->id))
			</x-slot>
		</x-modal>
		<x-modal name="modal-task-statuses" title="История статусов">
			<x-slot:body>
				@livewire(StatusTask::class, ['task' => $selectedTask])
			</x-slot>
		</x-modal>
		<x-modal name="modal-task-change-status" title="Смена статуса">
			<x-slot:body>
				@livewire(ChangeStatusTask::class, ['task' => $selectedTask])
			</x-slot>
		</x-modal>
	@endif
	<x-modal name="modal-task-add" title="Создание задачи">
		<x-slot:body>
			@livewire(CreateTask::class)
		</x-slot>
	</x-modal>


</section>


