<?php

namespace frontend\controllers\auth;

use shop\forms\auth\PasswordResetRequestForm;
use shop\forms\auth\ResetPasswordForm;
use shop\services\auth\PasswordResetService;
use Yii;
use yii\web\Controller;

class ResetController extends Controller
{
    public $layout = 'cabinet';
    private $service;
    public function __construct($id, $module, PasswordResetService $service, $config = [])
    {
        $this->service = $service;
        parent::__construct($id, $module, $config);
    }

    public function actionRequest()
    {
        $form = new PasswordResetRequestForm();
        if ($form->load($this->request->post()) && $form->validate()){
            try {
                $this->service->request($form);
                Yii::$app->session->setFlash('success', Yii::t('app', 'check email'));
                return $this->goHome();
            } catch (\DomainException $e) {
                \Yii::$app->errorHandler->logException($e);
                \Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('request', [
            'model' => $form,
        ]);

    }

    public function actionConfirm($token)
    {
        try {
            $this->service->validateToken($token);
        } catch (\DomainException $e) {
            \Yii::$app->errorHandler->logException($e);
            \Yii::$app->session->setFlash('error', $e->getMessage());
        }
        $form = new ResetPasswordForm();
        if ($form->load($this->request->post()) && $form->validate()){
            try {
                $this->service->reset($token, $form);
                Yii::$app->session->setFlash('success', Yii::t('app', 'New Password'));
            } catch (\DomainException $e) {
                \Yii::$app->errorHandler->logException($e);
                \Yii::$app->session->setFlash('error', $e->getMessage());
            }
            return $this->goHome();
        }
        return $this->render('confirm', [
            'model' => $form
        ]);
    }
}