<?php

namespace Railken\Mangadex\Concerns;

trait MangadexStatus
{
    protected $availableStatus = [
        1 => 'Ongoing',
        2 => 'Completed',
        3 => 'Cancelled',
        4 => 'Hiatus',
    ];

    public function getAvailableStatus()
    {
        return $this->availableStatus;
    }
}
