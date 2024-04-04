<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Task;
use App\Models\TaskStatus;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\JoinClause;
use Livewire\WithPagination;
use App\Http\Filters\TaskFilter;

class ToDo extends Component
{

    use WithPagination;

    public array $tasks;
    public Task $selectedTask;
    public $filterStatus;

    private $pagination;
    private const MAX_COUNT_PAGINATE = 3;


    public function mount() {
        $this->getItems();
    }
    
    public function render() {

        if ( $this->filterStatus ) {
            $this->getItems(['status' => $this->filterStatus]);
        } else {
            $this->getItems();
        }
        

        return view('livewire.to-do', ['base_tasks' => $this->pagination])->extends('layouts.app');
    }

    public function updating($property, $value) {
        if ($property === 'filterStatus') {
            $this->getItems(['status' => $value]);
        }
    }

    

    

    public function getItems(array $requestFilter = []) {
        $this->tasks = [];

        // \DB::enableQueryLog();
        $filter = app()->make(TaskFilter::class, ['queryParams' => array_filter($requestFilter)]);
        $this->pagination = Task::filter( $filter )->paginate( self::MAX_COUNT_PAGINATE );
        // dd(\DB::getQueryLog());

        foreach ($this->pagination as $key => $task) {
            $this->tasks[] = $task->toArray();
        }
    }

    public function selectTask($id) {
        $task = Task::find( $id );
        $this->selectedTask = $task;
    }

    public function edit($idTask) {
        $this->selectTask($idTask);
        $this->dispatch('open-modal', name: 'modal-task-edit');
    }

    public function statuses($idTask) {
        $this->selectTask($idTask);
        $this->dispatch('open-modal', name: 'modal-task-statuses');
    }

    public function changeStatus($idTask) {
        $this->selectTask($idTask);
        $this->dispatch('open-modal', name: 'modal-task-change-status');
    }

    #[On('todo-update')]
    public function update() {
        $this->getItems();
    }

    public function delete($id) {

        $task = Task::find( $id );
        $task->taskStatus()->delete();
        $task->delete();

        $this->getItems();

    }

    
}
