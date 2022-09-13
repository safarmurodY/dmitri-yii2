<?php

namespace shop\forms\manage\Shop;

use shop\entities\Shop\Product\Modification;
use yii\base\Model;

class ModificationForm extends Model
{
    public $code;
    public $name;
    public $price;
    public $modificationId;

    public function __construct(Modification $modification = null, $config = [])
    {
        if ($modification){
            $this->code = $modification->code;
            $this->name = $modification->name;
            $this->price = $modification->price;
            $this->modificationId = $modification->id;
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['code', 'name', 'price'], 'required'],
            [['code', 'name'], 'string', 'max' => 255],
            [['price', 'modificationId'], 'integer'],
        ];
    }
}