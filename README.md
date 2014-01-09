# Feedable

[![Build Status](https://travis-ci.org/jyggen/feedable.png?branch=master)](https://travis-ci.org/jyggen/feedable)
[![Coverage Status](https://coveralls.io/repos/jyggen/feedable/badge.png)](https://coveralls.io/r/jyggen/feedable)
[![Total Downloads](https://poser.pugx.org/jyggen/feedable/downloads.png)](https://packagist.org/packages/jyggen/feedable)
[![Latest Stable Version](https://poser.pugx.org/jyggen/feedable/v/stable.png)](https://packagist.org/packages/jyggen/feedable)

:package_description


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

``` php
$feedable = new Feedable\Feed(new Feedable\Formatter\RSS);
echo feedable->render();

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
