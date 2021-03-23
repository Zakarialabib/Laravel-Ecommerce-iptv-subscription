<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Mailers\AppMailer;
use Illuminate\Support\Str;


class TicketsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

 
    public function index()
    {
        $tickets = Ticket::paginate(10);
        $categories = Category::all();

        return view('admin.tickets.index', compact('tickets','categories'));
    }


    public function create()
    {
        $categories = Category::all();
        return view('admin.tickets.create', compact('categories'));
    }


    public function userTickets()
    {
        $tickets = Ticket::where('user_id', Auth::user()->id)->paginate(10);
        $categories = Category::all();
        return view('user.tickets.user_tickets', compact('tickets','categories'));
    }

    public function creation()
    {
        $categories = Category::all();
        return view('user.tickets.create', compact('categories'));
    }

  
    public function storing(Request $request, AppMailer $mailer)
    {

        $this->validate($request, [
            'title' => 'required',
            'category' => 'required',
            'priority' => 'required',
            'message' => 'required',
        ]);
        $ticket = new Ticket([
            'title' => $request->input('title'),
            'user_id' => Auth::user()->id,
            'ticket_id' => Str::random(10),
            'category_id' => $request->input('category'),
            'priority' => $request->input('priority'),
            'message' => $request->input('message'),
            'status' => "Open"
        ]);
        $ticket->save();        
        $mailer->sendTicketInformation(Auth::user(), $ticket);
        return redirect()->back()->with("status", "A ticket with ID: #$ticket->ticket_id has been opened.");
    }

    public function show($ticket_id)
    {
        $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();
        $comments = $ticket->comments;

        $category = $ticket->category;

        return view('admin.tickets.show', compact('ticket', 'category', 'comments'));
    }
    
    public function affiche($ticket_id)
    {
        $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();
        $comments = $ticket->comments;

        $category = $ticket->category;

        return view('user.tickets.show', compact('ticket', 'category', 'comments'));
    }

    public function close($ticket_id, AppMailer $mailer)
    {
        $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();
        $ticket->status = "Closed";
        $ticket->save();
        $ticketOwner = $ticket->user;
        $mailer->sendTicketStatusNotification($ticketOwner, $ticket);
        return redirect()->back()->with("status", "The ticket has been closed.");
    }
}