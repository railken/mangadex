<?php

namespace Railken\Mangadex\API\Releases;

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
        $page = $builder->getPage()->get('value');

        $results = $this->manager->request('GET', sprintf('/updates/%s', $page), []);

        $parser = new Parser($this->manager);

        return $parser->parse($results);
    }
}
