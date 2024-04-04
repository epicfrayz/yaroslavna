<div>
	<b>Задача: {{ $task->name }}</b>
	<hr>
	@foreach($statuses as $index => $status)
		@if ( $status['status_id'] == 1 )
			<div class="alert alert-primary" role="alert">#{{ ($index + 1) }}: Открыта - {{ $status['created_at'] }}</div>
		@elseif ( $status['status_id'] == 2 )
			<div class="alert alert-success" role="alert">#{{ ($index + 1) }}: Выполнена - {{ $status['created_at'] }}</div>
		@endif
	@endforeach
</div>
