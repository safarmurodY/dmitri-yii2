<?php

namespace shop\readModels;

use shop\entities\Shop\Category;

class CategoryReadRepository
{
    public function getRoot()
    {
        return Category::find()->roots()->one();
    }

    public function find($id)
    {
        return Category::find()->andWhere(['id' => $id])->andWhere(['>', 'depth', 0])->one();
    }
}