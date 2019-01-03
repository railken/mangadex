<?php

namespace Railken\Mangadex\Exceptions;

class InvalidArgumentException extends Exception
{
    public function __construct($field, $value = null, $suggestions = [])
    {
        parent::__construct(sprintf("invalid value '%s' for method %s(), expects: ".implode(', ', $suggestions).'', $value, $field));
    }
}
