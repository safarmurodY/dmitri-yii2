<?php

/** @var $this yii\web\View */
use yii\helpers\Html;
$this->title = 'Cabinet';
$this->params['breadcrumb'][] = $this->title;
?>
<div class="box">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="box-body">
        <p>Hello</p>
        <h2>Attach profile</h2>
        <?= \yii\authclient\widgets\AuthChoice::widget([
                'baseAuthUrl' => ['cabinet/network/attach'],
        ]); ?>
    </div>
</div>
