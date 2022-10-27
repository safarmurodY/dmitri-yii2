<?php

namespace shop\forms\shop;

use backend\helpers\PriceHelper;
use shop\entities\Shop\Product\Modification;
use shop\entities\Shop\Product\Product;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class CartForm extends Model
{
    public $modification;
    public $quantity;

    private $_product;

    public function __construct(Product $product, $config = [])
    {
        $this->_product = $product;
        $this->quantity = 1;
        parent::__construct($config);
    }

    public function rules()
    {
        return array_filter([
            $this->_product->modifications ? ['modification', 'required'] : false,
            ['quantity', 'required']
        ]);
    }

    public function modificationsList(): array
    {
        return ArrayHelper::map($this->_product->modifications, 'id', function(Modification $modification){
            return $modification->code . ' - ' . $modification->name . ' (' .PriceHelper::format($modification->price ?: $this->_product->price_new). ')';
        });
    }
}