<?php

namespace shop\entities\Shop\Product;

use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $price
 */
class Modification extends ActiveRecord
{
    public static function create($code, $name, $price): self
    {
        $object = new static();
        $object->code = $code;
        $object->name = $name;
        $object->price = $price;
        return $object;
    }

    public function edit($code, $name, $price): void
    {
        $this->code = $code;
        $this->name = $name;
        $this->price = $price;
    }

    public function isEqualTo($id): bool
    {
        return $this->id === $id;
    }

    public function isCodeEqualTo($code): bool
    {
        return $this->code === $code;
    }

    public static function tableName(): string
    {
        return '{{%shop_modifications}}';
    }
}