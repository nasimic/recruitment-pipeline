<?php

namespace Tests\Feature;

use App\Models\Candidate;
use App\Models\Skill;
use App\Models\Status;
use Database\Seeders\StatusSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CandidateControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_retrieve_candidates_list()
    {
        Candidate::factory()->count(3)->create();

        $response = $this->get('/api/candidates');

        $response->assertStatus(200);
    }

    public function test_retrieved_candidates_list_has_data()
    {
        Candidate::factory()->count(3)->create();

        $response = $this->get('/api/candidates');

        $response->assertJsonCount(3, 'data');
    }

    public function test_can_retrieve_single_candidate()
    {
        $candidate = Candidate::factory()->create();

        $response = $this->get('/api/candidates/'.$candidate->id);

        $response->assertStatus(200);
    }

    public function test_can_store_candidate()
    {
        $this->seed(StatusSeeder::class);

        $skills = Skill::factory(3)->create();
        
        $response = $this->postJson('/api/candidates/', [
            'first_name' => 'Nasimi',
            'last_name' => 'Mammadov',
            'position' => 'Developer',
            'min_salary' => '3000',
            'max_salary' => '4500',
            'linkedin_url' => "https://linkedin.com/asdf",
            'cv' => null,
            'skills' => $skills->pluck('id')->toArray()
        ]);

        $response->assertCreated();

        $this->assertDatabaseHas('candidates', [
            'id' => $response->json('data.id')
        ]);

        $response->assertJsonPath('data.first_name', 'Nasimi');
    }


    public function test_can_retrieve_candidates_by_status()
    {
        $status = Status::factory()->create();

        Candidate::factory(3)->create(['status_id'=> $status->id]);

        $response = $this->get('/api/candidates/status/'.$status->id);

        $response->assertStatus(200);

        $response->assertJsonCount(3, 'data');
    }

    public function test_can_change_status_with_comment()
    {
        $status1 = Status::factory()->create();
        $status2 = Status::factory()->create();

        $candidate = Candidate::factory()->create(['status_id' => $status1]);

        $response = $this->postJson('/api/candidates/'.$candidate->id.'/status/', [
            'status_id' => $status2->id,
            'comment' => 'Status changed'
        ]);

        $response->assertStatus(200);
        $response->assertJsonPath('data.status_id', $status2->id);
        $response->assertJsonPath('data.statuses.0.pivot.comment', 'Status changed');
    }

    public function test_can_retrieve_timeline_of_candidate()
    {
        $status1 = Status::factory()->create();
        $status2 = Status::factory()->create();
        $status3 = Status::factory()->create();

        $candidate = Candidate::factory()->create(['status_id' => $status1]);
        
        $candidate->statuses()->attach([
            $status1->id => [
                'comment' => 'Status set to 1'
            ]
        ]);


        $candidate->update(['status_id' => $status2->id]);
        $candidate->statuses()->attach([
            $status2->id => [
                'comment' => 'Status changed to 2'
            ]
        ]);
        
        $candidate->update(['status_id' => $status3->id]);
        $candidate->statuses()->attach([
            $status3->id => [
                'comment' => 'Status changed to 3'
            ]
        ]);
        

        $response = $this->get('/api/candidates/'.$candidate->id.'/timeline');

        $response->assertStatus(200);
        $response->assertJsonCount(3, 'data');
        $response->assertJsonPath('data.0.pivot.status_id', $status1->id);
    }
}
