<?php

namespace App\Listeners;

use IvoPetkov\HTML5DOMDocument;
use DOMXPath;
use TightenCo\Jigsaw\Jigsaw;
use Illuminate\Support\Str;

class GenerateHeadingAnchors {
    public function handle(Jigsaw $jigsaw)
    {
        foreach($jigsaw->getOutputPaths() as $outputPath) {
            if(!Str::contains($outputPath, 'assets')) {
                $currFile = ltrim($outputPath, '/') . '/index.html';
                $htmlString = $jigsaw->readOutputFile($currFile);
                $html = new HTML5DOMDocument;
                $html->loadHTML($htmlString, HTML5DOMDocument::ALLOW_DUPLICATE_IDS);
                $xpath = new DOMXPath($html);

                $headings = $xpath->query('//h1 | //h2 | //h3');

                for($i = 0; $i < $headings->length; $i++) {
                    $element = $headings->item($i);
                    $sluggedValue = Str::slug($element->textContent);

                    $newId = $html->createAttribute('id');
                    $newId->value = $sluggedValue;

                    $linkIcon = $html->createElement('span');
                    $linkClass = $html->createAttribute('class');
                    $linkClass->value = 'fas fa-link fa-fw';
                    $linkIcon->appendChild($linkClass);

                    $newAnchor = $html->createElement('a');
                    $anchorLink = $html->createAttribute('href');
                    $anchorLink->value = '#' . $sluggedValue;
                    $newAnchor->appendChild($anchorLink);
                    $newAnchor->appendChild($linkIcon);

                    $element->appendChild($newId);
                    $element->insertBefore($newAnchor, $element->firstChild);
                }

                $jigsaw->writeOutputFile($currFile, $html->saveHTML());
            }
        }
    }
}