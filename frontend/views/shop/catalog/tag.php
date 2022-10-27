<?php
/** @var $this \yii\web\View */
/** @var $tag \shop\entities\Shop\Tag */

/** @var $dataProvider \yii\data\ActiveDataProvider */

use yii\helpers\Html;

$this->title = $tag->name;


$this->params['breadcrumbs'][] = ['label' => 'Catalog', 'url' => ['index']];
$this->params['breadcrumbs'][] = $tag->name;
?>
<h1>Products with tag &laquo;<?= Html::encode($tag->name) ?>&raquo;</h1>

<hr>

<?= $this->render('_list', [
    'dataProvider' => $dataProvider,
]) ?>