<?php

namespace shop\forms\manage\Shop\Product;

use shop\entities\Shop\Characteristic;
use shop\entities\Shop\Product\Value;
use yii\base\Model;

/**
 * @property integer $id
 */
class ValueForm extends Model
{
    public $value;

    private $_characterstic;

    public function __construct(Characteristic $characteristic, Value $value = null, $config = [])
    {
        if ($value) {
            $this->value = $value->value;
        }
        $this->_characterstic = $characteristic;
        parent::__construct($config);
    }

    public function rules(): array
    {
        return array_filter([
            $this->_characterstic->required ? ['value', 'required'] : false,
            $this->_characterstic->isString() ? ['value', 'string', 'max' => 255] : false,
            $this->_characterstic->isInteger() ? ['value', 'integer'] : false,
            $this->_characterstic->isFloat() ? ['value', 'number'] : false,
            ['value', 'safe'],
        ]);
    }

    public function attributeLabels(): array
    {
        return [
            'value' => $this->_characterstic->name,
        ];
    }

    public function variantsList()
    {
        return $this->_characterstic->variants;
    }

    public function getId(): int
    {
        return $this->_characterstic->id;
    }
}