<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \shop\forms\manage\Shop\ModificationForm */
/** @var $modification \shop\entities\Shop\Product\Modification */
/* @var $product \shop\entities\Shop\Product\Product */


$this->title = 'Update Modification: ' . $modification->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['shop/product/index']];
$this->params['breadcrumbs'][] = ['label' => $product->name, 'url' => ['shop/product/view', 'id' => $product->id]];
$this->params['breadcrumbs'][] = $modification->name;
?>
<div class="brand-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
