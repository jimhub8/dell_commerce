<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user, $email, $pdf;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $email, $pdf)
    {
        $this->user = $user;
        $this->email = $email;
        $this->pdf = $pdf;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail = $this->email;

        return $this->from('courier@courier.com')
            ->markdown('mail.Invoice')
            ->to('jimlaravel@gmail.com')
            ->attachData($this->pdf, 'name.pdf', [
                'mime' => 'application/pdf',
            ])
            // ->attach('http://courier.dev/storage/book1.xlsx', [
            //     'as' => 'name.xlsx',
            //     'mime' => 'application/xlsx',
            // ])
            ->subject('Invoice Order');
    }
}
