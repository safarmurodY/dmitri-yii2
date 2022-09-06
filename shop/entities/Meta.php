<?php

namespace shop\entities;

class Meta
{
    public $title;
    public $description;
    public $keywords;

    /**
     * @param $title
     * @param $description
     * @param $keywords
     */
    public function __construct($title, $description, $keywords)
    {
        $this->title = $title;
        $this->description = $description;
        $this->keywords = $keywords;
    }
}