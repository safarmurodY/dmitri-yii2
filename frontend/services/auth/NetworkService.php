<?php

namespace frontend\services\auth;

use common\repositories\UserRepository;
use shop\entities\user\User;

class NetworkService
{
    private $users;

    /**
     * @param $users
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function auth($network, $identity): User
    {
        if ($user = $this->users->findByNetworkIdentity($network, $identity)){
            return $user;
        }
        $user = User::signupByNetwork($network, $identity);
        $this->users->save($user);
        return $user;
    }

}