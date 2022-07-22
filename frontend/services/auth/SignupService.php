<?php

namespace frontend\services\auth;

use common\models\User;
use common\repositories\UserRepository;
use frontend\models\SignupForm;
use yii\mail\MailerInterface;

class SignupService
{
    private MailerInterface $mailer;
    private UserRepository $users;

    public function __construct(UserRepository $users, MailerInterface $mailer)
    {
        $this->mailer = $mailer;
        $this->users = $users;
    }

    public function signup(SignupForm $form)
    {
        $user = User::requestSignup(
            $form->username,
            $form->email,
            $form->password
        );

        $this->users->save($user);
        $send = $this
            ->mailer
            ->compose(
                ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'],
                ['user' => $user]
            )
            ->setTo($user->email)
            ->setSubject('Signup for ' . \Yii::$app->name)
            ->send();
        if (!$send)
            throw new \RuntimeException('Send error.');

    }

    public function confirm($token): void
    {
        if (empty($token))
            throw new \DomainException('Empty confirm token');
        $user = $this->users->getByEmailConfirmToken($token);

        $user->confirmSignup();

        $this->users->save($user);
    }
}