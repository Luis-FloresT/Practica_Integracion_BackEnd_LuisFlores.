<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;


class DatabaseSeeder extends Seeder
{
     use WithoutModelEvents;

    public function run(): void
    {

        //User::factory(10)->create();
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'test@example.com',
        ]);
        $this->call(DemoSeeder::class);
    }
}
