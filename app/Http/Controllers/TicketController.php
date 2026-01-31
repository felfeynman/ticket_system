<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $query = Ticket::with('category');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        return response()->json($query->get());
    }

    public function store(Request $request)
    {

        $ticket = Ticket::create([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'status' => 'open',
            'created_by' => null,
        ]);

        return response()->json($ticket, 201);
    }

    public function show(Ticket $ticket)
    {
        return response()->json($ticket);
    }

    public function update(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);

        $ticket->update($request->only([
            'title',
            'description',
            'status',
            'category_id',
        ]));

        return $ticket;
    }

    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();

        return response()->noContent();
    }
}
