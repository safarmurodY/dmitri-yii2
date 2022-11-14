<?php

namespace shop\readModels;

use shop\entities\Shop\Category;
use yii\helpers\ArrayHelper;

class CategoryReadRepository
{
    public function getRoot()
    {
        return Category::find()->roots()->one();
    }

    /**
     * @param $id
     * @return Category|array|\yii\db\ActiveRecord|null
     */
    public function find($id)
    {
        return Category::find()->andWhere(['id' => $id])->andWhere(['>', 'depth', 0])->one();
    }


    public function findBySlug($slug)
    {
        return Category::find()->andWhere(['slug' => $slug])->andWhere(['>', 'depth', 0])->one();
    }

    public function getTreeWithSubOf($category): array
    {
        $query = Category::find()->andWhere(['>', 'depth', 0])->orderBy('left');
        if ($category) {
            $criteria = ['or', ['depth' => 1]];
            foreach (ArrayHelper::merge([$category], $category->parents) as $item) {
                $criteria[] = ['and', ['>', 'left', $item->left], ['<', 'right', $item->right], ['depth' => $item->depth + 1]];
            }
            $query->andWhere($criteria);
        } else {
            $query->andWhere(['depth' => 1]);
        }
        return $query->all();
    }
}