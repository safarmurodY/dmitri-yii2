<?php

namespace shop\entities\Shop\Product;

use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property int $created_at
 * @property int $product_id
 * @property int $user_id
 * @property int $vote
 * @property string $text
 * @property bool $active
 */
class Review extends ActiveRecord
{
    public static function create($userId, int $vote, string $text): self
    {
        $obj = new static();
        $obj->user_id = $userId;
        $obj->vote = $vote;
        $obj->text = $text;
        $obj->created_at = time();
        $obj->active = false;
        return $obj;
    }

    public function edit($vote, $text): void
    {
        $this->vote = $vote;
        $this->text = $text;
    }

    public function activate(): void
    {
        $this->active = true;
    }

    public function draft(): void
    {
        $this->active = false;
    }

    public function isActive(): bool
    {
        return $this->active == true;
    }

    public function isEqualTo($id): bool
    {
        return $this->id == $id;
    }

    public function getRating(): int
    {
        return $this->vote;
    }

    public static function tableName(): string
    {
        return '{{%shop_reviews}}';
    }

}