<?php

namespace shop\forms\manage\Shop\Product;

use shop\entities\Shop\Product\Product;
use shop\forms\manage\MetaForm;
use shop\forms\manage\Shop\TagForm;
use yii\base\Model;

/**
 * @property MetaForm $meta
 * @property CategoriesForm $categories
 * @property TagForm $tags
 * @property ValueForm $values
 */
class PriceFom extends Model
{
    public $old;
    public $new;

    public function __construct(Product $product = null, $config = [])
    {
        if ($product){
            $this->new = $product->price_new;
            $this->old = $product->price_old;
        }
        parent::__construct($config);
    }
    public function rules()
    {
        return [
            [['new'], 'required'],
            [['new', 'old'], 'integer', 'min' => 0]
        ];
    }
}