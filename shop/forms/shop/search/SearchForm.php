<?php

namespace shop\forms\shop\search;

use shop\entities\Shop\Brand;
use shop\entities\Shop\Category;
use shop\entities\Shop\Characteristic;
use yii\helpers\ArrayHelper;


/**
 * @property ValueForm[] $values
 */

class SearchForm extends \shop\forms\CompositeForm
{

    public $text;
    public $category;
    public $brand;

    public function __construct($config = [])
    {
        $this->values = array_map(function (Characteristic $characteristic){
            return new ValueForm($characteristic);
        }, Characteristic::find()->orderBy('sort')->all());
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['text'], 'string'],
            [['category', 'brand'], 'integer'],
        ];
    }
    public function categoriesList(): array
    {
        return ArrayHelper::map(Category::find()
            ->andWhere(['>', 'depth', 0])
            ->orderBy('left')
            ->asArray()
            ->all(), 'id', function (array $category){
            return ($category['depth'] > 1 ? str_repeat('-- ', $category['depth'] - 1). ' ' : '') . $category['name'];
        });
    }

    public function brandList():array
    {
        return ArrayHelper::map(Brand::find()
            ->orderBy('name')
            ->asArray()
            ->all(), 'id', 'name');
    }

    public function formName()
    {
        return '';
    }

    protected function internalForms(): array
    {
        return ['values'];
    }
}