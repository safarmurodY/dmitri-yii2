<?php

use common\models\User;
use shop\entities\Shop\Brand;
use shop\entities\Shop\Product\Product;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $searchModel \backend\forms\Shop\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <p>
        <?= Html::a('Create', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'attribute' => 'main_photo_id',
                        'value' => function(Product $model){
                            return $model->mainPhoto ? Html::img($model->mainPhoto->getThumbFileUrl('file', 'admin')) : null;
                        },
                        'format' => 'raw',
                        'label' => false,
                        'filter' => false,
                    ],
                    'id',
                    [
                        'attribute' => 'name',
                        'value' => function(Product $model){
                            return Html::a(Html::encode($model->name), ['view', 'id' => $model->id]);
                        },
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'category_id',
                        'value' => function($model){
                            return \yii\helpers\ArrayHelper::getValue($model, 'category.name');
                        },
                        'format' => 'raw',
                        'filter' => $searchModel->categoriesList()
                    ],
                    [
                        'attribute' => 'price_new',
                        'value' => function($model){
                            return $model->price_new;
                        },
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'status',
                        'value' => function($model){
                            return \shop\helpers\ProductHelper::statusLabel($model->status);
                        },
                        'filter' => \shop\helpers\ProductHelper::statusList(),
                        'format' => 'raw',
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
