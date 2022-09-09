<?php

namespace shop\repositories\Shop;

use shop\entities\Shop\Brand;
use shop\repositories\NotFoundException;
use yii\db\StaleObjectException;

class BrandRepository
{
    public function get($id):Brand
    {
        if (!$brand = Brand::findOne($id)){
            throw new NotFoundException('Brand not found');
        }
        return $brand;
    }

    public function save(Brand $brand):void
    {
        if (!$brand->save()){
            throw new \RuntimeException('Brand not saved');
        }
    }

    /**
     * @throws StaleObjectException
     */
    public function remove(Brand $brand)
    {
        if (!$brand->delete()){
            throw new \RuntimeException('Unable to remove brand');
        }
    }
}