<?php
namespace Feedable;

use DateTime;
use DOMDocument;
use UnexpectedValueException;

class Feed
{
    const NAME    = 'Feedable';
    const VERSION = '1.0-dev';
    const URI     = 'http://github.com/jyggen/feedable';

    protected $document;
    protected $formatter;

    public function __construct(FormatterInterface $formatter)
    {
        $this->document  = new DOMDocument('1.0', 'UTF-8');
        $this->formatter = $formatter;

        $formatter->bootstrap($this->document);
    }

    public function addItem(ItemInterface $item)
    {
        $this->formatter->addItem($item);
    }

    public function addItemCollection(array $items)
    {
        foreach ($items as $item) {
            $this->addItem($item);
        }
    }

    public function formatOutput($formatOutput)
    {
        if (is_bool($formatOutput) === false) {
            throw new UnexpectedValueException('Argument 1 must be bool, '.gettype($formatOutput).' given');
        }

        $this->document->formatOutput = $formatOutput;
    }

    public function getDocument()
    {
        return $this->document;
    }

    public function getFormatter()
    {
        return $this->formatter;
    }

    public function render($formatOutput = false)
    {
        if (is_bool($formatOutput) === false) {
            throw new UnexpectedValueException('Argument 1 must be bool, '.gettype($formatOutput).' given');
        }

        $this->document->formatOutput = $formatOutput;

        $this->formatter->setGenerator(Feed::NAME, Feed::VERSION, Feed::URI);
        $this->formatter->setUpdatedAt(new DateTime);
        $this->formatter->finalize();
        $this->document->normalizeDocument();
        return $this->document->saveXML();
    }

    public function setBaseUrl($value)
    {
        $this->formatter->setBaseUrl($value);
    }

    public function setDescription($value)
    {
        $this->formatter->setDescription($value);
    }

    public function setTitle($value)
    {
        $this->formatter->setTitle($value);
    }

    public function setUrl($value)
    {
        $this->formatter->setUrl($value);
    }
}
