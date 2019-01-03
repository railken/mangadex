<?php

namespace Railken\Mangadex\API\Searcher\Exceptions;

use Railken\Mangadex\Exceptions\InvalidArgumentException;

class BuilderInvalidAuthorFilterException extends InvalidArgumentException
{
    public function __construct($value = null, $suggestions = [])
    {
        return parent::__construct('author', $value, $suggestions);
    }
}
