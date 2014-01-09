# Feedable

[![Build Status](https://travis-ci.org/jyggen/feedable.png?branch=master)](https://travis-ci.org/jyggen/feedable)
[![Coverage Status](https://coveralls.io/repos/jyggen/feedable/badge.png)](https://coveralls.io/r/jyggen/feedable)
[![Total Downloads](https://poser.pugx.org/jyggen/feedable/downloads.png)](https://packagist.org/packages/jyggen/feedable)
[![Latest Stable Version](https://poser.pugx.org/jyggen/feedable/v/stable.png)](https://packagist.org/packages/jyggen/feedable)

Feedable is a simple and lightweight library which allows you to easily create RSS and Atom feeds.


## Install

Via Composer

``` json
{
    "require": {
        "jyggen/feedable": "~1.0"
    }
}
```


## Usage

First you'll have to decide which feed format you'd like to use. Feedable currently supports `Atom`, `RDF` and `RSS`.

To create a new RSS feed for example you'll have to pass an instance of `Feedable\Formatter\RSS` to `Feedable\Feed`, like this:

``` php
$feed = new Feedable\Feed(new Feedable\Formatter\RSS);
```


## Testing

``` bash
$ phpunit
```


## Credits

- [Jonas Stendahl](https://github.com/jyggen)
- [All Contributors](https://github.com/jyggen/feedable/contributors)


## License

The MIT License (MIT). Please see [License File](https://github.com/jyggen/feedable/blob/master/LICENSE) for more information.
