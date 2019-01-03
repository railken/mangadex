<?php

namespace Railken\Mangadex\API\Searcher\Exceptions;

use Railken\Mangadex\Exceptions\InvalidArgumentException;

class BuilderInvalidFilterException extends InvalidArgumentException
{
    public function __construct($field, $value = null, $suggestions = [])
    {
        return parent::__construct($field, $value, $suggestions);
    }
}
