<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Models\Ticket;

class TicketRepository
{
    public function findOrCreateCustomer(array $data): Customer
    {
        return Customer::firstOrCreate(
            [
                'email' => $data['email'] ?? null,
                'phone' => $data['phone'] ?? null,
            ],
            [
                'name' => $data['name'] ?? null,
            ]
        );
    }

    public function createTicket(Customer $customer, array $data): Ticket
    {
        return $customer->tickets()->create([
            'subject' => $data['subject'],
            'message' => $data['message'],
            'status' => 'new',
        ]);
    }
}
