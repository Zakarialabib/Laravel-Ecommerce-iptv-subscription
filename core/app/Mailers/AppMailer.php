<?php

namespace App\Mailers;

use App\Ticket;
use Illuminate\Contracts\Mail\Mailer;

class AppMailer
{
    protected $mailer;
    protected $fromAddress = 'support@supportticket.dev';
    protected $fromName = 'Support Ticket';
    protected $to;
    protected $subject;
    protected $view;
    protected $data = [];

    /**
     * AppMailer constructor.
     * @param $mailer
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendTicketInformation($user, Ticket $ticket)
    {
        $this->to = $user->email;

        $this->subject = "[Ticket ID: $ticket->ticket_id] $ticket->title";

        $this->view = 'user.emails.ticket_info';

        $this->data = compact('user', 'ticket');

        return $this->deliver();
    }

    public function sendTicketComments($user, Ticket $ticket, $comment)
    {
        $this->to = $user->email;

        $this->subject = "RE: $ticket->title (Ticket ID: $ticket->ticket_id)";

        $this->view = 'emails.ticket_comments';

        $this->data = compact('user', 'ticket', 'comment');

        return $this->deliver();
    }

    public function sendTicketStatusNotification($user, Ticket $ticket)
    {
        $this->to = $user->email;
        $this->subject = "RE: $ticket->title (Ticket ID: $ticket->ticket_id)";
        $this->view = 'emails.ticket_status';
        $this->data = compact('user', 'ticket');

        return $this->deliver();
    }

    public function deliver()
    {
        $this->mailer->send($this->view, $this->data, function($message){

            $message->from($this->fromAddress, $this->fromName)
                    ->to($this->to)->subject($this->subject);

        });
    }
}