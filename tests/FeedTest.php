<?php
namespace Feedable\Tests;

use DateTime;
use Feedable\Feed;
use Feedable\Formatter\RSS;

class FeedTest extends \PHPUnit_Framework_TestCase
{
    public function testInstantiable()
    {
        new Feed(new RSS);
    }

    public function feedProvider()
    {
        return array(array(new Feed(new RSS)));
    }

    /**
     * @dataProvider feedProvider
     */
    public function testGetDocument($feed)
    {
        $this->assertInstanceOf('DOMDocument', $feed->getDocument());
    }

    /**
     * @dataProvider feedProvider
     */
    public function testGetFormatter($feed)
    {
        $this->assertInstanceOf('Feedable\Formatter\RSS', $feed->getFormatter());
    }

    /**
     * @dataProvider feedProvider
     */
    public function testRender($feed)
    {
        $generator = Feed::URI;
        $date      = DateTime::createFromFormat('Y-m-d', date('Y-m-d'))->format(DateTime::RSS);
        $output    = <<<RSS
<?xml version="1.0" encoding="UTF-8"?>
<rss xmlns:sy="http://purl.org/rss/1.0/modules/syndication/" version="2.0">
  <channel>
    <generator>$generator</generator>
    <lastBuildDate>$date</lastBuildDate>
    <language>en-US</language>
    <sy:updatePeriod>hourly</sy:updatePeriod>
    <sy:updateFrequency>1</sy:updateFrequency>
  </channel>
</rss>

RSS;

        $this->assertSame($output, $feed->render(true));
    }

    /**
     * @dataProvider feedProvider
     */
    public function testSetBaseUrl($feed)
    {
        $generator = Feed::URI;
        $date      = DateTime::createFromFormat('Y-m-d', date('Y-m-d'))->format(DateTime::RSS);
        $output    = <<<RSS
<?xml version="1.0" encoding="UTF-8"?>
<rss xmlns:sy="http://purl.org/rss/1.0/modules/syndication/" version="2.0">
  <channel>
    <link>foobar</link>
    <generator>$generator</generator>
    <lastBuildDate>$date</lastBuildDate>
    <language>en-US</language>
    <sy:updatePeriod>hourly</sy:updatePeriod>
    <sy:updateFrequency>1</sy:updateFrequency>
  </channel>
</rss>

RSS;

        $feed->setBaseUrl('foobar');
        $this->assertSame($output, $feed->render(true));
    }

    /**
     * @dataProvider feedProvider
     */
    public function testSetDescription($feed)
    {
        $generator = Feed::URI;
        $date      = DateTime::createFromFormat('Y-m-d', date('Y-m-d'))->format(DateTime::RSS);
        $output    = <<<RSS
<?xml version="1.0" encoding="UTF-8"?>
<rss xmlns:sy="http://purl.org/rss/1.0/modules/syndication/" version="2.0">
  <channel>
    <description>foobar</description>
    <generator>$generator</generator>
    <lastBuildDate>$date</lastBuildDate>
    <language>en-US</language>
    <sy:updatePeriod>hourly</sy:updatePeriod>
    <sy:updateFrequency>1</sy:updateFrequency>
  </channel>
</rss>

RSS;

        $feed->setDescription('foobar');
        $this->assertSame($output, $feed->render(true));
    }

    /**
     * @dataProvider feedProvider
     */
    public function testSetTitle($feed)
    {
        $generator = Feed::URI;
        $date      = DateTime::createFromFormat('Y-m-d', date('Y-m-d'))->format(DateTime::RSS);
        $output    = <<<RSS
<?xml version="1.0" encoding="UTF-8"?>
<rss xmlns:sy="http://purl.org/rss/1.0/modules/syndication/" version="2.0">
  <channel>
    <title>foobar</title>
    <generator>$generator</generator>
    <lastBuildDate>$date</lastBuildDate>
    <language>en-US</language>
    <sy:updatePeriod>hourly</sy:updatePeriod>
    <sy:updateFrequency>1</sy:updateFrequency>
  </channel>
</rss>

RSS;

        $feed->setTitle('foobar');
        $this->assertSame($output, $feed->render(true));
    }

    /**
     * @dataProvider feedProvider
     */
    public function testSetUrl($feed)
    {
        $generator = Feed::URI;
        $date      = DateTime::createFromFormat('Y-m-d', date('Y-m-d'))->format(DateTime::RSS);
        $output    = <<<RSS
<?xml version="1.0" encoding="UTF-8"?>
<rss xmlns:atom="http://www.w3.org/2005/Atom" xmlns:sy="http://purl.org/rss/1.0/modules/syndication/" version="2.0">
  <channel>
    <atom:link href="foobar" rel="self" type="application/rss+xml"/>
    <generator>$generator</generator>
    <lastBuildDate>$date</lastBuildDate>
    <language>en-US</language>
    <sy:updatePeriod>hourly</sy:updatePeriod>
    <sy:updateFrequency>1</sy:updateFrequency>
  </channel>
</rss>

RSS;

        $feed->setUrl('foobar');
        $this->assertSame($output, $feed->render(true));
    }
}
