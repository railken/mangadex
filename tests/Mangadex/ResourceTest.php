<?php

namespace Railken\Mangadex\Tests\Mangadex;

use Railken\Mangadex\MangadexApi;

class ResourceTest extends TestCase
{
    public function testResourceBasic()
    {
        $api = new MangadexApi();
        $result = $api->resource(31477)->get();

        $this->assertTrue($result->chapters->count() > 0);

        $this->assertEquals("https://mangadex.org/title/31477", $result->url);
        $this->assertEquals("31477", $result->uid);
        $this->assertEquals('Solo Leveling', $result->name);
        $this->assertEquals('Ongoing', $result->status);

    }
}
