<?php
namespace App\Http\Controllers;

use App\Mail\VerifyEmail;
use App\Mail\TicketEmail;
use App\Mail\ForgotEmail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\EventsController;

class EmailController extends Controller
{
    public static function sendMail($receiver,$token) {
        session(['token' => $token]);
        Mail::to($receiver)->send(new VerifyEmail());
    }
    public static function sendTicket($receiver) {
        Mail::to($receiver)->send(new TicketEmail());
        return redirect('/myreservations');
    }
    public static function sendForgot($receiver) {
        Mail::to($receiver)->send(new ForgotEmail());
    }
}


