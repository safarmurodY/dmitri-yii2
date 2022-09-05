<?php

namespace shop\tests\unit\entities\Shop\Tag;

use Codeception\Test\Unit;

class TagCreateTest extends Unit
{

    public function testSuccess()
    {
        $tag = Tag::create(
            $name = 'Name',
            $slug = 'slug',
        );

        $this->assertEquals($name, $tag->name);
        $this->assertEquals($slug, $tag->slug);
    }
}