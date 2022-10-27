<?php

namespace shop\helpers;

use shop\entities\Shop\Product\Product;
use yii\helpers\ArrayHelper;

class ProductHelper
{
    public static function statusList()
    {
        return [
            Product::STATUS_ACTIVE => 'Active',
            Product::STATUS_DRAFT => 'Draft'
        ];
    }
    public static function statusLabel($status)
    {
        return ArrayHelper::getValue(self::statusList(), $status);
    }
}