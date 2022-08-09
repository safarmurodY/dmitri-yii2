<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \shop\forms\manage\UserEditForm */
/* @var $form yii\widgets\ActiveForm */
/** @var $user \common\models\User */

$this->title = 'Update';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $user->id, 'url' => ['view', 'id' => $user->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <div class="box">
        <div class="box-body">
            <?php $form = \yii\widgets\ActiveForm::begin() ?>

            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
            <?php \yii\widgets\ActiveForm::end() ?>
        </div>
    </div>

</div>
