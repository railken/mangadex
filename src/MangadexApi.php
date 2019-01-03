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
     * Retrieve information about a manga
     *
     * @param string $uid
     *
     * @return API\Resource\Builder
     */
    public function resource($uid)
    {
        return (new API\Resource\Builder($this))->uid($uid);
    }
}
