<?php

namespace Railken\Mangadex\API\Resource;

use DateTime;
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
     * @param string $api
     *
     * @return \Railken\Bag
     */
    public function parse($html, $api)
    {
        $api = json_decode($api);

        $node = HtmlPageCrawler::create($html);

        $card = $node->filter('.card-body > .row.edit');

        $bag = new Bag();
        $bag
            ->set('url', $node->filter("meta[property='og:url']")->attr('content'))
            ->set('uid', basename($bag->get('url')))
            ->set('name', trim((string) $node->filter('.card-header')->text()))
            ->set('cover', 'https://mangadex.org'.$card->filter('.col-xl-3 img')->attr('src'))
            ->set('description', html_entity_decode($api->manga->description))
            ->set('author', $api->manga->author)
            ->set('artist', $api->manga->artist)
            ->set('demographics', $card->filter('.col-xl-9 > div:nth-of-type(4) > .col-lg-9 .badge')->each(function ($node) {
                return trim($node->text());
            }))
            ->set('formats', $card->filter('.col-xl-9 > div:nth-of-type(5) > .col-lg-9 .badge')->each(function ($node) {
                return trim($node->text());
            }))
            ->set('genres', $card->filter('.col-xl-9 > div:nth-of-type(6) > .col-lg-9 .badge')->each(function ($node) {
                return trim($node->text());
            }))
            ->set('themes', $card->filter('.col-xl-9 > div:nth-of-type(7) > .col-lg-9 .badge')->each(function ($node) {
                return trim($node->text());
            }))
            ->set('aliases', $card->filter('.col-xl-9 > div:nth-of-type(1) > .col-lg-9 .list-inline-item')->each(function ($node) {
                return trim($node->text());
            }))
            ->set('rating', trim((string) $node->filter('.col-xl-9 > div:nth-of-type(8) > .col-lg-9 .list-inline-item:first-child > .text-primary')->text()))
            ->set('status', $card->filter('.col-xl-9 > div:nth-of-type(9) > .col-lg-9')->text())
            ->set('links', (array) $api->manga->links)
            ->set('chapters', Collection::make($api->chapter)->map(function ($value, $key) {
                $value->id = $key;
                $value->updated_at = (new DateTime())->setTimestamp($value->timestamp);

                return $value;
            })->filter(function ($chapter) {
                return $chapter->updated_at <= new DateTime();
            }))

            ;

        return $bag;

        return $bag;
    }
}
