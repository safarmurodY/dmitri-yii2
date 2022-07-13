<?php

namespace frontend\services\auth;

use common\models\User;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use Yii;
use yii\mail\MailerInterface;

class PasswordResetService
{
    private MailerInterface $mailer;
    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function request(PasswordResetRequestForm $form)
    {
        $user = User::findOne([
            'status' => User::STATUS_ACTIVE,
            'email' => $form->email,
        ]);
        if (!$user)
            throw new \DomainException('User not found');

        $user->requestPasswordReset();

        if (!$user->save())
            throw new \RuntimeException('Saving error');

        $send = $this
            ->mailer
//            $this
//            ->mailer
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
        $user = User::findByPasswordResetToken($token);
        if (!$user)
            throw new \DomainException('User not found');

        $user->resetPassword($form->password);

        if (!$user->save())
            throw new \RuntimeException('Saving error.');
    }
}