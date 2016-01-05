# CodepunkerApi

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]

A package that exploits the free web development tools API provided by [codepunker.com](https://www.codepunker.com/tools)

## Install

Via Composer

``` bash
$ composer require Codepunker/CodepunkerApi
```

## Usage

``` php
    <?php
    // Push your CSS/JS to the ServIt free CDN
    $params = [
        'base_uri'=>'https://www.codepunker.com/tools',
        'api_key'=>'glh5i4s59vsnytiu5fswwv4nr73k10y4',
        'assets'=>['https://news.ycombinator.com/news.css']
    ];
    $client = new \Codepunker\CodepunkerApi\ServIt;
    $client->setParams($params);
    $client->getToken();
    $outcome = json_decode($client->pushToCDN());

    $urls = $outcome->response; //this is a string
    ?>
```

## Change log

We'll see...

## Testing

``` bash
$ composer test
```

## Security

If you discover any security related issues, please email info@codepunker.com instead of using the issue tracker.

## Credits

- [The Codepunker](https://www.codepunker.com)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/:vendor/:package_name.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/:vendor/:package_name/master.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/:vendor/:package_name
[link-travis]: https://travis-ci.org/the-codepunker/CodepunkerApi