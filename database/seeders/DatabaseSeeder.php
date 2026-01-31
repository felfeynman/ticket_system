<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Ticket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //\Faker\Factory::create()->unique(true);

        //Category::factory(5)->create();
        //Ticket::factory(5)->create();
        // User::factory(10)->create();

        $this->call([
            CategorySeeder::class,
            TicketSeeder::class,
        ]);

        /*User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);*/
    }
}
