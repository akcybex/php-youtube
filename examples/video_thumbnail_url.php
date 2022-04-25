<?php

require_once 'constants.php';
require_once __DIR__ . '/../src/Youtube.php';

$youtube = new \AKCybex\Youtube(YOUTUBE_URL);

echo $youtube->getVideoThumbnailUrl(\AKCybex\Youtube::VIDEO_THUMBNAIL_0_480x360) . "\n";

