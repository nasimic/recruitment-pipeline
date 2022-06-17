<?php

namespace Tests\Feature;

use App\Models\Candidate;
use App\Models\Skill;
use App\Models\Status;
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
}
