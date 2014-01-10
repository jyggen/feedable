<?php
namespace Feedable\Formatter;

use DateTime;

class RDF extends AbstractFormatter
{
    public function finalize()
    {
        /*
        <rdf:Seq>
            <rdf:li rdf:resource="http://jyggen.com/projects/playback-spelforening-v3/"/>
            <rdf:li rdf:resource="http://jyggen.com/blog/internet-is-br0ken-updatez-plx/"/>
            <rdf:li rdf:resource="http://jyggen.com/code/minify-compress-your-files-on-the-fly/"/>
            <rdf:li rdf:resource="http://jyggen.com/projects/tour-4-dead/"/>
            <rdf:li rdf:resource="http://jyggen.com/projects/playback-spelforening-v-2/"/>
            <rdf:li rdf:resource="http://jyggen.com/projects/serieous-se/"/>
        </rdf:Seq>
         */

        $this->root->addElement('sy:updatePeriod', 'hourly'); // @todo: cache aware
        $this->root->addElement('sy:updateFrequency', 1); // @todo: cache aware
        $this->root->addElement('sy:updateBase', '2000-01-01T12:00+00:00');
        $this->root->addElement('items');
    }

    public function getRootElement()
    {
        return $this->root->addElement('rdf:RDF', null, array(
            'xmlns' => 'http://purl.org/rss/1.0/',
        ))->addElement('channel', null, array(
            'rdf:about' => 'http://example.com/', // @todo: use baseUrl
        ));
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
        $this->root->addElement('admin:generatorAgent', null, array(
            'rdf:resource' => $uri,
        ));
    }

    public function setTitle($value)
    {
        $this->root->addElement('title', $value);
    }

    public function setUpdatedAt(DateTime $value)
    {
        $this->root->addElement('dc:date', $value->format(DateTime::ATOM));
    }

    public function setUrl($value)
    {

    }
}
