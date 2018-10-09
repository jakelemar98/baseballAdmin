<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\DemoEmail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
  public function send(Request $request)
  {
      $title = $request->input('title');
      $content = $request->input('content');

      Mail::send('mail.demo', ['title' => $title, 'content' => $content], function ($message)
      {

          $message->from('me@gmail.com', 'Christian Nwamba');

          $message->to('chrisn@scotch.io');

      });


      return response()->json(['message' => 'Request completed']);
  }
}
