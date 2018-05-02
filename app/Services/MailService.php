<?php

namespace App\Services;

use PHPMailer\PHPMailer\PHPMailer;

class MailService
{
    private $mail;

    protected $mailFrom = 'example@email.com';
    protected $mailFromName = 'Name';

    public function __construct(PHPMailer $mail)
    {
        $this->mail = $mail;
    }

    public function set($subject = null, $body = null, $address = null, $name = null)
    {
        $this->mail->isSMTP();
        $this->mail->isHTML();
        $this->mail->SMTPAuth = true;
        $this->mail->SMTPSecure = 'ssl';
        $this->mail->SMTPOptions = array('ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true,
        ));
        $this->mail->CharSet = 'utf-8';
        // $this->mail->WordWrap = 75;
        $this->mail->Host = config('mail.host');
        $this->mail->Port = config('mail.port');
        $this->mail->Username = config('mail.username');
        $this->mail->Password = config('mail.password');
        $this->mail->From = $this->mailFrom;
        $this->mail->FromName = $this->mailFromName;

        $this->mail->Subject = $subject;
        $this->mail->Body = $body;
        $this->mail->addAddress($address, $name);

        $this->mail->AltBody = strip_tags(stripslashes($this->mail->Body)) . "\n\n";
        $this->mail->AltBody = str_replace(" ", "\n\n", $this->mail->AltBody);
    }

    public function send()
    {
        return $this->mail->send();
    }

    public function bcc($address, $name)
    {
        $this->mail->addBCC($address, $name);
    }
}