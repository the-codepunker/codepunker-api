# CodepunkerApi

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]

A package that exploits the free web development tools API provided by [codepunker.com](https://www.codepunker.com/tools)
Currently the ServIt and the Uglify API are the only ones that are available through this package.

## Install

Via Composer

``` bash
$ composer require codepunker/codepunkerapi
```

## Usage

``` php
    <?php
    //1. How to push your CSS/JS to the ServIt free CDN
        $config = parse_ini_file(__DIR__ . '/path/to/src/Config/config.ini');
        $key = $config['api_key'];

        $params = [
            'base_uri'=>'https://www.codepunker.com/tools',
            'api_key'=>$key,
            'assets'=>['https://news.ycombinator.com/news.css']
        ];
        $client = new \Codepunker\CodepunkerApi\ServIt;
        $client->setParams($params);
        $client->getToken();
        $outcome = json_decode($client->pushToCDN());

        $urls = $outcome->response; //this is a string

    //2. How to compile/minify CSS/JS/LESS/SASS code optionally pushing it to the
    //ServIt free CDN
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
            'pushtocdn'=>'true', //string 'true' or 'false'
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

## Credits

- [The Codepunker](https://www.codepunker.com)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/codepunker/codepunkerapi.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/the-codepunker/codepunker-api/master.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/codepunker/codepunkerapi
[link-travis]: https://travis-ci.org/the-codepunker/codepunker-api