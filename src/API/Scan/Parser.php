<?php

namespace Railken\Mangadex\API\Scan;

use Illuminate\Support\Collection;
use Railken\Bag;
use Railken\Mangadex\MangadexApi;

class Parser
{
    /*
     * @var MangadexApi
     */
    protected $manager;

    /**
     * Constructor.
     *
     * @param MangadexApi $manager
     */
    public function __construct(MangadexApi $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Parse the response.
     *
     * @param string $api
     *
     * @return Bag
     */
    public function parse($api)
    {
        $api = json_decode($api);

        $bag = new Bag();

        return Collection::make((array) $api->page_array)->map(function ($scan) use ($api) {
            $bag = new Bag();

            $host = parse_url($api->server, PHP_URL_HOST);

            $baseUrl = $host ? $api->server : 'https://mangadex.org'.$api->server;

            $bag->set('scan', sprintf('%s%s/%s', $baseUrl, $api->hash, $scan));

            return $bag;
        });

        return $bag;
    }
}
