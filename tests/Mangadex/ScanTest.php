<?php

namespace Railken\Mangadex\Tests\Mangadex;

use Railken\Mangadex\MangadexApi;

class ScanTest extends TestCase
{
    public function testScanBasic()
    {
        $api = new MangadexApi();
        $result = $api->resource(31477)->get();

        $chapter = $result->chapters->values()->get(0);

        $api->scan($chapter->id)->get()->each(function ($scan) {
            file_get_contents($scan->scan);
        });
    }
}
