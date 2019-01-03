<?php

namespace Railken\Mangadex\API\Scan;

use Railken\Bag;
use Railken\Mangadex\MangadexApi;

class Builder
{
    /**
     * @var MangadexApi
     */
    protected $manager;

    /**
     * Uid.
     *
     * @var Bag
     */
    protected $uid;

    /**
     * Construct.
     *
     * @param MangadexApi $manager
     */
    public function __construct(MangadexApi $manager)
    {
        $this->manager = $manager;
        $this->uid = new Bag();
    }

    /**
     * @param string $uid
     *
     * @return $this
     */
    public function uid(string $uid)
    {
        $this->uid
            ->set('value', $uid);

        return $this;
    }

    /**
     * @return \Railken\Bag
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * Send request.
     *
     * @return \Illuminate\Support\Collection
     */
    public function get()
    {
        $request = new Request($this->manager);

        return $request->send($this);
    }
}
