<?php

namespace Railken\Mangadex\Tests\Mangadex;

use Railken\Mangadex\MangadexApi;

class ResourceTest extends TestCase
{
    public function testResourceBasic()
    {
        $api = new MangadexApi();
        $result = $api->resource(31477)->get();

        print_r($result);

        $this->assertEquals('Solo Leveling', $result->name);
        $this->assertTrue($result->chapters->count() > 0);
    }
}
