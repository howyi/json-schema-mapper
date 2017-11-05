<?php

namespace JsonSchemaMapper;

use JsonSchemaMapper\Mapper;

class MapperTest extends \PHPUnit\Framework\TestCase
{
    private $prophet;

    protected function setup()
    {
        $this->prophet = new \Prophecy\Prophet;
    }

    protected function tearDown()
    {
        $this->prophet->checkPredictions();
    }

    public function testMap()
    {
        Mapper::map(
            'sample/json',
            'sample/generated',
            'Json',
            'templates'
        );

        $this->assertTrue(true);
    }
}
