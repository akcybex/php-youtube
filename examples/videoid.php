<?php

require_once 'constants.php';
require_once __DIR__ . '/../src/Youtube.php';

$youtube = new \AKCybex\Youtube(YOUTUBE_URL);

echo $youtube->getVideoId() . "\n";
