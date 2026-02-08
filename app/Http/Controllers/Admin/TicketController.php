<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with('customer')
            ->latest()
            ->paginate(10);

        return view('admin.tickets.index', compact('tickets'));
    }

    public function show(Ticket $ticket)
    {
        $ticket->load('customer');

        return view('admin.tickets.show', compact('ticket'));
    }

    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'status' => ['required', 'in:new,in_progress,done'],
        ]);

        $ticket->update([
            'status' => $request->status,
            'answered_at' => $request->status === 'done' ? now() : null,
        ]);

        return redirect()->back();
    }
}
