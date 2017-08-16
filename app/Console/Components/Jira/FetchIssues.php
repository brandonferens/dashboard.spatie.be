<?php

namespace App\Console\Components\Jira;

use App\Events\Jira\IssuesFetched;
use Illuminate\Console\Command;
use JiraRestApi\Issue\IssueService;
use JiraRestApi\JiraException;

class FetchIssues extends Command
{
    protected $signature   = 'dashboard:fetch-issues';

    protected $description = 'Fetch team members issues from Jira';

    public function handle(IssueService $issueService)
    {
        $projects = config('jira.projects');

        foreach (config('jira.users') as $user) {
            try {
                $jql = "project in ({$projects}) AND assignee in ({$user}) AND status in (Open, \"In Progress\", \"Waiting for QA\", \"In QA Review\", \"In Development\")";

                $response = $issueService->search($jql, 0, 3);

                $issues[$user] = $this->formatResponse($response->issues);
            } catch (JiraException $e) {
                dd('Jira Search Failed : ' . $e->getMessage());
            } finally {
                event(new IssuesFetched($issues ?? []));
            }
        }
    }

    private function formatResponse($issues)
    {
        return collect($issues)
            ->map(
                function ($issue) {
                    return [
                        'key'     => $issue->key,
                        'summary' => $issue->fields->summary,
                    ];
                }
            )
            ->toArray();
    }
}
