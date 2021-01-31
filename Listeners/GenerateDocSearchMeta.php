<?php

namespace App\Listeners;

use IvoPetkov\HTML5DOMDocument;
use TightenCo\Jigsaw\Jigsaw;
use Illuminate\Support\Str;

class GenerateDocSearchMeta {
    public function handle(Jigsaw $jigsaw)
    {
        foreach($jigsaw->getOutputPaths() as $outputPath) {
            if(!Str::contains($outputPath, 'assets')) {
                $currFile = ltrim($outputPath, '/') . '/index.html';
                $htmlString = $jigsaw->readOutputFile($currFile);
                $html = new HTML5DOMDocument;
                $html->loadHTML($htmlString, HTML5DOMDocument::ALLOW_DUPLICATE_IDS);

                if(!Str::contains($outputPath, 'blog') && Str::contains($outputPath, '/docs')) {
                    $version = [];
                    preg_match('/docs\/(?:(\d+)\.)?(?:(\d+)\.)?(\*|\d+)/', $outputPath, $version);

                    if(empty($version)) {
                        $version = 'master';
                    } else {
                        $version = str_replace('docs/', '', $version[0]);
                    }
                } else {
                    $version = 'master';
                }

                $head = $html->getElementsByTagName('head')->item(0);
                $meta = $html->createElement('meta');

                $nameAttr = $html->createAttribute('name');
                $nameAttr->value = 'docsearch:version';

                $contentAttr = $html->createAttribute('content');
                $contentAttr->value = $version;

                $meta->appendChild($nameAttr);
                $meta->appendChild($contentAttr);

                if(!is_null($head)) {
                    $head->appendChild($meta);
                }

                $jigsaw->writeOutputFile($currFile, $html->saveHTML());
            }
        }
    }
}