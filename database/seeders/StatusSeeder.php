<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['name' => 'Initial', 'style_class' => 'gray', 'is_default' => 1],
            ['name' => 'First Contact', 'style_class' => 'blue', 'is_default' => 0],
            ['name' => 'Interview', 'style_class' => 'yellow', 'is_default' => 0],
            ['name' => 'Tech Assignment', 'style_class' => 'black', 'is_default' => 0],
            ['name' => 'Rejected', 'style_class' => 'red', 'is_default' => 0],
            ['name' => 'Hired', 'style_class' => 'green', 'is_default' => 0],
        ];

        Status::insert($data);
    }
}
