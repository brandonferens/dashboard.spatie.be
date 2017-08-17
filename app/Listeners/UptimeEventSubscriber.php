<?php

namespace App\Listeners;

use App\Events\Event;
use App\Events\Uptime\UptimeCheckFailed;
use App\Events\Uptime\UptimeCheckSucceeded;
use Illuminate\Events\Dispatcher;

class UptimeEventSubscriber
{
    /**
     * @param $event
     */
    public function uptimeCheckFailed($event)
    {
        event(new UptimeCheckFailed($event->monitor, $event->downtimePeriod));
    }

    /**
     * @param $event
     */
    public function uptimeCheckRecovered($event)
    {
        event(new UptimeCheckRecovered($event->monitor, $event->downtimePeriod));
    }

    /**
     * @param $event
     */
    public function uptimeCheckSucceeded($event)
    {
        event(new UptimeCheckSucceeded($event->monitor));
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe(Dispatcher $events)
    {
        $events->listen(\Spatie\UptimeMonitor\Events\UptimeCheckFailed::class, 'App\Listeners\UptimeEventSubscriber@uptimeCheckFailed');
        $events->listen(\Spatie\UptimeMonitor\Events\UptimeCheckRecovered::class, 'App\Listeners\UptimeEventSubscriber@uptimeCheckRecovered');
        $events->listen(\Spatie\UptimeMonitor\Events\UptimeCheckSucceeded::class, 'App\Listeners\UptimeEventSubscriber@uptimeCheckSucceeded');
    }
}
