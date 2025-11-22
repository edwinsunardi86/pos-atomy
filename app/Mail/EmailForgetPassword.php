<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
class EmailForgetPassword extends Mailable
{
    use Queueable, SerializesModels;
    public $details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->from('eslip@prohr.co.id','E-SLIP PROHR')->subject('E_SLIP '.date('M'))->view('emails.format_email',$this->details)->attachData($this->pdf->output(), "text.pdf");
        return $this->from('no-reply@sos.co.id','New Password Login')->subject('New Password Login')->view('emails.forget_password',$this->details);
    }
}
