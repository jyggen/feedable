<?php
namespace Feedable\Formatter;

use DateTime;

class RSS extends AbstractFormatter
{
    public function finalize()
    {
        $this->addElement('language', 'en-US'); // @todo: configurable
        $this->addElement('sy:updatePeriod', 'hourly'); // @todo: cache aware
        $this->addElement('sy:updateFrequency', 1); // @todo: cache aware
    }

    public function getRootElement()
    {
        $this->root = $this->addElement('rss', null, array('version' => '2.0'));
        return $this->addElement('channel');
    }

    public function setBaseUrl($value)
    {
        $this->addElement('link', $value);
    }

    public function setDescription($value)
    {
        $this->addElement('description', $value);
    }

    public function setGenerator($name, $version, $uri)
    {
        $this->addElement('generator', $uri);
    }

    public function setTitle($value)
    {
        $this->addElement('title', $value);
    }

    public function setUpdatedAt(DateTime $value)
    {
        $this->addElement('lastBuildDate', $value->format(DateTime::RSS));
    }

    public function setUrl($value)
    {
        $this->addElement('atom:link', null, array('href' => $value, 'rel' => 'self', 'type' => 'application/rss+xml'));
    }
}
