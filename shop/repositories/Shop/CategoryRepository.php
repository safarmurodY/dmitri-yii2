<?php

namespace shop\repositories\Shop;

use shop\entities\Shop\Category;
use shop\repositories\NotFoundException;
use yii\db\StaleObjectException;

class CategoryRepository
{
    public function get($id):Category
    {
        if (!$category = Category ::findOne($id)){
            throw new NotFoundException('Category not found');
        }
        return $category;
    }

    public function save(Category $category):void
    {
        if (!$category->save()){
            throw new \RuntimeException('Category not saved');
        }
    }

    /**
     * @throws StaleObjectException
     */
    public function remove(Category $category)
    {
        if (!$category->delete()){
            throw new \RuntimeException('Unable to remove category');
        }
    }
}