<?php

namespace App\Listeners;

use samdark\sitemap\Sitemap;
use TightenCo\Jigsaw\Jigsaw;
use Illuminate\Support\Str;

class GenerateSitemap {
    public function handle(Jigsaw $jigsaw)
    {
        $baseUrl = $jigsaw->getConfig('baseUrl');
        $sitemap = new Sitemap($jigsaw->getDestinationPath() . '/sitemap.xml');

        collect($jigsaw->getOutputPaths())
            ->each(function($path) use ($baseUrl, $sitemap) {
                if(!Str::startsWith($path, '/assets')) {
                    $path = str_replace('\\', '/', $path);
                    $path = !Str::startsWith($path, '/') ? '/' . $path : $path;

                    $sitemap->addItem($baseUrl . $path, time(), Sitemap::DAILY);
                }
            });

        $sitemap->write();
    }
}