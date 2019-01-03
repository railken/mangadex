<?php

namespace Railken\Mangadex\API\Searcher;

use Railken\Mangadex\MangadexApi;

class Request
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
     * Send the request for the research.
     *
     * @param MangadexSearchBuilder $builder
     *
     * @return MangadexSearchResponse
     */
    public function send(Builder $builder)
    {
        $params = [];

        // Page
        $params['p'] = $builder->getPage()->get('value');

        // Name
        $params['title'] = str_replace('%20', ' ', $builder->getName()->get('value'));

        // Author
        $params['author'] = $builder->getAuthor()->get('value');

        // Artist
        $params['artist'] = $builder->getArtist()->get('value');

        // Tags
        $params['tags_inc'] = $builder->getIncludeTags()->get('value')->implode(',');
        $params['tags_exc'] = $builder->getExcludeTags()->get('value')->implode(',');
        $params['status'] = $builder->getStatus()->get('value');

        $query = http_build_query($params, null, '&');

        $results = $this->manager->request('GET', '/search', $query);

        $parser = new Parser($this->manager);

        return $parser->parse($results);
    }
}
