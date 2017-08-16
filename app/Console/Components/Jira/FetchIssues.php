<?php

namespace App\Console\Components\Jira;

use App\Events\Jira\IssuesFetched;
use Illuminate\Console\Command;
use JiraRestApi\Issue\IssueService;
use JiraRestApi\JiraException;

class FetchIssues extends Command
{
    protected $signature = 'dashboard:fetch-issues';

    protected $description = 'Fetch team members issues from Jira';

    public function handle(IssueService $issueService)
    {
        $jql = 'project = VA AND assignee in (brandon) AND status in (Open, "In Development")';

        try {
            $response = $issueService->search($jql, 0, 3);

            event(new IssuesFetched(['brandon' => $response->issues]));

        } catch (JiraException $e) {
            $this->assertTrue(false, 'Jira Search Failed : '.$e->getMessage());
        }
    }
}
