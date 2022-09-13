<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \shop\forms\manage\Shop\CharacteristicForm */

$this->title = 'Create';
$this->params['breadcrumbs'][] = ['label' => 'Characteristics', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brand-create">
    <?= $this->render('_form', [
        'model' => $model,
//        'brand' => $brand
    ]) ?>
</div>
