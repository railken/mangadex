<?php

namespace Railken\Mangadex\API\Searcher;

use Illuminate\Support\Collection;
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
     * Name of resource searched.
     *
     * @var Bag
     */
    protected $name;

    /**
     * Name of author searched.
     *
     * @var Bag
     */
    protected $author;

    /**
     * Name of artist searched.
     *
     * @var Bag
     */
    protected $artist;

    /**
     * Page.
     *
     * @var Bag
     */
    protected $page;

    /**
     * Status.
     *
     * @var Bag
     */
    protected $status;

    /**
     * Tags.
     *
     * @var Bag
     */
    protected $includeTags;

    /**
     * Tags.
     *
     * @var Bag
     */
    protected $excludeTags;

    /**
     * Construct.
     *
     * @param MangadexApi $manager
     */
    public function __construct(MangadexApi $manager)
    {
        $this->manager = $manager;
        $this->name = new Bag();
        $this->author = new Bag();
        $this->artist = new Bag();
        $this->page = new Bag();
        $this->status = new Bag();
        $this->includeTags = new Bag();
        $this->excludeTags = new Bag();
        $this->includeTags->set('value', new Collection());
        $this->excludeTags->set('value', new Collection());
    }

    /**
     * Throw an exceptions if value doesn't match with suggestion.
     *
     * @param string $class
     * @param mixed  $value
     * @param array  $suggestions
     */
    public function throwExceptionInvalidValue($class, $value, $suggestions)
    {
        if (is_array($value)) {
            if (count(array_diff($value, $suggestions)) != 0) {
                throw new $class($value, $suggestions);
            }
        } else {
            if (!in_array($value, $suggestions)) {
                throw new $class($value, $suggestions);
            }
        }
    }

    /**
     * Set the name of resource searched.
     *
     * @param string $name
     *
     * @return $this
     */
    public function name($name)
    {
        $this->name
            ->set('value', $name);

        return $this;
    }

    /**
     * Retrieve name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
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
     * Set the author of resource searched.
     *
     * @param string $author
     *
     * @return $this
     */
    public function author($author)
    {
        $this->author
            ->set('value', $author);

        return $this;
    }

    /**
     * Retrieve author.
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set the artist of resource searched.
     *
     * @param string $artist
     *
     * @return $this
     */
    public function artist($artist)
    {
        $this->artist
            ->set('value', $artist);

        return $this;
    }

    /**
     * Retrieve artist.
     *
     * @return string
     */
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * @param array $tags
     */
    public function includeTags($tags)
    {
        $this->throwExceptionInvalidValue(Exceptions\BuilderInvalidTagsValueException::class, $tags, $this->getAvailableTags());

        $this->includeTags
            ->set('value', Collection::make($tags)->map(function ($tag) {
                return array_search($tag, $this->getAvailableTags());
            }));

        return $this;
    }

    /**
     * @return Bag
     */
    public function getIncludeTags()
    {
        return $this->includeTags;
    }

    /**
     * Set the status of resource searched.
     *
     * @param string $status
     *
     * @return $this
     */
    public function status($status)
    {
        $this->throwExceptionInvalidValue(Exceptions\BuilderInvalidTagsValueException::class, $status, $this->getAvailableStatus());

        $this->status
            ->set('value', array_search($status, $this->getAvailableStatus()));

        return $this;
    }

    /**
     * Retrieve status.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param array $tags
     */
    public function excludeTags($tags)
    {
        $this->throwExceptionInvalidValue(Exceptions\BuilderInvalidGenresValueException::class, $tags, $this->getAvailableTags());

        $this->excludeTags
            ->set('value', Collection::make($tags)->map(function ($tag) {
                return array_search($tag, $this->getAvailableTags());
            }));

        return $this;
    }

    /**
     * @return Bag
     */
    public function getExcludeTags()
    {
        return $this->excludeTags;
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
