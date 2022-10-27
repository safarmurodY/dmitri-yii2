<?php

namespace shop\readModels;

use shop\entities\Shop\Brand;

class BrandReadRepository
{
    public function find($id)
    {
        return Brand::findOne($id);
    }
}