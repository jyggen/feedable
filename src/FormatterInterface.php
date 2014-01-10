<?php
namespace Feedable;

use DateTime;
use DOMDocument;

interface FormatterInterface
{
    public function addItem(ItemInterface $item);

    public function bootstrap(DOMDocument $document);

    public function finalize();

    public function getRootElement();

    public function setBaseUrl($value);

    public function setDescription($value);

    public function setGenerator($name, $version, $uri);

    public function setTitle($value);

    public function setUpdatedAt(DateTime $value);

    public function setUrl($value);
}
