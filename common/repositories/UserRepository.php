<?php

namespace common\repositories;

use common\models\User;

class UserRepository
{
    public function getByEmailConfirmToken($token): User
    {
        return $this->getBy(['verification_token' => $token]);
    }
    public function getByEmail(string $email): User
    {
        return $this->getBy(['email' => $email]);
    }

    public function getByPasswordResetToken(string $token): User
    {
        return $this->getBy(['password_reset_token' => $token]);
    }

    public function existByPasswordResetToken($token): bool
    {
        return (bool) User::findByPasswordResetToken($token);
    }

    public function save(User $user):void
    {
        if (!$user->save())
            throw new \RuntimeException('Saving error.');
    }

    private function getBy(array $condition): User
    {
        if (!$user = User::find()->where($condition)->limit(1)->one()){
            throw new NotFoundException('User Not Found.');
        }
        return $user;
    }


}