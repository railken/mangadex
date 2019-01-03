<?php

namespace Railken\Mangadex\API\Resource;

use Illuminate\Support\Collection;
use Railken\Bag;
use Railken\Mangadex\Concerns\MangadexStatus;
use Railken\Mangadex\Concerns\MangadexTags;
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
     * @param int $uid
     *
     * @return $this
     */
    public function uid(int $uid)
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
     * @return Response
     */
    public function get()
    {
        $request = new Request($this->manager);

        return $request->send($this);
    }
}
