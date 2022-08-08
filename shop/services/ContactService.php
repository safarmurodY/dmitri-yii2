<?php

namespace shop\services;

use shop\forms\ContactForm;
use yii\mail\MailerInterface;

class ContactService
{
    private $adminEmail;
    private MailerInterface $mailer;

    /**
     * @param $adminEmail
     * @param MailerInterface $mailer
     */
    public function __construct($adminEmail, MailerInterface $mailer)
    {
        $this->adminEmail = $adminEmail;
        $this->mailer = $mailer;
    }

    public function send(ContactForm $form)
    {
        $send = $this->mailer->compose()
            ->setTo($this->adminEmail)
            ->setSubject($form->subject)
            ->setTextBody($form->body)
            ->send();

        if (!$send)
            throw new \RuntimeException('Sending error.');
    }

}