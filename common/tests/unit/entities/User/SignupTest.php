<?php

namespace common\tests\unit\entities\User;

use User;

class SignupTest extends \Codeception\Test\Unit
{
    public function testSuccess()
    {
        \Yii::$app->params['adminEmail'] = 'admin@example.com';
        $user = User::requestSignup(
            $username = 'username',
            $email = 'email@site.com',
            $password = 'password'
        );
        $this->assertEquals($username, $user->username);
        $this->assertEquals($email, $user->email);
        $this->assertNotEmpty($user->password_hash);
        $this->assertNotEquals($password, $user->password_hash);
        $this->assertNotEmpty($user->created_at);
        $this->assertNotEmpty($user->auth_key);
        $this->assertTrue($user->isInactive());
        $this->assertFalse($user->isActive());
    }
}