<?php

namespace Railken\Mangadex\Tests\Mangadex;

use Railken\Mangadex\MangadexApi;

class ReleasesTest extends TestCase
{
    public function testReleasesBasic()
    {
        $api = new MangadexApi();
        $this->assertEquals(50, $api->releases()->page(1)->get()->results->count());
    }
}