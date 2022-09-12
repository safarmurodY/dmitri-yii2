<?php

namespace shop\repositories\Shop;

use shop\entities\Shop\Tag;
use shop\repositories\NotFoundException;
use yii\db\StaleObjectException;

class TagRepository
{

    public function get($id):Tag
    {
        if (!$tag = Tag::findOne($id)){
            throw new NotFoundException('Tag not found');
        }
        return $tag;
    }


    public function findByName($name)
    {
        return $this->getBy(['name' => $name]);
    }

    public function getBy(array $config)
    {
        if (!$tag = Tag::find()->where($config)->one()){
            throw new NotFoundException('Tag not found');
        }
        return $tag;
    }

    public function save(Tag $tag):void
    {
        if (!$tag->save()){
            throw new \RuntimeException('Tag not saved');
        }
    }

    /**
     * @throws StaleObjectException
     */
    public function remove(Tag $tag)
    {
        if (!$tag->delete()){
            throw new \RuntimeException('Unable to remove tag');
        }
    }
}