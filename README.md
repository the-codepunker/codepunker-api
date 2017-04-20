# CodepunkerApi

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]

A package that exploits the free web development tools API provided by [codepunker.com](https://www.codepunker.com/tools)
Currently the Uglify API is the only one that is available through this package.

## Install

Via Composer

``` bash
$ composer require codepunker/codepunkerapi
```

## Usage

``` php
    <?php
    //1. How to compile/minify CSS/JS/LESS/SASS code optionally 
        $keys = parse_ini_file(__DIR__ . '/../src/Config/config.ini');
        $key = $keys['api_key'];
        $params = [
            'base_uri'=>'https://www.codepunker.com/tools',
            'api_key'=>$key,
            'assets'=>[
                'https://www.codepunker.com/url_to_some_js_or_css_or_less_or_sass_file',
                'https://www.codepunker.com/url_to_another_js_or_css_or_less_or_sass_file'
            ],
            'language'=>'JavaScript', //language of the above files. valid values: 'JavaScript' or 'CSS' or 'LESS' or 'SASS'
        ];
        $client = new \Codepunker\CodepunkerApi\Uglify;
        $client->setParams($params);
        $client->getToken();
        $outcome = $client->uglify(); //this is a string
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
TEST

## Credits

- [The Codepunker](https://www.codepunker.com)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/codepunker/codepunkerapi.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/the-codepunker/codepunker-api/master.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/codepunker/codepunkerapi
[link-travis]: https://travis-ci.org/the-codepunker/codepunker-api
