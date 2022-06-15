<?php

namespace Database\Seeders;

use App\Models\Debug;
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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


         Debug::create([
             'Data' => 'Test User seed',
         ]);

        /*DB::table('debugs')->insert([
            'data' => Str::random(5),
            //'email' => Str::random(5).'@gmail.com',
            //'password' => Hash::make('password'),
        ]);*/
    }
}
