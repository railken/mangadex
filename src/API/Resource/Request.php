<?php

namespace Railken\Mangadex\API\Resource;

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
        $api = $this->manager->request('GET', "/api", [
            'id' => $builder->getUid()->get('value'),
            'type' => 'manga'
        ]);

        $html = $this->manager->request('GET', sprintf("/title/%s", $builder->getUid()->get('value')), []);

        $parser = new Parser($this->manager);

        return $parser->parse($html, $api);
    }
}
