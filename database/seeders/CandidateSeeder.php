<?php

namespace Database\Seeders;

use App\Models\Candidate;
use App\Models\Skill;
use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Candidate::factory(20)->hasAttached(
            Status::default()->first(),
            ['comment' => 'Discovered a candidate']
        )->hasAttached(
            Skill::factory()->count(3)
        )->create([
            'status_id' => Status::default()->first()->id
        ]);
    }
}
