<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Task;

class TaskTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_a_task_can_be_created()
    {
        $taskData = [
            'title' => 'New Task',
            'description' => 'Task description here',
            'state' => false,
            'deadline' => now()->addWeek(),
        ];

        $response = $this->post(route('tasks.store'), $taskData);

        $this->assertDatabaseHas('tasks', [
            'title' => 'New Task',
        ]);

        $response->assertRedirect(route('tasks.index'));
    }


    public function test_a_task_can_be_completed()
    {
        $task = Task::create([
            'title' => 'Task to Complete',
            'description' => 'Complete this task.',
            'state' => false,
            'deadline' => now()->addDay(),
        ]);

        $response = $this->patch(route('tasks.update', $task->id), [
            'change_state' => true,
        ]);

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'state' => true,
        ]);

        $response->assertRedirect(route('tasks.index'));
    }


    public function test_a_task_can_be_deleted()
    {
        $task = Task::create([
            'title' => 'Task to Delete',
            'description' => 'Delete this task.',
            'state' => false,
            'deadline' => now()->addDay(),
        ]);

        $response = $this->delete(route('tasks.destroy', $task->id));

        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id,
        ]);

        $response->assertRedirect(route('tasks.index'));
    }

}
