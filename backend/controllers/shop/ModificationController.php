<?php

namespace backend\controllers\shop;

use shop\entities\Shop\Product\Product;
use shop\forms\manage\Shop\ModificationForm;
use shop\services\manage\Shop\ProductManageService;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ModificationController extends Controller
{
    private $service;

    public function __construct($id, $module, ProductManageService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    public function actionIndex()
    {
        return $this->redirect('shop/product');
    }

    public function actionCreate($product_id)
    {
        $product = $this->findModel($product_id);
        $form = new ModificationForm();
        if ($form->load($this->request->post()) && $form->validate()){
            try {
                $this->service->addModification($product->id, $form);
                return  $this->redirect(['shop/product/view', 'id' => $product->id, '#' => 'modifications']);
            } catch (\DomainException $e) {
                \Yii::$app->errorHandler->logException($e);
                \Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('create', [
            'product' => $product,
            'model' => $form,
        ]);
    }

    public function actionUpdate($id, $product_id)
    {
        $product = $this->findModel($product_id);

        $modification = $product->getModification($id);
        $form = new ModificationForm($modification);
        if ($form->load($this->request->post()) && $form->validate()){
            try {
                $this->service->editModification($product->id, $form);
                return  $this->redirect(['shop/product/view', 'id' => $product->id, '#' => 'modifications']);
            } catch (\DomainException $e) {
                \Yii::$app->errorHandler->logException($e);
                \Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('update', [
            'product' => $product,
            'model' => $form,
            'modification' => $modification,
        ]);
    }

    public function actionDelete($product_id, $id)
    {
        $product = $this->findModel($product_id);
        try {
            $this->service->removeModification($product->id, $id);
        } catch (\DomainException $e) {
            \Yii::$app->errorHandler->logException($e);
            \Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return  $this->redirect(['shop/product/view', 'id' => $product->id, '#' => 'modifications']);
    }



    protected function findModel($id)
    {
        if (($model = Product::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}