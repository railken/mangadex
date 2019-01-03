<?php

namespace Railken\Mangadex\API\Searcher\Exceptions;

use Railken\Mangadex\Exceptions\InvalidArgumentException;

class BuilderInvalidNameFilterException extends InvalidArgumentException
{
    public function __construct($value = null, $suggestions = [])
    {
        return parent::__construct('name', $value, $suggestions);
    }
}
