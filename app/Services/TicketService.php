<?php

namespace App\Services;

use App\Models\Ticket;
use App\Repositories\TicketRepository;
use Illuminate\Validation\ValidationException;

class TicketService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        private TicketRepository $repository
    ) {}

    public function create(array $data): Ticket
    {
        if (empty($data['email']) && empty($data['phone'])) {
            throw ValidationException::withMessages([
                'contact' => 'Email or phone is required',
            ]);
        }

        $customer = $this->repository->findOrCreateCustomer($data);

        $exists = $customer->tickets()
            ->whereDate('created_at', today())
            ->exists();

        if ($exists) {
            throw ValidationException::withMessages([
                'ticket' => 'Only one ticket per day is allowed',
            ]);
        }

        return $this->repository->createTicket($customer, $data);
    }
}
