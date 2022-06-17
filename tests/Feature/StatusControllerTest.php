<?php

namespace Tests\Feature;

use App\Models\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StatusControllerTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_can_retrieve_status_list()
    {
        Status::factory()->count(3)->create();

        $response = $this->get('/api/statuses');

        $response->assertStatus(200);
    }

    public function test_retrieved_statuses_list_has_data()
    {
        Status::factory()->count(3)->create();

        $response = $this->get('/api/statuses');

        $response->assertJsonCount(3, 'data');
    }
}
