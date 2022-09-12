<?php

namespace shop\entities\Shop\Product;

use yii\db\ActiveRecord;

/**
 * @property int $product_id
 * @property int $tag_id
 */
class TagAssignment extends ActiveRecord
{
    public static function create($tagId):self
    {
        $object = new static();
        $object->tag_id = $tagId;
        return $object;
    }

    public function isForTag($id): bool
    {
        return $this->tag_id == $id;
    }

    public static function tableName()
    {
        return '{{%shop_tag_assignment}}';
    }
}