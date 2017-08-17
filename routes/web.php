<?php

use Carbon\Carbon;
use Spatie\UptimeMonitor\Events\UptimeCheckFailed;

Route::group(
    ['middleware' => 'auth.basic'], function () {
    Route::get('/', 'DashboardController@index');
}
);

Route::post('/webhook/github', 'GitHubWebhookController@gitRepoReceivedPush');

Route::get(
    '/test', function () {
    event(
        new UptimeCheckFailed(
            new \Spatie\UptimeMonitor\Models\Monitor(),
            new \Spatie\UptimeMonitor\Helpers\Period(Carbon::now(), Carbon::now())
        )
    );
}
);
