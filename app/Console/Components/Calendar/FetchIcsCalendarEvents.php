<?php

namespace App\Console\Components\Calendar;

use App\Events\Calendar\IcsEventsFetched;
use Carbon\Carbon;
use DateTime;
use ICal\ICal;
use Illuminate\Console\Command;

class FetchIcsCalendarEvents extends Command
{
    protected $signature   = 'dashboard:fetch-ics-calendar-events';

    protected $description = 'Fetch events from an ICS url';

    public function handle()
    {
        $ics = new ICal(config('confluence.ics'));

        $events = collect($ics->eventsFromInterval('3 months'))
            ->map(
                function ($event) {
                    $tExists = strpos($event->dtstart, 'T');
                    $start = $tExists ? $event->dtstart : "{$event->dtstart}T000000";

                    return [
                        'name'   => $event->summary,
                        'date'   => Carbon::createFromFormat('Ymd\THis', $start, 'America/Los_Angeles')
                            ->format(DateTime::ATOM),
                        'allDay' => ! $tExists,
                    ];
                }
            )->toArray();

        event(new IcsEventsFetched($events));
    }
}
