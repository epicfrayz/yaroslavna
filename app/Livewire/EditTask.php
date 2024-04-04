<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Task;

class EditTask extends Component
{

    public Task $task;

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

    
    protected $listeners = ['save'];

    public function render()
    {
        return view('livewire.edit-task');
    }

    public function mount() {
        $this->name = $this->task->name;
        $this->description = $this->task->description;
    }

    public function save() {
        $validatedData = $this->validate();
        
        $this->task->name = $this->name;
        $this->task->description = $this->description;
        $this->task->save();

        $this->dispatch('close-modal');
        $this->dispatch('todo-update');
    }
}
