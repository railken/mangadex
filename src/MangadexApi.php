<?php

namespace Railken\Mangadex;

class MangadexApi extends MangadexReader
{
    /**
     * Base url Mangadex.
     *
     * @var string
     */
    protected $url = 'https://mangadex.org/';

    /**
     * Retrieve base url.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Perform a search.
     *
     * @return API\Searcher\Builder
     */
    public function search()
    {
        return new API\Searcher\Builder($this);
    }

    /**
     * Search last releases.
     *
     * @return API\Releases\Builder
     */
    public function releases()
    {
        return new API\Releases\Builder($this);
    }

    /**
     * Retrieve genres available on Mangadex.
     *
     * @return array
     */
    public function getGenres()
    {
        return $this->genres;
    }
}