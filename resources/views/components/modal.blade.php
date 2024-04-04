<!-- Modal -->
@props(['name', 'title'])
<div 
	class="modal-task" 
	x-data="{ show : false, name: '{{ $name }}' }"
	x-show="show"
	x-on:open-modal.window="console.log($event.detail);console.log(name);show = ($event.detail.name === name)"
	x-on:close-modal.window="show = false"
	>
	<div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
                <h5 class="modal-title">{{ $title }}</h5>
                <button type="button" class="btn-close" x-on:click="$dispatch('close-modal')"></button>
			</div>

			<div class="modal-body">
                {{ $body }}
			</div>
		</div>
	</div>
</div>