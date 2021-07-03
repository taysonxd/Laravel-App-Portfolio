<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MessageReceived;

class MessagesController extends Controller
{
    public function store(Request $request) {

    	$message = request()->validate([
    		'name' => 'required',
    		'email' => 'required|email',
    		'subject' => 'required',
    		'message' => 'required|min:5'
    	]);

        Mail::to('hasker_75@hotmail.com')->queue(new MessageReceived($message));

    	return back()->with('status', 'Tu mensaje ha sido enviado correctamente, te responderemos cuanto antes.');
    	
    }
}
