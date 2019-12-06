<?php

namespace App\Mail;

use App\Order;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ThankYou extends Mailable
{
    use Queueable, SerializesModels;
    public $user, $cart_total, $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Order $order, $cart_total)
    {
        $this->user = $user;
        $this->order = $order;
        $this->cart_total = $cart_total;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Log::info($this->order);
        return $this->view('maileclipse::templates.thankYou')
            ->text('maileclipse::templates.thankYou_plain_text')
            ->to($this->user->email)
            ->subject('Thank you');
    }
}
