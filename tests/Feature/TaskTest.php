<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Livewire\Livewire;
use App\Livewire\CreateTask;
use App\Livewire\EditTask;
use App\Models\Task;
use App\Livewire\ChangeStatusTask;
use App\Livewire\ToDo;




class TaskTest extends TestCase
{
    public function test_create_task() {
        Livewire::test(CreateTask::class)
            ->set('name', 'задача')
            ->set('description', 'описание')
            ->call('add')
            ->assertViewHas('name', NULL)
            ->assertViewHas('description', NULL)
            ->assertDispatched('todo-update');
    }

    public function test_update_task() {
        $task = new Task;
        $task->name = 'Задача';
        $task->description = 'Описание';
        $task->status_id = 1;

        Livewire::test(EditTask::class, ['task' => $task])
            ->assertHasNoErrors('name')
            ->assertHasNoErrors('description')
            ->call('save')
            ->assertDispatched('close-modal')
            ->assertDispatched('todo-update');
    }

    public function test_delete_task() {
        $task = new Task;
        $task->name = 'Задача';
        $task->description = 'Описание';
        $task->status_id = 1;

        Livewire::test(ToDo::class, ['task' => $task])
            ->call('delete', 1);
    }

    public function test_change_status_task() {
        $task = new Task;
        $task->name = 'Задача';
        $task->description = 'Описание';
        $task->status_id = 1;
        $task->save();

        Livewire::test(ChangeStatusTask::class, ['task' => $task, 'status' => 2])
            ->call('saveChangeStatus')
            ->assertDispatched('updateDataStatus')
            ->assertDispatched('close-modal')
            ->assertDispatched('todo-update');
    }
}
