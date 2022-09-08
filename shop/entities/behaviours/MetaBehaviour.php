<?php

namespace shop\entities\behaviours;

use shop\entities\Meta;
use shop\entities\Shop\Brand;
use yii\base\Behavior;
use yii\base\Event;
use yii\db\ActiveRecord;
use yii\db\BaseActiveRecord;
use yii\helpers\Json;

class MetaBehaviour extends Behavior
{
    public $attribute = 'meta';
    public $jsonAttribute = 'json_attribute';

    public function events():array
    {
        return [
            BaseActiveRecord::EVENT_AFTER_FIND => 'onAfterFind',
            BaseActiveRecord::EVENT_BEFORE_INSERT => 'onBeforeSave',
            BaseActiveRecord::EVENT_BEFORE_UPDATE => 'onBeforeSave'
        ];
    }


    public function onAfterFind(Event $event): void
    {
        /** @var Brand $brand */
        $brand = $event->sender;
        $meta = Json::decode($brand->getAttribute($this->jsonAttribute));
        $brand->{$this->attribute} = new Meta($meta['title'], $meta['description'], $meta['keywords']);
    }
    public function onBeforeSave(Event $event): void
    {
        /** @var Brand $brand */
        $brand = $event->sender;
        $brand->setAttribute($this->jsonAttribute, Json::encode([
            'title' => $brand->{$this->attribute}->title,
            'description' => $brand->{$this->attribute}->description,
            'keywords' => $brand->{$this->attribute}->keywords,
        ]));
    }
}