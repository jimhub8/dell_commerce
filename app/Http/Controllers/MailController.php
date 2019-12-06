<?php

namespace App\Http\Controllers;

use App\Mail\ClientWelcome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function testmail()
    {
        $user = Auth::user();
        Mail::queue(new ClientWelcome($user));
        return 'success';
    }
}
