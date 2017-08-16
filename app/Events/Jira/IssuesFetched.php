<?php

namespace App\Events\Jira;

use App\Events\DashboardEvent;

class IssuesFetched extends DashboardEvent
{
    /** @var array */
    public $issues;

    public function __construct(array $issues)
    {
        $this->issues = $issues;
    }
}
