<?php

namespace Railken\Mangadex\Exceptions;

class ScanBuilderInvalidUrlException extends Exception
{
    public function __construct($url, $suggestion)
    {
        $this->message = sprintf("invalid value '%s' for method %s(), e.g (%s)", $url, 'url', $suggestion);
    }
}
