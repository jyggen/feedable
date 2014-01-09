<?php
namespace Feedable\Tests\Formatter;

use DateTime;
use DOMDocument;
use Feedable\Formatter\RDF;

class RDFTest extends \PHPUnit_Framework_TestCase
{
    public function testInstantiable()
    {
        new RDF;
    }

    public function rdfProvider()
    {
        $document  = new DOMDocument;
        $formatter = new RDF;

        $document->formatOutput = true;
        $formatter->bootstrap($document);

        return array(array($formatter, $document));
    }

    /**
     * @dataProvider rdfProvider
     */
    public function testBootstrap($rdf, $document)
    {
        $output = <<<Feed
<?xml version="1.0"?>
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/">
  <channel rdf:about="http://example.com/"/>
</rdf:RDF>

Feed;

        $this->assertSame($output, $document->saveXML());
    }

    /**
     * @dataProvider rdfProvider
     */
    public function testSetBaseUrl($rdf, $document)
    {
        $output = <<<Feed
<?xml version="1.0"?>
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/">
  <channel rdf:about="http://example.com/">
    <link>foobar</link>
  </channel>
</rdf:RDF>

Feed;

        $rdf->setBaseUrl('foobar');
        $this->assertSame($output, $document->saveXML());
    }

    /**
     * @dataProvider rdfProvider
     */
    public function testSetDescription($rdf, $document)
    {
        $output = <<<Feed
<?xml version="1.0"?>
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/">
  <channel rdf:about="http://example.com/">
    <description>foobar</description>
  </channel>
</rdf:RDF>

Feed;

        $rdf->setDescription('foobar');
        $this->assertSame($output, $document->saveXML());
    }

    /**
     * @dataProvider rdfProvider
     */
    public function testSetGenerator($rdf, $document)
    {
        $output = <<<Feed
<?xml version="1.0"?>
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:admin="http://webns.net/mvcb/" xmlns="http://purl.org/rss/1.0/">
  <channel rdf:about="http://example.com/">
    <admin:generatorAgent rdf:resource="http://example.com/"/>
  </channel>
</rdf:RDF>

Feed;

        $rdf->setGenerator('1.0', 'foobar', 'http://example.com/');
        $this->assertSame($output, $document->saveXML());
    }


    /**
     * @dataProvider rdfProvider
     */
    public function testSetTitle($rdf, $document)
    {
        $output = <<<Feed
<?xml version="1.0"?>
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/">
  <channel rdf:about="http://example.com/">
    <title>foobar</title>
  </channel>
</rdf:RDF>

Feed;

        $rdf->setTitle('foobar');
        $this->assertSame($output, $document->saveXML());
    }

    /**
     * @dataProvider rdfProvider
     */
    public function testSetUpdatedAt($rdf, $document)
    {
        $date   = new DateTime;
        $format = $date->format(DateTime::ATOM);
        $output = <<<Feed
<?xml version="1.0"?>
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns="http://purl.org/rss/1.0/">
  <channel rdf:about="http://example.com/">
    <dc:date>$format</dc:date>
  </channel>
</rdf:RDF>

Feed;

        $rdf->setUpdatedAt($date);
        $this->assertSame($output, $document->saveXML());
    }

    /**
     * @dataProvider rdfProvider
     */
    public function testSetUrl($rdf, $document)
    {
        $output = <<<Feed
<?xml version="1.0"?>
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/">
  <channel rdf:about="http://example.com/"/>
</rdf:RDF>

Feed;

        $rdf->setUrl('foobar');
        $this->assertSame($output, $document->saveXML());
    }
}
