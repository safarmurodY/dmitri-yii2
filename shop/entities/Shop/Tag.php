<?php

namespace shop\entities\Shop;

use yii\db\ActiveRecord;

/**
 * User model
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 *
 */

class Tag extends ActiveRecord
{
    public static function create($name, $slug):self
    {
        $tag = new static();
        $tag->name = $name;
        $tag->slug = $slug;
        return $tag;
    }

    public function edit($name, $slug)
    {
        $this->name = $name;
        $this->slug = $slug;
    }

    public static function tableName()
    {
        return 'shop_tags';
    }
}