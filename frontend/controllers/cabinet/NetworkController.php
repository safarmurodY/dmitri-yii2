<?php

namespace frontend\controllers\cabinet;

use shop\services\auth\NetworkService;
use yii\authclient\AuthAction;
use yii\authclient\ClientInterface;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\Controller;

class NetworkController extends Controller
{

    private NetworkService $service;
    public function __construct($id, $module, NetworkService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    public function actions()
    {
        return [
            'attach' => [
                'class' => AuthAction::class,
                'successCallback' => [$this, 'onAuthSuccess'],
                'successUrl' => Url::to(['cabinet/default/index'])
            ],
        ];
    }

    public function onAuthSuccess(ClientInterface $client): void
    {
        $network = $client->getId();
        $attributes = $client->getUserAttributes();
        $identity = ArrayHelper::getValue($attributes, 'id');
        try{
            $this->service->attach(\Yii::$app->user->id, $network, $identity);
            \Yii::$app->session->setFlash('success', \Yii::t('app', 'Attached'));
        }catch(\DomainException $e){
            \Yii::$app->errorHandler->logException($e);
            \Yii::$app->session->setFlash('error', $e->getMessage());
        }
    }


}