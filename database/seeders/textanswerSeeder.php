<?php

namespace Database\Seeders;

use App\Models\Debug;
use App\Models\TextAnswer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class textanswerSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         TextAnswer::create([
             'text_type '   => 'Text '.Str::random(5),
             'answer'       => 'Answer '.Str::random(5),
             'approve'      => 1
         ]);
    }
}
