<?php

namespace shop\services\auth;

use common\models\User;
use shop\forms\auth\PasswordResetRequestForm;
use shop\forms\auth\ResetPasswordForm;
use shop\repositories\UserRepository;
use Yii;
use yii\mail\MailerInterface;

class PasswordResetService
{
    private MailerInterface $mailer;
    private UserRepository $users;
    public function __construct(UserRepository $users, MailerInterface $mailer)
    {
        $this->mailer = $mailer;
        $this->users = $users;
    }

    public function request(PasswordResetRequestForm $form)
    {
        $user = $this->users->getByEmail($form->email);
        $user->requestPasswordReset();

        $this->users->save($user);

        $send = $this
            ->mailer
            ->compose(
                ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'],
                ['user' => $user]
            )
            ->setTo($user->email)
            ->setSubject('Password reset for ' . Yii::$app->name)
            ->send();

        if (!$send)
            throw new \RuntimeException('Send error.');
    }

    public function validateToken($token): void
    {
        if (empty($token) || !is_string($token))
            throw new \DomainException('Token can not be blank');

        if (!User::findByPasswordResetToken($token))
            throw new \DomainException('Wrong token.');
    }

    public function reset(string $token, ResetPasswordForm $form): void
    {
        $user = $this->users->getByPasswordResetToken($token);
        $user->resetPassword($form->password);
        $this->users->save($user);
    }



}