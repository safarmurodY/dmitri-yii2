<?php

namespace frontend\controllers\auth;

use shop\forms\auth\SignupForm;
use shop\services\auth\SignupService;
use Yii;
use yii\filters\AccessControl;

class SignupController extends \yii\web\Controller
{
    private $service;

    public function __construct($id, $module, SignupService $service, $config = [])
    {
        $this->service = $service;
        parent::__construct($id, $module, $config);
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
        ];
    }

    public function actionRequest()
    {
        $form = new SignupForm();
        if ($form->load($this->request->post()) && $form->validate())
            try {
                $this->service->signup($form);
                Yii::$app->session->setFlash('success', Yii::t('app', 'Check your Email'));
                return $this->goHome();
            } catch (\DomainException $e) {
                \Yii::$app->errorHandler->logException($e);
                \Yii::$app->session->setFlash('error', $e->getMessage());
            }
        return $this->render('request', [
            'model' => $form,
        ]);
    }

    public function actionConfirm($token)
    {
        try {
            $this->service->confirm($token);
            Yii::$app->session->setFlash('success', Yii::t('app', 'Confirmed'));
        } catch (\DomainException $e) {
            \Yii::$app->errorHandler->logException($e);
            \Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->goHome();
    }


}