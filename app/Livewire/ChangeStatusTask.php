<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Task;
use App\Models\TaskStatus;
use Carbon\Carbon;

class ChangeStatusTask extends Component
{

    public Task $task;
    public int $currentStatus;
    public $status;

    protected $listeners = ['saveChangeStatus'];

    public function render()
    {
        return view('livewire.change-status-task');
    }

    public function mount() {
        $this->currentStatus = $this->task->status_id;
    }

    public function saveChangeStatus() {
        $base_task = Task::find($this->task->id);
        $base_task->status_id = $this->status;
        $base_task->save();

        $taskStatus = new TaskStatus;
        $taskStatus->task_id = $this->task->id;
        $taskStatus->status_id = $this->status;
        $taskStatus->created_at = Carbon::now();
        $taskStatus->updated_at = Carbon::now();
        $taskStatus->save();

        
        $this->dispatch('updateDataStatus');
        $this->dispatch('close-modal');
        $this->dispatch('todo-update');
    }
}
