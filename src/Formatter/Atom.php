<?php
namespace Feedable\Formatter;

use DateTime;
use Feedable\ItemInterface;

class Atom extends AbstractFormatter
{
    public function addItem(ItemInterface $item)
    {
    }

    public function getRootElement()
    {
        return $this->root->addElement('feed', null, array(
            'xmlns'    => 'http://www.w3.org/2005/Atom',
            'xml:lang' => 'en-US',
            'xml:base' => 'http://example.com/', // @todo: use baseUrl
        ));
    }

    public function setBaseUrl($value)
    {
        $this->root->addElement('link', null, array(
            'rel'  => 'alternate',
            'type' => 'text/html',
            'href' => $value,
        ));
    }

    public function setDescription($value)
    {
        $this->root->addElement('subtitle', $value, array(
            'type' => 'text',
        ));
    }

    public function setGenerator($name, $version, $uri)
    {
        $this->root->addElement('generator', $name, array(
            'uri'     => $uri,
            'version' => $version,
        ));
    }

    public function setTitle($value)
    {
        $this->root->addElement('title', $value, array(
            'type' => 'text',
        ));
    }

    public function setUpdatedAt(DateTime $value)
    {
        $this->root->addElement('updated', $value->format(DateTime::ATOM));
    }

    public function setUrl($value)
    {
        $this->root->addElement('id', $value);
        $this->root->addElement('link', null, array(
            'rel'  => 'self',
            'type' => 'application/atom+xml',
            'href' => $value,
        ));
    }
}
