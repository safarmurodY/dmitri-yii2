<?php

namespace frontend\widgets;

use shop\entities\Shop\Category;
use shop\readModels\CategoryReadRepository;
use yii\base\Widget;
use yii\helpers\Html;

class CategoriesWidget extends Widget
{
    public ?Category $active;
    private CategoryReadRepository $categories;
    public function __construct(CategoryReadRepository $categories, $config = [])
    {
        parent::__construct($config);
        $this->categories = $categories;
    }

    public function run(): string
    {
        return Html::tag('div', implode(PHP_EOL, array_map(function (Category $category){
            $indent = ($category->depth > 1) ? str_repeat('&nbsp;&nbsp;&nbsp;', $category->depth - 1) . '-':'';
            $active = $this->active && ($this->active->id == $category->id  || $this->active->isChildOf($category));
            return Html::a(
                $indent . Html::encode($category->name),
                ['/shop/catalog/category', 'id' => $category->id],
                ['class' => $active ? 'list-group-item active' : 'list-group-item']
            );
        },$this->categories->getTreeWithSubOf($this->active))), [
            'class' => 'list-group'
        ]);
    }
}