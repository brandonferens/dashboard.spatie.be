<?php

return [
    'projects' => env('JIRA_PROJECTS'),
    'users'    => explode(',', env('JIRA_ASSIGNEES')),
];
