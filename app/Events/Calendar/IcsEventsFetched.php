<?php

namespace App\Events\Calendar;

use App\Events\DashboardEvent;

class IcsEventsFetched extends DashboardEvent
{
    /** @var array */
    public $events;

    public function __construct(array $events)
    {
        $this->events = $events;
    }
}
