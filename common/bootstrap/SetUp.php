<?php

namespace common\bootstrap;

use frontend\services\auth\PasswordResetService;
use frontend\services\contact\ContactService;
use yii\base\Application;
use yii\di\Instance;
use yii\mail\MailerInterface;

class SetUp implements \yii\base\BootstrapInterface
{
    /**
     * @inheritDoc
     */
    public function bootstrap($app)
    {
        $container = \Yii::$container;
//        $container->setSingleton(PasswordResetService::class);
        $container->setSingleton(MailerInterface::class, function () use ($app){
            return $app->mailer;
        });

        $container->setSingleton(ContactService::class, [], [
            $app->params['adminEmail'],
//            Instance::of(MailerInterface::class)
        ]);
//        $container->setSingleton(PasswordResetService::class, function () use ($app) {
//            return new PasswordResetService([\Yii::$app->params['supportEmail'] => \Yii::$app->name . ' robot']);
//        });


//        $container->setSingleton()
    }
}