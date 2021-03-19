<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\Mailers\AppMailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class CommentsController extends Controller
{
    public function postComment(Request $request, AppMailer $mailer)
    {
        $this->validate($request, [
            'comment' => 'required'
        ]);

        $comment = Comment::create([
            'ticket_id' => $request->input('ticket_id'),
            'user_id' => Auth::user()->id,
            'comment' => $request->input('comment')
        ]);

        // send mail if the user commenting is not the ticket owner
        if($comment->ticket->user->id !== Auth::user()->id) {
            $mailer->sendTicketComments($comment->ticket->user, Auth::user(), $comment->ticket, $comment);
        }

        return redirect()->back()->with("status", "Your comment has be submitted.");
    }

    public function respondComment(Request $request)
    {
        $this->validate($request, [
            'comment' => 'required'
        ]);

        Comment::create($request->all());

        $notification = array(
            'messege' => 'Your comment has be submitted!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);

    }
}