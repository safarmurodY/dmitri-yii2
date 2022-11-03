<?php
/** @var $this \yii\web\View */
/** @var $category \shop\entities\Shop\Category */
/** @var $dataProvider \yii\data\ActiveDataProvider */

use yii\helpers\Html;

$this->title = $category->getSeoTile();
$this->registerMetaTag(['name' => 'description', 'content' => $category->meta->description]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $category->meta->keywords]);

$this->params['breadcrumbs'][] = ['label' => 'Catalog', 'url' => ['index']];
foreach ($category->parents as $parent) {
    if (!$parent->isRoot()){
        $this->params['breadcrumbs'][] = ['label' => $parent->name, 'url' => ['category', 'id' => $parent->id]];
    }
}
$this->params['breadcrumbs'][] = $category->name;
?>
<h1><?= Html::encode($category->getHeadingTile()) ?></h1>

<?= $this->render('_subcategories', [
    'category' => $category
]) ?>
<?php if(trim($category->description)): ?>
    <div class="panel panel-default">
        <div class="panel-body">
            <?= Yii::$app->formatter->asNtext($category->description) ?>
        </div>
    </div>
<?php endif; ?>
<?= $this->render('_list', [
    'dataProvider' => $dataProvider,
]) ?>
