<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Task;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    protected function createProject()
    {
        return \App\Models\Project::create([
            'name' => 'New Project',
            'description' => 'Project description here',
            'start_date' => now(),
            'end_date' => now()->addMonth(),
        ]);
    }
    
    public function test_a_task_can_be_created()
    {
        $project = $this->createProject();
    
        $taskData = [
            'title' => 'New Task',
            'description' => 'Task description here',
            'state' => false,
            'deadline' => now()->addWeek()->toDateString(),
            'project_id' => $project->id,
        ];
    
        $response = $this->post(route('tasks.store'), $taskData);
    
        $this->assertDatabaseHas('tasks', [
            'title' => 'New Task',
            'project_id' => $project->id,
        ]);
    
        $response->assertRedirect(route('management.index'));
    }


    public function test_a_task_can_be_completed()
    {
        $project = $this->createProject();

        $task = Task::create([
            'title' => 'Task to Complete',
            'description' => 'Complete this task.',
            'state' => false,
            'deadline' => now()->addDay()->toDateString(),
            'project_id' => $project->id,
        ]);
    
        $response = $this->patch(route('tasks.update', $task->id), [
            'change_state' => true,
        ]);
    
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'state' => true,
        ]);
    }


    public function test_a_task_can_be_deleted()
    {
        $project = $this->createProject();

        $task = Task::create([
            'title' => 'Task to Complete',
            'description' => 'Complete this task.',
            'state' => false,
            'deadline' => now()->addDay()->toDateString(),
            'project_id' => $project->id,
        ]);

        $response = $this->delete(route('tasks.destroy', $task->id));

        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id,
        ]);

        $response->assertRedirect(route('management.index'));
    }

}
