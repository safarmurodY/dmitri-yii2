<?php


/* @var $this yii\web\View */
/* @var $model \shop\forms\manage\Shop\CategoryForm */

$this->title = 'Create';
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brand-create">
    <?= $this->render('_form', [
        'model' => $model,
//        'brand' => $brand
    ]) ?>
</div>
