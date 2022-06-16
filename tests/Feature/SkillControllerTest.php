<?php

namespace Tests\Feature;

use App\Models\Skill;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SkillControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_retrieve_skills_list()
    {
        Skill::factory()->count(3)->create();

        $response = $this->get('/api/skills');

        $response->assertStatus(200);
    }

    public function test_retrieved_skills_list_has_data()
    {
        Skill::factory()->count(3)->create();

        $response = $this->get('/api/skills');

        $response->assertJsonCount(3, 'data');
    }
}
