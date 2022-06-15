<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
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
        $user_db = (User::where('name', 'admin')->first());
        if (empty($user_db)){
            User::table('users')->create([
                'name' => Str::random(5),
                'email' => Str::random(5).'@gmail.com',
                'password' => Hash::make('password'),
            ]);
        } else {
            return;
        }

    }
}
