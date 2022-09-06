<?php

namespace common\tests\unit\entities\User;



use common\models\User;

class ConfirmSignupTest extends \Codeception\Test\Unit
{
    public function testSuccess()
    {
        $user = new User([
            'status' => User::STATUS_INACTIVE,
            'verification_token' => 'token'
        ]);
        $user->confirmSignup();
        $this->assertEmpty($user->verification_token);
        $this->assertFalse($user->isInactive());
        $this->assertTrue($user->isActive());
    }

    public function testAlreadyActive()
    {
        $user = new User([
            'status' => User::STATUS_ACTIVE,
            'verification_token' => null
        ]);

        $this->expectExceptionMessage('User is already active.');
        $user->confirmSignup();
    }
}