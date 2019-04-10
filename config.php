<?php

return [
    'production' => false,
    'baseUrl' => '',
    'collections' => [],
    'versions' => [
        'master',
        '0.10',
        '0.9',
        '0.8',
        '0.7',
    ],
    'github_issues_url' => 'https://github.com/VizuaaLOG/BulmaJS/issues',
    'released_version' => '0.10.0',
    'documentation_version' => '0.10',
    'is' => function ($page, $section) {
        return str_contains($page->getPath(), $section) ? 'is-active' : '';
    },
];
