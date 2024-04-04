<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Task;
use App\Models\Status;
use App\Models\TaskStatus;
use Carbon\Carbon;

class CreateTask extends Component
{
    public string $name;
    public string $description;

    protected $rules = [
        'name' => 'required',
        'description' => 'required'
    ];
    
    protected $messages = [
        'name.required' => 'Поле "Название" обязательное',
        'description.required' => 'Поле "Описание" обязательное'
    ];

    public function render()
    {
        return view('livewire.create-task');
    }

    public function add() {
        $validatedData = $this->validate();

        $task = new Task;
        $task->name = $this->name;
        $task->description = $this->description;
        $task->status_id = Status::OPENED;
        $task->save();
        
        $taskStatus = new TaskStatus;
        $taskStatus->task_id = $task->id;
        $taskStatus->status_id = Status::OPENED;
        $taskStatus->created_at = Carbon::now();
        $taskStatus->updated_at = Carbon::now();
        $taskStatus->save();
        
        $this->dispatch('close-modal', name: 'modal-task-add');
        $this->reset();
        $this->dispatch('todo-update');
    }
}
