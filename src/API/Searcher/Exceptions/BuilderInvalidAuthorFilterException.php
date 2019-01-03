<?php

namespace Railken\Mangadex\API\Searcher\Exceptions;

use Railken\Mangadex\Exceptions\InvalidArgumentException;

class BuilderInvalidAuthorFilterException extends InvalidArgumentException
{
    public function __construct($value = null, $suggestions = [])
    {
        parent::__construct('author', $value, $suggestions);
    }
}
