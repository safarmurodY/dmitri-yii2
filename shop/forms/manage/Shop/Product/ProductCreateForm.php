<?php

namespace shop\forms\manage\Shop\Product;

use shop\entities\Shop\Brand;
use shop\entities\Shop\Characteristic;
use shop\entities\Shop\Product\Product;
use shop\forms\CompositeForm;
use shop\forms\manage\MetaForm;
use yii\helpers\ArrayHelper;

/**
 * @property PriceFom $price
 * @property MetaForm $meta
 * @property CategoriesForm $categories
 * @property PhotosForm $photos
 * @property TagsForm $tags
 * @property ValueForm[] $values
 */
class ProductCreateForm extends CompositeForm
{
    public $brandId;
    public $code;
    public $name;
    public $description;

    public function __construct($config = [])
    {
        $this->price = new PriceFom();
        $this->meta = new MetaForm();
        $this->categories = new CategoriesForm();
        $this->photos = new PhotosForm();
        $this->tags = new TagsForm();
        $this->values = array_map(function (Characteristic $characteristic){
            return new ValueForm($characteristic);
        }, Characteristic::find()->orderBy('sort')->all());
        parent::__construct($config);
    }

    public function rules():array
    {
        return [
            [['brandId', 'code', 'name', 'description'], 'required'],
            [['code', 'name'], 'string', 'max' => 255],
            [['brandId'], 'integer'],
            [['description'], 'string'],
            [['code'], 'unique', 'targetClass' => Product::class],
        ];
    }


    public function brandList():array
    {
        return ArrayHelper::map(Brand::find()->orderBy('name')->asArray()->all(), 'id', 'name');
    }

    protected function internalForms(): array
    {
        return ['price', 'meta', 'photos', 'categories', 'tags', 'values'];
    }
}