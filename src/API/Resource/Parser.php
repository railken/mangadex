<?php

namespace Railken\Mangadex\API\Resource;

use Illuminate\Support\Collection;
use Railken\Bag;
use Railken\Mangadex\MangadexApi;
use Wa72\HtmlPageDom\HtmlPageCrawler;

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
     * @return string                 $html
     * @return MangadexSearchResponse
     */
    public function parse($html)
    {
        $data = json_decode($html, true);
        $data['manga']['chapters'] = $data['chapter'];
        return new Bag($data['manga']);
    }
}
