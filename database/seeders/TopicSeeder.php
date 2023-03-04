<?php

namespace Database\Seeders;

use App\Models\Topic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Topic::create(['name' => 'Programming']);
        Topic::create(['name' => 'Design']);
        Topic::create(['name' => 'SEO']);
        Topic::create(['name' => 'Random']);
        Topic::create(['name' => 'UX/UI']);
    }
}
