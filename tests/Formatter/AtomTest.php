<?php
namespace Feedable\Tests\Formatter;

use DOMDocument;
use Feedable\Formatter\Atom;

class AtomTest extends \PHPUnit_Framework_TestCase
{
    public function testInstantiable()
    {
        new Atom;
    }

    public function atomProvider()
    {
        $document  = new DOMDocument;
        $formatter = new Atom;

        $document->formatOutput = true;
        $formatter->bootstrap($document);

        return array(array($formatter, $document));
    }

    /**
     * @dataProvider atomProvider
     */
    public function testBootstrap($atom, $document)
    {
        $output = <<<Feed
<?xml version="1.0"?>
<feed xmlns="http://www.w3.org/2005/Atom" xml:lang="en-US" xml:base="http://example.com/"/>

Feed;

        $this->assertSame($output, $document->saveXML());
    }

    /**
     * @dataProvider atomProvider
     */
    public function testSetBaseUrl($atom, $document)
    {
        $output = <<<Feed
<?xml version="1.0"?>
<feed xmlns="http://www.w3.org/2005/Atom" xml:lang="en-US" xml:base="http://example.com/">
  <link rel="alternate" type="text/html" href="foobar"/>
</feed>

Feed;

        $atom->setBaseUrl('foobar');
        $this->assertSame($output, $document->saveXML());
    }

    /**
     * @dataProvider atomProvider
     */
    public function testSetDescription($atom, $document)
    {
        $output = <<<Feed
<?xml version="1.0"?>
<feed xmlns="http://www.w3.org/2005/Atom" xml:lang="en-US" xml:base="http://example.com/">
  <subtitle type="text">foobar</subtitle>
</feed>

Feed;

        $atom->setDescription('foobar');
        $this->assertSame($output, $document->saveXML());
    }

    /**
     * @dataProvider atomProvider
     */
    public function testSetTitle($atom, $document)
    {
        $output = <<<Feed
<?xml version="1.0"?>
<feed xmlns="http://www.w3.org/2005/Atom" xml:lang="en-US" xml:base="http://example.com/">
  <title type="text">foobar</title>
</feed>

Feed;

        $atom->setTitle('foobar');
        $this->assertSame($output, $document->saveXML());
    }

    /**
     * @dataProvider atomProvider
     */
    public function testSetUrl($atom, $document)
    {
        $output = <<<Feed
<?xml version="1.0"?>
<feed xmlns="http://www.w3.org/2005/Atom" xml:lang="en-US" xml:base="http://example.com/">
  <id>foobar</id>
  <link rel="self" type="application/atom+xml" href="foobar"/>
</feed>

Feed;

        $atom->setUrl('foobar');
        $this->assertSame($output, $document->saveXML());
    }
}
