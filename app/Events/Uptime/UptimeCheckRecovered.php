<?php

namespace App\Events\Uptime;

use App\Events\DashboardEvent;
use Spatie\UptimeMonitor\Helpers\Period;
use Spatie\UptimeMonitor\Models\Monitor;

class UptimeCheckRecovered extends DashboardEvent
{
    /**
     * @var string
     */
    public $url;

    /**
     * @var string
     */
    public $startedFailingAt;

    public function __construct(Monitor $monitor, Period $downtimePeriod)
    {
        $this->url = $monitor->url->getScheme() . '://' . $monitor->url->getHost();

        $this->startedFailingAt = $downtimePeriod->startDateTime->toIso8601String();
    }
}
