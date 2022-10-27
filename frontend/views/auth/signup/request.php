<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var \shop\forms\auth\SignupForm $model */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="row">
        <div class="col-sm-6">
            <div class="well">
                <h2>New Customer</h2>
                <p><strong>Register Account</strong></p>
                <p>By creating an account you will be able to shop faster, be up to date on an order's status, and keep track of the orders you have previously made.</p>
                <a href="http://opencart3:8081/index.php?route=account/register" class="btn btn-primary">Continue</a>
            </div>
            <div class="well">
                <h2> Social </h2>
                <?= \yii\authclient\widgets\AuthChoice::widget([
                    'baseAuthUrl' => ['auth/network/auth']
                ]) ?>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="well">
                <h2>Returning Customer</h2>
                <p><strong>I am a returning customer</strong></p>
                <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

