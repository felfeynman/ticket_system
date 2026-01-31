<?php

namespace Database\Seeders;

use App\Models\Ticket;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ticket::truncate();

        $categories = Category::all();

        Ticket::factory()
            ->count(5)
            ->make()
            ->each(function ($ticket) use ($categories) {
                $ticket->category_id = $categories->random()->id;
                $ticket->save();
            });
    }
}
