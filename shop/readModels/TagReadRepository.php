<?php

namespace shop\readModels;

use shop\entities\Shop\Tag;

class TagReadRepository
{
    public function find($id)
    {
        return Tag::findOne($id);
    }
}