<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\NoticeMail;
use App\Models\User;
use Illuminate\Http\Request;

class RepresentativeController extends Controller
{
    public function index()
    {
        return view('representative_admin');
    }

    public function writeMail()
    {
        return view('mail_send');
    }

    public function sendMail(Request $request)
    {
        $subject = $request->subject;
        $content = $request->content;
        $users = User::all();

        foreach($users as $user) {
            Mail::to($user->email)->send(new NoticeMail($subject, $content));
        }

        return view('mail_done');
    }
}
