<?php
namespace Feedable;

interface ItemInterface
{
    public function getItemAuthor();

    public function getItemCreatedAt();

    public function getItemDescription();

    public function getItemIdentifier();

    public function getItemTitle();

    public function getItemUrl();
}
