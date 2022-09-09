<?php

namespace shop\repositories\Shop;

use shop\entities\Shop\Product\Product;
use shop\repositories\NotFoundException;
use yii\db\StaleObjectException;

class ProductRepository
{
    public function get($id):Product
    {
        if (!$product = Product::findOne($id)){
            throw new NotFoundException('Product not found');
        }
        return $product;
    }

    public function save(Product $product):void
    {
        if (!$product->save()){
            throw new \RuntimeException('Product not saved');
        }
    }

    /**
     * @throws StaleObjectException
     */
    public function remove(Product $product)
    {
        if (!$product->delete()){
            throw new \RuntimeException('Unable to remove brand');
        }
    }
}