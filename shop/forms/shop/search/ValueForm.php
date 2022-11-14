<?php

namespace shop\forms\shop\search;

use shop\entities\Shop\Characteristic;
use shop\entities\Shop\Product\Value;
use yii\base\Model;

/**
 * @property int $id
 */
class ValueForm extends Model
{
    public $from;
    public $to;
    public $equal;

    private $_characteristics;

    public function __construct(Characteristic $characteristic, Value $value = null, $config = [])
    {
        $this->_characteristics = $characteristic;
        parent::__construct($config);
    }

    public function rules(): array
    {
        return array_filter([
            $this->_characteristics->isString() ? ['equal', 'string'] : false,
            $this->_characteristics->isInteger() || $this->_characteristics->isFloat() ? [['from', 'to'], 'integer']:false,
            ['value', 'safe'],
        ]);
    }
    public function attributeLabels(): array
    {
        return [
            'value' => $this->_characteristics->name,
        ];
    }

    public function isFilled()
    {
        return !empty($this->from) || !empty($this->to) || !empty($this->equal);
    }

    public function variantList():array
    {
        return $this->_characteristics->variants;
    }

    public function getCharacteristicName(): string
    {
        return  $this->_characteristics->name;
    }

    public function getId():int
    {
        return $this->_characteristics->id;
    }

    public function formName():string
    {
        return 'v';
    }
}