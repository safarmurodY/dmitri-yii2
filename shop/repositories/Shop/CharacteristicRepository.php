<?php

namespace shop\repositories\Shop;

use shop\entities\Shop\Characteristic;
use shop\repositories\NotFoundException;
use yii\db\StaleObjectException;

class CharacteristicRepository
{
    public function get($id):Characteristic
    {
        if (!$characteristic = Characteristic ::findOne($id)){
            throw new NotFoundException('Characteristic not found');
        }
        return $characteristic;
    }

    public function save(Characteristic $characteristic):void
    {
        if (!$characteristic->save()){
            throw new \RuntimeException('Characteristic not saved');
        }
    }

    /**
     * @throws StaleObjectException
     */
    public function remove(Characteristic $characteristic)
    {
        if (!$characteristic->delete()){
            throw new \RuntimeException('Unable to remove brand');
        }
    }
}