#!/user/bin/env php
<?php

$tags = [];

foreach (glob("_posts/*.md") as $filename) {
    $lines = file_get_contents($filename);
    preg_match("/\ntags: (.*)\n/", $lines, $match);
    if (!isset($match[1])) {
        continue;
    }
    $temp = explode(" ", $match[1]);
    foreach ($temp as $item) {
        $tag = trim($item);
        if (!in_array($tag, $tags)) {
            $tags[] = $tag;
        }
    }
}

foreach (glob("_my_tags/*.md") as $filename) {
    unlink($filename);
}

if (!is_dir('_my_tags')) {
    mkdir('_my_tags', 0700);
}

foreach ($tags as $tag) {
    $tagLow = strtolower($tag);
    $line = sprintf("---\nslug: %s\nname: %s\n---", $tagLow, $tag);
    file_put_contents("_my_tags/" . $tagLow . ".md", $line);
}
