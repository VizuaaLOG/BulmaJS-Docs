<?php

return array_merge([
    'production' => true,
    'baseUrl' => 'https://bulmajs.tomerbe.co.uk',
    'collections' => [
        'posts' => [
            'path' => 'blog/{published_date|Y-m}/{filename}',
            'author' => 'VizuaaLOG (Tom)'
        ]
    ],
    'github_issues_url' => 'https://github.com/VizuaaLOG/BulmaJS/issues',
    'is' => function ($page, $section) {
        return str_contains($page->getPath(), $section) ? 'is-active' : '';
    },
], require('./versions.config.php'));
