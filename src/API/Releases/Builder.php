<?php

namespace Railken\Mangadex\API\Releases;

use Railken\Bag;
use Railken\Mangadex\Concerns\MangadexStatus;
use Railken\Mangadex\Concerns\MangadexTags;
use Railken\Mangadex\MangadexApi;

class Builder
{
    use MangadexTags;
    use MangadexStatus;

    /**
     * @var MangadexApi
     */
    protected $manager;

    /**
     * Page.
     *
     * @var Bag
     */
    protected $page;

    /**
     * Construct.
     *
     * @param MangadexApi $manager
     */
    public function __construct(MangadexApi $manager)
    {
        $this->manager = $manager;
        $this->page = new Bag(['value' => 1]);
    }

    /**
     * @param int $page
     *
     * @return $this
     */
    public function page(int $page)
    {
        $this->page
            ->set('value', $page);

        return $this;
    }

    /**
     * @return \Railken\Bag
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Send request.
     *
     * @return \Railken\Bag
     */
    public function get()
    {
        $request = new Request($this->manager);

        return $request->send($this);
    }
}
