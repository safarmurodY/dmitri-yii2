<?php

namespace shop\entities\Shop\Product;

use yii\db\ActiveRecord;

/**
 * @property integer $product_id
 * @property integer $category_id
 */

class CategoryAssignment extends ActiveRecord
{
    public static function create($category_id):self
    {
        $assignment = new static();
        $assignment->category_id = $category_id;
        return $assignment;
    }

    public function isForCategory($id):bool
    {
        return $this->category_id == $id;
    }

    public static function tableName()
    {
        return '{{%shop_category_assignment}}';
    }
}