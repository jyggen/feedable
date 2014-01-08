<?php
namespace Feedable\Tests\Formatter;

use DateTime;
use Feedable\Feed;
use Feedable\Formatter\RDF;

class RDFTest extends \PHPUnit_Framework_TestCase
{
    public function testInstantiable()
    {
        new RDF;
    }

    public function testBootstrap()
    {
        $feed      = new Feed(new RDF);
        $generator = Feed::URI;
        $date      = DateTime::createFromFormat('Y-m-d', date('Y-m-d'))->format(DateTime::ATOM);
        $output    = <<<RSS
<?xml version="1.0" encoding="UTF-8"?>
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:admin="http://webns.net/mvcb/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:sy="http://purl.org/rss/1.0/modules/syndication/" xmlns="http://purl.org/rss/1.0/">
  <channel rdf:about="http://example.com/">
    <admin:generatorAgent rdf:resource="$generator"/>
    <dc:date>$date</dc:date>
    <sy:updatePeriod>hourly</sy:updatePeriod>
    <sy:updateFrequency>1</sy:updateFrequency>
    <sy:updateBase>2000-01-01T12:00+00:00</sy:updateBase>
    <items/>
  </channel>
</rdf:RDF>

RSS;

        $feed->formatOutput(true);
        $this->assertSame($output, $feed->render());
    }

    public function feedProvider()
    {
        return array(array(new Feed(new RDF)));
    }

    /**
     * @dataProvider feedProvider
     */
    public function testSetBaseUrl($feed)
    {
        $generator = Feed::URI;
        $date      = DateTime::createFromFormat('Y-m-d', date('Y-m-d'))->format(DateTime::ATOM);
        $output    = <<<RSS
<?xml version="1.0" encoding="UTF-8"?>
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:admin="http://webns.net/mvcb/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:sy="http://purl.org/rss/1.0/modules/syndication/" xmlns="http://purl.org/rss/1.0/">
  <channel rdf:about="http://example.com/">
    <link>foobar</link>
    <admin:generatorAgent rdf:resource="$generator"/>
    <dc:date>$date</dc:date>
    <sy:updatePeriod>hourly</sy:updatePeriod>
    <sy:updateFrequency>1</sy:updateFrequency>
    <sy:updateBase>2000-01-01T12:00+00:00</sy:updateBase>
    <items/>
  </channel>
</rdf:RDF>

RSS;

        $feed->formatOutput(true);
        $feed->setBaseUrl('foobar');
        $this->assertSame($output, $feed->render());
    }

    /**
     * @dataProvider feedProvider
     */
    public function testSetDescription($feed)
    {
        $generator = Feed::URI;
        $date      = DateTime::createFromFormat('Y-m-d', date('Y-m-d'))->format(DateTime::ATOM);
        $output    = <<<RSS
<?xml version="1.0" encoding="UTF-8"?>
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:admin="http://webns.net/mvcb/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:sy="http://purl.org/rss/1.0/modules/syndication/" xmlns="http://purl.org/rss/1.0/">
  <channel rdf:about="http://example.com/">
    <description>foobar</description>
    <admin:generatorAgent rdf:resource="$generator"/>
    <dc:date>$date</dc:date>
    <sy:updatePeriod>hourly</sy:updatePeriod>
    <sy:updateFrequency>1</sy:updateFrequency>
    <sy:updateBase>2000-01-01T12:00+00:00</sy:updateBase>
    <items/>
  </channel>
</rdf:RDF>

RSS;

        $feed->formatOutput(true);
        $feed->setDescription('foobar');
        $this->assertSame($output, $feed->render());
    }

    /**
     * @dataProvider feedProvider
     */
    public function testSetTitle($feed)
    {
        $generator = Feed::URI;
        $date      = DateTime::createFromFormat('Y-m-d', date('Y-m-d'))->format(DateTime::ATOM);
        $output    = <<<RSS
<?xml version="1.0" encoding="UTF-8"?>
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:admin="http://webns.net/mvcb/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:sy="http://purl.org/rss/1.0/modules/syndication/" xmlns="http://purl.org/rss/1.0/">
  <channel rdf:about="http://example.com/">
    <title>foobar</title>
    <admin:generatorAgent rdf:resource="$generator"/>
    <dc:date>$date</dc:date>
    <sy:updatePeriod>hourly</sy:updatePeriod>
    <sy:updateFrequency>1</sy:updateFrequency>
    <sy:updateBase>2000-01-01T12:00+00:00</sy:updateBase>
    <items/>
  </channel>
</rdf:RDF>

RSS;

        $feed->formatOutput(true);
        $feed->setTitle('foobar');
        $this->assertSame($output, $feed->render());
    }

    /**
     * @dataProvider feedProvider
     */
    public function testSetUrl($feed)
    {
        $generator = Feed::URI;
        $date      = DateTime::createFromFormat('Y-m-d', date('Y-m-d'))->format(DateTime::ATOM);
        $output    = <<<RSS
<?xml version="1.0" encoding="UTF-8"?>
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:admin="http://webns.net/mvcb/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:sy="http://purl.org/rss/1.0/modules/syndication/" xmlns="http://purl.org/rss/1.0/">
  <channel rdf:about="http://example.com/">
    <admin:generatorAgent rdf:resource="$generator"/>
    <dc:date>$date</dc:date>
    <sy:updatePeriod>hourly</sy:updatePeriod>
    <sy:updateFrequency>1</sy:updateFrequency>
    <sy:updateBase>2000-01-01T12:00+00:00</sy:updateBase>
    <items/>
  </channel>
</rdf:RDF>

RSS;

        $feed->formatOutput(true);
        $feed->setUrl('foobar');
        $this->assertSame($output, $feed->render());
    }
}
