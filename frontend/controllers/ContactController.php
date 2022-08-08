<?php

namespace frontend\controllers;

use shop\forms\ContactForm;
use shop\services\ContactService;
use yii\web\Controller;

class ContactController extends Controller
{
    private $service;

    public function __construct($id, $module, ContactService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    public function actionIndex()
    {
        $form = new ContactForm();
        if ($form->load($this->request->post()) && $form->validate()){
            try{
                $this->service->send($form);
                \Yii::$app->session->setFlash('success', \Yii::t('app', 'Success'));
                return $this->goHome();
            }catch(\Exception $e){
                \Yii::$app->errorHandler->logException($e);
                \Yii::$app->session->setFlash('error', \Yii::t('app', 'Error'));
            }
            return $this->refresh();
        }
        return  $this->render('index', [
            'model' => $form,
        ]);
    }
}