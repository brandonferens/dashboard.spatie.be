<?php

namespace App\Events\Uptime;

use App\Events\DashboardEvent;
use Spatie\UptimeMonitor\Models\Monitor;

class UptimeCheckSucceeded extends DashboardEvent
{
    /**
     * @var string
     */
    public $url;

    public function __construct(Monitor $monitor)
    {
        $this->url = $monitor->url->getScheme() . '://' . $monitor->url->getHost();
    }
}
