<?php
namespace Feedable\Formatter;

use DateTime;
use Feedable\ItemInterface;

class RSS extends AbstractFormatter
{
    public function addItem(ItemInterface $item)
    {
        $node = $this->root->addElement('item');
        $node->addElement('title', $item->getItemTitle());
        $node->addElement('link', $item->getItemUrl());
        $node->addElement('pubDate', $item->getItemCreatedAt());
        $node->addElement('dc:creator', $item->getItemAuthor(), array(), true);
        $node->addElement('guid', $item->getItemIdentifier(), array(
            'isPermaLink' => false,
        ));
        $node->addElement('description', $item->getItemDescription(), array(), true);
        $node->addElement('content:encoded', $item->getItemDescription(), array(), true);
    }

    public function finalize()
    {
        $this->root->addElement('language', 'en-US'); // @todo: configurable
        $this->root->addElement('sy:updatePeriod', 'hourly'); // @todo: cache aware
        $this->root->addElement('sy:updateFrequency', 1); // @todo: cache aware
    }

    public function getRootElement()
    {
        return $this->document->addElement('rss', null, array(
            'version' => '2.0',
        ))->addElement('channel');
    }

    public function setBaseUrl($value)
    {
        $this->root->addElement('link', $value);
    }

    public function setDescription($value)
    {
        $this->root->addElement('description', $value);
    }

    public function setGenerator($name, $version, $uri)
    {
        $this->root->addElement('generator', $uri);
    }

    public function setTitle($value)
    {
        $this->root->addElement('title', $value);
    }

    public function setUpdatedAt(DateTime $value)
    {
        $this->root->addElement('lastBuildDate', $value->format(DateTime::RSS));
    }

    public function setUrl($value)
    {
        $this->root->addElement('atom:link', null, array(
            'href' => $value,
            'rel'  => 'self',
            'type' => 'application/rss+xml',
        ));
    }
}
