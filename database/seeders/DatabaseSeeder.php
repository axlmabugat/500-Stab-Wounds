<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\SalesSeeder; 

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'raw500',
            'email' => '500@gmail.com',
        ]);

        $this->call(SalesSeeder::class);
    }
}
