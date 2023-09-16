<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        
        //create a user first because it is a foreign key in listing
        //then pass the created user in listings factory
        // We have only created 1 user with name and email of our choice
        // but we can create random user also without providing name, email
        // $user = User::factory()->create([
        //     'name'      =>  'John Doe',
        //     'email'     =>  'john@gmail.com' 
        // ]);
        
        // Listing::factory(5)->create([
        //     'user_id' => $user->id
        // ]);
    }
}
