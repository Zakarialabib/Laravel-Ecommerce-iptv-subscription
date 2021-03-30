<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Mailers\AppMailer;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Str;
use App\Emailsetting;

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

          // Send Mail to Buyer
           $mail = new PHPMailer(true);
           $ticketOwner = $ticket->user;

           $em = Emailsetting::first();
   
           if ($em->is_smtp == 1) {
               try {
                   $mail->isSMTP();
                   $mail->Host       = $em->smtp_host;
                   $mail->SMTPAuth   = true;
                   $mail->Username   = $em->smtp_user;
                   $mail->Password   = $em->smtp_pass;
                   $mail->SMTPSecure = $em->email_encryption;
                   $mail->Port       = $em->smtp_port;
   
                   //Recipients
                   $mail->setFrom($em->from_email, $em->from_name);
                   $mail->addAddress($ticketOwner->email, $ticketOwner->name);
   
                   // Content
                   $mail->isHTML(true);
                   $mail->Subject = "Ticket' . $ticket->ticket_id .";
                   $mail->Body    = 'Bonjour <strong>' . $ticketOwner->name . '</strong>,<br/>Votre Ticket est créer.<br/>'. $ticket->title . $ticket->status .'Si vous avez une autre question ou un problem à rsesoudre veuillez nous contactez.<br/>Merci et Bonne journée';
   
                   $mail->send();
               } catch (Exception $e) {
                   // die($e->getMessage());
               }
           } else {
               try {
                   //Recipients
                   $mail->setFrom($em->from_mail, $em->from_name);
                   $mail->addAddress($ticketOwner->email, $ticketOwner->name);
   
                   // Attachments
   
                   // Content
                   $mail->isHTML(true);
                   $mail->Subject = "Ticket' . $ticket->ticket_id .";
                   $mail->Body    = 'Bonjour <strong>' . $ticketOwner->name . '</strong>,<br/>Votre Ticket est créer.<br/>'. $ticket->title . $ticket->status .'Si vous avez une autre question ou un problem à rsesoudre veuillez nous contactez.<br/>Merci et Bonne journée';
   
                   $mail->send();
               } catch (Exception $e) {
                   // die($e->getMessage());
               }
           }
   

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

    public function close($ticket_id)
    {
        $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();
        $ticket->status = "Closed";
        $ticket->save();


           // Send Mail to Buyer
           $mail = new PHPMailer(true);
           $ticketOwner = $ticket->user;

           $em = Emailsetting::first();
   
           if ($em->is_smtp == 1) {
               try {
                   $mail->isSMTP();
                   $mail->Host       = $em->smtp_host;
                   $mail->SMTPAuth   = true;
                   $mail->Username   = $em->smtp_user;
                   $mail->Password   = $em->smtp_pass;
                   $mail->SMTPSecure = $em->email_encryption;
                   $mail->Port       = $em->smtp_port;
   
                   //Recipients
                   $mail->setFrom($em->from_email, $em->from_name);
                   $mail->addAddress($ticketOwner->email, $ticketOwner->name);
   
                   // Content
                   $mail->isHTML(true);
                   $mail->Subject = "Ticket Closed";
                   $mail->Body    = 'Bonjour <strong>' . $ticketOwner->name . '</strong>,<br/>Votre Ticket est fermée. Si vous avez une autre question ou un problem à rsesoudre veuillez nous contactez.<br/>Merci et Bonne journée';
   
                   $mail->send();
               } catch (Exception $e) {
                   // die($e->getMessage());
               }
           } else {
               try {
                   //Recipients
                   $mail->setFrom($em->from_mail, $em->from_name);
                   $mail->addAddress($ticketOwner->email, $ticketOwner->name);
   
                   // Attachments
   
                   // Content
                   $mail->isHTML(true);
                   $mail->Subject = "Ticket Closed";
                   $mail->Body    = 'Bonjour <strong>' . $ticketOwner->name . '</strong>,<br/>Votre Ticket est fermée. Si vous avez une autre question ou un problem à rsesoudre veuillez nous contactez.<br/>Merci et Bonne journée';
   
                   $mail->send();
               } catch (Exception $e) {
                   // die($e->getMessage());
               }
           }
   

        return redirect()->back()->with("status", "The ticket has been closed.");
    }
}