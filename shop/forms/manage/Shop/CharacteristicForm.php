<?php

namespace shop\forms\manage\Shop;

use shop\entities\Shop\Characteristic;
use yii\base\Model;
use shop\helpers\CharacteristicHelper;

/**
 * @property array $variants
 */

class CharacteristicForm extends Model
{
    public $name;
    public $type;
    public $required;
    public $default;
    public $textVariants;
    public $sort;

    private $_characteristics;

    public function __construct(Characteristic $characteristic = null, $config = [])
    {
        if ($characteristic){
            $this->name = $characteristic->name;
            $this->type = $characteristic->type;
            $this->required = $characteristic->required;
            $this->default = $characteristic->default;
            $this->textVariants = implode(PHP_EOL, $characteristic->variants);
            $this->sort = $characteristic->sort;
            $this->_characteristics = $characteristic;
        }else{
            $this->sort = Characteristic::find()->max('sort') + 1;
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['name', 'type', 'sort'], 'required'],
            [['required'], 'boolean'],
            [['default'], 'string', 'max' => 255],
            [['textVariants'], 'string'],
            [['sort'], 'integer'],
            [['name'], 'unique', 'targetClass' => Characteristic::class, 'filter' => $this->_characteristics ? ['<>', 'id', $this->_characteristics->id] : null],
        ];
    }

    public function typeList():array
    {
        return CharacteristicHelper::typeList();
    }

    public function getVariants():array
    {
        return preg_split('#[\r\n]+#i', $this->textVariants);
    }

}