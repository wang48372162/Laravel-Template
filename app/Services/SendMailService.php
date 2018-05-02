<?php

namespace App\Services;

class SendMailService extends MailService
{
    protected $mailFrom = 'example@abc.com';
    protected $mailFromName = 'John';

    public function sendSeminarMail($input)
    {
        $this->set(
            'E-mail title',
            view('mail/test', ['input' => $input]),
            $input['email'],
            $input['name']
        );
        $this->send();
    }
}
