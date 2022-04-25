<?php

namespace AKCybex;

class Youtube
{
    // Available Thumbnails
    const VIDEO_THUMBNAIL_0_480x360 = '0.jpg';
    const VIDEO_THUMBNAIL_1_120x90 = '1.jpg';
    const VIDEO_THUMBNAIL_2_120x90 = '2.jpg';
    const VIDEO_THUMBNAIL_3_120x90 = '3.jpg';
    const VIDEO_THUMBNAIL_DEFAULT_120x90 = 'default.jpg';
    const VIDEO_THUMBNAIL_MQ_1_320x180 = 'mq1.jpg';
    const VIDEO_THUMBNAIL_MQ_2_320x180 = 'mq2.jpg';
    const VIDEO_THUMBNAIL_MQ_3_320x180 = 'mq3.jpg';
    const VIDEO_THUMBNAIL_MQ_DEFAULT_320x180 = 'mqdefault.jpg';
    const VIDEO_THUMBNAIL_HQ_1_480x360 = 'hq1.jpg';
    const VIDEO_THUMBNAIL_HQ_2_480x360 = 'hq2.jpg';
    const VIDEO_THUMBNAIL_HQ_3_480x360 = 'hq3.jpg';
    const VIDEO_THUMBNAIL_HQ_DEFAULT_480x360 = 'hqdefault.jpg';

    // Additionally, the some other thumbnails may or may not exist.
    // Their presence is probably based on whether the video is high-quality.
    const VIDEO_THUMBNAIL_SD_1_640x480 = 'sd1.jpg';
    const VIDEO_THUMBNAIL_SD_2_640x480 = 'sd2.jpg';
    const VIDEO_THUMBNAIL_SD_3_640x480 = 'sd3.jpg';
    const VIDEO_THUMBNAIL_SD_DEFAULT_640x480 = 'sddefault.jpg';
    const VIDEO_THUMBNAIL_HQ_720_1280x720 = 'hq720.jpg';
    const VIDEO_THUMBNAIL_MAX_RES_DEFAULT_1920x1080 = 'maxresdefault.jpg';

    private $url;
    private $matches = null;

    public function __construct($url = '')
    {
        $this->url = $url;
        $this->parseUrl();
    }

    private function parseUrl()
    {
        $matches = [];
        if (preg_match("/(?:youtube(?:-nocookie)?\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|vi|shorts|e(?:mbed)?)\/|\S*?[?&]v=|\S*?[?&]vi=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/",
            $this->url, $matches)) {
            $this->matches = $matches;
        } else {
            $this->matches = null;
        }
        return $this;
    }

    public function getUrl()
    {
        if ($this->isValidUrl()) {
            return $this->matches[0];
        }

        return null;
    }

    public function setUrl($url)
    {
        $this->url = $url;
        $this->parseUrl();
    }

    public function isValidUrl()
    {
        return !is_null($this->matches);
    }

    public function getEmbeddedUrl(array $options = [])
    {
        if ($this->isValidUrl()) {
            return "https://www.youtube.com/embed/" . $this->getVideoId() . (!empty($options) ? '?' . http_build_query($options) : '');
        }
        return null;
    }

    public function getVideoId()
    {
        return isset($this->matches[1]) ? $this->matches[1] : null;
    }

    public function getVideoThumbnailUrl($thumbnail)
    {
        if ($this->isValidUrl()) {
            return "https://img.youtube.com/vi/" . $this->getVideoId() . "/" . $thumbnail;
        }
        return null;
    }
}
