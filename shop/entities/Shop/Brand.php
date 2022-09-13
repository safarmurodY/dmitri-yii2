<?php

namespace shop\entities\Shop;

use shop\entities\behaviours\MetaBehaviour;
use shop\entities\Meta;
use yii\helpers\Json;

/**
 * @property integer $id
 * @property string $name
 * @property string $slug
 *
 * @property Meta $meta
 */

class Brand extends \yii\db\ActiveRecord
{
    public $meta;

    public static function create($name, $slug, Meta $meta)
    {
        $brand = new static();
        $brand->name = $name;
        $brand->slug = $slug;
        $brand->meta = $meta;
        return $brand;
    }

    public function edit($name, $slug, Meta $meta)
    {
        $this->name = $name;
        $this->slug = $slug;
        $this->meta = $meta;
    }

    public static function tableName(): string
    {
        return '{{%shop_brands}}';
    }

    public function behaviors():array
    {
        return [
            MetaBehaviour::class,
//            [
//                'class' =>
//                'attribute' => 'meta',
//                'jsonAttribute' => 'meta_json'
//            ]
        ];
    }


}