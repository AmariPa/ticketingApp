<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Comment;

class TicketController extends Controller
{
    public function index()
    {
         $tickets = Ticket::with('comments')->get();
        return view('tickets.index', compact('tickets'));
    }

    public function addComment(Request $request, $ticketId)
{
    $request->validate([
        'comment' => 'required|string',
    ]);

    $ticket = Ticket::findOrFail($ticketId);
    $comment = new Comment;
    $comment->body = $request->comment;
    $comment->ticket_id = $ticket->id;
    $comment->save();

    return redirect()->route('tickets.index')->with('success', 'Comment added successfully.');
}
}