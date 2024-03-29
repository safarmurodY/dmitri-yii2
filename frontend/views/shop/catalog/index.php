<?php
/** @var $this \yii\web\View */

/** @var $category \shop\entities\Shop\Category */

/** @var $dataProvider \yii\data\ActiveDataProvider */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = 'Catalog';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>

<?= $this->render('_subcategories', [
    'category' => $category
]) ?>
<?= $this->render('_list', [
    'dataProvider' => $dataProvider,
]) ?>
