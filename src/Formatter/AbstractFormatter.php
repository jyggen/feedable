<?php
namespace Feedable\Formatter;

use DOMDocument;
use Feedable\FormatterInterface;
use Feedable\Node;

abstract class AbstractFormatter implements FormatterInterface
{
    protected $document;
    protected $root;

    public function bootstrap(DOMDocument $document)
    {
        $this->document = new Node($document, $document);
        $this->root     = $this->document;
        $this->root     = $this->getRootElement();
    }

    public function finalize()
    {

    }
}
