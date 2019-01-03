<?php

namespace Railken\Mangadex\API\Releases;

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
     * @param string $html
     *
     * @return \Railken\Bag
     */
    public function parse($html)
    {
        $node = HtmlPageCrawler::create($html);

        $bag = new Bag();

        $bag->set('results', Collection::make($node->filter('.table-responsive .manga_title ')->each(function ($node) {
            $bag = new Bag();

            $title = $node;

            return $bag
                ->set('uid', basename(dirname($title->attr('href'))))
                ->set('name', html_entity_decode(trim($title->html())))
                ->set('url', 'https://mangadex.org.com'.$title->attr('href'))
                ->set('updated_at', new \DateTime($node->parents()->parents()->parents()->nextAll()->filter('time')->attr('datetime')))
            ;
        })));

        $bag->set('page', $node->filter('.pagination > li.active a')->text());

        $bag->set('pages', str_replace('/', '', str_replace('updates', '', (string) $node->filter('.pagination > li:last-of-type a')->attr('href'))));

        return $bag;
    }
}
