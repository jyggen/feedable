<?php
namespace Feedable\Formatter;

use DOMDocument;
use Feedable\Exception\UnresolvableNamespaceException;
use Feedable\FormatterInterface;

abstract class AbstractFormatter implements FormatterInterface
{
    protected $document;
    protected $namespaces = array(
        'admin' => 'http://webns.net/mvcb/',
        'atom'  => 'http://www.w3.org/2005/Atom',
        'dc'    => 'http://purl.org/dc/elements/1.1/',
        'rdf'   => 'http://www.w3.org/1999/02/22-rdf-syntax-ns#',
        'sy'    => 'http://purl.org/rss/1.0/modules/syndication/',
        'xml'   => 'http://www.w3.org/XML/1998/namespace',
    );
    protected $root;

    public function bootstrap(DOMDocument $document)
    {
        $this->document = $document;
        $this->root     = $this->document;
        $this->root     = $this->getRootElement();
    }

    public function finalize()
    {

    }

    protected function addElement($tag, $value = null, $attributes = array(), $escape = false)
    {

        $element = $this->document->createElement($tag);
        $this->root->appendChild($element);

        if (strpos($tag, ':') !== false) {
            $parts     = explode(':', $tag);
            $namespace = $this->resolveNamespace($parts[0]);
            $this->document->createAttributeNS($namespace, $tag);
        }

        if ($value !== null) {
            if ($escape === true) {
                $node = $this->document->createCDATASection($value);
            } else {
                $node = $this->document->createTextNode($value);
            }
            $element->appendChild($node);
        }

        if (empty($attributes) === false) {
            foreach ($attributes as $attribute => $value) {
                if ($value === true) {
                    $value = 'true';
                }
                if ($value === false) {
                    $value = 'false';
                }

                if (strpos($attribute, ':') !== false) {
                    $parts     = explode(':', $attribute);
                    $namespace = $this->resolveNamespace($parts[0]);
                    $attribute = $this->document->createAttributeNS($namespace, $attribute);
                } else {
                    $attribute = $this->document->createAttribute($attribute);
                }

                $attribute->value = $value;
                $element->appendChild($attribute);
            }
        }

        return $element;
    }

    protected function resolveNamespace($namespace)
    {
        if (isset($this->namespaces[$namespace]) === false) {
            throw new UnresolvableNamespaceException('Unable to resolve namespace with prefix "'.$namespace.'".');
        }

        return $this->namespaces[$namespace];
    }
}
