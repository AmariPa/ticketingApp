<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;


// Tickets listing/landing page
Route::get('/', [TicketController::class, 'index'])->name('tickets.index');

// Route for adding comments to a ticket
Route::post('/add-comment-to-ticket/{ticketId}', [TicketController::class, 'addComment'])->name('tickets.addComment');