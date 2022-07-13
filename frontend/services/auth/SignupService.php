<?php

namespace frontend\services\auth;

use common\models\User;
use frontend\models\SignupForm;

class SignupService
{
    public function signup(SignupForm $form)
    {
        $user = User::requestSignup($form->username,
            $form->email,
            $form->password
        );
        if (!$user->save()){
            throw new \RuntimeException('Saving error');
        }
        return $user;
    }

}