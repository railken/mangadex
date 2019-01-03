<?php

namespace Railken\Mangadex\API\Scan;

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
     * @param Builder $builder
     *
     * @return \Illuminate\Support\Collection
     */
    public function send(Builder $builder)
    {
        $api = $this->manager->request('GET', '/api', [
            'id'   => $builder->getUid()->get('value'),
            'type' => 'chapter',
        ]);

        $parser = new Parser($this->manager);

        return $parser->parse($api);
    }
}
