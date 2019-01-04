<?php

namespace Railken\Mangadex\API\Resource;

use DateTime;
use Illuminate\Support\Collection;
use Railken\Bag;
use Railken\Mangadex\Concerns\MangadexStatus;
use Railken\Mangadex\Concerns\MangadexTags;
use Railken\Mangadex\MangadexApi;
use Wa72\HtmlPageDom\HtmlPageCrawler;

class Parser
{
    use MangadexTags;
    use MangadexStatus;
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

        $tags = $api->manga->genres;

        $bag
            ->set('url', $node->filter("meta[property='og:url']")->attr('content'))
            ->set('uid', basename($bag->get('url')))
            ->set('name', trim((string) $node->filter('.card-header')->text()))
            ->set('cover', 'https://mangadex.org'.$card->filter('.col-xl-3 img')->attr('src'))
            ->set('description', html_entity_decode($api->manga->description))
            ->set('author', $api->manga->author)
            ->set('artist', $api->manga->artist)
            ->set('aliases', $card->filter('.col-xl-9 > div:nth-of-type(1) > .col-lg-9 .list-inline-item')->each(function ($node) {
                return trim($node->text());
            }))
            ->set('contents', array_intersect_key($this->getAvailableContentTags(), array_flip($api->manga->genres)))
            ->set('formats', array_intersect_key($this->getAvailableFormatTags(), array_flip($api->manga->genres)))
            ->set('genres', array_intersect_key($this->getAvailableGenreTags(), array_flip($api->manga->genres)))
            ->set('themes', array_intersect_key($this->getAvailableThemeTags(), array_flip($api->manga->genres)))
            ->set('rating', trim((string) $node->filter('.col-xl-9 > div:nth-of-type(8) > .col-lg-9 .list-inline-item:first-child > .text-primary')->text()))
            ->set('status', $this->getAvailableStatus()[$api->manga->status])
            ->set('links', (array) $api->manga->links)
            ->set('chapters', Collection::make(isset($api->chapter) ? $api->chapter : [])->map(function ($value, $key) {
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
