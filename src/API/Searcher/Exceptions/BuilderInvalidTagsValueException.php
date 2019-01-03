<?php

namespace Railken\Mangadex\API\Searcher\Exceptions;

use Railken\Mangadex\Exceptions\InvalidArgumentException;

class BuilderInvalidTagsValueException extends InvalidArgumentException
{
    public function __construct($value = null, $suggestions = [])
    {
        parent::__construct('tags', implode(', ', $value), $suggestions);
    }
}
