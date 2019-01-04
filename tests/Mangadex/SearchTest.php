<?php

namespace Railken\Mangadex\Tests\Mangadex;

use Railken\Mangadex\MangadexApi;

class SearchTest extends TestCase
{
    public function testSearchBasic()
    {
        $api = new MangadexApi();
        $result = $api
            ->search()
            ->includeTags(['Action', 'Adventure'])
            ->excludeTags(['Samurai'])
            ->status('Ongoing')
            ->name('a')
            ->artist('a')
            ->page(1)
            ->get();

        $this->assertEquals(40, $result->results->count());
        $this->assertEquals(1, $result->page);
    }
}
