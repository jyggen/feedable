<?php
namespace Feedable\Formatter;

use DateTime;

class Atom extends AbstractFormatter
{
    public function getRootElement()
    {
        return $this->addElement('feed', null, array(
            'xmlns'    => 'http://www.w3.org/2005/Atom',
            'xml:lang' => 'en-US',
            'xml:base' => 'http://example.com/', // @todo: use baseUrl
        ));
    }

    public function setBaseUrl($value)
    {
        $this->addElement('link', null, array('rel' => 'alternate', 'type' => 'text/html', 'href' => $value));
    }

    public function setDescription($value)
    {
        $this->addElement('subtitle', $value, array('type' => 'text'));
    }

    public function setGenerator($name, $version, $uri)
    {
        $this->addElement('generator', $name, array('uri' => $uri, 'version' => $version));
    }

    public function setTitle($value)
    {
        $this->addElement('title', $value, array('type' => 'text'));
    }

    public function setUpdatedAt(DateTime $value)
    {
        $this->addElement('updated', $value->format(DateTime::ATOM));
    }

    public function setUrl($value)
    {
        $this->addElement('id', $value);
        $this->addElement('link', null, array('rel' => 'self', 'type' => 'application/atom+xml', 'href' => $value));
    }
}
