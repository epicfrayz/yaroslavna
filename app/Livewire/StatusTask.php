<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Task;

class StatusTask extends Component
{
    public Task $task;
    public array $statuses;
    
    protected $listeners = ['updateDataStatus'];

    public function mount() {
        $this->statuses = $this->task->getAllStatuses();
    }

    public function render() {
        // dd( $this->statuses );
        return view('livewire.status-task');
    }

    public function updateDataStatus() {
        $this->statuses = $this->task->getAllStatuses();
    }
}
