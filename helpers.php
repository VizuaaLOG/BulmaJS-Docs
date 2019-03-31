<?php

function formatPageListPath($path, $version) {
    $path = str_replace('./source/docs/' . $version, '', $path);
    $path = str_replace('.md', '', $path);
    $path = str_replace('.blade', '', $path);
    return ltrim($path, '/');
}

function getPageList($version, $collection = false, $path = false) {
    if(!$path) $path = './source/docs/' . $version;
    if(!$collection) $collection = collect();

    if(file_exists($path) && is_dir($path)) {
        $result = scandir($path);
        $files = array_diff($result, array('.', '..', '.DS_Store', 'index.blade.md'));
        
        if(count($files) > 0) {
            foreach($files as $file) {
                if(is_file("$path/$file")) {
                    $collection->add(formatPageListPath($path . '/' . $file, $version));
                } else if(is_dir("$path/$file")) {
                    getPageList($version, $collection, "$path/$file");
                }
            }
        }
    }

    return $collection->map(function($path) use($version) {
        $p = explode('/', $path);
        $item = [
            'path' => '/docs/' . $version . '/' . $path,
            'category' => ucwords(str_replace('-', ' ', $p[0])),
            'page' => ucwords(str_replace('-', ' ', $p[1]))
        ];
        return (object) $item;
    })->groupBy('category');
}