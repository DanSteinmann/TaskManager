<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Project;
use App\Models\User;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    
    public function test_a_project_can_be_created()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $projectData = [
            'name' => 'New Project',
            'description' => 'Task description here',
            'start_date' => now()->toDateString(),
            'end_date' => now()->addWeek()->toDateString(),
        ];
    
        $response = $this->post(route('projects.store'), $projectData);
    
        $this->assertDatabaseHas('projects', [
            'name' => 'New Project'
        ]);
    
        $response->assertRedirect(route('management.index'));
        $response = $this->get(route('management.index'));
        $response->assertSee('New Project');
    }

    public function test_a_project_can_be_deleted()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $project = Project::create([
            'name' => 'New Project',
            'description' => 'Task description here',
            'start_date' => now()->toDateString(),
            'end_date' => now()->addWeek()->toDateString(),
        ]);
        
        $response = $this->delete(route('projects.destroy', $project->id));

        $this->assertDatabaseMissing('projects', [
            'name' => 'New Project'
        ]);

        $response->assertRedirect(route('management.index'));

    }

    public function test_a_project_can_be_updated()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        
        $project = Project::create([
            'name' => 'Project Name',
            'description' => 'Task description here',
            'start_date' => now()->toDateString(),
            'end_date' => now()->addWeek()->toDateString(),
        ]);
    
        $this->assertDatabaseHas('projects', [
            'id' => $project->id,
            'name' => 'Project Name'
        ]);
    
        $updatedProjectData = [
            'name' => 'Project Name Edited'
        ];
    
        $response = $this->patch(route('projects.update', $project->id), $updatedProjectData);
    
        $this->assertDatabaseHas('projects', [
            'id' => $project->id,
            'name' => 'Project Name Edited'
        ]);
    
        $response = $this->get(route('management.index'));
        $response->assertSee('Project Name Edited');
    }
    
}
