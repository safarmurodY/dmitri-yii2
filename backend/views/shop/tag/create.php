<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \shop\forms\manage\Shop\TagForm */

$this->title = 'Create Brand';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brand-create">
    <?= $this->render('_form', [
        'model' => $model,
//        'brand' => $brand
    ]) ?>
</div>
