<?php

require_once 'constants.php';
require_once __DIR__ . '/../src/Youtube.php';

$youtube = new \AKCybex\Youtube(YOUTUBE_URL);

// without options
echo $youtube->getEmbeddedUrl() . "\n";

// with options
echo $youtube->getEmbeddedUrl(['autoplay' => 1]) . "\n";
