<?php

use TightenCo\Jigsaw\Jigsaw;

/** @var $container \Illuminate\Container\Container */
/** @var $events \TightenCo\Jigsaw\Events\EventBus */

/**
 * You can run custom code at different stages of the build process by
 * listening to the 'beforeBuild', 'afterCollections', and 'afterBuild' events.
 *
 * For example:
 *
 * $events->beforeBuild(function (Jigsaw $jigsaw) {
 *     // Your code here
 * });
 */

$events->afterBuild(function (Jigsaw $jigsaw) {
    foreach($jigsaw->getOutputPaths() as $outputPath) {
        if(!str_contains($outputPath, 'assets')) {
            $currFile = ltrim($outputPath, '/') . '/index.html';
            $htmlString = $jigsaw->readOutputFile($currFile);
            $html = new DOMDocument;
            $html->loadHTML($htmlString);
            $xpath = new DOMXPath($html);

            $headings = $xpath->query('//h1 | //h2 | //h3');
            
            for($i = 0; $i < $headings->length; $i++) {
                $element = $headings->item($i);
                $sluggedValue = str_slug($element->textContent);

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
});