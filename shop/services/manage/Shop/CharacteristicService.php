<?php

namespace shop\services\manage\Shop;

use shop\entities\Shop\Characteristic;
use shop\forms\manage\Shop\CharacteristicForm;
use shop\repositories\Shop\CharacteristicRepository;
use shop\repositories\Shop\ProductRepository;

class CharacteristicService
{

    private CharacteristicRepository $characteristics;
    private ProductRepository $products;

    /**
     * @param CharacteristicRepository $characteristics
     * @param ProductRepository $products
     */
    public function __construct(
        CharacteristicRepository $characteristics,
        ProductRepository        $products
    ) {
        $this->characteristics = $characteristics;
        $this->products = $products;
    }


    public function create(CharacteristicForm $form): Characteristic
    {
        $characteristic = Characteristic::create(
            $form->name,
            $form->type,
            $form->required,
            $form->default,
            $form->variants,
            $form->sort
        );
        $this->characteristics->save($characteristic);
        return $characteristic;
    }

    public function edit($id, CharacteristicForm $form)
    {
        $characteristic = $this->characteristics->get($id);
        $characteristic->edit(
            $form->name,
            $form->type,
            $form->required,
            $form->default,
            $form->variants,
            $form->sort
        );
        $this->characteristics->save($characteristic);
    }

    public function remove($id): void
    {
        $characteristic = $this->characteristics->get($id);
        $this->characteristics->remove($characteristic);
    }
}