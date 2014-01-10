<?php
namespace Feedable\Tests;

use DOMDocument;
use DOMNode;
use Feedable\Node;

class NodeTest extends \PHPUnit_Framework_TestCase
{
    public function testInstantiable()
    {
        new Node(new DOMNode, new DOMDocument);
    }

    public function nodeProvider()
    {
        $document = new DOMDocument;
        $document->formatOutput = true;
        return array(array(new Node($document, $document), $document));
    }

    /**
     * @dataProvider nodeProvider
     */
    public function testAddElement($class, $document)
    {
        $output = <<<FEED
<?xml version="1.0"?>
<foo/>

FEED;

        $class->addElement('foo');
        $this->assertSame($output, $document->saveXML());
    }

    /**
     * @dataProvider nodeProvider
     */
    public function testAddElementInNamespace($class, $document)
    {
        $output = <<<FEED
<?xml version="1.0"?>
<sy:foo xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"/>

FEED;

        $class->addElement('sy:foo');
        $this->assertSame($output, $document->saveXML());
    }

    /**
     * @dataProvider nodeProvider
     */
    public function testAddElementWithValue($class, $document)
    {
        $output = <<<FEED
<?xml version="1.0"?>
<foo>bar</foo>

FEED;

        $class->addElement('foo', 'bar');
        $this->assertSame($output, $document->saveXML());
    }

    /**
     * @dataProvider nodeProvider
     */
    public function testAddElementWithEscapedValue($class, $document)
    {
        $output = <<<FEED
<?xml version="1.0"?>
<foo><![CDATA[bar]]></foo>

FEED;

        $class->addElement('foo', 'bar', array(), true);
        $this->assertSame($output, $document->saveXML());
    }

    /**
     * @dataProvider nodeProvider
     */
    public function testAddElementWithAttributes($class, $document)
    {
        $output = <<<FEED
<?xml version="1.0"?>
<foo baz="qux">bar</foo>

FEED;

        $class->addElement('foo', 'bar', array('baz' => 'qux'));
        $this->assertSame($output, $document->saveXML());
    }

    /**
     * @dataProvider nodeProvider
     */
    public function testAddElementWithNamespacedAttributes($class, $document)
    {
        $output = <<<FEED
<?xml version="1.0"?>
<foo xmlns:sy="http://purl.org/rss/1.0/modules/syndication/" sy:baz="qux">bar</foo>

FEED;

        $class->addElement('foo', 'bar', array('sy:baz' => 'qux'));
        $this->assertSame($output, $document->saveXML());
    }

    /**
     * @dataProvider nodeProvider
     */
    public function testAddElementWithBoolAttributes($class, $document)
    {
        $output = <<<FEED
<?xml version="1.0"?>
<foo baz="true" qux="false">bar</foo>

FEED;

        $class->addElement('foo', 'bar', array('baz' => true, 'qux' => false));
        $this->assertSame($output, $document->saveXML());
    }

    /**
     * @dataProvider nodeProvider
     */
    public function testAddElementReturnNode($class, $document)
    {
        $this->assertInstanceOf('Feedable\Node', $class->addElement('foo'));
    }

    /**
     * @dataProvider nodeProvider
     * @expectedException Feedable\Exception\UnresolvableNamespaceException
     */
    public function testAddElementWithUnresolvableNamespace($class, $document)
    {
        $class->addElement('foo:bar');
    }

    /**
     * @dataProvider nodeProvider
     */
    public function testAddElementToChild($class, $document)
    {
        $output = <<<FEED
<?xml version="1.0"?>
<foo>
  <bar/>
</foo>

FEED;

        $class->addElement('foo')->addElement('bar');
        $this->assertSame($output, $document->saveXML());
    }

    /**
     * @dataProvider nodeProvider
     */
    public function testAddElementInNamespaceSecondLevel($class, $document)
    {
        $output = <<<FEED
<?xml version="1.0"?>
<foo xmlns:sy="http://purl.org/rss/1.0/modules/syndication/">
  <sy:bar/>
</foo>

FEED;

        $class->addElement('foo')->addElement('sy:bar');
        $this->assertSame($output, $document->saveXML());
    }
}
