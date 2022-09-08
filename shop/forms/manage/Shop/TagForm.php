<?php

namespace shop\forms\manage\Shop;

use shop\entities\Shop\Tag;
use shop\validators\SlugValidator;

class TagForm extends \yii\base\Model
{
    public $name;
    public $slug;

    private $_tag;

    public function __construct(Tag $tag = null, $config = [])
    {
        if ($tag){
            $this->name = $tag->name;
            $this->slug = $tag->slug;
            $this->_tag = $tag;
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['name', 'slug'], 'required'],
            [['name', 'slug'], 'max' => 255],
            ['slug', SlugValidator::class],
            [['name', 'slug'], 'unique', 'targetClass' => Tag::class, 'filter' => $this->_tag ? ['<>', 'id', $this->_tag->id] : null],
        ];
    }
}