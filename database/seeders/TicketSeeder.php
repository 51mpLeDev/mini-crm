<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Ticket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::factory()
            ->count(5)
            ->has(
                Ticket::factory()->count(2)
            )
            ->create();
    }
}
