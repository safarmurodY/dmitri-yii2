<?php

namespace shop\repositories;

use common\models\User;
use shop\entities\User\Network;

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

    public function get($id)
    {
        return $this->getBy(['id' => $id]);
    }

    public function getByPasswordResetToken(string $token): User
    {
        return $this->getBy(['password_reset_token' => $token]);
    }

    public function findByNetworkIdentity($network, $identity): ?User
    {
        return User::find()->joinWith('networks n')->andWhere(['n.network' => $network, 'n.identity' => $identity])->one();
    }

    public function findByUsernameOrEmail($value): User
    {
        return User::find()->andWhere(['or', ['username' => $value], ['email' => $value]])->one();
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

    public function saveNetwork(Network $network): void
    {
        if (!$network->save())
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