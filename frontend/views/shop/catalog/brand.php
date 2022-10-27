<?php
/** @var $this \yii\web\View */
/** @var $brand \shop\entities\Shop\Brand */
/** @var $dataProvider \yii\data\ActiveDataProvider */

use yii\helpers\Html;

$this->title = $brand->getSeoTile();
$this->registerMetaTag(['name' => 'description', 'content' => $brand->meta->description]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $brand->meta->keywords]);

$this->params['breadcrumbs'][] = ['label' => 'Catalog', 'url' => ['index']];
$this->params['breadcrumbs'][] = $brand->name;
?>
<h1><?= Html::encode($brand->name) ?></h1>
<hr>
<?= $this->render('_list', [
    'dataProvider' => $dataProvider,
]) ?>
