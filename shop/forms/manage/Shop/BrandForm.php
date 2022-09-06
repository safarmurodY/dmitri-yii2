<?php

namespace shop\forms\manage\Shop;

use shop\entities\Shop\Brand;
use shop\entities\Shop\Tag;

class BrandForm extends \yii\base\Model
{
    public $name;
    public $slug;

    private $_brand;

    public function __construct(Brand $brand = null, $config = [])
    {
        if ($brand){
            $this->name = $brand->name;
            $this->slug = $brand->slug;
            $this->_brand = $brand;
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['name', 'slug'], 'required'],
            [['name', 'slug'], 'max' => 255],
            ['slug', 'match', 'pattern' => '#^[a-z0-9_-]*$#s'],
            [['name', 'slug'], 'unique', 'targetClass' => Brand::class, 'filter' => $this->_brand ? ['<>', 'id', $this->_brand->id] : null],
        ];
    }
}