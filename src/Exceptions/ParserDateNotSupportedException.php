<?php

namespace Railken\Mangadex\Exceptions;

class ParserDateNotSupportedException extends Exception
{
    public function __construct($date)
    {
        $this->message = sprintf('Format %s not supported', $date);
    }
}
