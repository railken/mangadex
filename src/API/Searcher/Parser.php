<?php

namespace Railken\Mangadex\API\Searcher;

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
        $node = HtmlPageCrawler::create($html);

        $bag = new Bag();

        $bag->set('results', (new Collection($node->filter('.manga-entry')->each(function ($node) {
            $bag = new Bag();

            $title = $node->filter('.manga_title');

            return $bag
                ->set('uid', basename(dirname($title->attr('href'))))
                ->set('name', html_entity_decode(trim($title->html())))
                ->set('url', 'https://mangadex.org.com'.$title->attr('href'))
            ;
        })))->filter(function ($v) {
            return $v;
        })->values());

        $bag->set('page', $node->filter('.pagination > li.active a')->text());

        $query = parse_url($node->filter('.pagination > li:last-of-type a')->attr('href'), PHP_URL_QUERY);
        parse_str($query, $params);
        $bag->set('pages', $params['p']);

        return $bag;
    }
}
