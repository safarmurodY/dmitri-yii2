<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \shop\forms\manage\Shop\BrandForm */
/** @var $brand \shop\entities\Shop\Brand */

$this->title = 'Update';
$this->params['breadcrumbs'][] = ['label' => 'Brands', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $brand->name, 'url' => ['view', 'id' => $brand->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brand-create">
    <?= $this->render('_form', [
        'model' => $model,
        'brand' => $brand
    ]) ?>
</div>
