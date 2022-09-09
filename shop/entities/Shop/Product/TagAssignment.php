<?php

namespace shop\entities\Shop\Product;

use yii\db\ActiveRecord;

/**
 * @property int $id
 */
class TagAssignment extends ActiveRecord
{
    public static function create():self
    {
        $object = new static();
        return $object;
    }



    public static function tableName()
    {
        return '{{%shop_tag_assignment}}';
    }
}