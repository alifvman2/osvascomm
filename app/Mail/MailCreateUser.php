<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailCreateUser extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->from($this->data['createMail'], $this->data['created_by'])
            ->view('admin.users.email')
            ->with('data', $this->data)
            ->subject($this->data['appName'] . " Akun Anda Telah Dibuat")
            ->attach($this->data['logo']);
    }
}
