<?php

namespace common\bootstrap;

use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;
use frontend\urls\CategoryUrlRule;
use shop\readModels\CategoryReadRepository;
use shop\services\ContactService;
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

        $container->setSingleton(Client::class, function () use ($app){
            return ClientBuilder::create()->build();
        });

        $container->setSingleton(MailerInterface::class, function () use ($app) {
            return $app->mailer;
        });
        $container->setSingleton('cache', function () use ($app) {
            return $app->cache;
        });

        $container->setSingleton(ContactService::class, [], [
            $app->params['adminEmail'],
        ]);

        $container->set(CategoryUrlRule::class, [], [
            Instance::of(CategoryReadRepository::class),
            Instance::of('cache'),
        ]);
    }
}