<?php

namespace shop\services\auth;

use common\models\User;
use shop\entities\User\Network;
use shop\repositories\UserRepository;

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
//        $netWorks = Network::create($network, $identity, $user->id);
//
//        $this->users->saveNetwork($netWorks);

        return $user;
    }

    public function attach($user_id, $network, $identity)
    {
        if ($this->users->findByNetworkIdentity($network, $identity)){
            throw new \DomainException('network already attached');
        }
        $user = $this->users->get($user_id);
        $user->attachNetwork($network, $identity);
        $this->users->save($user);
    }

}